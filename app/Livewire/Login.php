<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Login extends Component
{
    public $email = '';
    public $password = '';
    public $error = '';

    public function login()
    {
        $this->error = '';

        if (auth()->attempt(['email' => $this->email, 'password' => $this->password])) {
            $user = auth()->user();
            if ($user->status === 'nonaktif') {
                auth()->logout();
                $this->error = 'Akun Anda telah dinonaktifkan.';
                return;
            }
            
            session()->regenerate();
            $this->redirect(route('dashboard'), navigate: true);
            return;
        }

        $this->error = 'Email atau password salah.';
    }

    public function render()
    {
        return view('livewire.login');
    }
}
