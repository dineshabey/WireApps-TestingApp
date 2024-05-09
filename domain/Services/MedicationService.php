<?php

namespace domain\Services;

use App\Http\Resources\MedicationResource;
use App\Helpers\ResponseHelper;
use App\Models\Medication;
use Illuminate\Http\Request;

class MedicationService
{
    protected $medication;
    public function __construct()
    {
        $this->medication = new Medication();
    }
    public function all()
    {

        $medications = $this->medication->all();

        if ($medications !== null) {
            return MedicationResource::collection($medications);
        } else {
            return ResponseHelper::createErrorResponse('An error occurred while fetching medications.', 500);
        }
    }
    public function show($id)
    {
        $medication = $this->medication->find($id);
        if (!$medication) {
            return ResponseHelper::createErrorResponse('Medication not found', 404);
        }
        return new MedicationResource($medication);
    }

    public function store(Request $request)
    {
        $this->medication->name = $request->input('name');
        $this->medication->description = $request->input('description');
        $this->medication->quantity = $request->input('quantity');
        $medications_response = $this->medication->save();

        return response()->json($medications_response, 201);
    }
    public function update(Request $request, $id)
    {
        $medication = Medication::findOrFail($id);
        $medication->name = $request->input('name');
        $medication->description = $request->input('description');
        $medication->quantity = $request->input('quantity');
        $medication->save();

        return response()->json($medication, 200);
    }
    // public function destroy($id)
    // {
    //     $medication = Medication::findOrFail($id);
    //     $medication->delete();

    //     return response()->json(null, 204);
    // }
}
