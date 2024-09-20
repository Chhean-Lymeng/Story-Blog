<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',      // Name is optional
            'email' => 'nullable|email',              // Email is optional
            'phone' => 'nullable|string|max:20',      // Phone is optional
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ];
    }

    public function authorize()
    {
        return true;  // No authentication required, anyone can submit
    }
}