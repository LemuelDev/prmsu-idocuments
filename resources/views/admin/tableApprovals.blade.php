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
            <td class="p-3 text-md text-center tracking-wide">{{$user->isPending}}</td>
            <td class="p-5 text-md text-center tracking-wide ">
              {{-- <div class="flex items-center justify-center gap-2">
                <a href="{{route('admin.approve', $user->id)}}" class="text-white rounded-md px-4 py-3 bg-green-500 hover:bg-green-600 text-center whitespace-nowrap">APPROVE</a>
                <a href="" class="text-white rounded-md px-4 py-3 bg-red-500 hover:bg-red-600 text-center whitespace-nowrap">DELETE</a>
              </div> --}}
              <a href="{{route('admin.trackApproval', $user->id)}}" class="text-white rounded-md px-4 py-3 bg-green-500 hover:bg-green-600 text-center whitespace-nowrap">VIEW</a>
            </td>
          </tr>
        @empty
        <div class="text-center ">
            <p class="text-red-500 font-bold text-lg">NO CURRENTLY APPROVALS</p>
        </div>
        @endforelse
        </tbody>
    </table>
  </div>
  
  <div class="py-8 bg-transparent">
    {{ $users->links('pagination::tailwind')}}
  </div>