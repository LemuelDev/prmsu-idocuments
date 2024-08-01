@extends('layout.student')

@section('content')

    @include('shared.navbar')

    <div class="pl-10 pt-8 max-lg:pl-5 max-lg:max-w-14">
        <a href="{{route('student.dashboard')}}" class="inline-block py-2 pb-1 px-8 text-white text-center rounded-md no-underline hover:no-underline bg-blue-600 hover:bg-blue-700" style="line-height: 1.5;">
            <span class="text-2xl" style="display: inline-block; vertical-align: middle;"><box-icon name='left-arrow-alt' color='#ffffff'></box-icon></span>
        </a>
    </div> 
    
    <section class="xl:max-w-[1300px] 2xl:max-w-[1500px] mx-auto p-4 w-full px-16 max-lg:px-4">

        <div class="py-4 flex justify-between items-center max-md:flex-col max-md:justify-center max-md:gap-6">
            <h4 class="font-bold text-2xl text-center max-sm:text-xl">History of Request</h4>
            <select name="sort" id="sort" class="py-3 px-6 rounded-md border-none outline-none shadow bg-transparent">
                <option value="{{ route('student.historyOfRequest') }}" {{ request()->url() == route('student.historyOfRequest') ? 'selected' : '' }}>All Request</option>
                <option value="{{ route('student.lastTwoWeeks') }}" {{ request()->url() == route('student.lastTwoWeeks') ? 'selected' : '' }}>Last 2 weeks</option>
                <option value="{{ route('student.lastMonth') }}" {{ request()->url() == route('student.lastMonth') ? 'selected' : '' }}>Last Month</option>
                <option value="{{ route('student.completed') }}" {{ request()->url() == route('student.completed') ? 'selected' : '' }}>Completed</option>
                <option value="{{ route('student.rejected') }}" {{ request()->url() == route('student.rejected') ? 'selected' : '' }}>Rejected</option>
                <option value="{{ route('student.forDeletion') }}" {{ request()->url() == route('student.forDeletion') ? 'selected' : '' }}>For Deletion</option>
            </select>
        </div>

        <script>
            document.getElementById("sort").addEventListener("change", function() {
                var selectedValue = this.value;
                if (selectedValue) {
                    window.location.href = selectedValue;
                }
            });
           
            </script>

        @include('student.tableHistoryRequest')
        

    </section>



@endsection 