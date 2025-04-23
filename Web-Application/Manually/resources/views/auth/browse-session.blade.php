@extends('layouts.aside')

@section('main')

<main class="min-h-screen w-full flex items-center justify-center bg-[#0d1b2a] overflow-auto py-5">
    <div class="bg-[#1b263b] p-8 rounded-xl shadow-2xl max-w-[800px] w-full transition-all duration-300">

        <h1 class="text-3xl font-semibold text-center text-[#e0e1dd] mb-10">Browse Session</h1>

        @foreach($device_sessions as $session)
        <div class="bg-[#0d1b2a] text-[#e0e1dd] p-4 my-2 rounded-xl shadow">
            🖥️ {{ $session->browser }} - {{ $session->os }}
            <br>
            🕐 {{ $session->created_at->diffForHumans() }}
        </div>
        @endforeach

        <form action="{{route('logout.other.device')}}" method="POST" class="mt-8 text-center">
            @csrf
            <button type="submit"
                class="bg-red-600 cursor-pointer hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-300 ease-in-out">
                Logout Other Devices
            </button>
        </form>

    </div>
</main>


@endsection