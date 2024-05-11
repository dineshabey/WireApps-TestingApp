<?php

namespace domain\Services;

use App\Http\Resources\customerResource;
use App\Helpers\ApiResponseHelper;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CustomerService
{
    protected $customer;
    public function __construct()
    {
        $this->customer = new Customer();
    }
    public function all()
    {

        $customers = $this->customer->all();

        if ($customers !== null) {
            $data = customerResource::collection($customers);
            return ApiResponseHelper::success('customer found', $data);
        } else {
            return ApiResponseHelper::error('An error occurred while fetching customers.', $customers, 500);
        }
    }
    public function show($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:customers,id',
        ]);

        if ($validator->fails()) {
            return ApiResponseHelper::error('Validation Failed', $validator->errors()->first(), 400);
        }
        $customer = $this->customer->find($id);
        if (!$customer) {
            return ApiResponseHelper::error('customer not found', $customer, 404);
        }
        $data = new customerResource($customer);
        return ApiResponseHelper::success('customer found', $data);
    }


    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'nullable|string',
            'phone' => 'required|numeric|min:0',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ApiResponseHelper::error('Validation Failed', $validator->errors()->first(), 400);
        }

        try {
            $customer = new customer();
            $customer->name = $request->input('name');
            $customer->email = $request->input('email');
            $customer->phone = $request->input('phone');
            $customer->address = $request->input('address');
            $customer->save();

            $data = new customerResource($customer);
            return ApiResponseHelper::success('customer added successfully', $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Failed to add customer', $e->getMessage(), 500);
        }
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'nullable|string',
            'phone' => 'required|numeric|min:0',
            'address' => 'required|string',

        ]);

        if ($validator->fails()) {
            return ApiResponseHelper::error('Validation Failed', $validator->errors()->first(), 400);
        }
        $customer = $this->customer->find($id);
        if (!$customer) {
            return ApiResponseHelper::error('customer not found', $customer, 404);
        }

        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        $customer->address = $request->input('address');
        $customer->save();

        if (!$customer) {
            return ApiResponseHelper::error('Failed to update customer', $customer, 500);
        }

        $data = new customerResource($customer);
        return ApiResponseHelper::success('customer added successfully', $data);
    }
    public function destroy($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:customers,id',
        ]);

        if ($validator->fails()) {
            return ApiResponseHelper::error('Validation Failed', $validator->errors()->first(), 400);
        }
        $customer = $this->customer->find($id);
        if (!$customer) {
            return ApiResponseHelper::error('customer not found', $customer, 404);
        }

        $delete =  $customer->delete();

        if (!$delete) {
            return ApiResponseHelper::error('Failed to update customer', $delete, 500);
        }
        $data = new customerResource($customer);
        return ApiResponseHelper::success('customer deleted successfully', $data);
    }
}
