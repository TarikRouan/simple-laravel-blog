<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight px-5 py-2.5">
            {{ __('Create New Post') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="pb-8">
                @if ($errors->any())
                    <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                        Something went wrong... 
                    </div>
                    <ul class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form class="p-6 text-gray-900 flex gap-2 flex-col border-b-2"
                        action="{{ route('blog.store') }}"
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input
                        type="text"
                        name="title"
                        placeholder="Title..."
                        class="bg-transparent block border-b-2 w-full h-20 text-2xl outline-none rounded">

                        <textarea
                        name="content"
                        placeholder="content..."
                        class="py-20 bg-transparent block border-b-2 w-full h-60 text-xl outline-none rounded"></textarea>

                        <div class="bg-grey-lighter py-10">
                            <label class="w-44 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase border border-black cursor-pointer rounded">
                                    <span class="mt-2 text-base leading-normal">
                                        Select a file
                                    </span>
                                <input
                                    type="file"
                                    name="image_path"
                                    class="hidden">
                            </label>
                        </div>

                        <button
                        type="submit"
                        class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                        Submit Post
                        </button>

                    </form>
            </div>

        </div>
    </div>

</x-app-layout>
