<?php

namespace App\Http\Controllers;

use domain\Facades\CustomerFacade;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    public function index()
    {
        if (Gate::allows('view-customer')) {
            $response = CustomerFacade::all();
            return $response;
        } else {
            return response()->json(['error' => 'Permission denied '], 403);
        }
    }

    public function show($id)
    {
        if (Gate::allows('view-customer')) {
            $response = CustomerFacade::show($id);
            return $response;
        } else {
            return response()->json(['error' => 'Permission denied '], 403);
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('create-customer')) {
            $response = CustomerFacade::store($request);
            return $response;
        } else {
            return response()->json(['error' => 'Permission denied '], 403);
        }
    }

    public function update(Request $request, $id)
    {
        if (Gate::allows('update-customer')) {
            $response = CustomerFacade::update($request, $id);
            return $response;
        } else {
            return response()->json(['error' => 'Permission denied '], 403);
        }
    }

    public function destroy($id)
    {
        if (Gate::allows('delete-customer')) {
            $response = CustomerFacade::destroy($id);
            return $response;
        } else {
            return response()->json(['error' => 'Permission denied '], 403);
        }
    }

    public function softDelete($id)
    {
        if (Gate::allows('soft-delete-customer')) {
            $response = CustomerFacade::softDelete($id);
            return $response;
        } else {
            return response()->json(['error' => 'Permission denied'], 403);
        }
    }
}
