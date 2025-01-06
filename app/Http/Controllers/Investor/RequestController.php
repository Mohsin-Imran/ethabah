<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\InvestorFunds;
use App\Models\InvestorRequest;
use App\Models\ProjectUpdate;
use App\Models\RequestBike;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $requestesData = InvestorRequest::with('investmentFund.category')->where('user_id', auth()->user()->id)->get();
        return view('investor.request.index', get_defined_vars());
    }

    public function view($id)
    {
        $requestData = RequestBike::with('projectUpdate')->find($id);
        return view('investor.request.view', data: get_defined_vars());
    }
    public function create()
    {
        $investorFunds = InvestorFunds::with('investments')->get();

        foreach ($investorFunds as $fund) {
            $fund->pending_amount = $fund->amount - $fund->investments->sum('amount'); // Calculate pending amount
        }

        return view('investor.request.create', compact('investorFunds'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:1',
            'end_of_period' => 'required|date',
            'investor_funds_id' => 'required|exists:investor_funds,id',
            'start_of_period' => 'required|date',
        ]);

        $fund = InvestorFunds::with('investments')->findOrFail($validatedData['investor_funds_id']);
        $pendingAmount = $fund->amount - $fund->investments->sum('amount');

        // Check if investment amount exceeds pending funds
        if ($validatedData['amount'] > $pendingAmount) {
            return redirect()->back()->withErrors(['amount' => 'The investment amount exceeds the pending funds!'])->withInput();
        }

        // Save the investment request
        $investment = new InvestorRequest();
        $investment->user_id = auth()->user()->id;
        $investment->investor_funds_id = $validatedData['investor_funds_id'];
        $investment->amount = $validatedData['amount'];
        $investment->end_of_period = $validatedData['end_of_period'];
        $investment->start_of_period = $validatedData['start_of_period'];
        $investment->save();

        return redirect()->back()->with('message', 'Request added successfully');
    }


    public function updateDocument(Request $request)
    {
        $validatedData = $request->validate([
            'request_id' => 'required|string|max:255',
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
        $projectData->request_id = $validatedData['request_id'];
        $projectData->update_name = $validatedData['update_name'];
        $projectData->document = !empty($uploadedFiles) ? json_encode($uploadedFiles) : null;

        if ($projectData->save()) {
            return redirect()->back()->with('message', 'Request added successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to save data');
        }
    }

}
