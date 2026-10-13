<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // ═══════════════════════════════════════════════
            // PROFIL PERSONNEL
            // ═══════════════════════════════════════════════
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'location' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:500'],

            // ═══════════════════════════════════════════════
            // MON COMMERCE
            // ═══════════════════════════════════════════════
            'business_name' => ['nullable', 'string', 'max:255'],
            'business_category' => ['nullable', 'string', 'max:100'],
            'business_address' => ['nullable', 'string', 'max:255'],
            'business_city' => ['nullable', 'string', 'max:100'],
            'business_district' => ['nullable', 'string', 'max:100'],
            'business_country' => ['nullable', 'string', 'max:100'],
            'business_website' => ['nullable', 'url', 'max:255'],
            'business_mode' => ['nullable', 'in:local,online'],
        ];
    }
}