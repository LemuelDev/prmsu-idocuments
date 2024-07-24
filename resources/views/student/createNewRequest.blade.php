@extends('layout.student')

@section('content')

    @include('shared.navbar')

    <div class="pl-10 pt-8 max-lg:pl-5 max-lg:max-w-14">
        <a href="{{route('student.listOfRequestForms')}}" class="inline-block py-2 pb-1 px-8 text-white text-center rounded-md no-underline hover:no-underline bg-blue-600 hover:bg-blue-700" style="line-height: 1.5;">
            <span class="text-2xl" style="display: inline-block; vertical-align: middle;"><box-icon name='left-arrow-alt' color='#ffffff'></box-icon></span>
        </a>
    </div>
    <section class="xl:max-w-[1300px] 2xl:max-w-[1500px] mx-auto p-4 w-full px-8 max-lg:px-4">

        <div class="py-4 pt-6">
            <h4 class="text-2xl font-bold text-center">CREATE NEW REQUEST</h4>
        </div>

        <div class="mt-4 py-10 w-full rounded-xl shadow px-6 max-sm:px-3">
 
            <form method="POST" action="{{route('student.request')}}" class="grid grid-cols-2 max-md:grid-cols-1 gap-4">
                @csrf
                <div class="p-4 flex items-center gap-4">
                    <label for="requested_document" class="font-bold text-md">Type of Document Requested:</label>
                    <select name="requested_document" id="requested_document" class="py-3 px-6 rounded-md border-none w-full outline-none shadow bg-transparent">
                        <option value="" disabled selected>Select Document</option>
                        <option value="Certificate of Enrollment">Certificate of Enrollment</option>
                        <option value="Certificate of Grades">Certificate of Grades</option>
                        <option value="Transcript of Records">Transcript of Records</option>
                    </select>
                </div>

                <div class="p-4 flex items-center gap-4">
                    <label for="num-ctc" class="font-bold text-md">No. of copies of CTC:</label>
                    <input type="number" min="1" value="1" name="num-ctc" id="num-ctc" class="px-6 py-3 rounded-md w-full font-bold shadow bg-transparent border-none outline-none focus:ring-2 focus:ring-green-600">
                </div>

                <div class="p-4 flex items-center gap-4">
                    <label for="num-orig" class="font-bold text-md">No. of copies of Original Document:</label>
                    <input type="number" min="1" value="1" name="num-orig" id="num-orig" class="px-6 py-3 rounded-md w-full font-bold shadow bg-transparent border-none outline-none focus:ring-2 focus:ring-green-600">
                </div>

                <div class="p-4 flex items-center gap-4">
                    <label for="purpose" class="font-bold text-md">Purpose of Request:</label>
                    <input type="text" placeholder="Enter purpose here" name="purpose" id="purpose" class="placeholder-slate-600 px-6  py-3 w-full rounded-md shadow bg-transparent border-none outline-none focus:ring-2 focus:ring-green-600">
                </div>

                 <div class="p-4 flex items-center gap-4 max-w-[500px] mx-auto md:col-span-2">
                     <button type="submit"  class="text-white text-md  text-center rounded-md px-10 py-3 bg-green-500 hover:bg-green-600">REQUEST NOW</button>
                 </div>
             </form> 

        </div>
        
    </section>
    
@endsection