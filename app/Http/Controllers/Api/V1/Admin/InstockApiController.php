<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstockRequest;
use App\Http\Requests\UpdateInstockRequest;
use App\Http\Resources\Admin\InstockResource;
use App\Models\Instock;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstockApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('instock_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstockResource(Instock::with(['type', 'vendor', 'category', 'status'])->get());
    }

    public function store(StoreInstockRequest $request)
    {
        $instock = Instock::create($request->all());

        return (new InstockResource($instock))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Instock $instock)
    {
        abort_if(Gate::denies('instock_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstockResource($instock->load(['type', 'vendor', 'category', 'status']));
    }

    public function update(UpdateInstockRequest $request, Instock $instock)
    {
        $instock->update($request->all());

        return (new InstockResource($instock))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Instock $instock)
    {
        abort_if(Gate::denies('instock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instock->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
