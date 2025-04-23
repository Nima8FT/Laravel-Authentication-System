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
                <a href="{{route('profile.show')}}" class="block px-4 py-2 rounded-lg hover:bg-[#415a77] transition">👤
                    Profile</a>
                <a href="{{route('change.password.show')}}"
                    class="block px-4 py-2 rounded-lg hover:bg-[#415a77] transition">
                    🔐 Change Password
                </a>
                <a href="{{route('browse.session')}}" class="block px-4 py-2 rounded-lg hover:bg-[#415a77] transition">
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

    @yield('main')
    @endsection