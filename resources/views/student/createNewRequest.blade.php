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
                        {{-- <option value="Certificate of Enrollment">Certificate of Enrollment</option>
                        <option value="Certificate of Grades">Certificate of Grades</option>
                        <option value="Certificate of GWA">Certificate of GWA</option>
                        <option value="Certificate of Academic Completion">Certificate of Academic Completion</option>
                        <option value="Certificate of Graduation">Certificate of Graduation</option>
                        <option value="Certificate of Candidate for Graduation">Certificate of Candidate for Graduation</option>
                        <option value="Certificate of Honor Graduate">Certificate of Honor Graduate</option>
                        <option value="Certificate of English as Intruction">Certificate of English as Intruction</option>
                        <option value="Certificate of Course Description">Certificate of Course Description</option>
                        <option value="Original Diploma">Original Diploma</option>
                        <option value="Copy of Diploma">Copy of Diploma</option>
                        <option value="Form 137">Form 137</option>
                        <option value="Related Learning Experience">Related Learning Experience</option>
                        <option value="CAV">Certification / Authentication / Verification</option>
                        <option value="Transcript of Records">Transcript of Records</option> --}}

                        @forelse ($documents as $document)
                        <option value="{{$document->available_documents}}">{{$document->available_documents}}</option>
                        @empty
                             <option value="" >Coming Soon</option>
                        @endforelse
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


                <div class="p-4 flex items-center gap-4">
                    <label for="purpose" class="font-bold text-md">Did you graduate from PRMSU?</label>
                    <select name="check_graduate" id="check_graduate" class="py-3 px-6 rounded-md border-none w-full outline-none shadow bg-transparent">
                        <option value="" disabled selected>Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>

                <div class="min-[470px]:p-4 flex flex-col items-center gap-4">
                    <div class="flex max-lg:flex-col max-md:flex-row max-[470px]:flex-col  items-center gap-3">
                        <label for="last_term" class="font-bold text-md md:min-w-[150px]">Enter last term:</label>
                        <select name="last_term" id="last_term" class="py-3 px-6 rounded-md border-none sm:max-w-[150px] w-full outline-none shadow bg-transparent">
                            <option value="" disabled selected>Select</option>
                            <option value="1">1st term</option>
                            <option value="2">2nd term</option>
                            <option value="3">3rd term</option>
                            <option value="summer">Summer/Midyear</option>
                        </select>
                        <input type="text" placeholder="Enter school year (2022-2023)" name="last_school_year" id="school_year" class="placeholder-slate-600 px-6  py-3 w-full rounded-md shadow bg-transparent border-none outline-none focus:ring-2 focus:ring-green-600">
                    </div>
                    <span class="text-gray-500 text-center italic">If not graduate, please fill this up</span>
                </div>

                <div class="p-4 flex items-center gap-4">
                    <label for="purpose" class="font-bold text-md">Did you have a correction of name at PRMSU?</label>
                    <select name="check_correction" id="check_correction" class="py-3 px-6 rounded-md border-none w-full outline-none shadow bg-transparent">
                        <option value="" disabled selected>Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>

                <div class="p-4 flex items-center gap-4">
                    <label for="purpose" class="font-bold text-md">If yes, enter your original name:</label>
                    <input type="text" placeholder="Enter original name" name="orig_name" id="orig_name" class="placeholder-slate-600 px-6  py-3 w-full rounded-md shadow bg-transparent border-none outline-none focus:ring-2 focus:ring-green-600">
                </div>

                 <div class="p-4 flex items-center gap-4 max-w-[500px] mx-auto md:col-span-2">
                     <button type="submit"  class="text-white text-md  text-center rounded-md px-10 py-3 bg-green-500 hover:bg-green-600">REQUEST NOW</button>
                 </div>
                 @if (session()->has('failed'))
                 <div class="toast-message text-red-600 text-center col-span-2  rounded min-w-16">
                     {{ session('failed') }}
                 </div>
                @endif
                @if (session()->has('success'))
                    <div class="toast-message text-green-600 text-center col-span-2  rounded min-w-16">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="grid gap-2 col-span-2 ">
                        @foreach ($errors->all() as $error)
                            <div class="toast-message text-red-600 text-center col-span-2  rounded min-w-26 duration-300 ease-in-out">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif
             </form> 

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
        
    </section>
    
@endsection