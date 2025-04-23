@extends('layouts.aside')

@section('main')
<main class="min-h-screen w-full flex items-center justify-center bg-[#0d1b2a] overflow-auto py-5">
    <div class="bg-[#1b263b] p-8 rounded-xl shadow-2xl max-w-[800px] w-full transition-all duration-300">
        <h1 class="text-3xl font-semibold text-center text-[#e0e1dd] mb-5">
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

        <div class="flex flex-col max-w-md mx-auto">

            {{-- Email Verification --}}
            <div class="bg-[#1b263b] p-5 rounded-xl shadow">
                @if (!$user->email_verified_at)
                <form action="{{ route('verification.send') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full cursor-pointer px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition ease-in-out duration-300">
                        Verify Your Email
                    </button>
                </form>
                <p class="mt-2 text-sm text-red-300 text-center">Your email is not verified.</p>
                @else
                <div class="px-5 py-3 bg-green-600/20 text-green-400 border border-green-600 rounded-md shadow-sm">
                    ✅ Your Email Is Verified
                </div>
                @endif
            </div>

            {{-- Two Factor Authentication --}}
            <div class="bg-[#1b263b] rounded-xl shadow">
                @if (!$user->google2fa_secret)
                <form method="GET" action="{{route('enable.2fa.show')}}">
                    @csrf
                    <button type="submit"
                        class="w-full cursor-pointer px-6 py-3 border border-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition ease-in-out duration-300">
                        Enable Two Factor Authentication
                    </button>
                </form>
                @else
                <form method="POST" action="{{route('disable.2fa')}}">
                    @csrf
                    <button type="submit"
                        class="w-full cursor-pointer px-6 py-3 border border-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition ease-in-out duration-300">
                        Disable Two Factor Authentication
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</main>



</div>
@endsection