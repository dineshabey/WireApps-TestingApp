<?php

namespace domain\Services;

use App\Http\Resources\MedicationResource;
use App\Helpers\ApiResponseHelper;
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
            $data = MedicationResource::collection($medications);
            return ApiResponseHelper::success('Medication found', $data);
        } else {
            return ApiResponseHelper::error('An error occurred while fetching medications.', $medications, 500);
        }
    }
    public function show($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:medications,id',
        ]);

        if ($validator->fails()) {
            return ApiResponseHelper::error('Validation Failed', $validator->errors()->first(), 400);
        }
        $medication = $this->medication->find($id);
        if (!$medication) {
            return ApiResponseHelper::error('Medication not found', $medication, 404);
        }
        $data = new MedicationResource($medication);
        return ApiResponseHelper::success('Medication found', $data);
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
            return ApiResponseHelper::error('Validation Failed', $validator->errors()->first(), 400);
        }

        try {
            $medication = new Medication();
            $medication->name = $request->input('name');
            $medication->description = $request->input('description');
            $medication->quantity = $request->input('quantity');
            $medication->save();

            $data = new MedicationResource($medication);
            return ApiResponseHelper::success('Medication added successfully', $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Failed to add medication', $e->getMessage(), 500);
        }
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return ApiResponseHelper::error('Validation Failed', $validator->errors()->first(), 400);
        }
        $medication = $this->medication->find($id);
        if (!$medication) {
            return ApiResponseHelper::error('Medication not found', $medication, 404);
        }

        $medication->name = $request->input('name');
        $medication->description = $request->input('description');
        $medication->quantity = $request->input('quantity');
        $medication->save();

        if (!$medication) {
            return ApiResponseHelper::error('Failed to update medication', $medication, 500);
        }

        $data = new MedicationResource($medication);
        return ApiResponseHelper::success('Medication added successfully', $data);
    }
    public function destroy($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:medications,id',
        ]);

        if ($validator->fails()) {
            return ApiResponseHelper::error('Validation Failed', $validator->errors()->first(), 400);
        }
        $medication = $this->medication->find($id);
        if (!$medication) {
            return ApiResponseHelper::error('Medication not found', $medication, 404);
        }

        $delete =  $medication->delete();

        if (!$delete) {
            return ApiResponseHelper::error('Failed to update medication', $delete, 500);
        }
        $data = new MedicationResource($medication);
        return ApiResponseHelper::success('Medication deleted successfully', $data);
    }
}
