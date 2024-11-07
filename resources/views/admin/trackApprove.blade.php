@extends('layout.student')

@section('content')

    @include('shared.navbar')

    <div class="pl-10 pt-8 max-lg:pl-5 max-lg:max-w-14">
        <a href="{{route('admin.approvals')}}" class="inline-block py-2 pb-1 px-8 text-white text-center rounded-md no-underline hover:no-underline bg-blue-600 hover:bg-blue-700" style="line-height: 1.5;">
            <span class="text-2xl" style="display: inline-block; vertical-align: middle;"><box-icon name='left-arrow-alt' color='#ffffff'></box-icon></span>
        </a>
    </div>

    <section class="xl:max-w-[1300px] 2xl:max-w-[1500px] mx-auto p-4 w-full px-8 max-lg:px-4">

            <div class="py-4">
                <h4 class="text-2xl font-bold text-center">USER PROFILE</h4>
            </div>
 
            <form class="w-full grid md:grid-cols-2 grid-cols-1 gap-4" >    
                <div class="p-4 flex items-center gap-4">
                    <label for="name" class="font-bold">NAME:</label>
                    <input type="text" name="name" readonly  class="py-3 px-6 w-full rounded-md  border-gray-400 border-2 outline-none shadow-xl" value="{{$user->name}}">
                </div>
                
                <div class="p-4 flex items-center gap-4">
                    <label for="email" class="font-bold">EMAIL:</label>
                    <input type="text" name="email" readonly  class="py-3 px-6 w-full rounded-md  border-gray-400 border-2 outline-none shadow-xl" value="{{$user->email}}">
                </div>
                
                <div class="p-4 flex items-center gap-4">
                    <label for="address" class="font-bold">ADDRESS:</label>
                    <input type="text" name="address" readonly  class="py-3 px-6 w-full rounded-md  border-gray-400 border-2 outline-none shadow-xl" value="{{$user->address}}">
                </div>
                
 
                 <div class="p-4 flex items-center gap-4">
                    <label for="sex" class="font-bold">SEX:</label>
                    <select name="sex" id="sex" @readonly(true) class="py-3 rounded-md w-full px-6 shadow  border-gray-400 border-2 outline-none" >
                        <option value="" disabled selected>Select Sex</option>
                        <option value="male" {{$user->sex == 'male' ? 'selected' : 'disabled' }}>MALE</option>
                        <option value="female" {{$user->sex == 'female' ? 'selected' : 'disabled' }}>FEMALE</option>
                    </select>
                </div>

                <div class="p-4 flex items-center gap-4">
                    <label for="course" class="font-bold">Course:</label>
                    <input type="text" readonly name="course" id="course" value="{{$user->course}}" placeholder="Enter your phone number..." class="py-3 rounded-md w-full px-6 shadow  border-gray-400 border-2 outline-none">
                </div>

                <div class="p-4 flex items-center gap-4">
                    <label for="year" class="font-bold">YEAR:</label>
                    <select name="year" id="year" @readonly(true) class="py-3 rounded-md w-full px-6  border-gray-400 border-2 outline-none shadow">
                        <option value="" disabled selected>Select Year</option>
                        <option value="1" {{$user->year == '1' ? 'selected' : 'disabled' }}>1</option>
                        <option value="2" {{$user->year == '2' ? 'selected' : 'disabled' }}>2</option>
                        <option value="3" {{$user->year == '3' ? 'selected' : 'disabled' }}>3</option>
                        <option value="4" {{$user->year == '4' ? 'selected' : 'disabled' }}>4</option>
                    </select>
                </div>

                <div class="p-4 flex items-center gap-4">
                    <label for="student_number" class="font-bold">Student Number:</label>
                    <input type="text" readonly name="student_number" id="student_number" value="{{$user->student_number}}" placeholder="Enter your phone number..." class="py-3 rounded-md w-full px-6 shadow  border-gray-400 border-2 outline-none">
                </div>


                <div class="p-4 flex items-center gap-4">
                    <label for="phone_number" class="font-bold">Phone Number:</label>
                    <input type="number" readonly name="phone_number" id="phone_number" value="{{$user->phone_number}}" placeholder="Enter your phone number..." class="py-3 rounded-md w-full px-6 shadow  border-gray-400 border-2 outline-none">
                </div>
                

                 <div class="p-4 flex items-center gap-4 max-w-[700px] mx-auto md:col-span-2 ">
                    <a href="{{route('admin.approve', $user->id)}}" class="text-white rounded-md px-4 py-3 bg-green-500 hover:bg-green-600 text-center whitespace-nowrap">APPROVE</a>
                    <a href="{{route('admin.deleteApproval', $user->id)}}" class="text-white rounded-md px-4 py-3 bg-red-500 hover:bg-red-600 text-center whitespace-nowrap">DELETE</a>
                 </div>
             </form> 
     
      
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