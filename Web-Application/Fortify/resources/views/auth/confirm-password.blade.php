@extends('app')

@section('content')
<div class="h-screen w-full flex items-center justify-center bg-[#0d1b2a]">
    <div class="bg-[#1b263b] p-8 rounded-xl shadow-xl max-w-sm w-full">
        <h1 class="text-3xl font-semibold text-center text-[#e0e1dd] mb-6">Confirm Password</h1>

        @if (session()->has('error'))
        <div class="text-red-500 text-center mb-4">{{ session('error') }}</div>
        @endif


        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-2">
            @csrf
            <div class="flex flex-col">
                <label for="password" class="text-[#e0e1dd] mb-2">{{ __('Password') }}</label>
                <input id="password" type="password" wire:model.lazy="password" name="password"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>

                @error('password')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 cursor-pointer">
                Confirm Password
            </button>

            @if (Route::has('password.request'))
            <a class="text-blue-500 text-center mt-4 block" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif
        </form>
    </div>
</div>
@endsection