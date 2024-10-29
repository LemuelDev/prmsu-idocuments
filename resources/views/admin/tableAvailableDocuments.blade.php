<div class="overflow-x-auto rounded-lg shadow-xl min-[470px]:mt-8">
    <table class="w-full">
        <thead>
          <tr>
            <th class="text-center text-xl p-4 font-semibold">Available Documents</th>
            <th class="text-center text-xl p-4 font-semibold">Processing Time</th>
            <th class="text-center text-xl p-4 font-semibold">Action</th>
            
          </tr>
        </thead>
        <tbody>
            @forelse ($documents as $document)
            <tr class=" hover:bg-white">
              <td class="p-3 text-md text-center tracking-wide">{{$document->available_documents}}</td>
              @if ($document->time === "1")
              <td class="p-3 text-md text-center tracking-wide">{{$document->time}} {{$document->interval}}</td>
              @else
              <td class="p-3 text-md text-center tracking-wide">{{$document->time}} {{$document->interval}}s</td>
              @endif
              <td class="p-3 text-md text-center tracking-wide w-40">
                <div class="flex items-center justify-center gap-2">
                  <a href="{{route('admin.editDocument', $document->id)}}" class="text-white rounded-md px-4 py-3 bg-green-500 hover:bg-green-600 text-center whitespace-nowrap">EDIT</a>
                  <button class="delete-btn text-white py-3 px-6 bg-red-500 hover:bg-red-600 rounded-md"
                        data-file-id="{{$document->id}}"
                        data-toggle-modal="#deleteConfirmationModal">
                    DELETE
                </button>
                </div>
              </td>
            </tr>
          @empty
          <div class="text-center ">
              <p class="text-red-500 font-bold text-lg">NO CURRENTLY AVAILABLE DOCUMENTS</p>
          </div>
          @endforelse
        </tbody>
    </table>
  </div>

  <div class="py-8 bg-transparent">
    {{ $documents->links('pagination::tailwind')}}
  </div>
  