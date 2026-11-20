<?php

namespace App\Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTenantRequest extends FormRequest
{
public function authorize(): bool
{
    return $this->user()?->can(
        'create',
        \App\Models\Tenant::class
    ) ?? false;
}
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'owner' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100', Rule::unique('tenants', 'email')],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['Aktif', 'Pending', 'Nonaktif'])],
        ];
    }
}
