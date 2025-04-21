@extends('app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-[#0d1b2a]">
    <div class="bg-[#1b263b] shadow-lg rounded-xl p-6 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center text-[#e0e1dd]">Verify Your Email Address</h2>

        {{-- Success Message --}}
        @if (session()->has('success'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 text-center rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        @if (Auth::check())
        <form action="{{route('verification.send')}}" class="space-y-4" method="POST">
            @csrf
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition cursor-pointer duration-300">
                Resend Email
            </button>
        </form>
        @endif
    </div>
</div>
@endsection