@extends('layout.student')

@section('content')

    @include('shared.navbar')

    <div class="pl-10 pt-8 max-lg:pl-5 max-lg:max-w-14">
        <a href="{{route('student.dashboard')}}" class="inline-block py-2 pb-1 px-8 text-white text-center rounded-md no-underline hover:no-underline bg-blue-600 hover:bg-blue-700" style="line-height: 1.5;">
            <span class="text-2xl" style="display: inline-block; vertical-align: middle;"><box-icon name='left-arrow-alt' color='#ffffff'></box-icon></span>
        </a>
    </div>

    <section class="xl:max-w-[1300px] 2xl:max-w-[1500px] mx-auto p-4 w-full px-8 max-lg:px-4">

            @if ($editing ?? false)
            <div class="py-4">
                <h4 class="text-2xl font-bold text-center">EDIT ACCOUNT PROFILE</h4>
            </div>
 
            <form method="POST" action="{{route('student.updateProfile', auth()->user()->id)}}" class="w-full grid md:grid-cols-2 grid-cols-1 gap-4" >
                @csrf
                @method('PUT')
                <div class="p-4 flex items-center gap-4">
                    <label for="name" class="font-bold">FIRSTNAME:</label>
                    <input type="text" name="firstname" class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->firstname}}">
                </div>
                <div class="p-4 flex items-center gap-4">
                    <label for="name" class="font-bold">MIDDLENAME:</label>
                    <input type="text" name="middlename" class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->middlename}}">
                </div>
                <div class="p-4 flex items-center gap-4">
                    <label for="name" class="font-bold">LASTNAME:</label>
                    <input type="text" name="lastname" class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->lastname}}">
                </div>
                <div class="p-4 flex items-center gap-4">
                    <label for="name" class="font-bold">EXTENSIONNAME:</label>
                    <input type="text" name="extensionname" class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->extensionname}}">
                </div>
    
                <div class="p-4 flex items-center gap-4">
                    <label for="username" class="font-bold">USERNAME:</label>
                    <input type="text" name="username"  class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->username}}">
                </div>
    
                <div class="p-4 flex items-center gap-4">
                    <label for="email" class="font-bold">EMAIL:</label>
                    <input type="text" name="email"  class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->email}}">
                </div>
                
                <div class="p-4 flex items-center gap-4">
                    <label for="address" class="font-bold">ADDRESS:</label>
                    <input type="text" name="address"  class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->address}}">
                </div>
                
                <div class="p-4 flex items-center gap-4">
                    <label for="birthday" class="font-bold">BIRTHDAY:</label>
                    <input type="date" name="birthday"  class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->birthday}}">
                 </div>
                
                <div class="p-4 flex items-center gap-4">
                   <label for="age" class="font-bold">AGE:</label>
                   <input type="text" name="age"  class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->age}}">
                </div>
 
                 <div class="p-4 flex items-center gap-4">
                    <label for="sex" class="font-bold">SEX:</label>
                    <select name="sex" id="sex" class="py-3 rounded-md w-full px-6 bg-slate-100 border-black shadow bg-transparent outline-green-500" >
                        <option value="" disabled selected>Select Sex</option>
                        <option value="male" {{ auth()->user()->userProfile->sex == 'male' ? 'selected' : '' }}>MALE</option>
                        <option value="female" {{ auth()->user()->userProfile->sex == 'female' ? 'selected' : '' }}>FEMALE</option>
                    </select>
                 </div>

                 {{-- <div class="p-4 flex items-center gap-4">
                    <label for="course" class="font-bold">COURSE:</label>
                    <select name="course" id="course" class="py-3 rounded-md w-full px-6 bg-slate-100 border-black shadow outline-green-500 bg-transparent" >
                        <option value="" disabled selected>Select Course</option>
                        <option value="bs_infotech" {{ auth()->user()->userProfile->course == 'bs_infotech' ? 'selected' : '' }}>BS INFORMATION TECHNOLOGY</option>
                        <option value="bs_fisheries" {{ auth()->user()->userProfile->course == 'bs_fisheries' ? 'selected' : '' }}>BS FISHERIES</option>
                    </select>
                </div> --}}

                <div class="p-4 flex items-center gap-4">
                    <label for="year" class="font-bold">YEAR:</label>
                    <select name="year" id="year" class="py-3 rounded-md w-full px-6 bg-slate-100 border-black outline-green-500 bg-transparent shadow">
                        <option value="" disabled selected>Select Year</option>
                        <option value="1" {{ auth()->user()->userProfile->year == '1' ? 'selected' : '' }}>1</option>
                        <option value="2" {{ auth()->user()->userProfile->year == '2' ? 'selected' : '' }}>2</option>
                        <option value="3" {{ auth()->user()->userProfile->year == '3' ? 'selected' : '' }}>3</option>
                        <option value="4" {{ auth()->user()->userProfile->year == '4' ? 'selected' : '' }}>4</option>
                    </select>
                </div>
                <div class="p-4 flex items-center gap-4">
                    <label for="phone_number" class="font-bold">Number:</label>
                    <input type="number" name="phone_number" id="phone_number" value="{{auth()->user()->userProfile->phone_number}}" placeholder="Enter your phone number..." class="py-3 rounded-md w-full px-6 bg-transparent shadow bg-slate-100 border-black outline-green-500">
                </div>
 
                 <div class="p-4 flex items-center gap-4 max-w-[400px] mx-auto md:col-span-2 ">
                     <button type="submit"  class="text-white text-md max-sm:text-sm text-center rounded-md px-16 py-3 bg-green-500 hover:bg-green-600">SAVE</button>
                 </div>

                 @if ($errors->any())
                 <div class="grid gap-2 text-center py-4 md:col-span-2 ">
                     @foreach ($errors->all() as $error)
                         <div class="toast-message text-red-600 text-center col-span-2  rounded min-w-26 duration-300 ease-in-out">
                             {{ $error }}
                         </div>
                     @endforeach
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
                 @endif
             </form> 
     
            @else
        
        <div class="py-4">
            <h4 class="text-2xl font-bold text-center">ACCOUNT PROFILE</h4>
        </div>

        <div class="mt-4 py-10  w-full rounded-xl shadow grid grid-cols-2 max-md:grid-cols-1 gap-4 px-6">
            <div class="p-4 flex items-center gap-4">
                 <label for="name" class="font-bold">FIRSTNAME:</label>
                 <input type="text" name="firstname" readonly class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->firstname}}">
             </div>
             <div class="p-4 flex items-center gap-4">
                <label for="name" class="font-bold">MIDDLENAME:</label>
                <input type="text" name="middlename" readonly class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->middlename }}">
            </div>
            <div class="p-4 flex items-center gap-4">
                <label for="name" class="font-bold">LASTNAME:</label>
                <input type="text" name="lastname" readonly class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->lastname}}">
            </div>
            <div class="p-4 flex items-center gap-4">
                <label for="name" class="font-bold">EXTENSIONNAME:</label>
                <input type="text" name="extensionname" readonly class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->extensionname }}">
            </div>
 
             <div class="p-4 flex items-center gap-4">
                 <label for="username" class="font-bold">USERNAME:</label>
                 <input type="text" name="username" readonly  class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->username}}">
             </div>
 
             <div class="p-4 flex items-center gap-4">
                 <label for="email" class="font-bold">EMAIL:</label>
                 <input type="text" name="email" readonly  class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->email}}">
             </div>
             
             <div class="p-4 flex items-center gap-4">
                 <label for="address" class="font-bold">ADDRESS:</label>
                 <input type="text" name="address" readonly  class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->address}}">
             </div>
 
             <div class="p-4 flex items-center gap-4">
                 <label for="sex" class="font-bold">SEX:</label>
                 <input type="text" name="sex" readonly  class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->sex}}">
             </div>

             <div class="p-4 flex items-center gap-4">
                <label for="birthday" class="font-bold">BIRTHDAY:</label>
                <input type="text" name="birthday"  class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->birthday}}">
             </div>

             <div class="p-4 flex items-center gap-4">
                <label for="age" class="font-bold">AGE:</label>
                <input type="text" name="age"  class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->age}}">
            </div>

             <div class="p-4 flex items-center gap-4">
                <label for="course" class="font-bold">COURSE:</label>
                <input type="text" name="course" readonly  class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->course}}">
            </div>

            <div class="p-4 flex items-center gap-4">
                <label for="year" class="font-bold">Year:</label>
                <input type="text" name="year" readonly  class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->year}}">
            </div>

            <div class="p-4 flex items-center gap-4">
                <label for="phone_number" class="font-bold">Phone Number:</label>
                <input type="text" name="phone_number" readonly  class="py-3 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl" value="{{auth()->user()->userProfile->phone_number}}">
            </div>
 
             <div class="p-4 flex items-center gap-4 max-w-[500px] mx-auto md:col-span-2">
                 <a href="{{route('student.editProfile')}}"  class="text-white text-md max-sm:text-sm text-center rounded-md px-6 py-3 bg-green-500 hover:bg-green-600">EDIT PROFILE</a>
                 <a href="{{route('student.updatePassword')}}" class="text-white text-md max-sm:text-sm text-center rounded-md px-6 py-3 bg-gray-500 hover:bg-gray-600">UPDATE PASSWORD</a>
             </div>
            @endif
         </div> 

    </section>


     {{-- success modal --}}
     @if (session()->has('success'))
                                                                        
     <!-- Modal -->
             <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
                 <!-- Modal Content -->
                 <div class="bg-white rounded-lg shadow-lg p-6 mx-4 sm:mx-auto w-full sm:w-96">
                     <!-- Modal Header -->
                     <div class="flex justify-end items-center mb-4 py-2">
                         
                         <!-- Close Button -->
                         <a href="#" id="close-modal" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700" aria-label="Close">
                             <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                             </svg>
                         </a>
                     </div>
                     <!-- Modal Body -->
                     <div class="mb-4 py-4">
                         <p class="text-center text-green-600">{{session('success')}} </p>
                     </div>
                 </div>
             </div>

             <script>
                 // Get references to modal elements
                 const modal = document.getElementById('modal');
                 const closeModalButton = document.getElementById('close-modal');


                 // Function to open the modal
                 function openModal() {
                     modal.classList.remove('hidden');
                 }

                 // Function to close the modal
                 function closeModal() {
                     modal.classList.add('hidden');
                 }

                 // Event listener for close button
                 closeModalButton.addEventListener('click', closeModal);

             </script>
      @endif

  




@endsection