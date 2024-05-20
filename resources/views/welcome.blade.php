@extends('layout')

@section('title', 'Home')

@section('head')
    <script src="/js/welcome.js" defer></script>
@endsection

@section('main_content')
    <form id="upload-form" method="POST" action="{{ route('image.create') }}" enctype="multipart/form-data"
        class="flex justify-center items-center flex-col gap-5 py-64">
        @csrf
        @method('POST')
        <div id="drag-and-drop" class="flex items-center justify-center w-1/4">
            <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full min-w-64 h-64 border-2 border-gray-300 border-dashed rounded-3xl cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-none dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <ion-icon class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        name="cloud-upload-outline"></ion-icon>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                            upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG or JPG</p>
                </div>
                <input id="dropzone-file" type="file" name="dropzone-file" class="hidden" accept="image/*" multiple />
            </label>
        </div>

        <div id="images-list" class="flex items-center justify-center flex-col md:flex-row gap-3">
            <div class="h-32 w-32 hidden"></div>
        </div>

        <button id="upload-btn" type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Sabmit</button>
    </form>
@endsection
