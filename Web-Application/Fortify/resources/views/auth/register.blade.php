@extends('app')

@section('content')
<div class="bg-[#0d1b2a] h-screen flex justify-center items-center">
    <div
        class="flex justify-center items-center flex-wrap shadow-lg rounded-xl login-form size-150 max-w-[500px] bg-[#1b263b] h-auto text-center p-4">
        <h1 class="w-full font-bold text-4xl text-[#e0e1dd] mt-3">Register Page</h1>

        <div class="w-[90%] p-5">
            <form method="POST" action="{{ route(name: 'register') }}">
                @csrf
                <div class="text-left my-5">
                    <label for="username" class="font-bold text-[#e0e1dd]">Name:</label>
                    <input wire:model.lazy='name' name="name" type="text" placeholder="Enter your text"
                        class="w-full my-2 px-4 py-2 border border-[#e0e1dd] text-[#e0e1dd] rounded-md shadow-sm focus:outline-none" />
                    <p class="w-full text-red-500">@error('name') {{ $message }} @enderror</p>
                </div>
                <div class="text-left my-5">
                    <label for="username" class="font-bold text-[#e0e1dd]">Email:</label>
                    <input wire:model.lazy='email' name="email" type="email" placeholder="Enter your text"
                        class="w-full my-2 px-4 py-2 border border-[#e0e1dd] text-[#e0e1dd] rounded-md shadow-sm focus:outline-none" />
                    <p class="w-full text-red-500">@error('email') {{ $message }} @enderror</p>
                </div>
                <div class="text-left my-5">
                    <label for="username" class="font-bold text-[#e0e1dd]">Password:</label>
                    <input wire:model.lazy='password' name="password" type="password" placeholder="Enter your text"
                        class="w-full my-2 px-4 py-2 border border-[#e0e1dd] text-[#e0e1dd] rounded-md shadow-sm focus:outline-none" />
                    <p class="w-full text-red-500">@error('password') {{ $message }} @enderror</p>
                </div>
                <div class="text-left my-5">
                    <label for="username" class="font-bold text-[#e0e1dd]">Confirm Password:</label>
                    <input wire:model.lazy='password_confirmation' name="password_confirmation" type="password"
                        placeholder="Enter your text"
                        class="w-full my-2 px-4 py-2 border border-[#e0e1dd] text-[#e0e1dd] rounded-md shadow-sm focus:outline-none" />
                    <p class="w-full text-red-500">@error('password_confirmation') {{ $message }} @enderror</p>
                </div>
                <div class="mt-8">
                    <button
                        class="border border-[#e0e1dd] font-medium w-full p-2 rounded-md bg-[#e0e1dd] cursor-pointer hover:opacity-85 transition duration-300 ease-in-out text-black">Register</button>
                </div>
            </form>
            <div class="mt-4 flex justify-between items-center gap-4">
                <button
                    class="border border-[#e0e1dd] text-[#e0e1dd] w-full p-2 rounded-md font-medium cursor-pointer hover:opacity-85 transition duration-300 ease-in-out hover:bg-[#e0e1dd] hover:text-[#1b263b]">With
                    Github</button>
                <button
                    class="border border-[#e0e1dd] text-[#e0e1dd] w-full p-2 rounded-md font-medium cursor-pointer hover:opacity-85 hover:bg-[#e0e1dd] hover:text-[#1b263b] transition duration-300 ease-in-out">With
                    Facebook</button>
            </div>
            <div class="text-[#e0e1dd] mt-4">
                <a wire:navigate href="{{route('login')}}">
                    Already have an account?
                    <span
                        class="cursor-pointer font-medium underline hover:opacity-85 transition duration-300 ease-in-out">Login</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection