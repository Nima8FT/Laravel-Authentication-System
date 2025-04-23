@extends('layouts.aside')

@section('main')
<main class="min-h-screen w-full flex items-center justify-center bg-[#0d1b2a] overflow-auto py-5">
    <div class="bg-[#1b263b] p-8 rounded-xl shadow-2xl max-w-[800px] w-full transition-all duration-300">

        <h1 class="text-3xl font-semibold text-center text-[#e0e1dd] mb-10">Edit Profile</h1>

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-[#e0e1dd] mb-2">Name</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}"
                    class="w-full px-4 py-3 rounded-lg bg-[#415a77] text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <p class="w-full text-red-500">@error('name') {{ $message }} @enderror</p>
            </div>

            <div>
                <label for="email" class="block text-[#e0e1dd] mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}"
                    class="w-full px-4 py-3 rounded-lg bg-[#415a77] text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <p class="w-full text-red-500">@error('email') {{ $message }} @enderror</p>
            </div>

            <div class="text-center">
                <button type="submit"
                    class="inline-block cursor-pointer px-6 py-3 border border-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition ease-in-out duration-300">
                    Save Changes
                </button>
            </div>
        </form>

    </div>
</main>




</div>
@endsection