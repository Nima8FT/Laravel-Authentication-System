@extends('app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-100 mb-6">
            Reset Password
        </h2>

        @if (session()->has('status'))
        <div class="mb-4 text-green-600 dark:text-green-400">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{route('password.update')}}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-4">
                <label for="email" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Email</label>
                <input type="email" id="email" wire:model.lazy="email" name="email"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">New
                    Password</label>
                <input type="password" id="password" wire:mode.lazy="password" name="password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white @error('password') border-red-500 @enderror">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Password Confirmation --}}
            <div class="mb-6">
                <label for="password_confirmation"
                    class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" wire:model.lazy="password_confirmation"
                    name="password_confirmation"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-300 cursor-pointer">
                Reset Password
            </button>
        </form>
    </div>
</div>
@endsection