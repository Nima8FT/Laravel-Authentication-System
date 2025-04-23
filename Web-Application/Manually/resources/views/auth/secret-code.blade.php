@extends('layouts.app')

@section('content')
<div class="bg-[#0d1b2a] h-screen flex justify-center items-center space-x-6">
    <div
        class="flex justify-center items-center p-4 flex-wrap shadow-lg rounded-xl login-form size-150 max-w-[500px] bg-[#1b263b] h-auto text-center">
        <h1 class="w-full font-bold text-4xl text-[#e0e1dd]">Two Factor Secret Code</h1>

        <div class="w-[90%] p-5">
            <p class="text-[#e0e1dd] text-xl mb-4 font-medium">
                Please enter your secret code to login
            </p>
            <form method="POST" action="{{route('secret.code')}}">
                @csrf
                <div class="text-left my-5">
                    <label for="code" class="font-bold text-[#e0e1dd]">Code:</label>
                    <input wire:model.lazy='code' name="code" type="text" placeholder="Enter your text"
                        class="w-full my-2 px-4 py-2 border border-[#e0e1dd] text-[#e0e1dd] rounded-md shadow-sm focus:outline-none" />
                    <p class="w-full text-red-500">@error('code') {{ $message }} @enderror</p>
                </div>
                <div class="mt-8">
                    <button type="submit"
                        class="border border-[#e0e1dd] font-medium w-full p-2 rounded-md bg-[#e0e1dd] cursor-pointer hover:opacity-85 transition duration-300 ease-in-out text-black">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection