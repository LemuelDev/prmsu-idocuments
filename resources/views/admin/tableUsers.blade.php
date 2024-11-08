<div class="overflow-x-auto rounded-lg shadow-xl min-[470px]:mt-8">
    <table class="w-full">
        <thead>
          <tr>
            <th class="text-center text-xl p-4 font-semibold">Name</th>
            <th class="text-center text-xl p-4 font-semibold">Course</th>
            <th class="text-center text-xl p-4 font-semibold">Age</th>
            <th class="text-center text-xl p-4 font-semibold">Sex</th>
            <th class="text-center text-xl p-4 font-semibold">Status</th>
            <th class="text-center text-xl p-4 font-semibold">Action</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr class=" hover:bg-white">
              <td class="p-3 text-md text-center tracking-wide">{{$user->name}}</td>
              <td class="p-3 text-md text-center tracking-wide">{{$user->course}}</td>
              <td class="p-3 text-md text-center tracking-wide">{{$user->age}}</td>
              <td class="p-3 text-md text-center tracking-wide">{{$user->sex}}</td>
              <td class="p-3 text-md text-center tracking-wide">{{$user->user_status}}</td>
              <td class="p-3 text-md text-center tracking-wide w-40">
                <div class="flex items-center justify-center gap-2">
                  <a href="{{route('admin.trackUsers', $user->id)}}" class="text-white rounded-md px-4 py-3 bg-green-500 hover:bg-green-600 text-center whitespace-nowrap">VIEW</a>
                  <button class="delete-btn text-white py-3 px-6 bg-red-500 hover:bg-red-600 rounded-md"
                  data-file-id="{{$user->id}}"
                  data-toggle-modal="#deleteConfirmationModal">
                    DELETE
                  </button>
                </div>
              </td>
            </tr>
          @empty
          <div class="text-center ">
              <p class="text-red-500 font-bold text-lg">NO CURRENTLY ACTIVE USERS</p>
          </div>
          @endforelse
        </tbody>
    </table>
  </div>

  <div class="py-8 bg-transparent">
    {{ $users->links('pagination::tailwind')}}
  </div>
  