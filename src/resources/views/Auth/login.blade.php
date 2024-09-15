@extends('components.auth-layout')

@section('content')
    <h1 class="text-3xl font-semibold mb-6 text-black text-center">Login</h1>
    <h1 class="text-sm font-semibold mb-6 text-gray-500 text-center">Join to Our Community with all time access and free </h1>

    @error('password')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror

    <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required  class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" required class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
        </div>
        <div class="flex justify-between">
            <div class="flex items-center space-x-2">
                <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-200 rounded focus:ring-gray-300 focus:ring-2 ">
                <label for="remember_me" class="text-sm text-black">Remember me</label>
            </div>
            <a href="{{ route('password.request') }}" class="block text-sm text-black hover:underline">Lupa Pasword?</a>
        </div>
        <div>
            <button type="submit" class="w-full bg-black text-white p-2 rounded-md hover:bg-gray-800 focus:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">Login</button>
        </div>
    </form>
    <div class="mt-4 text-sm text-gray-600 text-center">
        <p>Belum Mempunyai Akun? <a href="{{ route('sign-up') }}" class="text-black hover:underline">Sign Up</a>
        </p>
    </div>
@endsection
