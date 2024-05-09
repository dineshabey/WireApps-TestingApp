<?php

namespace domain\Services;

use App\Http\Resources\MedicationResource;
use App\Helpers\ResponseHelper;
use App\Models\Medication;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:medications,id',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::createErrorResponse('Invalid medication id', 400);
        }
        $medication = $this->medication->find($id);
        if (!$medication) {
            return ResponseHelper::createErrorResponse('Medication not found', 404);
        }
        return new MedicationResource($medication);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::createErrorResponse($validator->errors()->first(), 400);
        }

        $this->medication->name = $request->input('name');
        $this->medication->description = $request->input('description');
        $this->medication->quantity = $request->input('quantity');
        $medication = $this->medication->save();

        if (!$medication) {
            return ResponseHelper::createErrorResponse('Failed to store medication', 500);
        }
        $medications = $this->medication->latest()->first();
        return new MedicationResource($medications);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::createErrorResponse($validator->errors()->first(), 400);
        }
        $medication = $this->medication->find($id);
        if (!$medication) {
            return ResponseHelper::createErrorResponse('Medication not found', 404);
        }

        $medication->name = $request->input('name');
        $medication->description = $request->input('description');
        $medication->quantity = $request->input('quantity');
        $medication->save();

        if (!$medication) {
            return ResponseHelper::createErrorResponse('Failed to update medication', 500);
        }

        return new MedicationResource($medication);
    }
    public function destroy($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:medications,id',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::createErrorResponse('Invalid medication id', 400);
        }
        $medication = $this->medication->find($id);
        if (!$medication) {
            return ResponseHelper::createErrorResponse('Medication not found', 404);
        }

        $delete =  $medication->delete();

        if (!$delete) {
            return ResponseHelper::createErrorResponse('Failed to delete medication', 500);
        }
        return new MedicationResource($medication);
    }
}
