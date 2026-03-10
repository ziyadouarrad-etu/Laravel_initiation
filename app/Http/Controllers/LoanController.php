<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Display a listing of the loans
        $loans = \App\Models\Loan::all();

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
    public function store(Request $request)
    {
        //validate the request
        $validatedData = $request->validate([
            'borrower_name' => 'required|string|max:255',
            'borrower_email' => 'required|email|max:255',
            'book_title' => 'required|string|max:255',
            'borrowed_at' => 'date',
            'due_date' => 'date|after:borrowed_at',
            'returned' => 'boolean',
            'status' => 'in:active,returned,overdue',
        ]);

        // Create the loan
        $loan = \App\Models\Loan::create($validatedData);

        return response()->json(['message' => 'Loan created successfully', 'data' => $loan], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //display the specified loan
        $loan = \App\Models\Loan::find($id);

        if (!$loan) {
            return response()->json(['message' => 'Loan not found.'], 404);
        }
        return response()->json(['message' => 'Loan found.', 'data' => $loan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update the specified loan
        $loan = \App\Models\Loan::find($id);

        if (!$loan) {
            return response()->json(['message' => 'Loan not found.'], 404);
        }
        //validate the request
        $validatedData = $request->validate([
            'borrower_name' => 'nullable|string|max:255',
            'borrower_email' => 'nullable|email|max:255',
            'book_title' => 'nullable|string|max:255',
            'borrowed_at' => 'nullable|date',
            'due_date' => 'nullable|date|after:borrowed_at',
            'returned' => 'nullable|boolean',
            'status' => 'nullable|in:active,returned,overdue',
        ]);

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
        $loan = \App\Models\Loan::find($id);
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
        $loan = \App\Models\Loan::find($id);
        if (!$loan) {
            return response()->json(['message' => 'Loan not found.'], 404);
        }
        $loan->returned = true;
        $loan->status = 'returned';
        $loan->save();
        return response()->json(['message' => 'Loan marked as returned successfully', 'data' => $loan]);
    }
}
