<x-app-layout>
    <x-slot name="header">
                <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Comments ') }}
        </h2>
        </div>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                @foreach ($comments as $comment)
                    <div class="p-6 text-gray-900 flex justify-between items-center border-b-2">
                         <div class="text-lg flex-auto">
                            {{ $comment->name }}
                        </div>
                        <div class="text-md  flex-auto">
                            {{ $comment->email }}
                        </div>
                        <div class="text-md  flex-auto">
                            {{ $comment->comment }}
                        </div>
                        <div class="text-lg flex justify-between items-center gap-3"> 

                            <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class=" text-red-500 pr-3 flex justify-center items-center hover:font-bold" type="submit">
                                    Delete Comment
                                </button>
                                </form>   
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mx-auto mt-3 pb-10 w-4/5">
                {{ $comments->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
