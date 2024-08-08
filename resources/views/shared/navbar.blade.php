<div class="relative text-right flex items-start px-4 pt-4 justify-between max-lg:justify-between  gap-4  2xl:max-w-[1800px] max-[470px]:justify-end ">
    
    <div class="pl-8 pt-2 max-lg:pl-0 max-[470px]:hidden grid">
        <h4 class="font-bold text-xl text-left">PRMSU CANDELARIA</h4>
        <span class="italic text-left text-lg">iDocuments</span>
    </div>

    <div class="flex items-center justify-center max-lg:px-0 p-1">
       <!-- Profile Dropdown Toggle -->
        <div class="relative inline-block text-center lg:min-w-[250px]">
            <div class=" flex items-center cursor-pointer p-2 border border-gray-200 rounded-md  lg:px-8" id="profile-dropdown-toggle">
                <!-- User Information -->
                <div class=" px-2">
                    <p class="text-sm font-medium text-gray-900 mb-0">
                        {{ auth()->user()->userProfile->name }}
                        
                    </p>
                    @if (auth()->user()->userProfile->user_type === 'admin' )
                    <span class="text-xs text-gray-500 pt-0 text-center">
                        Administrator || Registrar
                    </span>
                    @else
                    <span class="text-xs text-gray-500 pt-0 text-center">
                        Student || {{$courseAbr}}
                    </span>
                        
                    @endif
                   
                </div>
                <!-- Dropdown Icon -->
                <span class="ml-2 text-gray-500">
                    <box-icon name='chevron-down'></box-icon>
                </span>
            </div>

            <!-- Dropdown Menu -->
            <div class="origin-top-right absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-10 hidden" id="profile-dropdown">
                <ul class="py-1">
                    <!-- Profile Link -->
                    <li>
                        @if (auth()->user()->userProfile->user_type === 'admin' )
                        <a href="" class="flex items-center cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <box-icon name='user' class="inline-block mr-2 mt-2"></box-icon>
                            <span class="pt-3">
                                Profile
                            </span>
                        </a>
                        @else
                        <a href="{{route('student.profile')}}" class="flex items-center cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <box-icon name='user' class="inline-block mr-2 mt-2"></box-icon>
                            <span class="pt-3">
                                Profile
                            </span>
                        </a>
                            
                        @endif
                      
                    </li>
                    <hr class="border-t my-2">
                    <!-- Logout Button -->
                    <li>
                        <a class="flex items-center cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"  id="toggleButton2">
                            <box-icon name='log-out' class="inline-block mr-2 mt-2"></box-icon>
                            <span class="pt-3">
                                Logout
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

  
</div>
  <!-- Modal -->
  <div id="modal2" class="fixed inset-0 flex items-center justify-center hidden  bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded shadow-md min-w-lg mx-auto px-10">
        <p class="mb-4 py-8">Are you sure you want to logout?</p>
        <div class="flex items-center justify-center gap-4">
            <button id="closeModalButton2" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded">Close</button>
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button class="py-2 bg-red-600 text-white text-md px-4 rounded-md m-auto hover:bg-red-700 border-none ">LOGOUT</button>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get toggle button and modal elements
        var toggleButton = document.getElementById('toggleButton2');
        var modal = document.getElementById('modal2');
        var closeModalButton = document.getElementById('closeModalButton2');

        // Toggle modal display when button clicked
        toggleButton.addEventListener('click', function () {
            modal.classList.toggle('hidden');
        });

        // Close modal when close button clicked
        closeModalButton.addEventListener('click', function () {
            modal.classList.add('hidden');
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggle = document.getElementById('profile-dropdown-toggle');
        const dropdownMenu = document.getElementById('profile-dropdown');

        dropdownToggle.addEventListener('click', function () {
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function (event) {
            if (!dropdownMenu.contains(event.target) && !dropdownToggle.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    });
</script>

