<div class="overflow-x-auto rounded-lg shadow-xl min-[470px]:mt-8">
  <table class="w-full">
      <thead>
        <tr>
          <th class="text-center text-xl p-4 font-semibold">Request_ID</th>
          <th class="text-center text-xl p-4 font-semibold">Name</th>
          <th class="text-center text-xl p-4 font-semibold">Course</th>
          <th class="text-center text-xl p-4 font-semibold">Status</th>
          <th class="text-center text-xl p-4 font-semibold">Requested Document</th>
          <th class="text-center text-xl p-4 font-semibold">Date Requested</th>
          <th class="text-center text-xl p-4 font-semibold">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($forms as $form)
        <tr class=" hover:bg-white">
             <td class="p-3 text-md text-center tracking-wide">{{$form->id}}</td>
             <td class="p-3 text-md text-center tracking-wide">{{$form->userProfile->name}}</td>
             <td class="p-3 text-md text-center tracking-wide">{{$form->userProfile->course}}</td>
             @if ($form->status === 'pending')
             <td class="p-3 text-md text-center tracking-wide ">
              <span class="rounded-md p-2 bg-blue-500 text-white ">{{$form->status}}</span>
             </td>
             @else
             <td class="p-3 text-md text-center tracking-wide min-w-40">
              <span class="rounded-md p-2 bg-orange-500 text-white ">{{$form->status}}</span>
             </td> 
             @endif
             <td class="p-3 text-md text-center tracking-wide w-40">{{$form->requested_document}} </td>
             <td class="p-3 text-md text-center tracking-wide">{{ $form->created_at->format('F j, Y') }} </td>
             <td class="p-3 text-md text-center tracking-wide w-40">
               <div class="flex items-center justify-center gap-2">
                 <a href="{{route('admin.trackRequest', $form->id)}}" class="text-white rounded-md px-4 py-3 bg-green-500 hover:bg-green-600 text-center whitespace-nowrap">TRACK REQUEST</a>
                 <button class="delete-btn text-white py-3 px-6 bg-red-500 hover:bg-red-600 rounded-md"
                       data-file-id="{{$form->id}}"
                       data-toggle-modal="#deleteConfirmationModal">
                   DELETE
               </button>
               </div>
             </td>
       </tr> 
        @empty
        <div class="text-center py-4">
         <p class="text-red-500 font-bold text-lg">NO CURRENTLY LIST OF REQUEST</p>
        </div>
        @endforelse
       </tbody>
   </table>
</div>

 <div class="py-4 bg-transparent">
   {{ $forms->links('pagination::tailwind')}}
 </div>
