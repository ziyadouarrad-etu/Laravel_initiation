<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
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
            'borrower_name' => 'required|string|max:255',
            'borrower_email' => 'required|email|max:255',
            'book_title' => 'required|string|max:255',
            'borrowed_at' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrowed_at',
        ];
    }
    public function messages(): array
    {
        return [
            'borrower_name.required' => 'The borrower name is required.',
            'borrower_email.required' => 'The borrower email is required.',
            'borrower_email.email' => 'The borrower email must be a valid email address.',
            'book_title.required' => 'The book title is required.',
            'borrowed_at.required' => 'The borrowed at date is required.',
            'borrowed_at.date' => 'The borrowed at date must be a valid date.',
            'due_date.required' => 'The due date is required.',
            'due_date.date' => 'The due date must be a valid date.',
            'due_date.after_or_equal' => 'The due date must be after or equal to the borrowed at date.',
        ];
    }
}
