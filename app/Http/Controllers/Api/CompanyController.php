<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CompanyController extends Controller
{
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'register_num' => 'required|string|max:255',
    //         'phone' => 'required|string|max:15',
    //         'email' => 'required|email|unique:users,email',
    //         'register_certificate' => 'required',
    //         'commercial_certificate' => 'required',
    //         'licenses' => 'required',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     $user = new User;
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = bcrypt($request->password);
    //     $user->save();

    //     $company = new Company;

    //     if ($request->hasFile('register_certificate') && $request->file('register_certificate')->isValid()) {
    //         $imageName = time() . '.' . $request->file('register_certificate')->getClientOriginalExtension();
    //         $request->file('register_certificate')->move(public_path('register_certificate'), name: $imageName);
    //         $company->register_certificate = $imageName;
    //     } else {
    //         return redirect()->back()->with('error', 'Image is required.');
    //     }

    //     if ($request->hasFile('commercial_certificate') && $request->file('commercial_certificate')->isValid()) {
    //         $imageName = time() . '.' . $request->file('commercial_certificate')->getClientOriginalExtension();
    //         $request->file('commercial_certificate')->move(public_path('commercial_certificate'), name: $imageName);
    //         $company->commercial_certificate = $imageName;
    //     } else {
    //         return redirect()->back()->with('error', 'Image is required.');
    //     }
    //     if ($request->hasFile('licenses') && $request->file('licenses')->isValid()) {
    //         $imageName = time() . '.' . $request->file('licenses')->getClientOriginalExtension();
    //         $request->file('licenses')->move(public_path('licenses'), name: $imageName);
    //         $company->licenses = $imageName;
    //     } else {
    //         return redirect()->back()->with('error', 'Image is required.');
    //     }

    //     $company->user_id = $user->id;
    //     $company->name = $request->name;
    //     $company->register_num = $request->register_num;
    //     $company->phone = $request->phone;
    //     $company->email = $request->email;
    //     $company->password = bcrypt($request->password);
    //     $company->register_certificate = $imageName;
    //     $company->save();
    //     return response()->json(['message' => 'Data saved successfully!', 'data' => $company], 201);
    // }

    public function store(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'name'                     => 'required|string|max:255',
                'phone'                    => 'required|string',
                'register_certificate'     => 'required',
                'register_certificate.*'   => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
                'commercial_certificate'   => 'required',
                'commercial_certificate.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
                'licenses'                 => 'nullable',
                'licenses.*'               => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
                'email'                    => 'required|email|unique:users,email',
                'password'                 => 'required|string|min:8',
                'register_num'             => 'required|string',
            ]);

            // Hash the password
            $hashedPassword = bcrypt($request->password);

            // Initialize company object
            $company = new Company();

            // Handle file uploads using private method for each category
            $company->register_certificate   = $this->uploadFiles($request->file('register_certificate'), 'register_certificate');
            $company->commercial_certificate = $this->uploadFiles($request->file('commercial_certificate'), 'commercial_certificate');
            $company->licenses               = $this->uploadFiles($request->file('licenses'), 'licenses');

            // Save company information
            $company->name         = $validatedData['name'];
            $company->phone        = $validatedData['phone'];
            $company->register_num = $validatedData['register_num'];
            $company->email        = $validatedData['email'];
            $company->password     = $hashedPassword;

            // Save user information
            $user           = new User();
            $user->name     = $validatedData['name'];
            $user->email    = $validatedData['email'];
            $user->password = $hashedPassword;
            $user->role     = 2; // Adjust the role as needed
            $user->save();

            // Associate user to the company
            $company->user_id = $user->id;
            $company->save();

            // Return success response
            return response()->json([
                'message' => 'Company registered successfully.',
                'company' => $company,
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function editCompany()
    {
        $companyId = auth()->user()->company_id;
        if (! $companyId) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        try {
            $user = Company::findOrFail($companyId);
            return response()->json([
                'message' => 'Investor details fetched successfully.',
                'data'    => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Investor not found.',
                'error'   => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name'         => 'required|string|max:255',
                'phone'        => 'required|string',
                'address'      => 'required|string',
                'email'        => 'required|email|unique:users,email,' . auth()->user()->id,
                'password'     => 'sometimes|nullable|string|min:8',
                'register_num' => 'required|string',
            ]);

            $user = User::find(auth()->user()->id);
            if (! $user) {
                return response()->json(['message' => 'User not found.'], 404);
            }

            $user->name  = $validatedData['name'];
            $user->email = $validatedData['email'];
            if (! empty($request->password)) {
                $user->password = bcrypt($request->password);
            }
            $user->save();

            $company = Company::find($user->company_id);
            if (! $company) {
                return response()->json(['message' => 'Company not found.'], 404);
            }

            if (! $company->register_certificate || ! $company->commercial_certificate || ! $company->licenses) {
                $company->register_certificate   = $this->uploadFiles($request->file('register_certificate'), 'register_certificate');
                $company->commercial_certificate = $this->uploadFiles($request->file('commercial_certificate'), 'commercial_certificate');
                $company->licenses               = $this->uploadFiles($request->file('licenses'), 'licenses');
            }
            $company->name         = $validatedData['name'];
            $company->phone        = $validatedData['phone'];
            $company->register_num = $validatedData['register_num'];
            $company->email        = $validatedData['email'];
            $company->address      = $validatedData['address'];
            $company->user_id      = $user->id;

            $company->save();

            return response()->json([
                'message' => 'Company updated successfully.',
                'company' => $company,
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    private function uploadFiles($files, $folder)
    {
        $uploadedFiles = [];
        if ($files) {
            $files = is_array($files) ? $files : [$files];
            foreach ($files as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->extension();
                $filePath = public_path($folder);
                if (! file_exists($filePath)) {
                    mkdir($filePath, 0755, true);
                }
                $file->move($filePath, $fileName);
                $uploadedFiles[] = $fileName;
            }
        }
        return json_encode($uploadedFiles);
    }

}
