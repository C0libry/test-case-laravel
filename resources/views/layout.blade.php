<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    @vite('resources/css/app.css')

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" defer></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" defer></script>

    <title> @yield('title') </title>

    @yield('head')
</head>

<body>
    <header class="flex justify-center items-center px-24 py-8 bg-gray-900">
        <a class="mr-auto" href="{{ route('home.index') }}">
            <ion-icon class="size-10 md:size-16 text-orange-500" name="cloud-upload-outline"></ion-icon>
        </a>
        <nav>
            <ul>
                <li>
                    <a class="text-gray-50 size-6 hover:text-orange-500 transition-all duration-300"
                        href="{{ route('gallery.index') }}">
                        <ion-icon class="size-10 md:size-16 text-orange-500" name="image-outline"></ion-icon>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    @yield('main_content')
</body>

</html>
