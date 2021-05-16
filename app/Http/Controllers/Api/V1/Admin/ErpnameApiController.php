<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreErpnameRequest;
use App\Http\Requests\UpdateErpnameRequest;
use App\Http\Resources\Admin\ErpnameResource;
use App\Models\Erpname;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ErpnameApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('erpname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ErpnameResource(Erpname::with(['zone'])->get());
    }

    public function store(StoreErpnameRequest $request)
    {
        $erpname = Erpname::create($request->all());

        return (new ErpnameResource($erpname))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Erpname $erpname)
    {
        abort_if(Gate::denies('erpname_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ErpnameResource($erpname->load(['zone']));
    }

    public function update(UpdateErpnameRequest $request, Erpname $erpname)
    {
        $erpname->update($request->all());

        return (new ErpnameResource($erpname))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Erpname $erpname)
    {
        abort_if(Gate::denies('erpname_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $erpname->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
