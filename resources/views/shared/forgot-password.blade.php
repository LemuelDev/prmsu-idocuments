@extends('layout.portal')


@section('content')
<section class="flex items-center justify-center w-full min-h-screen py-4 bg-mesh-gradient ">
    <div class="grid grid-cols-1 md:grid-cols-2  max-w-[1100px]  h-auto m-auto p-6 pt-14 max-md:pt-4 ">
        <div class="text-center p-7 bg-blue-900 shadow-2xl rounded-xl max-md:px-4 grid justify-center gap-4 ">
            <div class="mt-10">
                <img src="{{ asset('images/prmsu.png') }}" class="max-w-[200px] h-[200px] rounded-full text-white mx-auto">
           </div>
            <h4 class="text-3xl font-bold text-white max-md:py-8 max-sm:text-2xl leading-[3rem]">iDocument Request for President Ramon Magsaysay State University <br> Candelaria Campus Registrar's Office</h4>
        </div>
        <form action="{{route('password.email')}}" method="post" class="grid content-center gap-5 py-14 px-12 shadow-2xl rounded-xl max-md:px-6 max-md:py-6">
            @csrf
            <h4 class="text-center text-black py-4 text-3xl font-bold">FORGOT PASSWORD</h4>
            <label for="email" class=" text-lg text-center ">Enter your Email</label>
            <input type="text" name="email" id="email" placeholder="Enter email..." class="py-4 rounded-md pt-2 px-6 bor-r-8 bg-slate-100 border-black outline-green-500 w-full">
            <button type="submit" class="py-3 text-xl px-7 border-r-full border-none bg-green-500 text-white rounded-lg">Continue</button>
            <p class="pt-2 text-lg text-center">Don't have any account? <a href="{{ route('signup') }}" class="text-lg text-blue-600">Sign Up</a></p>
            <p class="mt-0 text-lg text-center">Already have an account? <a href="{{ route('login') }}" class="text-lg text-blue-600">Login</a></p>
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