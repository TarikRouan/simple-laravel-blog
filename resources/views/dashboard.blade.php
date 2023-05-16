<x-app-layout>
    <x-slot name="header">
                <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
        <a href="{{ route('blog.create') }}" class="text-white font-semibold text-md bg-blue-500 hover:bg-blue-700 rounded-full px-5 py-2.5">
            {{ __('Create New Post') }}
        </a>
        </div>
    </x-slot>


    <div class="py-12">

        <form class="w-3/5 mx-auto flex mb-5"
        action="{{ route('searchadm') }}"
        method="GET">
        @csrf
        <input
        type="text"
        name="search"
        placeholder="search"
        class="bg-transparent block border-b-2 w-full h-12 text-2xl outline-none rounded">
  
      <button
        class="uppercase bg-gradient-to-r from-blue-400 to-blue-500 text-gray-100 text-lg font-extrabold px-5 border"
        type="submit"
        >
        Search
      </button>
    </form>
        
        @if (session()->has('message'))
        <div class="mx-auto w-4/5 pb-10">
            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                {{ session()->get('message') }}
            </div>
        </div>
        
    @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                @foreach ($posts as $post)
                    <div class="p-6 text-gray-900 flex justify-between items-center border-b-2">
                        <div class="text-lg flex-auto w-32">
                            {{ $post->title }}
                        </div>
                        <div class="text-md hover:font-bold flex-auto">
                            <a href="{{ route('comment.index', $post->id) }}">{{ $post->comments->count() }} Comments</a>
                        </div>
                        <div class="text-lg flex justify-between items-center gap-3">
                            <a href="{{ route('blog.edit', $post->id) }}" class="block italic text-blue-500 border-b-1 border-blue-400 hover:font-bold">Edit</a>
                            <form action="{{ route('blog.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class=" text-red-500 pr-3 flex justify-center items-center hover:font-bold" type="submit">
                                    Delete
                                </button>
                                </form>   
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="/comment/full" class="w-1/5 flex justify-center items-center m-auto italic bg-blue-500 text-white p-1 rounded-lg my-2 border-b-1 border-blue-400 hover:font-bold">All Comments</a>
            <div class="mx-auto mt-3 pb-10 w-4/5">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
