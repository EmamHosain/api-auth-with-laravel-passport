<?php

namespace App\Http\Controllers\Api\Customer;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Customer\CustomerLoginRequest;
use App\Http\Requests\Customer\CustomerRegisterRequest;

class CustomerAuthController extends Controller
{
    protected $guardName = 'api-customer';
    
    public function customerLogin(CustomerLoginRequest $customerLoginRequest)
    {
        $customer = Customer::where('email', $customerLoginRequest->input('email'))->first();

        if (!$customer || !Hash::check($customerLoginRequest->input('password'), $customer->password)) {
            return response()->json([
                'error' => 'Invalid credentials'
            ], 401);
        }

        $token = $customer->createToken('customerToken', ['check-customer'])->accessToken;

        return response()->json([
            'success' => 'Customer Login successful.',
            'token' => $token
        ], 200);
    }

    public function customerRegister(CustomerRegisterRequest $customerRegisterRequest)
    {
        Customer::create([
            'name' => $customerRegisterRequest->input('name'),
            'email' => $customerRegisterRequest->input('email'),
            'password' => Hash::make($customerRegisterRequest->input('password')),
        ]);

        return response()->json([
            'success' => 'Registration successful.',
        ], 200);
    }

    public function getCustomerProfile()
    {
        $customer_profile = Auth::guard($this->guardName)->user();
        return response()->json([
            'customer profile' => $customer_profile,
            'success' => 'get data successful.'
        ]);
    }

    public function customerLogout()
    {
        $customer_profile = Auth::guard($this->guardName)->user();
        $token = $customer_profile->token();
        $token->revoke();
        return response()->json([
            'success' => 'true',
            'message' => 'Customer Logout successful.',
            'token' => $customer_profile->token()
        ]);
    }
}
