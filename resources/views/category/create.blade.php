<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Websites') }}
            </h2>
    </x-slot>



  <!-- component -->
<div class='flex items-center justify-center min-h-screen bg-gradient-to-br'>
		<div class='w-full max-w-2xl p-20 mx-auto bg-white rounded-lg shadow-xl'>
			@if ($errors->any())
                <h1 class="px-5 py-2 font-bold text-red-500">Alert:</h1>
                <ol class="list-decimal px-7 ">
                @foreach ($errors->all() as $err)
                    <li class="px-5 py-2 font-bold text-red-500">{{$err}}</li>
                @endforeach
                </ol>
            @endif
			<div class='max-w-md mx-auto space-y-6'>

				<form action="/category" method="POST">
                    @csrf
					<h2 class="text-2xl font-bold ">Add category</h2>
					<hr class="my-6  mb-6">
					<label class="uppercase text-sm font-bold opacity-70 ">Name</label>
					<input name="name" type="text" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none">
					<Button
                                type="submit"
                                class="mt-8 border-2 px-5 py-2 rounded-lg border-black border-b-4 font-black translate-y-2 border-l-4">
                                Add
                    </Button>
				</form>

			</div>
		</div>
	</div>


</x-app-layout>