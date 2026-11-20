<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.customer')]
#[Title('Masuk — LaundryHub')]
class CustomerLogin extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    /**
     * @return array<string, array<int, mixed>>
     */
    protected function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function login(): void
    {
        $this->validate();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', 'Email atau password salah.');

            return;
        }

        session()->regenerate();

        $destination = match (Auth::user()->role) {
            'admin', 'super_admin' => route('admin.dashboard'),
            'tenant' => route('tenant.dashboard'),
            default => route('customer.home'),
        };

        $this->redirect($destination, navigate: true);
    }

    public function render()
    {
        return view('livewire.customer-login');
    }
}
