@extends('layout.admin')

@section('content')

    @include('shared.navbar')

    <div class="pl-10 pt-8 max-lg:pl-5 max-lg:max-w-14">
        <a href="#" class="inline-block py-2 pb-1 px-8 text-white text-center rounded-md no-underline hover:no-underline bg-blue-600 hover:bg-blue-700" style="line-height: 1.5;">
            <span class="text-2xl" style="display: inline-block; vertical-align: middle;"><box-icon name='left-arrow-alt' color='#ffffff'></box-icon></span>
        </a>
    </div>

    <section class="xl:max-w-[1300px] 2xl:max-w-[1500px] mx-auto p-4 w-full px-16 max-lg:px-4">

        <div class="py-4 flex justify-between items-center max-md:flex-col max-md:justify-center max-md:gap-6">
            <h4 class="font-bold text-2xl text-center max-sm:text-xl">Manage Available Documents</h4>
            <select name="sort" id="sort" class="py-3 px-6 rounded-md border-none outline-none shadow bg-transparent">
                <option value="" disabled selected>Sort</option>
                <option value="7days">Manage Digital Forms</option>
                <option value="14days">Available Documents to Request</option>
            </select>
        </div>
        
        @include('admin.tableAvailableDocuments')
        <div class="py-10 flex justify-end">
            <a href="#" class="px-6 py-3 rounded-md border-none outline-none text-white text-center text-xl bg-green-500 hover:bg-green-600">Add Document</a>
        </div>

    </section>



@endsection 