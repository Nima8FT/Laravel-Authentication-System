@extends('layouts.app')

@section('content')
<div class="bg-[#0d1b2a] min-h-screen flex justify-center items-center space-x-4">
    <div class="mt-10 bg-[#1b263b] p-6 rounded-xl shadow-xl max-w-[600px] w-full mx-auto transition-all duration-300">
        <h3 class="text-2xl font-semibold text-center text-[#e0e1dd] mb-6">
            Two Factor Authentication Setup
        </h3>

        <div class="mb-6 text-center">
            <p class="text-sm text-[#e0e1dd] font-mono break-all mb-3">{{ $secret }}</p>
            <div class="flex justify-center">
                {!! $urlQRCode !!}
            </div>
        </div>

        <form method="POST" action="{{ route('enable.2fa') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="secret" value="{{ $secret }}">

            <div>
                <label for="otp" class="block text-[#e0e1dd] mb-1 font-semibold">OTP Code</label>
                <input name="otp" type="text" placeholder="Enter your OTP code"
                    class="w-full px-4 py-2 rounded-md bg-[#1b263b] border border-[#e0e1dd] text-[#e0e1dd] focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <p class="text-red-400 mt-1 text-sm">@error('otp') {{ $message }} @enderror</p>
            </div>

            <button type="submit"
                class="w-full cursor-pointer py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-semibold transition duration-300">
                Verify OTP
            </button>
        </form>
    </div>
</div>
@endsection