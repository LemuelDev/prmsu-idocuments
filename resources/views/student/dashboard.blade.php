@extends('layout.student')

@section('content')
    @include('shared.navbar')

    <section class="xl:max-w-[1300px] 2xl:max-w-[1500px] mx-auto p-4 w-full px-20 max-lg:px-8">
        {{-- <div class="pt-2 pb-8">
            <a href="#" class="py-3 px-8 text-white rounded-md text-xl no-underline hover:no-underline bg-blue-600 hover:bg-blue-700">BACK</a>
        </div> --}}
        <div class="max-[470px]:block hidden text-center w-full pt-4">
            <h4 class="font-bold text-xl">PRMSU CANDELARIA <br> iDocuments</h4>
        </div> 

        <div class="grid grid-cols-3 max-md:grid-cols-1  gap-7 items-center content-center pt-32 max-[470px]:pt-6 max-sm:pb-6">

            <a href="{{route('student.listOfRequestForms')}}" class="text-xl max-md:text-lg max-md:px-12 max-lg:px-4  max-lg:text-lg max-sm:px-9  font-bold px-16 py-20 flex flex-col items-center justify-center rounded-xl shadow-2xl bg-[#4A249D] hover:bg-[#3e2478] text-white">
            <span class="text-2xl"><box-icon name='notepad' type='solid' color='#ffffff' ></box-icon></span>List of Request Forms</a>
            
            <a href="{{route('student.historyOfRequest')}}" class="text-xl max-md:text-lg max-md:px-12 max-lg:text-lg max-lg:px-4 max-sm:px-9  font-bold px-16 py-20 flex flex-col items-center justify-center rounded-xl shadow-2xl bg-[#f3c335] hover:bg-[#d5af3d] text-white">
            <span class="text-2xl"><box-icon name='history' type='solid' color='#ffffff'></box-icon></span>History of Request</a>
            
            <a href="{{route('student.profile')}}" class="text-xl max-md:text-lg max-md:px-12 max-lg:text-lg max-lg:px-4  max-sm:px-9 font-bold px-16 py-20 flex flex-col items-center justify-center rounded-xl shadow-2xl bg-[#405D72] hover:bg-[#2d4657] text-white">
            <span class="text-2xl"><box-icon type='solid' name='user' color='#ffffff'></box-icon></span>Profile</a>
            
        </div>

    </section>


@endsection