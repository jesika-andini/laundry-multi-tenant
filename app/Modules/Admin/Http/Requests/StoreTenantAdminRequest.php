<?php

namespace App\Modules\Admin\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTenantAdminRequest extends FormRequest
{
    /**
     * Hanya Super Admin yang boleh membuat akun.
     */
    public function authorize(): bool
    {
        return $this->user()?->can(
            'create',
            User::class
        ) ?? false;
    }

    /**
     * Validasi data akun Admin Laundry.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
            ],

            'tenant_id' => [
                'required',
                'integer',
                Rule::exists('tenants', 'id'),
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ];
    }
}
