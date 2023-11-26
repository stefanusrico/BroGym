<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;
    // use AuthenticatesUsers;

    protected $redirectTo = '/home';

    // protected $redirectTo = 'dashboard/admin';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function redirectTo()
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'admin':
                return '/dashboard/admin';
                break;
            case 'user':
                return '/dashboard/user';
                break;
            default:
                return '/home'; // Redirect default jika peran tidak dikenali
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'age' => ['required', 'integer'],
            'gender' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
        ]);
    }

    protected function create(array $data)
    {
        $role = 'admin';
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'age' => $data['age'],
            'gender' => $data['gender'],
            'phone_number' => $data['phone_number'],
            'role' => $role,
        ]);
    }
}