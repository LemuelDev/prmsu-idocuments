@extends('layout.admin')

@section('content')

    @include('shared.navbar')
    
    <div class="pl-10 pt-8 max-lg:pl-5 max-lg:max-w-14">
        <a href="{{route('admin.dashboard')}}" class="inline-block py-2 pb-1 px-8 text-white text-center rounded-md no-underline hover:no-underline bg-blue-600 hover:bg-blue-700" style="line-height: 1.5;">
            <span class="text-2xl" style="display: inline-block; vertical-align: middle;"><box-icon name='left-arrow-alt' color='#ffffff'></box-icon></span>
        </a>
    </div>

    <section class="xl:max-w-[1300px] 2xl:max-w-[1500px] mx-auto p-4 w-full px-16 max-lg:px-4">
        <div class="py-4 flex justify-between items-center max-md:flex-col max-md:justify-center max-md:gap-6">
            <h4 class="font-bold text-2xl text-center max-sm:text-xl">Manage Courses</h4>
           <div class="flex gap-3">
            <a href="{{route('admin.createCourse')}}" class=" pt-2 px-6 max-sm:py-2 max-sm:px-4 bg-purple-600 rounded-md outline-none border-none text-white hover:bg-purple-700 ">Create Course</a>
            <select name="sort" id="sort" class="py-3 px-6 rounded-md border-none outline-none shadow bg-transparent">
                <option value="{{ route('admin.manageCourses') }}" {{ request()->url() == route('admin.manageCourses') ? 'selected' : '' }}>Manage Courses</option>
                <option value="{{ route('admin.manageAvailableDocuments') }}" {{ request()->url() == route('admin.manageAvailableDocuments') ? 'selected' : '' }}>Manage AvailableDocuments</option>
            </select>
           </div>
        </div>

        <script>
            document.getElementById("sort").addEventListener("change", function() {
                var selectedValue = this.value;
                if (selectedValue) {
                    window.location.href = selectedValue;
                }
            });
        </script>


        @include('admin.tableCourses')
        
          <!-- Confirmation Modal -->
          <div class="fixed inset-0 z-50 overflow-y-auto hidden" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white rounded-lg shadow-xl max-w-lg mx-auto p-6">
                    <div class="modal-header flex justify-start items-center py-1">
                        <h5 class="text-lg font-medium" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    </div>
                    <div class="modal-body my-4 text-red-500 py-4">
                        Are you sure you want to delete this course? 
                    </div>
                    <div class="modal-footer flex justify-end gap-4">
                        <button type="button" class="text-white py-2 px-6 bg-gray-500 hover:bg-gray-600 rounded-md" data-close-modal>Cancel</button>
                        <form id="deleteForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white py-2 px-6 bg-red-500 hover:bg-red-600 rounded-md">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
            // Open modal when a button with data-toggle-modal is clicked
            document.querySelectorAll('[data-toggle-modal]').forEach(button => {
                button.addEventListener('click', function() {
                    const modalSelector = button.getAttribute('data-toggle-modal');
                    const modal = document.querySelector(modalSelector);
                    const fileId = button.getAttribute('data-file-id');

                    // Ensure fileId is available
                    if (fileId) {
                        // Set the form action URL
                        const deleteForm = modal.querySelector('#deleteForm');
                        
                        // Construct the URL with the file ID parameter
                        const deleteUrl = `/admin/deleteCourse/${fileId}`;
                        
                        // Set the form action to the constructed URL
                        deleteForm.setAttribute('action', deleteUrl);
                        
                        // Show the modal
                        modal.classList.remove('hidden');
                    }
                });
            });

            // Close modal when a button with data-close-modal is clicked
            document.querySelectorAll('[data-close-modal]').forEach(button => {
                button.addEventListener('click', function() {
                    const modal = button.closest('#deleteConfirmationModal');
                    // Hide the modal
                    modal.classList.add('hidden');
                });
            });
            });


        </script>

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