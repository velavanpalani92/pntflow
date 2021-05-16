<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInstockRequest;
use App\Http\Requests\StoreInstockRequest;
use App\Http\Requests\UpdateInstockRequest;
use App\Models\Category;
use App\Models\Instock;
use App\Models\Status;
use App\Models\Vendor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InstockController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('instock_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Instock::with(['type', 'vendor', 'category', 'status'])->select(sprintf('%s.*', (new Instock())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'instock_show';
                $editGate = 'instock_edit';
                $deleteGate = 'instock_delete';
                $crudRoutePart = 'instocks';

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
            $table->addColumn('type_category_name', function ($row) {
                return $row->type ? $row->type->category_name : '';
            });

            $table->addColumn('vendor_vendor_name', function ($row) {
                return $row->vendor ? $row->vendor->vendor_name : '';
            });

            $table->editColumn('serialno', function ($row) {
                return $row->serialno ? $row->serialno : '';
            });
            $table->editColumn('source', function ($row) {
                return $row->source ? Instock::SOURCE_SELECT[$row->source] : '';
            });
            $table->editColumn('orderno', function ($row) {
                return $row->orderno ? $row->orderno : '';
            });
            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });
            $table->addColumn('category_category_name', function ($row) {
                return $row->category ? $row->category->category_name : '';
            });

            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'type', 'vendor', 'category', 'status']);

            return $table->make(true);
        }

        return view('admin.instocks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('instock_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = Category::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vendors = Vendor::all()->pluck('vendor_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.instocks.create', compact('types', 'vendors', 'categories', 'statuses'));
    }

    public function store(StoreInstockRequest $request)
    {
        $instock = Instock::create($request->all());

        return redirect()->route('admin.instocks.index');
    }

    public function edit(Instock $instock)
    {
        abort_if(Gate::denies('instock_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = Category::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vendors = Vendor::all()->pluck('vendor_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $instock->load('type', 'vendor', 'category', 'status');

        return view('admin.instocks.edit', compact('types', 'vendors', 'categories', 'statuses', 'instock'));
    }

    public function update(UpdateInstockRequest $request, Instock $instock)
    {
        $instock->update($request->all());

        return redirect()->route('admin.instocks.index');
    }

    public function show(Instock $instock)
    {
        abort_if(Gate::denies('instock_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instock->load('type', 'vendor', 'category', 'status');

        return view('admin.instocks.show', compact('instock'));
    }

    public function destroy(Instock $instock)
    {
        abort_if(Gate::denies('instock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instock->delete();

        return back();
    }

    public function massDestroy(MassDestroyInstockRequest $request)
    {
        Instock::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
