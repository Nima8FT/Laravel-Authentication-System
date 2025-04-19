<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DeleteAccount extends Component
{
    public function deleteAccount()
    {
        try {
            $user = auth()->user();
            Auth::logout();

            $user->delete();

            // invalidate session
            session()->invalidate();
            session()->regenerateToken();

            return redirect('/login')->with('status', 'Your account has been deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'There was a problem deleting your account.');
        }
    }

    public function render()
    {
        return view('livewire.delete-account');
    }
}
