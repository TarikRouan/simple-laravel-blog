<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Blog</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-blue-50">
    <div class="p-6 flex justify-between items-center bg-gradient-to-r from-blue-200 to-blue-400 ">
        <a href="{{ route('blog.index') }}" class="flex gap-2 items-center">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
            <h1 class="font-bold text-3xl text-gray-800">BLOG</h1>
        </a>

        @if (Route::has('login'))
            <div class="text-right">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-black-600 hover:text-black-900 hover:font-bold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-black-600 hover:text-black-900 hover:font-bold">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-black-600 hover:text-black-900 hover:font-bold">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        

    </div>

    <div class="w-4/5 mx-auto pb-5">
        <div class="text-center p-10">
            <h1 class="text-3xl text-gray-700">
                All Articles
            </h1>
        </div>
        <form class="w-3/5 mx-auto flex"
            action="{{ route('searchpub') }}"
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
    </div>

    <div class="flex flex-wrap gap-2 p-10">


    @foreach($posts as $post)
    <div class="w-auto pb-10">
        <div class="bg-white  rounded-lg drop-shadow-2xl sm:basis-3/4 basis-full sm:mr-8 pb-10 sm:pb-0 h-96">
            <img src="{{ asset($post->image_path) }}" alt="{{ $post->title }}" class="w-96 h-64">
            <div class="w-11/12 mx-auto p-3">
                <h2 class="text-gray-900 text-lg font-bold pt-6 pb-0 sm:pt-0 hover:text-gray-700 transition-all w-64 ">
                    <a href="{{ route('blog.show', $post->id) }}">
                        {{ $post->title }} 
                    </a>
                    
                </h2>
                <span class="text-gray-500 text-sm sm:text-base ">
                    Made by:
                        <a href=""
                           class="text-blue-500 italic hover:text-blue-400 hover:border-b-2 border-blue-400 pb-3 transition-all">
                           {{ $post->user->name }}
                        </a>
                    on {{ $post->updated_at->format('d/m/Y') }}
                </span>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="mx-auto pb-10 w-4/5 text-lg">
    {{ $posts->links() }}
</div>
    
</body>
</html>