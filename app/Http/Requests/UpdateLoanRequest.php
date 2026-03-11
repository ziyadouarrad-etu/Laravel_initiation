<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'borrower_name' => 'sometimes|required|string|max:255',
            'borrower_email' => 'sometimes|required|email|max:255',
            'book_title' => 'sometimes|required|string|max:255',
            'borrowed_at' => 'sometimes|required|date',
            'due_date' => 'sometimes|required|date|after_or_equal:borrowed_at',
            'returned' => 'sometimes|required|boolean',
            'status' => 'sometimes|required|string|in:active,returned,overdue',
        ];
    }
}
