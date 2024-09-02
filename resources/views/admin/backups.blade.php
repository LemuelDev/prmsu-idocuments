

@extends('layout.admin')

@section('content')

    @include('shared.navbar')

    <div class="pl-10 pt-8 max-lg:pl-5 max-lg:max-w-14">
        <a href="{{route('admin.dashboard')}}" class="inline-block py-2 pb-1 px-8 text-white text-center rounded-md no-underline hover:no-underline bg-blue-600 hover:bg-blue-700" style="line-height: 1.5;">
            <span class="text-2xl" style="display: inline-block; vertical-align: middle;"><box-icon name='left-arrow-alt' color='#ffffff'></box-icon></span>
        </a>
    </div>
    

    <section class="xl:max-w-[1300px] 2xl:max-w-[1500px] mx-auto p-4 w-full px-16 max-lg:px-4">

        <div class="max-w-[1100px] mx-auto px-4 sm:px-10 py-6 shadow rounded-md bg-transparent grid text-left">
            <div class="py-4 grid gap-4">
                <h4 class="text-2xl font-bold max-sm:text-center">System Backup</h4>
                <p class="text-lg leading-7 pb-6 max-sm:text-center">System backups are essential for protecting data against loss due to hardware failures, software issues, or cyberattacks. 
                By regularly creating copies of critical data and system configurations, users can quickly restore their systems to a previous state, minimizing downtime and disruption. 
                Implementing a consistent backup strategy and regularly testing backups are key to ensuring data integrity and availability.</p>
            </div>
            <form action="{{ route('backup.create') }}" id="backup-form" class="max-sm:max-w-[200px] max-sm:mx-auto" method="POST">
                @csrf
                <button type="submit" id="backup-btn" class="px-10 py-3 rounded-md text-white bg-green-600 hover:bg-green-700">Create Backup</button>
            </form>
            <div id="status-message" style="display: none;" class="py-6"></div>
            <span class="italic text-gray-600 pt-5 max-sm:text-center">Last Backup: {{$lastBackupDate}} </span>
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

          
        {{-- success modal --}}
        @if (session()->has('error'))
                                                                        
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
                            <p class="text-center text-green-600">{{session('error')}} </p>
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