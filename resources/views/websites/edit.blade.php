<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Websites') }}
        </h2>
    </x-slot>

    <div class="pt-5">
       
        <!-- component -->
        <div  class=" bg-white sm:mx-32 lg:mx-32 xl:mx-72 ">
            @if ($errors->any())
                <h1 class="px-5 py-2 font-bold text-red-500">Alert:</h1>
                <ol class="list-decimal px-7 ">
                @foreach ($errors->all() as $err)
                    <li class="px-5 py-2 font-bold text-red-500">{{$err}}</li>
                @endforeach
                </ol>
            @endif
            <div class="flex justify-center container mx-auto">
                <div class="w-full">
                    <div class="mt-4 px-4">
                        <h1 class="text-3xl font-semibold py-7 px-5">Edit An AI Website</h1>
                   
                        <form class="mx-5 my-5" action="/website/{{$website->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <label class="relative block p-3 border-2 border-black rounded" htmlFor="name">
                                <span class="text-md font-semibold text-zinc-900" htmlFor="name">
                                    Name :
                                </span>
                                <input class="w-full bg-transparent p-0 text-sm  text-gray-500 focus:outline-none"
                                    id="name" type="text" placeholder="Website name" name="title" value="{{$website->title}}" />
                            </label>

                            <label class="relative block p-3 border-2 border-black rounded mt-3" htmlFor="name">
                                <span class="text-md font-semibold text-zinc-900" htmlFor="name">
                                    Website Url :
                                </span>
                                <input class="w-full bg-transparent p-0 text-sm  text-gray-500 focus:outline-none"
                                    id="name" type="text" placeholder="Website Url" name="url" value="{{$website->url}}"  />
                            </label>
                          
                            <div class="w-full flex flex-wrap justify-between ">
                            <div>
                                <div class="shrink-0 mt-5 flex justify-start w-full ">
                                    <img class="h-50 w-50 object-cover" src="{{ asset('storage/images/'.$website->image_url) }}"
                                        alt="Current profile photo" id="blah" />
                                </div>
                                <div class="flex justify-start w-full">                           
                                    <label class="block pt-2 ">
                                        <span class="sr-only t-2">Choose profile photo</span>
                                        <input type="file"
                                     
                                        id="imgInp"
                                        name="image"
                                            class="w-full text-sm text-slate-500
                                                    file:mr-4 file:py-2 file:px-4
                                                    file:rounded-full file:border-0
                                                    file:text-sm file:font-semibold
                                                    file:bg-pink-300 file:text-zinc-900
                                                    hover:file:bg-rose-300
                                                    " />
                                    </label>
                                </div>
                            </div>

                            <label class="relative block p-3 border-2 mt-5 border-black rounded w-[30rem]" htmlFor="name">
                                <span class="text-md font-semibold text-zinc-900" htmlFor="name">
                                   Desicription :
                                </span>

                                <textarea
                                    class="w-full mt-5   p-3 text-sm border-black bg-transparent text-gray-500 focus:outline-none h-[80%]  text-start"
                                    id="name" type="text" placeholder="Write Website's  Desicription" name="desc">{{$website->description}}</textarea>
                            </label>
                            </div>

                 

                        
                       
                        

                            <Button
                                type="submit"
                                class="mt-8 border-2 px-5 py-2 rounded-lg border-black border-b-4 font-black translate-y-2 border-l-4">
                                update
                            </Button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
 

    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function(){
            readURL(this);
        });
    </script>

</x-app-layout>

