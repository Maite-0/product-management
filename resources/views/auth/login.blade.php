<x-layout>

    <h1 class="title">Login</h1>
    <div class="mx-auto max-w-screen-sm bg-white shadow-lg rounded-lg p-6">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            {{-- Email --}}
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                <input type="email" id="email" name="email"
                    class="input mt-2 block w-full rounded-md border-slate-300 focus:ring-blue-500 focus:border-blue-500"
                    required>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                <input type="password" id="password" name="password"
                    class="input mt-2 block w-full rounded-md border-slate-300 focus:ring-blue-500 focus:border-blue-500"
                    required>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me Checkbox --}}
            <div class="mb-4 flex items-center">
                <input type="checkbox" id="remember" class="form-checkbox">
                <label for="remember" class="text-sm text-slate-700 ml-2">Remember Me</label>
                @error('remember')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            @error('failed')
                <p class="error">{{ $message }}</p>
            @enderror
            {{-- Submit Button --}}
            <div class="mt-6">
                <button type="submit"
                    class="btn w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Login
                </button>
            </div>
        </form>
    </div>

</x-layout>
