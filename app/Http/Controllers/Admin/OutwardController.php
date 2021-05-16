<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOutwardRequest;
use App\Http\Requests\StoreOutwardRequest;
use App\Http\Requests\UpdateOutwardRequest;
use App\Models\Category;
use App\Models\Erpname;
use App\Models\Instock;
use App\Models\Outward;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OutwardController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('outward_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Outward::with(['erp', 'serialno', 'category', 'status'])->select(sprintf('%s.*', (new Outward())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'outward_show';
                $editGate = 'outward_edit';
                $deleteGate = 'outward_delete';
                $crudRoutePart = 'outwards';

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
            $table->addColumn('erp_erpname', function ($row) {
                return $row->erp ? $row->erp->erpname : '';
            });

            $table->addColumn('serialno_serialno', function ($row) {
                return $row->serialno ? $row->serialno->serialno : '';
            });

            $table->addColumn('category_category_name', function ($row) {
                return $row->category ? $row->category->category_name : '';
            });

            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'erp', 'serialno', 'category', 'status']);

            return $table->make(true);
        }

        return view('admin.outwards.index');
    }

    public function create()
    {
        abort_if(Gate::denies('outward_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $erps = Erpname::all()->pluck('erpname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $serialnos = Instock::all()->pluck('serialno', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.outwards.create', compact('erps', 'serialnos', 'categories', 'statuses'));
    }

    public function store(StoreOutwardRequest $request)
    {
        $outward = Outward::create($request->all());

        return redirect()->route('admin.outwards.index');
    }

    public function edit(Outward $outward)
    {
        abort_if(Gate::denies('outward_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $erps = Erpname::all()->pluck('erpname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $serialnos = Instock::all()->pluck('serialno', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $outward->load('erp', 'serialno', 'category', 'status');

        return view('admin.outwards.edit', compact('erps', 'serialnos', 'categories', 'statuses', 'outward'));
    }

    public function update(UpdateOutwardRequest $request, Outward $outward)
    {
        $outward->update($request->all());

        return redirect()->route('admin.outwards.index');
    }

    public function show(Outward $outward)
    {
        abort_if(Gate::denies('outward_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outward->load('erp', 'serialno', 'category', 'status');

        return view('admin.outwards.show', compact('outward'));
    }

    public function destroy(Outward $outward)
    {
        abort_if(Gate::denies('outward_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outward->delete();

        return back();
    }

    public function massDestroy(MassDestroyOutwardRequest $request)
    {
        Outward::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
