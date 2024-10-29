@extends('layout.portal')

@section('content')
<section class="flex items-center justify-center w-full min-h-screen py-4 ">
    <div class="grid grid-cols-1 md:grid-cols-2 max-w-[1100px] h-auto m-auto p-6 pt-14 max-md:pt-4 ">
        <div class="text-center p-7 bg-blue-900 shadow-2xl rounded-xl max-md:px-4 grid justify-center gap-4 ">
            <div class="mt-10">
                 <img src="{{ asset('images/prmsu.png') }}" class="max-w-[200px] h-[200px] rounded-full text-white mx-auto">
            </div>
             <h4 class="text-3xl font-bold text-white max-md:py-8 max-sm:text-2xl leading-[3rem]">iDocument Request for President Ramon Magsaysay State University <br> Candelaria Campus Registrar's Office</h4>
         </div>
        <form action="{{ route('login') }}" method="post" class="grid content-center gap-5 py-6 px-12 shadow-2xl rounded-xl max-md:px-6 max-md:py-6">
            @csrf
            <h4 class="text-center text-black py-4 text-3xl font-bold">LOGIN</h4>
            <input type="text" name="username" id="username" placeholder="Enter username..." class="py-3  px-6 border-2 border-gray-500 focus:border-none rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-green-500">
            <input type="password" name="password" id="password" placeholder="Enter password..." class="py-3  px-6 border-2 border-gray-500 focus:border-none  rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-green-500">
            <button type="submit" class="py-3 text-xl px-7 bg-green-500 text-white rounded-lg w-full">LOGIN</button>
            <a href="{{ route('password.request') }}" class="text-blue-700 text-center text-lg hover:underline block">Forgot Password?</a>
            <p class="py-2 text-lg text-center">Don't have an account? <a href="{{ route('signup') }}" class="text-blue-700">Sign Up</a></p>
            @if (session()->has('failed'))
            <div class="toast-message text-red-600 text-center rounded min-w-16">
                {{ session('failed') }}
            </div>
            @endif
            @if (session()->has('success'))
            <div class="toast-message  text-green-600  text-center rounded min-w-16">
                {{ session('success') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="grid gap-2">
                @foreach ($errors->all() as $error)
                <div class="toast-message  text-red-600 text-center rounded min-w-26 duration-300 ease-in-out">
                    {{ $error }}
                </div>
                @endforeach
            </div>
            @endif
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                const toastMessages = document.querySelectorAll('.toast-message');
                toastMessages.forEach(message => {
                    message.style.opacity = '0';
                    setTimeout(() => message.remove(), 500);
                });
            }, 3000); // 3000ms = 3 seconds
        });
    </script>
</section>


@endsection