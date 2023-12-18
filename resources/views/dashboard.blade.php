<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12  min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-5 flex flex-col">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="h-25 gap-4 flex flex-col items-center text-center">
                        <h1 class="text-2xl font-bold">Websites: ({{ $websites->count() }})</h1>
                        <button onclick="window.location.href = '/website/create'"
                            class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded w-25">
                            Add website
                        </button>
                    </div>


                    <!-- Table -->
                    <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-5">
                        <header class="px-5 py-4 border-b border-gray-100">
                            <h2 class="font-semibold text-gray-800">Websites</h2>
                        </header>
                        <div class="p-3">
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full">
                                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                        <tr>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Name</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Url</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Category</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">More info</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-center">action</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">

                                        @if ($websites->count() > 0)

                                            @foreach ($websites->all() as $item)
                                                <tr>
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img
                                                                    class="rounded-full w-10 h-10 object-cover"
                                                                    src="{{ asset('/storage/images/' . $item->image_url) }}"
                                                                    width="40" height="40" alt="Alex Shatov">
                                                            </div>
                                                            <div class="font-medium text-gray-800">{{ $item->title }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap">
                                                        <a href="https://{{ $item->url }}"
                                                            class="underline text-green-600">{{ $item->url }}
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap">
                                                        {{-- <p class="text-md text-blue-600">{{ $item->name }}</p> --}}
                                                          @foreach ($item->categories as $category)
                                                        <p class="text-md text-blue-600">{{ $category->name }}</p>
                                                        @endforeach
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap">
                                                        <a href="/website/{{$item->id}}"
                                                            class="bg-orange-500 p-2 px-5 text-white hover:shadow-lg text-xs font-thin">More
                                                            info</a>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="text-lg text-center flex flex-col gap-2">
                                                            <a href="/website/edit/{{ $item->id }}"
                                                                class="bg-blue-500 p-2 text-white hover:shadow-lg text-xs font-thin">Edit</a>
                                                            <form action="/website/{{ $item->id }}" method="post"
                                                                class=" bg-red-500  text-white hover:shadow-lg text-xs font-thin">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="bg-red-500 p-2 text-white hover:shadow-lg text-xs font-thin cursor-pointer">Remove</button>
                                                            </form>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="h-25 gap-4 flex flex-col items-center text-center">
                        <h1 class="text-2xl font-bold">Categories: ({{ $categories->count() }})</h1>

                        <button onclick="window.location.href = '/category/create'"
                            class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded w-25">
                            Add Category
                        </button>
                        <div class="table  p-2 w-full max-w-2xl mx-auto">
                            <table class="w-full border">
                                <thead>
                                    <tr class="bg-gray-50 border-b">

                                        <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                                            <div class="flex items-center justify-center">
                                                ID

                                            </div>
                                        </th>
                                        <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                                            <div class="flex items-center justify-center">
                                                Name

                                            </div>
                                        </th>

                                        <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                                            <div class="flex items-center justify-center">
                                                Action

                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if ($categories->count() > 0)
                                        @foreach ($categories->all() as $item)
                                            <tr class="bg-gray-100 text-center border-b text-sm text-gray-600">
                                                <td class="p-2 border-r">{{ $item->id }}</td>
                                                <td class="p-2 border-r">{{ $item->name }}</td>
                                                <td>
                                                    <a href="/category/edit/{{ $item->id }}"
                                                        class="bg-blue-500 p-2 text-white hover:shadow-lg text-xs font-thin">Edit</a>

                                                    <a onclick="showMenu()"
                                                        class="bg-red-500 p-2 text-white hover:shadow-lg text-xs font-thin">Remove</a>

                                                    
                                                    <div class="absolute  flex justify-center items-center">
                                                        <div id="menu"
                                                            class="w-full h-full bg-white-900 bg-opacity-80 top-0 fixed sticky-0 hidden" >
                                                            <div
                                                                class="2xl:container  2xl:mx-auto py-48 px-4 md:px-28 flex justify-center items-center">
                                                                <div
                                                                    class="w-screen md:w-auto dark:bg-gray-800 relative flex flex-col justify-center items-center bg-white py-16 px-4 md:px-24 xl:py-24 xl:px-36">
                                                                    <div role="banner">

                                                                    </div>
                                                                    <div class="mt-12">
                                                                        <h1 role="main"
                                                                            class="text-3xl dark:text-white lg:text-4xl font-semibold leading-7 lg:leading-9 text-center text-gray-800">
                                                                           Are you sure you want to delete this category?</h1>
                                                                    </div>
                                                                    <div class="mt">
                                                                        <p
                                                                            class="mt-6  w-96 text-2xl dark:text-red leading-7 text-center text-red-800">
                                                                            Deleting this cateogry will also delete all the websites in that category </p>
                                                                    </div>
                                                                    <div class="flex gap-4">
                                                                        <form action="/category/{{$item->id}}" method="post">
                                                                        @csrf
                                                                        @method("delete");
                                                                        <button type="submit"
                                                                        class="w-full dark:text-gray-800 dark:hover:bg-gray-100 dark:bg-white sm:w-auto mt-14 text-base leading-4 text-center text-white py-6 px-16 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 bg-gray-800 hover:bg-black">Delete</button>
                                                                        </form>
                                                    
                                                                    <button
                                                                        onclick="showMenu(false)"
                                                                        class="w-full dark:text-gray-800 dark:hover:bg-gray-100 dark:bg-white sm:w-auto mt-14 text-base leading-4 text-center text-white py-6 px-16 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 bg-gray-800 hover:bg-black">Cancel</button>
                                                                    </div>
                                                                    
                                                                    <button onclick="showMenu(true)"
                                                                        class="text-gray-800 dark:text-gray-400 absolute top-8 right-8 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800"
                                                                        aria-label="close">
                                                                        <svg width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M18 6L6 18" stroke="currentColor"
                                                                                stroke-width="1.66667"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" />
                                                                            <path d="M6 6L18 18" stroke="currentColor"
                                                                                stroke-width="1.66667"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    let menu = document.getElementById("menu");
    const showMenu = (flag) => {
        menu.classList.toggle("hidden");
    };
</script>
