@extends('layout.student')

@section('content')
    @include('shared.navbar')

    <div class="pl-10 pt-8 max-lg:pl-5 max-lg:max-w-14">
        <a href="{{route('student.profile')}}" class="inline-block py-2 pb-1 px-8 text-white text-center rounded-md no-underline hover:no-underline bg-blue-600 hover:bg-blue-700" style="line-height: 1.5;">
            <span class="text-2xl" style="display: inline-block; vertical-align: middle;"><box-icon name='left-arrow-alt' color='#ffffff'></box-icon></span>
        </a>
    </div>

    <section class="xl:max-w-[1300px] 2xl:max-w-[1500px] mx-auto p-4 w-full px-16 pb-6 max-lg:px-8 max-sm:px-4">
        
        <div class="py-4">
            <h4 class="text-2xl font-bold text-center">UPDATE PASSWORD</h4>
        </div>

        <div class="flex items-center justify-around max-md:flex-col max-md:gap-4 gap-8 py-4 shadow w-full rounded-xl mt-6">
            <div class="max-w-[500px] px-4 text-center">
                <h4 class="font-bold text-2xl lg:text-3xl py-3">Important Reminder:</h4>
                <p class="py-3 lg:text-xl">Enter your current password in order to update it.</p>
                <p class="py-3 lg:text-xl">Make sure to have a strong and unique password  before updating it.</p>
            </div>
            <form method="POST" action="{{route('student.changePassword', auth()->user()->id)}}" class="grid grid-cols-1 gap-4 px-4 max-w-[600px] "> 
                @csrf
                @method('PUT')
                <div class="grid text-left gap-4 py-3">
                    <label for="current_password" class="font-bold text-lg">Current Password:</label>
                    <input type="password" name="current_password" id="current_password" placeholder="Currrent password.." class="py-3 placeholder-slate-600 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl focus:outline-1 focus:ring-green-400 focus:ring-2">
                    <span class="text-sm text-gray-500 italic">
                        Enter your current password
                    </span>
                </div>
                <div class="grid text-left gap-4 py-3">
                    <label for="new_password" class="font-bold text-lg">New Password:</label>
                    <input type="password" name="new_password" id="new_password" placeholder="New password.." class="py-3 placeholder-slate-600 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl focus:outline-1 focus:ring-green-400 focus:ring-2">
                    <span class="text-sm text-gray-500 italic">
                        Must contain at least one lowercase letter, one uppercase letter, one number, and one special character.
                    </span>
                </div>
                <div class="grid text-left gap-4 py-3">
                    <label for="new_password_confirmation" class="font-bold text-lg">Confirm Password:</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm password.." class="py-3 placeholder-slate-600 px-6 w-full rounded-md border-none outline-none bg-transparent shadow-xl focus:outline-1 focus:ring-green-400 focus:ring-2">
                    <span class="text-sm text-gray-500 italic">
                        Confirm your new password.
                    </span>
                </div>
                <button type="submit" class="py-3 px-16 rounded-md text-white bg-green-600 hover:bg-green-700  max-w-[350px] mx-auto">UPDATE</button>
                @if ($errors->any())
                <div class="grid gap-2 text-center py-4  ">
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
          
        </div>

    </section>

         {{-- failed modal --}}
         @if (session()->has('failed'))
                                                                        
         <!-- Modal -->
                 <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
                     <!-- Modal Content -->
                     <div class="bg-white rounded-lg shadow-lg p-6 mx-4 sm:mx-auto w-full sm:w-96">
                         <!-- Modal Header -->
                         <div class="flex justify-between items-center mb-4 py-2">
                             <h2 class="font-bold text-xl">Update Password</h2>
                             <!-- Close Button -->
                             <a href="#" id="close-modal" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700" aria-label="Close">
                                 <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                 </svg>
                             </a>
                         </div>
                         <!-- Modal Body -->
                         <div class="mb-4 py-4">
                             <p class="text-center text-red-600">{{session('failed')}} </p>
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