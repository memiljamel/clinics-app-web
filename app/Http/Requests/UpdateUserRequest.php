<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use App\Enums\MartialStatus;
use App\Enums\PatientType;
use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateUserRequest extends FormRequest
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
            'avatar' => ['nullable', 'image', 'max:1024', 'mimes:jpg,jpeg,png'],
            'name' => ['required', 'string', 'min:3', 'max:70'],
            'password' => ['nullable', 'string', 'min:8', 'max:70', 'confirmed'],
            'role' => ['required', 'string', new Enum(Role::class)],
            'phone_number' => ['nullable', 'string', 'digits_between:11,14'],
            'date_of_birth' => ['nullable', 'date', 'date_format:Y-m-d', 'before_or_equal:today'],
            'type' => ['nullable', 'string', new Enum(PatientType::class)],
            'allergy' => ['nullable', 'string', 'min:3', 'max:70'],
            'status' => ['nullable', 'string', new Enum(MartialStatus::class)],
            'address' => ['nullable', 'string', 'min:3', 'max:255', 'regex:/(^[-0-9A-Za-z.,\/ ]+$)/'],
            'gender' => ['nullable', 'string', new Enum(Gender::class)],
        ];
    }
}
