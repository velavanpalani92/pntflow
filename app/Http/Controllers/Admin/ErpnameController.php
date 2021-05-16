<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyErpnameRequest;
use App\Http\Requests\StoreErpnameRequest;
use App\Http\Requests\UpdateErpnameRequest;
use App\Models\Erpname;
use App\Models\Zone;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ErpnameController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('erpname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Erpname::with(['zone'])->select(sprintf('%s.*', (new Erpname())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'erpname_show';
                $editGate = 'erpname_edit';
                $deleteGate = 'erpname_delete';
                $crudRoutePart = 'erpnames';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('erpname', function ($row) {
                return $row->erpname ? $row->erpname : '';
            });
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Erpname::STATUS_SELECT[$row->status] : '';
            });
            $table->addColumn('zone_zone', function ($row) {
                return $row->zone ? $row->zone->zone : '';
            });

            $table->editColumn('zone.region', function ($row) {
                return $row->zone ? (is_string($row->zone) ? $row->zone : $row->zone->region) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'zone']);

            return $table->make(true);
        }

        return view('admin.erpnames.index');
    }

    public function create()
    {
        abort_if(Gate::denies('erpname_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zones = Zone::all()->pluck('zone', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.erpnames.create', compact('zones'));
    }

    public function store(StoreErpnameRequest $request)
    {
        $erpname = Erpname::create($request->all());

        return redirect()->route('admin.erpnames.index');
    }

    public function edit(Erpname $erpname)
    {
        abort_if(Gate::denies('erpname_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zones = Zone::all()->pluck('zone', 'id')->prepend(trans('global.pleaseSelect'), '');

        $erpname->load('zone');

        return view('admin.erpnames.edit', compact('zones', 'erpname'));
    }

    public function update(UpdateErpnameRequest $request, Erpname $erpname)
    {
        $erpname->update($request->all());

        return redirect()->route('admin.erpnames.index');
    }

    public function show(Erpname $erpname)
    {
        abort_if(Gate::denies('erpname_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $erpname->load('zone', 'erpOutwards');

        return view('admin.erpnames.show', compact('erpname'));
    }

    public function destroy(Erpname $erpname)
    {
        abort_if(Gate::denies('erpname_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $erpname->delete();

        return back();
    }

    public function massDestroy(MassDestroyErpnameRequest $request)
    {
        Erpname::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
