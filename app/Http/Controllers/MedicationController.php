<?php

namespace App\Http\Controllers;

use domain\Facades\MedicationFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class MedicationController extends Controller
{
    public function index()
    {

        if (Gate::allows('view-medication')) {
            $response = MedicationFacade::all();
            return $response;
        } else {
            return response()->json(['error' => 'Permission denied '], 403);
        }
    }
    public function show($id)
    {
        if (Gate::allows('view-medication')) {
            $response = MedicationFacade::show($id);
            return $response;
        } else {
            return response()->json(['error' => 'Permission denied'], 403);
        }
    }
    public function store(Request $request)
    {
        if (Gate::allows('create-medication')) {
            $response = MedicationFacade::store($request);
            return $response;
        } else {
            return response()->json(['error' => 'Permission denied '], 403);
        }
    }

    public function update(Request $request, $id)
    {
        if (Gate::allows('update-medication')) {
            $response = MedicationFacade::update($request, $id);
            return $response;
        } else {
            return response()->json(['error' => 'Permission denied '], 403);
        }
    }

    public function destroy($id)
    {
        if (Gate::allows('delete-medication')) {
            $response = MedicationFacade::destroy($id);
            return $response;
        } else {
            return response()->json(['error' => 'Permission denied '], 403);
        }
    }
    public function softDelete($id)
    {
        if (Gate::allows('soft-delete-medication')) {
            $response = MedicationFacade::destroy($id);
            return $response;
        } else {
            return response()->json(['error' => 'Permission denied '], 403);
        }
    }
}
