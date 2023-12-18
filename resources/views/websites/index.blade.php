

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Websites') }}
        </h2>
    </x-slot>
    <div class="w-100 flex justify-center text-white text-sm pt-4">
        <p class="text-3xl">
                AI Websites
        </p>
    </div>
    <!-- This is an example component -->
    <div class=" rounded-xl  flex flex-wrap justify-between  lg:mx-32  gap-5 bg-white mt-5  min-h-fit p-5 "> 
        <div class="flex gap-5 items-center">
             <h1 class="text-2xl">search: </h1>
            <form action="/website/filter" method="get">
            
            <input type="text" placeholder="search" name="search">
            <button type="submit">search</button>
            </form>
              
        </div>
        <div class="flex gap-5 items-center min-h-fit">
            <h1 class="text-2xl">Filters: </h1>
            <form action="/website/filter" method="get" id="filter">
                    <select name="filter" id="" class="select-all max-h-fit" onchange="filterData()">
                        @if (!Request::get('filter'))
                        <option  selected >All</option>
                        @endif
                        @foreach ($categories as $category)
                           @if (Request::get('filter') == $category->id)
                               <option value="{{$category->id}}" selected >{{$category->name}}</option>
                           @else
                                <option value="{{$category->id}}" >{{$category->name}}</option>
                           @endif
                            
                        @endforeach
                    </select>
            </form>
            
        </div>
    </div>
    <div class='flex  items-start justify-center pt-5 min-h-screen'>
        <div class=' rounded-3xl  flex flex-wrap justify-center lg:justify-start lg:mx-32  gap-5'>

            @foreach ($websites as $website)
                <div class="grid rounded-3xl max-w-sm  min-w-[2rem] shadow-sm bg-slate-100  flex-col">
                    <img src={{ asset('/storage/images/'.$website->image_url) }}
                        width="390" height="200" class="rounded-t-3xl justify-center grid h-80 object-cover"
                        alt="movie.title" />

                    <div class="group p-6 grid z-10">
                        <a href="/website/{{$website->id}}" class="group-hover:text-cyan-700 font-bold sm:text-2xl line-clamp-2">
                            {{$website->title}}
                        </a>
                       
                        <div class="h-28">
                            <span class="line-clamp-4 py-2 text-base font-light leading-relaxed">
                                {{$website->description}}
                            </span>
                        </div>
                        <div class=" grid-cols-5 flex group justify-between">
                            <div class="font-black flex flex-col">
                                <span class="text-yellow-500 text-xl">Rating</span>
                                <span class="text-3xl flex gap-x-1 items-center group-hover:text-yellow-600">
                                    {{$website->avg_rating ?? 0}}/5
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">

                                        <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M9.15316 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z"
                                                fill="#eab308" />
                                        </g>

                                    </svg>
                                </span>
                            </div>
                            <div class="flex flex-col items-end">
                                <div class="h-7">
                                
                                    <span class="text-3xl  font-bold  gap-x-2 cursor-pointer" onclick> 
                                        @if (isset($website->user_id)) 
                                        <form action="/favourite" method="POST">
                                                @csrf
                                                @method("delete")
                                                <input type="text" name="id" hidden value={{$website->id}}>
                                                <button type="submit" >
                                                    <svg  xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="red" class="bi bi-heart-fill mt-6" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                                </svg>
                                           </button>
                                        </form>
                                           
                                             
                                        @else
                                        <form action="/favourite" method="POST">
                                                @csrf
                                                <input type="text" name="id" hidden value={{$website->id}}>
                                                <button type="submit" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="red" class="bi bi-heart mt-6 " viewBox="0 0 16 16" >
                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                            </svg>
                                        </button>
                                        </form>
                                        @endif
                                        
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
</x-app-layout>



<script>
    function filterData(){
      document.getElementById("filter").submit();
    }
</script>