@extends('layouts.app')

@section('content')
<div class="bg-[#0d1b2a] min-h-screen flex justify-center items-center space-x-4">
    <aside class="bg-[#1b263b] h-screen w-[300px] rounded-xl flex flex-col justify-between p-5 text-white shadow-lg">
        <div class="mt-5">
            <div class="text-center mb-6">
                <h1 class="font-bold text-3xl">{{$user->name}} Panel</h1>
                <p class="text-gray-300 mt-1">You are logged in!</p>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg hover:bg-[#415a77] transition">
                    📊 Dashboard
                </a>
                <a href="#" class="block px-4 py-2 rounded-lg hover:bg-[#415a77] transition">👤
                    Profile</a>
                <a href="#" class="block px-4 py-2 rounded-lg hover:bg-[#415a77] transition">
                    🔐 Change Password
                </a>
                <a href="#" class="block px-4 py-2 rounded-lg hover:bg-[#415a77] transition">
                    🖥️ Browse Session
                </a>
            </nav>
        </div>

        <div class="mt-6 space-y-4">
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit"
                    class="block text-center w-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-300 rounded-lg py-2 cursor-pointer">Logout</button>
            </form>
            <form action="{{route('delete.account')}}" method="POST">
                @csrf
                <button type="submit"
                    class="block text-center w-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-300 rounded-lg py-2 cursor-pointer">Delete
                    Account</button>
            </form>
        </div>
    </aside>

    <main class="min-h-screen w-full flex items-center justify-center bg-[#0d1b2a] overflow-auto py-5">
        <div class="bg-[#1b263b] p-8 rounded-xl shadow-2xl max-w-[800px] w-full transition-all duration-300">
            <h1 class="text-3xl font-semibold text-center text-[#e0e1dd] mb-10">
                {{ $user->email }}
            </h1>

            @if (session('success'))
            <div
                class="mb-4 px-4 py-3 rounded-md bg-green-600/20 text-green-300 border border-green-500 flex items-center justify-between shadow">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()"
                    class="text-green-300 hover:text-white transition duration-200 cursor-pointer">&times;</button>
            </div>
            @endif

            <div class="flex flex-col md:flex-row gap-6 justify-center items-start flex-wrap">
                {{-- Email Verification --}}

                @if (!$user->email_verified_at)
                <form action="#" method="POST" class="mb-3 w-full">
                    @csrf
                    <button type="submit"
                        class="px-6 cursor-pointer py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                        Verify Your Email
                    </button>
                </form>
                <p class="text-sm text-red-300">Your email is not verified.</p>
                @else
                <div class="px-5 py-3 bg-green-600/20 text-green-400 border border-green-600 rounded-md shadow-sm">
                    ✅ Your Email Is Verified
                </div>
                @endif

                {{-- Two Factor Auth --}}
                @if (!$user->google2fa_secret)
                <form method="GET" action="#">
                    @csrf
                    <button type="submit"
                        class="inline-block cursor-pointer px-6 py-3 border border-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition ease-in-out duration-300">
                        Enable Two Factor Authentication
                    </button>
                </form>
                @else
                <form method="POST" action="#">
                    @csrf
                    <button type="submit"
                        class="inline-block cursor-pointer px-6 py-3 border border-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition ease-in-out duration-300">
                        Disable Two Factor Authentication
                    </button>
                </form>
                @endif

            </div>
        </div>
    </main>



</div>
@endsection