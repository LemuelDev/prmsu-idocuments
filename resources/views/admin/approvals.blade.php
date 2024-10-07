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
            <h4 class="font-bold text-2xl text-center max-sm:text-xl">Pending Approvals</h4>
            <div class="flex gap-3">
                <form method="GET" class="flex items-center justify-center gap-4">
                    <input type="text" placeholder="Search Name" name="search" id="search" class="py-3 max-sm:py-2  px-6 bg-transparent shadow  rounded-lg w-full border border-gray-400 focus:border-none focus:outline-none focus:ring-2 focus:ring-green-500">
                    <button type="submit" class="py-3 px-6 max-sm:py-2 max-sm:px-4 bg-purple-600 rounded-md outline-none border-none text-white hover:bg-purple-700 ">Search</button>
                </form>
                <select name="sort" id="sort" class="py-3 px-6 rounded-md border-none outline-none shadow bg-transparent">
                    <option value="{{ route('admin.approvals') }}" {{ request()->url() == route('admin.approvals') ? 'selected' : '' }}>Approvals</option>
                    <option value="{{ route('admin.activeUsers') }}" {{ request()->url() == route('admin.activeUsers') ? 'selected' : '' }}>ActiveUsers</option>
                </select>
            </div>

            <script>
                document.getElementById("sort").addEventListener("change", function() {
                    var selectedValue = this.value;
                    if (selectedValue) {
                        window.location.href = selectedValue;
                    }
                });
            </script>
        </div>

        @include('admin.tableApprovals')
      
    
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