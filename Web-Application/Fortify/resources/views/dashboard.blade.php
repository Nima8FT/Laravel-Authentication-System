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
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit"
                    class="block cursor-pointer text-center w-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-300 rounded-lg py-2">Logout</button>
            </form>
        </div>
    </aside>


    <main class="h-screen w-full flex items-center justify-center bg-[#0d1b2a]">
        <div class="bg-[#1b263b] p-8 rounded-xl shadow-xl max-w-[800px] w-full">
            <h1 class="text-3xl font-semibold text-center text-[#e0e1dd] mb-6">{{ auth()->user()->email }}</h1>
        </div>


    </main>

</div>
@endsection