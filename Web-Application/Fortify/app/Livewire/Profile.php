<?php

namespace App\Livewire;

use GuzzleHttp\Psr7\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public function render()
    {
        return view('livewire.profile');
    }
}
