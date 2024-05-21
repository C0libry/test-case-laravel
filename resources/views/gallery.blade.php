@extends('layout')

@section('title', 'Gallery')

@section('head')
    <script src="/js/gallery.js" defer></script>
@endsection

@section('main_content')
    <div class="flex justify-center flex-col">
        <div class="flex justify-center pt-10">
            <form id="sort-form" action="{{ route('gallery.index') }}" method="GET">
                <select id="sort-selector" name="sort"
                    class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="-created_at">Sort by upload date. New first</option>
                    <option value="created_at">Sort by upload date. Old first</option>
                    <option value="name">Sort by name A-Z</option>
                    <option value="-name">Sort by name Z-A</option>
                </select>
            </form>
        </div>
        <div class="flex justify-center">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-4/5 py-10">
                @foreach ($images as $image)
                    <div class="h-full max-w-full">
                        <a href="{{ $image->path }}"><img class="h-5/6 w-full rounded-t-lg hover:"
                                src="{{ $image->path }}" alt=""></a>
                        <div class="flex justify-between items-center h-1/6 w-full rounded-b-lg bg-gray-900 text-gray-50">
                            <div class="w-1/4 text-center">{{ $image->created_at }}</div>
                            <div class="w-1/2 text-center break-words">
                                {{ $image->name }}</div>
                            <a class="w-1/4 text-center" href="{{ route('image.download', $image->id) }}">
                                <ion-icon class=" size-5 md:size-8 hover:text-orange-500"
                                    name="cloud-download-outline"></ion-icon>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex justify-center pb-10">{{ $images->links() }}</div>
    </div>
@endsection
