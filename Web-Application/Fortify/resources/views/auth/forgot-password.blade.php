@extends('app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-200 mb-6">Reset Password</h2>

        @if (session('status'))
        <div class="mb-4 text-sm text-green-600 dark:text-green-400">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Email Address</label>
                <input wire:model.lazy='email' id="email" type="email" name="email" required autofocus
                    autocomplete="email"
                    class="w-full px-4 py-2 border rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">

                @error('email')
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 cursor-pointer">
                    Send Password Reset Link
                </button>
            </div>
        </form>
    </div>
</div>
@endsection