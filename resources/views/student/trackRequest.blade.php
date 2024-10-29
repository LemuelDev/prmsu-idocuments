@extends('layout.student')

@section('content')

    @include('shared.navbar')

    <div class="pl-10 pt-8 max-lg:pl-5 max-lg:max-w-14">
        <a href="{{route('student.listOfRequestForms')}}" class="inline-block py-2 pb-1 px-8 text-white text-center rounded-md no-underline hover:no-underline bg-blue-600 hover:bg-blue-700" style="line-height: 1.5;">
            <span class="text-2xl" style="display: inline-block; vertical-align: middle;"><box-icon name='left-arrow-alt' color='#ffffff'></box-icon></span>
        </a>
    </div>

    <section class="xl:max-w-[1300px] 2xl:max-w-[1500px] mx-auto p-4 w-full px-8 max-lg:px-4">

        <div class="py-4">
            <h4 class="text-2xl font-bold text-center">TRACKING REQUEST</h4>
        </div>

        <div class="w-full rounded-md shadow mt-8 py-6 px-4 md:px-8 flex items-start justify-start gap-2 flex-col">
            
            <div class="flex justify-center gap-8 w-full max-md:flex-col  max-md:items-center">
                <div class="p-3 flex items-center gap-4 justify-center">
                    <p class="text-lg font-bold">REQUEST_ID:</p>
                    <span class="font-light text-xl">{{$requestDocument->id}}</span>
                </div>
                <div class="p-3 flex items-center gap-4 justify-center">
                    <p class="text-lg font-bold">STATUS:</p>
                    <span class="font-light text-lg px-2 py-1 rounded-md text-white bg-blue-500">{{$requestDocument->status}}</span>
                </div>
                <div class="p-3 flex items-center text-center gap-4 justify-center">
                    <p class="text-lg font-bold">Date Requested:</p>
                    <span class="font-light text-lg px-2">{{$requestDocument->created_at->format('F j, Y')}}</span>
                </div>
            </div>
            
            <div class="w-full">
                <h4 class="text-xl font-bold tracking-wide py-4 text-center">Additional Details:</h4>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 w-full md:items-center md:text-center  mx-auto gap-4 py-8">
                <div class="p-3 flex gap-2 md:items-start justify-center items-center">
                    <span class="font-bold text-md md:text-lg text-center">Requested Document:</span>
                    <p class="text-lg text-center">{{$requestDocument->requested_document}}</p>
                </div>
                <div class="p-3 flex gap-2 md:items-start justify-center items-center">
                    <span class="font-bold text-md md:text-lg">No. of copies of ctc:</span>
                    <p class="text-lg">{{$requestDocument->copies_ctc}}</p>
                </div>
                <div class="p-3 flex gap-2 md:items-start justify-center items-center">
                    <span class="font-bold text-md md:text-lg">No. of copies of original document:</span>
                    <p class="text-lg">{{$requestDocument->copies_orig}}</p>
                </div>
                <div class="p-3 flex gap-2 md:items-start justify-center items-center">
                    <span class="font-bold text-md md:text-lg">Purpose of Request:</span>
                    <p class="text-lg">{{$requestDocument->purpose}}</p>
                </div>
            </div>

            <div class="flex justify-center w-full max-w-[300px] mx-auto py-3 md:col-span-2">
                <a href="{{route('student.editRequest', $requestDocument->id)}}" class="px-8 py-3 text-white rounded-md bg-green-600 hover:bg-green-700">Edit Request</a>
            </div>
       
        </div>

    </section>



@endsection