<div class="overflow-x-auto rounded-lg shadow-xl min-[470px]:mt-8">
    <table class="w-full">
        <thead>
          <tr>
            <th class="text-center text-xl p-4 font-semibold">Request_ID</th>
            <th class="text-center text-xl p-4 font-semibold">Date</th>
            <th class="text-center text-xl p-4 font-semibold">Requested Document</th>
            <th class="text-center text-xl p-4 font-semibold">Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($forms as $form)
            <tr class=" hover:bg-white">
              <td class="p-3 text-md text-center tracking-wide">{{$form->id}}</td>
              <td class="p-3 text-md text-center tracking-wide">{{ $form->created_at->format('F j, Y') }}</td>
              <td class="p-3 text-md text-center tracking-wide">{{$form->requested_document}} </td>
              <td class="p-4 text-md text-center tracking-wide">
                @if ($form->status == 'completed')
                <span class="rounded-md p-2 bg-green-500 text-white ">Completed</span>
                @elseif($form->status == 'rejected')
                <span class="rounded-md p-2 bg-red-500 text-white ">Rejected</span>
                @else
                <span class="rounded-md p-2 bg-orange-500 text-white ">For Deletion</span>
                @endif
              </td>
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
  