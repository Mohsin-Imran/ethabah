<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProjectUpdate;
use App\Models\RequestBike;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $requestesData = RequestBike::where('user_id', auth()->user()->id)->get();
        return view('company.request.index', get_defined_vars());
    }

    public function view($id)
    {
        $requestData = RequestBike::with('projectUpdate')->find($id);
        return view('company.request.view', data: get_defined_vars());
    }
    public function create()
    {
        $categories = Category::all();
        return view('company.request.create', get_defined_vars());
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required', // Validate category id
            'purpose_of_funding' => 'required|string|max:255',
            'total_funds' => 'required|numeric|min:1',
            'description' => 'required|string|max:1000',
            'request_document' => 'nullable|array', // Validate that request_document is an array
            'request_document.*' => 'file|mimes:pdf,doc,docx,jpeg,png|max:2048', // Validate file types and size
        ]);

        $requestData = new RequestBike;
        $uploadedFiles = [];

        if ($request->hasFile('request_document')) {
            $documents = $request->file('request_document');
            if (is_array($documents)) {
                foreach ($documents as $file) {
                    $fileName = time() . '_' . uniqid() . '.' . $file->extension();
                    $file->move(public_path('request_document'), $fileName);
                    $uploadedFiles[] = $fileName;
                }
            } else {
                $fileName = time() . '_' . uniqid() . '.' . $documents->extension();
                $documents->move(public_path('request_document'), $fileName);
                $uploadedFiles[] = $fileName;
            }
        }

        $requestData->user_id = auth()->user()->id;
        $requestData->company_id = auth()->user()->company_id;
        $requestData->name = $validatedData['name'];
        $requestData->category = $validatedData['category']; // Use category from the form
        $requestData->purpose_of_funding = $validatedData['purpose_of_funding'];
        $requestData->total_funds = $validatedData['total_funds'];
        $requestData->description = $validatedData['description'];
        $requestData->request_document = !empty($uploadedFiles) ? json_encode($uploadedFiles) : null; // Save file info as JSON
        $requestData->save();

        return redirect()->back()->with('message1', 'Request Add successfully');

    }

    public function updateDocument(Request $request)
    {
        $validatedData = $request->validate([
            'project_id' => 'required|string|max:255',
            'update_name' => 'required|string|max:255',
            'document' => 'nullable|array',
            'document.*' => 'file|mimes:pdf,doc,docx,jpeg,png|max:2048',
        ]);

        $projectData = new ProjectUpdate();
        $uploadedFiles = [];

        if ($request->hasFile('document')) {
            foreach ($request->file('document') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->extension();
                $file->move(public_path('document'), $fileName);
                $uploadedFiles[] = $fileName;
            }
        }

        $projectData->user_id = $request->user_id;
        $projectData->company_id = $request->company_id;
        $projectData->project_id = $validatedData['project_id'];
        $projectData->update_name = $validatedData['update_name'];
        $projectData->document = !empty($uploadedFiles) ? json_encode($uploadedFiles) : null;

        if ($projectData->save()) {
            return redirect()->back()->with('message', 'Request added successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to save data');
        }
    }

}
