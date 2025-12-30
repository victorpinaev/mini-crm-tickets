<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'phone' => [
                'required',
                'regex:/^\+[1-9]\d{1,14}$/',
                'max:20',
            ],
            'email' => ['nullable', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'files' => ['nullable', 'array'],
            'files.*' => ['file', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'Phone number must be in E.164 format.',
            'files.*.max' => 'Each file must not exceed 5MB.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => $this->email ? strtolower(trim($this->email)) : null,
            'name' => trim($this->name),
            'subject' => trim($this->subject),
        ]);
    }
}
