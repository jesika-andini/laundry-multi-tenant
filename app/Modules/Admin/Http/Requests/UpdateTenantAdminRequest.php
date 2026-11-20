<?php

namespace App\Modules\Admin\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTenantAdminRequest extends FormRequest
{
    /**
     * Hanya Super Admin yang boleh mengubah akun.
     */
    public function authorize(): bool
    {
        $user = $this->route('user');

        return $user instanceof User
            && ($this->user()?->can('update', $user) ?? false);
    }

    /**
     * Validasi perubahan akun Admin Laundry.
     */
    public function rules(): array
    {
        $user = $this->route('user');

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
                Rule::unique('users', 'email')->ignore($user->id),
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
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ];
    }
}
