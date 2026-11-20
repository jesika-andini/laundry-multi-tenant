<?php

namespace App\Livewire;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.customer')]
#[Title('Daftar Jadi Mitra — LaundryHub')]
class PartnerRegistration extends Component
{
    public string $name = '';

    public string $owner = '';

    public string $email = '';

    public string $phone = '';

    public string $address = '';

    public string $description = '';

    public string $password = '';

    public string $password_confirmation = '';

    public bool $agree = false;

    public bool $submitted = false;

    /**
     * @return array<string, array<int, mixed>>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'owner' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('tenants', 'email'),
                Rule::unique('users', 'email'),
            ],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:500'],
            'description' => ['nullable', 'string', 'max:1000'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'agree' => ['accepted'],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'name.required' => 'Nama laundry wajib diisi.',
            'owner.required' => 'Nama pemilik wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar. Gunakan email lain.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'address.required' => 'Alamat laundry wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'agree.accepted' => 'Kamu harus menyetujui syarat dan ketentuan.',
        ];
    }

    public function submit(): void
    {
        $data = $this->validate();

        DB::transaction(function () use ($data): void {
            $tenant = Tenant::create([
                'name' => $data['name'],
                'owner' => $data['owner'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'description' => $data['description'] ?: null,
                'status' => 'Pending',
            ]);

            User::create([
                'name' => $data['owner'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => 'tenant',
                'tenant_id' => $tenant->id,
            ]);
        });

        $this->submitted = true;

        $this->reset([
            'name',
            'owner',
            'email',
            'phone',
            'address',
            'description',
            'password',
            'password_confirmation',
            'agree',
        ]);

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.partner-registration');
    }
}
