<div class="overflow-x-auto rounded-lg shadow-xl min-[470px]:mt-8">
  <table class="w-full">
      <thead>
        <tr>
          <th class="text-center text-xl p-4 font-semibold">Request_ID</th>
          <th class="text-center text-xl p-4 font-semibold">Name</th>
          <th class="text-center text-xl p-4 font-semibold">Course</th>
          {{-- <th class="text-center text-xl p-4 font-semibold">Year</th> --}}
          <th class="text-center text-xl p-4 font-semibold">Requested Document</th>
          <th class="text-center text-xl p-4 font-semibold">Date Requested </th>
          <th class="text-center text-xl p-4 font-semibold">Status</th>
          <th class="text-center text-xl p-4 font-semibold">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($forms as $form)
          <tr class=" hover:bg-white">
            <td class="p-3 text-md text-center tracking-wide">{{$form->id}}</td>
            <td class="p-3 text-md text-center tracking-wide">{{$form->userProfile->name}}</td>
             <td class="p-3 text-md text-center tracking-wide">{{$form->userProfile->course}}</td>
            <td class="p-3 text-md text-center tracking-wide">{{$form->requested_document}} </td>
            <td class="p-3 text-md text-center tracking-wide">{{ $form->created_at->format('F j, Y') }}</td>
            <td class="p-4 text-md text-center tracking-wide min-w-40 ">
              @if ($form->status == 'completed')
              <span class="rounded-md p-2 bg-green-500 text-white ">Completed</span>
              @elseif($form->status == 'rejected')
              <span class="rounded-md p-2 bg-red-500 text-white ">Rejected</span>
              @elseif($form->status == 'ongoing')
              <span class="rounded-md p-2 bg-blue-500 text-white ">Ongoing</span>
              @else
              <span class="rounded-md p-2 bg-orange-500 text-white tracking-wide ">For Deletion</span>
              @endif
            </td>
            @if ($form->status == 'completed')
            <td class="p-3 text-md text-center tracking-wide">
               <a href="{{ route('admin.download', $form->id) }}" class="">
                   <span class="text-xl"><box-icon type='solid' name='download'></box-icon></span>
               </a>
           </td>
           @elseif ($form->status == 'ongoing')
           <td class="p-3 text-md text-center tracking-wide w-40">
            <a href="{{route('admin.trackRequest', $form->id)}}" class="text-white rounded-md px-4 py-3 text-sm bg-green-500 hover:bg-green-600 text-center whitespace-nowrap">TRACK REQUEST</a>
           </td>
          @elseif ($form->status == 'rejected')
           <td class="p-3 text-md text-center tracking-wide">
               <a onclick="toggleModal('rejectModal', '{{ $form->reject_reason }}')" 
                   class="px-4 py-2 text-white text-center rounded-md bg-red-500 hover:bg-red-600 cursor-pointer">
                   Check
               </a>
           </td>
        @endif
          </tr>
        @empty
        <div class="text-center ">
            <p class="text-red-500 font-bold text-lg">NO CURRENTLY HISTORY OF REQUEST</p>
        </div>
        @endforelse
       
      </tbody>
  </table>
</div>

<div class="py-4 bg-transparent">
  {{ $forms->links('pagination::tailwind')}}
</div>
