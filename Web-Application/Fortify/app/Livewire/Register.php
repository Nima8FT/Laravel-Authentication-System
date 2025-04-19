<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Actions\Fortify\CreateNewUser;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed', // Password confirmation
    ];
    public function register(CreateNewUser $creator)
    {
        $this->validate();


        $user = $creator->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ]);

        Auth::login($user);

        if ($user) {
            session()->flash('message', 'User registered successfully!');
            return redirect()->route('login');
        } else {
            session()->flash('error', 'There was an error registering the user. Please try again.');
        }

        return redirect()->route('profile');
    }

    public function resetInputs()
    {
        $this->reset(['name', 'email', 'password', 'password_confirmation']);
    }
    public function render()
    {
        return view('livewire.register');
    }
}
