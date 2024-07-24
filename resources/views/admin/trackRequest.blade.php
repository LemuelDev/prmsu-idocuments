@extends('layout.admin')

@section('content')

    @include('shared.navbar')

    <div class="pl-10 pt-8 max-lg:pl-5 max-lg:max-w-14">
        <a href="{{route('admin.listOfRequestForms')}}" class="inline-block py-2 pb-1 px-8 text-white text-center rounded-md no-underline hover:no-underline bg-blue-600 hover:bg-blue-700" style="line-height: 1.5;">
            <span class="text-2xl" style="display: inline-block; vertical-align: middle;"><box-icon name='left-arrow-alt' color='#ffffff'></box-icon></span>
        </a>
    </div>
    

    <section class="xl:max-w-[1300px] 2xl:max-w-[1500px] mx-auto p-4 w-full px-8 max-lg:px-4">

        <div class="py-4">
            <h4 class="text-2xl font-bold text-center">TRACKING REQUEST</h4>
        </div>

        <div class="w-full rounded-md shadow mt-8 py-6 px-4 md:px-8 flex items-start justify-start gap-2 flex-col">
            
            <div class="flex justify-around w-full max-md:flex-col max-md:justify-center max-md:items-center">
                <div class="p-3 flex items-center gap-4 justify-center">
                    <p class="text-lg font-bold">REQUEST_ID:</p>
                    <span class="font-light text-xl">{{$requestDocument->id}}</span>
                </div>
                <div class="p-3 flex items-center gap-4 justify-center">
                    <p class="text-lg font-bold">STATUS:</p>
                    @if ($requestDocument->status === "pending")
                    <span class="font-light text-lg px-2 py-1 rounded-md text-white bg-blue-500">{{$requestDocument->status}}</span>
                    @else
                    <span class="font-light text-lg px-2 py-1 rounded-md text-white bg-orange-500">{{$requestDocument->status}}</span>
                    @endif
                </div>
                <div class="p-3 flex items-center text-center gap-4 justify-center">
                    <p class="text-lg font-bold">Date Requested:</p>
                    <span class="font-light text-lg px-2">{{$requestDocument->created_at->format('F j, Y') }}</span>
                </div>
            </div>
            
            <div class="w-full">
                <h4 class="text-xl font-bold tracking-wide py-4 text-center">Additional Details:</h4>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 w-full md:items-center md:text-center gap-4 py-8">
                <div class="p-3 flex gap-2 md:items-start justify-center items-center">
                    <span class="font-bold text-md md:text-lg text-center">Name:</span>
                    <p class="text-lg text-center">{{$requestDocument->userProfile->name}}</p>
                </div>
                <div class="p-3 flex gap-2 md:items-start justify-center items-center">
                    <span class="font-bold text-md md:text-lg text-center">Course:</span>
                    <p class="text-lg text-center">{{$requestDocument->userProfile->course}}</p>
                </div>
                <div class="p-3 flex gap-2 md:items-start justify-center items-center">
                    <span class="font-bold text-md md:text-lg text-center">Year:</span>
                    <p class="text-lg text-center">3</p>
                </div>
                <div class="p-3 flex gap-2 md:items-start justify-center items-center">
                    <span class="font-bold text-md md:text-lg text-center">Sex:</span>
                    <p class="text-lg text-center">{{$requestDocument->userProfile->sex}}</p>
                </div>
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

            @if ($requestDocument->status === 'pending')
            <div class="grid grid-cols-3 items-center w-full gap-4 py-3 max-sm:grid-cols-1 px-12">
                <a  onclick="toggleModal('approveModal', {{$requestDocument->id}})" class="px-8 py-4 text-white text-center rounded-md bg-green-600 hover:bg-green-700">Approve</a>
                <a  onclick="toggleModal('rejectModal', {{$requestDocument->id}})" class="px-8 py-4 text-white text-center rounded-md bg-red-600 hover:bg-red-700">Reject</a>
                <a href="#" class="px-8 py-4 text-white text-center rounded-md bg-purple-600 hover:bg-purple-700">Contact Student</a>
            </div>
            @else
            <form method="POST" action="{{route('admin.deleteRequest', $requestDocument->id)}}" class="max-w-[300px] mx-auto py-3">
                @csrf
                 @method('DELETE')
                <button type="submit" class="px-16 py-4 text-white text-center rounded-md bg-red-600 hover:bg-red-700">Delete Request</button>
            </form >
            @endif
    
        </div>

        <script>
            function toggleModal(modalId, documentId) {
                const modal = document.getElementById(modalId);
                modal.classList.toggle('hidden');
                modal.classList.toggle('flex');
    
                if (documentId) {
                    const approveButton = modal.querySelector('#approve-button');
                    const rejectButton = modal.querySelector('#reject-button');
    
                    
                if (approveButton) {
                    const approveUrl = `/admin/trackRequest/approve/${documentId}`;
                    approveButton.href = approveUrl;
                }

                if (rejectButton) {
                    const rejectUrl = `/admin/trackRequest/reject/${documentId}`;
                    rejectButton.href = rejectUrl;
                }
                }
            }
        </script>

       <!-- Approve Modal -->
        <div id="approveModal" class="fixed inset-0  items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg p-6 max-w-sm w-full">
                <h2 class="text-xl font-semibold mb-4">Confirm Approval</h2>
                <p class="mb-4">Are you sure you want to approve this request?</p>
                <div class="flex justify-end">
                    <button onclick="toggleModal('approveModal')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md mr-2">Cancel</button>
                    <a href="#" id="approve-button" class="px-4 py-2 bg-green-600 text-white rounded-md ">Approve</a>
                </div>
            </div>
        </div>

        <!-- Reject Modal -->
        <div id="rejectModal" class="fixed inset-0  items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg p-6 max-w-sm w-full">
                <h2 class="text-xl font-semibold mb-4">Confirm Rejection</h2>
                <p class="mb-4">Are you sure you want to reject this request?</p>
                <div class="flex justify-end">
                    <button onclick="toggleModal('rejectModal')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md mr-2">Cancel</button>
                    <a href="#" id="reject-button" class="px-4 py-2 bg-red-600 text-white rounded-md">Reject</a>
                </div>
            </div>
        </div>


    </section>



@endsection