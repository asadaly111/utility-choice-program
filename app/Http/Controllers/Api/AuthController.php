<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'The provided credentials are incorrect.'], 403);
        }
        if (!$user->status) {
            return response()->json(['message' => 'Your account is deactive, please contact site administrator.'], 403);
        }

        $token = $user->createToken('PortalToken')->plainTextToken;
        $userData = $user->only(['id', 'name', 'avatar', 'avatar_url', 'role']);
        return response()->json([
            'token' => $token,
            'userData' => $userData,
            'permissions' => $this->userRolePermissions($user->role->value),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }

    public function userRolePermissions($role)
    {
        switch ($role) {
            case 'admin':
                return [
                    'role' => $role,
                    'abilities' => [
                        'dashboard-view',
                        'orders-view',
                        'new-order',
                        'new-invoice',
                        'invoices-view',
                        'my-profile-view',
                        'password-view',
                        'my-account-view',
                        'commercial-view',
                        'customers-view',
                        'contracts-view',
                        'users-view',
                        'users-edit',
                        'users-add',
                        'users-delete',
                        'users-active-view',
                        'users-deactive-view',
                    ],
                ];
                break;
            case 'client':
                return [
                    'role' => $role,
                    'abilities' => [
                        'dashboard-view',
                        'orders-view',
                        'new-invoice',
                        'invoices-view',
                        'my-profile-view',
                        'password-view',
                        'my-account-view',
                    ],
                ];
                break;
            case 'employee':
                return [
                    'role' => $role,
                    'abilities' => [
                        'dashboard-view',
                        'orders-view',
                        'new-order',
                        'my-profile-view',
                        'password-view',
                        'my-account-view',
                    ],
                ];
                break;
            default:
                return [
                    'role' => $role,
                    'abilities' => [
                        'dashboard-view',
                        'ordes-view',
                    ],
                ];
                break;
        }
    }
}
