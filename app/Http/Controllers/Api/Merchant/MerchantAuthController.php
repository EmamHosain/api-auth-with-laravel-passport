<?php

namespace App\Http\Controllers\Api\Merchant;
use App\Models\Merchant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Merchant\MerchantLoginRequest;
use App\Http\Requests\Merchant\MerchantRegisterRequest;

class MerchantAuthController extends Controller
{
    protected $guardName = 'api-merchant';
    public function merchantLogin(MerchantLoginRequest $merchantLoginRequest)
    {
        $merchant = Merchant::where('email', $merchantLoginRequest->input('email'))->first();

        if (!$merchant || !Hash::check($merchantLoginRequest->input('password'), $merchant->password)) {
            return response()->json([
                'error' => 'Invalid credentials'
            ], 401);
        }

        $token = $merchant->createToken('merchantToken', ['check-merchant'])->accessToken;

        return response()->json([
            'success' => 'Merchant Login successful.',
            'token' => $token
        ], 200);
    }

    public function merchantRegister(MerchantRegisterRequest $merchantRegisterRequest)
    {
        Merchant::create([
            'name' => $merchantRegisterRequest->input('name'),
            'email' => $merchantRegisterRequest->input('email'),
            'password' => Hash::make($merchantRegisterRequest->input('password')),
        ]);

        return response()->json([
            'success' => 'Registration successful.',
        ], 200);
    }



    public function getTokenWithScopes()
    {
        $merchant = Auth::guard($this->guardName)->user();
        return response()->json([
            'merchant token with scopes' => $merchant->token(),
        ]);
    }





    public function getMerchantProfile()
    {
        $merchant_profile = Auth::guard($this->guardName)->user();
        return response()->json([
            'merchant profile' => $merchant_profile,
            'success' => 'Get data successful.'
        ]);
    }

    public function merchantLogout()
    {
        $merchant_profile = Auth::guard($this->guardName)->user();
        $token = $merchant_profile->token();
        $token->revoke();
        return response()->json([
            'success' => 'true',
            'message' => 'Merchant Logout successful.',
            'token' => $merchant_profile->token()
        ]);
    }
}
