<?php

namespace App\Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTenantRequest extends FormRequest
{
public function authorize(): bool
{
    $tenant = \App\Models\Tenant::find(
        $this->route('id')
    );

    return $tenant !== null
        && ($this->user()?->can('update', $tenant) ?? false);
}
    public function rules(): array
    {
        $tenantId = $this->route('id');

        return [
            'name' => ['required', 'string', 'max:100'],
            'owner' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('tenants', 'email')->ignore($tenantId),
            ],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }
}
