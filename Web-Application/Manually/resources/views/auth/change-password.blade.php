@extends('layouts.aside')

@section('main')

<main class="min-h-screen w-full flex items-center justify-center bg-[#0d1b2a] overflow-auto py-5">
    <div class="bg-[#1b263b] p-8 rounded-xl shadow-2xl max-w-[800px] w-full transition-all duration-300">

        <h1 class="text-3xl font-semibold text-center text-[#e0e1dd] mb-10">Change Password</h1>

        <form action="{{ route('change.password') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="current_password" class="block text-[#e0e1dd] mb-2">Current Password</label>
                <input type="password" id="current_password" name="current_password" value="{{$user->password}}"
                    class="w-full px-4 py-3 rounded-lg bg-[#415a77] text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <p class="w-full text-red-500 text-sm mt-1">@error('current_password') {{ $message }} @enderror</p>
            </div>

            <div>
                <label for="password" class="block text-[#e0e1dd] mb-2">New Password</label>
                <input type="password" id="password" name="password"
                    class="w-full px-4 py-3 rounded-lg bg-[#415a77] text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <p class="w-full text-red-500 text-sm mt-1">@error('password') {{ $message }} @enderror</p>
            </div>

            <div>
                <label for="password_confirmation" class="block text-[#e0e1dd] mb-2">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full px-4 py-3 rounded-lg bg-[#415a77] text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div class="text-center">
                <button type="submit"
                    class="inline-block cursor-pointer px-6 py-3 border border-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition ease-in-out duration-300">
                    Update Password
                </button>
            </div>
        </form>

    </div>
</main>


@endsection