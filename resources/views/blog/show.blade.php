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
<div class="w-4/5 mx-auto">

    <div class="pt-10">
        <a href="{{ URL::previous() }}"
           class="text-blue-500 italic hover:text-blue-400 hover:border-b-2 border-blue-400 pb-3 transition-all py-20">
            < Back to previous page
        </a>
    </div>

    <h4 class="text-left sm:text-center text-2xl sm:text-4xl md:text-5xl font-bold text-gray-900 py-10 sm:py-20">
        {{ $post->title }}
    </h4>


    <div class="block lg:flex flex-row">
        <div class="basis-9/12 text-center sm:block sm:text-left">
            <span class="text-left sm:text-center sm:text-left sm:inline block text-gray-900 pb-10 sm:pt-0 pt-0 sm:pt-10 pl-0 sm:pl-4 -mt-8 sm:-mt-0">
                Made by:
                <a
                    href=""
                    class="font-bold text-blue-500 italic hover:text-blue-400 hover:border-b-2 border-blue-400 pb-3 transition-all py-20">
                    {{ $post->user->name }}
                </a>
                On {{ $post->updated_at->format('d/m/Y') }}
            </span>
        </div>
    </div>

    <div class="pt-10 pb-10 text-gray-900 text-3xl">
        <p class="text-base text-black pt-10">
            {{ $post->content }}
        </p>
    </div>


</div>
    <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg w-4/5 mx-auto mt-10">
        <form class="p-6 text-gray-900 flex gap-2 flex-col border-b-2 "
            action="{{ route('comment.store', $post->id) }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            <h4>
                Add comment : 
            </h4>
            <input
            type="text"
            name="name"
            placeholder="Name..."
            class="bg-transparent block border-b-2 w-full h-20 text-2xl outline-none rounded">
            <input
            type="email"
            name="email"
            placeholder="Email..."
            class="bg-transparent block border-b-2 w-full h-20 text-2xl outline-none rounded">
            <textarea
            name="comment"
            placeholder="comment..."
            class="py-20 bg-transparent block border-b-2 w-full h-60 text-xl outline-none rounded"></textarea>

            <button
            type="submit"
            class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
            Comment
            </button>

        </form>
</div>

<div class="w-4/5 mx-auto mt-10 sm:px-6 lg:px-8 p-5 border-2 rounded">
    <h4 class="font-bold mb-2">
        Comments : 
    </h4>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @foreach ($comments as $comment)
            <div class="p-6 text-gray-900  border-b-2">
                <div class="flex items-center gap-5 ml-3">
                <h5 class="font-semibold text-lg ">
                    {{ $comment->name }}
                </h5>
               <p class="text-gray-600 text-sm">
                {{ $post->updated_at->format('d/m/Y') }}
               </p>
            </div>
            <p class="ml-20 m-5 text-lg">
                {{ $comment->comment }}
            </p>
            </div>
        @endforeach
</div>


</body>
</html>