<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required',
                'passport' => 'required', // File validation
                'national_id' => 'required', // File validation
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|string|min:8',
            ]);

            // Hash the password
            $hashedPassword = bcrypt($validatedData['password']);

            // Create a new user instance
            $user = new User();
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->phone = $validatedData['phone'];
            $user->password = $hashedPassword;
            $user->role = 2; // Assuming role '2' is for investors

            // Handle file uploads
            if ($request->hasFile('passport') && $request->file('passport')->isValid()) {
                $passportName = time() . '_passport.' . $request->passport->extension();
                $request->passport->move(public_path('investor_register'), $passportName);
                $user->passport = $passportName;
            }

            if ($request->hasFile('national_id') && $request->file('national_id')->isValid()) {
                $nationalIdName = time() . '_national_id.' . $request->national_id->extension();
                $request->national_id->move(public_path('investor_register'), $nationalIdName);
                $user->national_id = $nationalIdName;
            }

            // Save the user
            $user->save();

            return response()->json([
                'message' => 'User registered successfully.',
                'user' => $user,
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            // Validate incoming request
            $validatedData = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string|min:8',
            ]);

            // Check credentials
            if (!Auth::attempt($validatedData)) {
                return response()->json([
                    'message' => 'Invalid email or password.',
                ], 401);
            }

            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'message' => 'Login successful.',
                'user' => $user,
                'token' => $token,
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required',
                // 'register_certificate' => 'required|file|mimes:jpg,jpeg,png,pdf',
                // 'commercial_certificate' => 'required|file|mimes:jpg,jpeg,png,pdf',
                // 'licenses' => 'required|file|mimes:jpg,jpeg,png,pdf',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'register_num' => 'required|string',
            ]);

            $hashedPassword = bcrypt($validatedData['password']);

            $user = new User();
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = $hashedPassword;
            $user->role = 2;
            $user->save();

            $company = new Company();
            if ($request->hasFile('register_certificate') && $request->file('register_certificate')->isValid()) {
                $registerCertName = time() . '.' . $request->register_certificate->extension();
                $request->register_certificate->move(public_path('register_certificate'), $registerCertName);
                $company->register_certificate = $registerCertName;
            }
            if ($request->hasFile('commercial_certificate') && $request->file('commercial_certificate')->isValid()) {
                $commercialCertName = time() . '.' . $request->commercial_certificate->extension();
                $request->commercial_certificate->move(public_path('commercial_certificate'), $commercialCertName);
                $company->commercial_certificate = $commercialCertName;
            }
            if ($request->hasFile('licenses') && $request->file('licenses')->isValid()) {
                $licensesName = time() . '.' . $request->licenses->extension();
                $request->licenses->move(public_path('licenses'), $licensesName);
                $company->licenses = $licensesName;
            }

            $company->user_id = $user->id;
            $company->name = $validatedData['name'];
            $company->register_num = $validatedData['register_num'];
            $company->phone = $validatedData['phone'];
            $company->email = $validatedData['email'];
            $company->password = $hashedPassword;
            $company->save();

            return response()->json([
                'message' => 'Company registered successfully.',
                'Company' => $company,
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}