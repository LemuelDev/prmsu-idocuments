@extends('layout.admin')

@section('content')

    @include('shared.navbar')

    <div class="pl-10 pt-8 max-lg:pl-5 max-lg:max-w-14">
        <a href="{{route('admin.manageAvailableDocuments')}}" class="inline-block py-2 pb-1 px-8 text-white text-center rounded-md no-underline hover:no-underline bg-blue-600 hover:bg-blue-700" style="line-height: 1.5;">
            <span class="text-2xl" style="display: inline-block; vertical-align: middle;"><box-icon name='left-arrow-alt' color='#ffffff'></box-icon></span>
        </a>
    </div>
    

    <section class="xl:max-w-[1300px] 2xl:max-w-[1500px] mx-auto p-4 w-full px-8 max-lg:px-4">


        <div class="w-full rounded-md shadow mt-8 py-6 px-4 md:px-8">
            
                <form action="{{route('admin.saveDocument')}}" method="POST" class="flex justify-center flex-col gap-8 pt-5 max-w-[800px] mx-auto ">
                    @csrf
                    <div class="py-4">
                        <h4 class="text-2xl font-bold text-center">CREATE REQUEST DOCUMENT:</h4>
                    </div>
                    <div class="py-4 flex flex-col">
                        <div class="p-4 flex items-center gap-4">
                            <label for="available_documents" class="font-bold text-md">REQUEST DOCUMENT:</label>
                            <input type="text" name="available_documents" id="available_documents" placeholder="Enter request document"  class="px-6  py-3 rounded-md w-full font-bold shadow bg-transparent border-none outline-none focus:ring-2 focus:ring-green-600">
                        </div>
                        
                    </div>
                    <button type="submit"  class="text-white text-md max-w-[250px] mx-auto  text-center rounded-md px-10 py-3 bg-green-500 hover:bg-green-600">CREATE DOCUMENT</button>
                </form>
                
                @if (session()->has('failed'))
                <div class="toast-message text-red-600 text-center col-span-2 pt-4 rounded min-w-16">
                    {{ session('failed') }}
                </div>
               @endif
               @if (session()->has('error'))
                <div class="toast-message text-red-600 text-center col-span-2 pt-4  rounded min-w-16">
                    {{ session('error') }}
                </div>
               @endif
               @if (session()->has('success'))
                   <div class="toast-message text-green-600 text-center col-span-2 pt-4  rounded min-w-16">
                       {{ session('success') }}
                   </div>
               @endif
               @if ($errors->any())
                   <div class="grid gap-2 col-span-2 ">
                       @foreach ($errors->all() as $error)
                           <div class="toast-message text-red-600 text-center col-span-2 pt-4  rounded min-w-26 duration-300 ease-in-out">
                               {{ $error }}
                           </div>
                       @endforeach
                   </div>
               @endif

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
            
        </div>




    </section>



@endsection