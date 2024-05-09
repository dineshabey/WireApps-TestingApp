<?php

namespace domain\Services;

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

        try {
            // $medications = Medication::all();
            $medications = $this->medication->all();
            return response()->json($medications);
        } catch (\Exception $e) {
            // Log the error
            // \Log::error($e);
            return response()->json(['error' => 'An error occurred while fetching medications.'], 500);
        }
    }
    // public function show($id)
    // {
    //     $medication = Medication::findOrFail($id);
    //     return response()->json($medication);
    // }

    // public function store(Request $request)
    // {
    //     $medication = new Medication();
    //     $medication->name = $request->input('name');
    //     $medication->description = $request->input('description');
    //     $medication->quantity = $request->input('quantity');
    //     $medication->save();

    //     return response()->json($medication, 201);
    // }
    // public function update(Request $request, $id)
    // {
    //     $medication = Medication::findOrFail($id);
    //     $medication->name = $request->input('name');
    //     $medication->description = $request->input('description');
    //     $medication->quantity = $request->input('quantity');
    //     $medication->save();

    //     return response()->json($medication, 200);
    // }
    // public function destroy($id)
    // {
    //     $medication = Medication::findOrFail($id);
    //     $medication->delete();

    //     return response()->json(null, 204);
    // }
}
