<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanRequest;
use App\Models\Loan;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Display a listing of the loans
        $loans = Loan::all();

        if ($loans->isEmpty()) {
            $result = [
                'message' => 'No loans found.',
                'data' => [],
            ];
        } else {
            $result = [
                'message' => 'Loans found.',
                'data' => $loans,
            ];

        }

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoanRequest $request)
    {
        $validatedData = $request->validated();

        // Create the loan
        $loan = Loan::create($validatedData);

        return response()->json(['message' => 'Loan created successfully', 'data' => $loan], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //display the specified loan
        $loan = Loan::find($id);

        if (!$loan) {
            return response()->json(['message' => 'Loan not found.'], 404);
        }
        return response()->json(['message' => 'Loan found.', 'data' => $loan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoanRequest $request, string $id)
    {
        $loan = Loan::find($id);
        if (!$loan) {
            return response()->json(['message' => 'Loan not found.'], 404);
        }
        $validatedData = $request->validated();

        // If no data is provided for update, return an error
        if (empty($validatedData)) {
            return response()->json(['message' => 'No data provided for update.'], 400);
        }

        // Update the loan
        $loan->update($validatedData);

        return response()->json(['message' => 'Loan updated successfully', 'data' => $loan]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete the specified loan
        $loan = Loan::find($id);
        if (!$loan) {
            return response()->json(['message' => 'Loan not found.'], 404);
        }
        $loan->delete();
        return response()->json(['message' => 'Loan deleted successfully']);
    }
    /**
     * Mark the specified loan as returned.
     */
    public function markAsReturned(string $id)
    {
        $loan = Loan::find($id);
        if (!$loan) {
            return response()->json(['message' => 'Loan not found.'], 404);
        }
        $loan->returned = true;
        $loan->status = 'returned';
        $loan->save();
        return response()->json(['message' => 'Loan marked as returned successfully', 'data' => $loan]);
    }
}
