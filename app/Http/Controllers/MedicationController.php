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
}
