<?php

namespace App\Http\Controllers;

use domain\Facades\MedicationFacade;
use App\Models\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    public function index()
    {
        $response = MedicationFacade::all();
        return $response;
    }
    public function show($id)
    {
        $response = MedicationFacade::show($id);
        return $response;
    }
    public function store(Request $request)
    {
        $response = MedicationFacade::store($request);
        return $response;
    }
}
