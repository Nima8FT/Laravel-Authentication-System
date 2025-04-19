<div class="bg-[#0d1b2a] h-screen flex justify-center items-center">
    <div
        class="flex justify-center items-center p-4 flex-wrap shadow-lg rounded-xl login-form size-150 max-w-[500px] bg-[#1b263b] h-auto text-center">
        <h1 class="w-full font-bold text-4xl text-[#e0e1dd]">Login Page</h1>

        <div class="w-[90%] p-5">
            <form wire:submit='login'>
                <div class="text-left my-5">
                    <label for="username" class="font-bold text-[#e0e1dd]">Email:</label>
                    <input wire:model='email' type="email" placeholder="Enter your text"
                        class="w-full my-2 px-4 py-2 border border-[#e0e1dd] text-[#e0e1dd] rounded-md shadow-sm focus:outline-none" />
                    <p class="w-full text-red-500">@error('email') {{ $message }} @enderror</p>
                </div>
                <div class="text-left my-5">
                    <label for="username" class="font-bold text-[#e0e1dd]">Password:</label>
                    <input wire:model='password' type="password" placeholder="Enter your text"
                        class="w-full my-2 px-4 py-2 border border-[#e0e1dd] text-[#e0e1dd] rounded-md shadow-sm focus:outline-none" />
                    <p class="w-full text-red-500">@error('password') {{ $message }} @enderror</p>
                </div>
                <div class="text-left my-5 flex justify-start items-center">
                    <input type="checkbox" placeholder="Enter your text"
                        class="accent-blue-500 w-4 h-4 rounded-md focus:outline-none transition ease-in-out border-none" />
                    <label for="username" class="font-bold text-[#e0e1dd] px-2">Remember me</label>
                </div>
                <div class="text-[#e0e1dd] flex justify-between">
                    <a wire:navigate
                        class="cursor-pointer font-medium underline hover:opacity-85 transition duration-300 ease-in-out">Forgot
                        Password</a>
                    <a wire:navigate href="{{route('register')}}"
                        class="cursor-pointer font-medium underline hover:opacity-85 transition duration-300 ease-in-out">Register</a>
                </div>
                <div class="mt-8">
                    <button
                        class="border border-[#e0e1dd] font-medium w-full p-2 rounded-md bg-[#e0e1dd] cursor-pointer hover:opacity-85 transition duration-300 ease-in-out">Login</button>
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
        </div>
    </div>

    @if (session('success'))
    <p class="font-bold text-green-500 text-lg">{{ session('success') }}</p>
    @elseif(session('error'))
    <p class="font-bold text-red-500 text-lg">{{ session('error') }}</p>
    @endif
</div>