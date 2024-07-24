@extends('layout.portal')

@section('content')
<section class="flex items-center justify-center w-full min-h-screen py-4 bg-mesh-gradient ">
    <div class="flex flex-col lg:flex-row max-w-[1400px] h-auto m-auto p-6 max-sm:pt-4">
        <div class="flex-shrink-0 text-center p-7 bg-blue-900 shadow-2xl rounded-xl max-md:px-4 w-full lg:max-w-[600px]">
            <div class="lg:max-h-[400px] lg:pt-16 grid justify-center lg:gap-12 gap-4 w-full pt-0">
                <div class="mt-10">
                    <img src="{{ asset('images/prmsu.png') }}" class="max-w-[200px] h-[200px] rounded-full text-white mx-auto">
                </div>
                <h4 class="text-3xl font-bold text-white max-md:py-8 max-sm:text-2xl leading-[3rem]">
                    iDocument Request for President Ramon Magsaysay State University
                    <br>
                    Candelaria Campus Registrar's Office
                </h4>
            </div>
        </div>
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="flex-grow grid lg:grid-cols-3 grid-cols-2 max-[525px]:grid-cols-1 content-center gap-5 py-8 px-4 shadow-2xl rounded-2xl">
            @csrf
            <h4 class="text-center text-black py-4 text-3xl font-bold lg:col-span-3 col-span-2">CREATE AN ACCOUNT</h4>
    
            <div class="max-[525px]:col-span-2">
                <label for="firstname">Firstname:</label>
                <input type="text" name="firstname" id="name" value="{{ old('firstname') }}" placeholder="Enter your first name..." class="py-3 rounded-md w-full px-6 bg-slate-100 border-black outline-green-500">
            </div>
            <div class="max-[525px]:col-span-2">
                <label for="lastname">Lastname:</label>
                <input type="text" name="lastname" id="name" value="{{ old('lastname') }}" placeholder="Enter your last name..." class="py-3 rounded-md w-full px-6 bg-slate-100 border-black outline-green-500">
            </div>
            <div class="max-[525px]:col-span-2">
                <label for="middlename">Middlename:</label>
                <input type="text" name="middlename" id="name" value="{{ old('middlename') }}" placeholder="Enter your full name..." class="py-3 rounded-md w-full px-6 bg-slate-100 border-black outline-green-500">
                <span class="text-sm text-gray-500 italic">
                   (Optional)
                </span>
            </div>
            <div class="max-[525px]:col-span-2">
                <label for="extensionname">Extension Name:</label>
                <input type="text" name="extensionname" id="name" value="{{ old('extensionname') }}" placeholder="Enter your full name..." class="py-3 rounded-md w-full px-6 bg-slate-100 border-black outline-green-500">           
                <span class="text-sm text-gray-500 italic">
                    (E.g, jr, sr,)
                 </span>
            </div>
    
            <div>
                <label for="course">COURSE:</label>
                <select name="course" id="course" class="py-3 rounded-md w-full px-6 bg-slate-100 border-black outline-green-500">
                    <option value="" disabled selected>Select Course</option>
                    <option value="bs_infotech">BS INFORMATION TECHNOLOGY</option>
                    <option value="bs_fisheries">BS FISHERIES</option>
                </select>
            </div>
    
            <div class="max-[525px]:col-span-2">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Enter username..." class="py-3 rounded-md w-full px-6 bg-slate-100 border-black outline-green-500">
            </div>
    
            <div class="max-[525px]:col-span-2">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Enter Email..." class="py-3 rounded-md w-full px-6 bg-slate-100 border-black outline-green-500">
            </div>
    
            <div class="max-[525px]:col-span-2">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Enter Address..." class="py-3 rounded-md w-full px-6 bg-slate-100 border-black outline-green-500">
            </div>
    
            <div class="max-[525px]:col-span-2">
                <label for="age">Age:</label>
                <input type="number" name="age" id="age" value="{{ old('agename') }}" placeholder="Enter your age..." class="py-3 rounded-md w-full px-6 bg-slate-100 border-black outline-green-500">
            </div>
    
            <div class="max-[525px]:col-span-2 lg:col-span-2">
                <label for="birthday">Birthdate:</label>
                <input type="date" name="birthday" id="birthday" value="{{ old('birthday') }}" placeholder="Enter your birthday..." class="py-3 rounded-md w-full px-6 bg-slate-100 border-black outline-green-500">
            </div>
            <div>
                <label for="sex">SEX:</label>
                <select name="sex" id="sex" class="py-3 rounded-md w-full px-6 bg-slate-100 border-black outline-green-500">
                    <option value="" disabled selected>Select Sex</option>
                    <option value="male">MALE</option>
                    <option value="female">FEMALE</option>
                </select>
            </div>
    
            <div class="max-[525px]:col-span-2 lg:col-span-2">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter password..." class="py-3 rounded-md w-full px-6 bg-slate-100 border-black outline-green-500">
                <span class="text-sm text-gray-500 italic">
                    Must contain at least one lowercase letter, one uppercase letter, one number, and one special character.
                </span>
            </div>
    
            <div class="max-lg:col-span-2">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password..." class="py-3 rounded-md w-full px-6 bg-slate-100 border-black outline-green-500">
            </div>
    
            <button type="submit" class="py-3 text-xl px-7 bg-green-500 text-white rounded-lg w-full col-span-2 lg:col-span-3">SIGN UP</button>
    
            <p class="py-2 text-xl text-center col-span-2 lg:col-span-3">Already have an account? <a href="{{ route('login') }}" class="text-xl text-blue-700">Login</a></p>
    
            @if (session()->has('failed'))
                <div class="toast-message text-red-600 text-center col-span-2 lg:col-span-3 rounded min-w-16">
                    {{ session('failed') }}
                </div>
            @endif
            @if (session()->has('success'))
                <div class="toast-message text-green-600 text-center col-span-2 lg:col-span-3 rounded min-w-16">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="grid gap-2 col-span-2 lg:col-span-3">
                    @foreach ($errors->all() as $error)
                        <div class="toast-message text-red-600 text-center col-span-2  rounded min-w-26 duration-300 ease-in-out">
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
