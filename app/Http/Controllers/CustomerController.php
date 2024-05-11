<?php

namespace App\Http\Controllers;

use domain\Facades\CustomerFacade;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $response = CustomerFacade::all();
        return $response;
    }
    public function show($id)
    {
        $response = CustomerFacade::show($id);
        return $response;
    }
    public function store(Request $request)
    {
        $response = CustomerFacade::store($request);
        return $response;
    }

    public function update(Request $request, $id)
    {
        $response = CustomerFacade::update($request, $id);
        return $response;
    }
    public function destroy($id)
    {
        $response = CustomerFacade::destroy($id);
        return $response;
    }
    public function softDelete($id)
    {
        $response = CustomerFacade::softDelete($id);
        return $response;
    }
}
