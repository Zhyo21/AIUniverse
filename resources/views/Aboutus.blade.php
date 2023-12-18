<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="flex justify-center w-100 min-h-screen  overflow-hidden">
    <div class="  w-75  overflow-hidden">
      <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] border border-dashed border-stone-200 bg-white m-5">
        <!-- card body  -->
        <div class="flex-auto block py-8 px-9">
          <div>
            <div class="mb-9">
              <h1 class="mb-2 text-[1.75rem] font-semibold text-dark">Contributors</h1>
              <span class="text-[1.15rem] font-medium text-muted"> We are students with greate passion to make your work easir with our website</span>
            </div>
            <div class="flex flex-wrap ">
              <div class="flex flex-col mr-5 text-center mb-11 lg:mr-16">
                <div class="inline-block mb-4 relative shrink-0 rounded-[.95rem]">
                  <img class="inline-block shrink-0 rounded-[.95rem] w-[150px] h-[150px]" src="{{asset("imgs/zhyar.jpg")}}" alt="avarat image">
                </div>
                <div class="text-center">
                  <a href="https://github.com/Zhyo21" class="text-dark font-semibold hover:text-primary text-[1.25rem] transition-colors duration-200 ease-in-out">Zhyar Farhad</a>
                  <span class="block font-medium text-muted">Web-Devoloper</span>
                </div>
              </div>
              <div class="flex flex-col mr-5 text-center mb-11 lg:mr-16">
                <div class="inline-block mb-4 relative shrink-0 rounded-[.95rem]">
                  <img class="inline-block shrink-0 rounded-[.95rem] w-[150px] h-[150px]" src="{{asset("imgs/warin.jpg")}}" alt="avarat image">
                </div>
                <div class="text-center">
                  <a href="https://.com" class="text-dark font-semibold hover:text-primary text-[1.25rem] transition-colors duration-200 ease-in-out">Warin Aswad</a>
                  <span class="block font-medium text-muted">Web-Designer</span>
                </div>
              </div>
              <div class="flex flex-col mr-5 text-center mb-11 lg:mr-16">
                <div class="inline-block mb-4 relative shrink-0 rounded-[.95rem]">
                  <img class="inline-block shrink-0 rounded-[.95rem] w-[150px] h-[150px]" src="{{asset("imgs/tara.jpg")}}" alt="avarat image">  
                </div>
                <div class="text-center">
                  <a href="https://github.com/taradlerr" class="text-dark font-semibold hover:text-primary text-[1.25rem] transition-colors duration-200 ease-in-out">Tara Dler</a>
                  <span class="block font-medium text-muted">web-Devoloper</span>
                </div>
              </div>
 
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="flex flex-wrap -mx-3 mb-5">
 
  </div>
</div>
</x-app-layout>