<div class="overflow-x-auto rounded-lg shadow-xl min-[470px]:mt-8">
    <table class="w-full">
        <thead>
          <tr>
            <th class="text-center text-xl p-4 font-semibold">Request_ID</th>
            <th class="text-center text-xl p-4 font-semibold">Date</th>
            <th class="text-center text-xl p-4 font-semibold">Requested Document</th>
            <th class="text-center text-xl p-4 font-semibold">Action</th>
          </tr>
        </thead>
        <tbody>
         @forelse ($forms as $form)
         <tr class=" hover:bg-white">
              <td class="p-3 text-md text-center tracking-wide">{{$form->id}} </td>
              <td class="p-3 text-md text-center tracking-wide">{{ $form->created_at->format('F j, Y') }} </td>
              <td class="p-3 text-md text-center tracking-wide">{{$form->requested_document}} </td>
              <td class="p-3 text-md text-center tracking-wide w-40">
                <div class="flex items-center justify-center gap-2">
                  <a href="{{route('student.trackRequest', $form->id)}}" class="text-white rounded-md px-4 py-3 bg-green-500 hover:bg-green-600 text-center whitespace-nowrap">TRACK REQUEST</a>
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
  