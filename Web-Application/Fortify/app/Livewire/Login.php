<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|string|min:8', // Password confirmation
    ];
    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->flash('success', 'You are logged in successfully!');
            return redirect()->route('profile');
        }
        session()->flash('error', 'Invalid credentials. Please try again.');
    }
    public function render()
    {
        return view('livewire.login');
    }
}
