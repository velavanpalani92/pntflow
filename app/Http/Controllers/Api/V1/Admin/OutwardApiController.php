<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOutwardRequest;
use App\Http\Requests\UpdateOutwardRequest;
use App\Http\Resources\Admin\OutwardResource;
use App\Models\Outward;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OutwardApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('outward_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OutwardResource(Outward::with(['erp', 'serialno', 'category', 'status'])->get());
    }

    public function store(StoreOutwardRequest $request)
    {
        $outward = Outward::create($request->all());

        return (new OutwardResource($outward))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Outward $outward)
    {
        abort_if(Gate::denies('outward_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OutwardResource($outward->load(['erp', 'serialno', 'category', 'status']));
    }

    public function update(UpdateOutwardRequest $request, Outward $outward)
    {
        $outward->update($request->all());

        return (new OutwardResource($outward))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Outward $outward)
    {
        abort_if(Gate::denies('outward_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outward->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
