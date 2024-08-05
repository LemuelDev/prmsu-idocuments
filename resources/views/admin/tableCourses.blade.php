<div class="overflow-x-auto rounded-lg shadow-xl min-[470px]:mt-8">
    <table class="w-full">
        <thead>
          <tr>
            <th class="text-center text-xl p-4 font-semibold">Available Courses</th>
            <th class="text-center text-xl p-4 font-semibold">Courses_Abbreviation</th>
            <th class="text-center text-xl p-4 font-semibold">Action</th>
            
          </tr>
        </thead>
        <tbody>
            @forelse ($courses as $course)
            <tr class=" hover:bg-white">
              <td class="p-3 text-md text-center tracking-wide ">{{$course->courses}}</td>
              <td class="p-3 text-md text-center tracking-wide ">{{$course->courses_abr}}</td>
              <td class="p-3 text-md text-center tracking-wide w-40">
                <div class="flex items-center justify-center gap-2">
                  <a href="{{route('admin.editCourse', $course->id)}}" class="text-white rounded-md px-4 py-3 bg-green-500 hover:bg-green-600 text-center whitespace-nowrap">EDIT COURSE</a>
                  <button class="delete-btn text-white py-3 px-6 bg-red-500 hover:bg-red-600 rounded-md"
                        data-file-id="{{$course->id}}"
                        data-toggle-modal="#deleteConfirmationModal">
                    DELETE
                </button>
                </div>
              </td>
            </tr>
          @empty
          <div class="text-center ">
              <p class="text-red-500 font-bold text-lg">NO CURRENTLY COURSES AVAILABLE</p>
          </div>
          @endforelse
        </tbody>
    </table>
  </div>

  <div class="py-8 bg-transparent">
    {{ $courses->links('pagination::tailwind')}}
  </div>
  