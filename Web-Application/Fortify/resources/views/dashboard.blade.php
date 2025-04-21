@extends('app')

@section('content')
<div class="bg-[#0d1b2a] h-screen flex justify-center items-center space-x-4">
    <aside class="bg-[#1b263b] h-screen w-[300px] rounded-xl flex flex-col justify-between p-5 text-white shadow-lg">
        <div class="mt-5">
            <div class="text-center mb-6">
                <h1 class="font-bold text-3xl">Your Panel</h1>
                <p class="text-gray-300 mt-1">You are logged in!</p>
            </div>

            <nav class="space-y-2">
                <a href="#" class="block px-4 py-2 rounded-lg hover:bg-[#415a77] transition">👤 Profile</a>
            </nav>
        </div>

        <div class="mt-6 space-y-4">
            <form action="{{route(name: 'logout')}}" method="POST">
                @csrf
                <button type="submit"
                    class="block text-center w-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-300 rounded-lg py-2 cursor-pointer">Logout</button>
            </form>
        </div>
    </aside>


    <main class="h-screen w-full flex items-center justify-center bg-[#0d1b2a]">
        <div class="bg-[#1b263b] p-8 rounded-xl shadow-xl max-w-[800px] w-full">
            <h1 class="text-3xl font-semibold text-center text-[#e0e1dd] mb-6">{{ auth()->user()->email }}</h1>

            @if (session('status') === 'two-factor-authentication-enabled')
            <div class="bg-green-100 text-green-800 p-4 mb-4 rounded-lg shadow-md border border-green-300">
                <strong class="font-medium">Two-Factor Authentication is enabled!</strong>
            </div>
            @endif

            @if (session('status') === 'two-factor-authentication-disabled')
            <div class="bg-red-100 text-red-800 p-4 mb-4 rounded-lg shadow-md border border-red-300">
                <strong class="font-medium">Two-Factor Authentication is disabled.</strong>
            </div>
            @endif

            <form action="{{ route('two-factor.enable') }}" method="POST" class="space-y-4 text-center">
                @csrf
                @if (Auth::user()->two_factor_secret)
                @method('DELETE')

                <div class="w-48 h-48 mx-auto text-white bg-white">{!! Auth::user()->twoFactorQrCodeSvg() !!}</div>

                <div>
                    <h4>Recovery Codes</h4>
                    <ul class="grid grid-cols-2 gap-3">
                        @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $recovery_code)
                        <li
                            class="bg-[#1e3a5f] text-sm text-[#cbd5e1] px-4 py-2 rounded-md border border-[#3b4b5c] tracking-wider">
                            {{ $recovery_code }}
                        </li>
                        @endforeach
                    </ul>
                </div>

                <button type="submit"
                    class="w-[50%] cursor-pointer bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg transition duration-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                    Disable Two-Factor Authentication
                </button>
                @else
                <button type="submit"
                    class="w-[50%] cursor-pointer bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Enable Two-Factor Authentication
                </button>
                @endif
            </form>
        </div>


    </main>

</div>
@endsection