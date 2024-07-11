<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>People Center</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-hero-pattern bg-no-repeat bg-cover bg-fixed">
    <nav
        class="backdrop-blur bg-opacity-25 bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">People Center Event
                    Booking</span>
            </a>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="" alt="">
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">Bonnie Green</span>
                        <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">name@flowbite.com</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                out</a>
                        </li>
                    </ul>
                </div>
                <button data-collapse-toggle="navbar-user" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                <ul
                    class="flex flex-col font-medium p-4 md:p-0 mt-4 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0  dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-900 rounded hover:scale-110 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-900 rounded hover:scale-110 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-900 rounded hover:scale-110 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Services</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-900 rounded hover:scale-110 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Pricing</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-900 rounded hover:scale-110 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section>
        <div class="h-screen flex flex-col justify-center bg-black bg-opacity-50">
            <div
                class="ml-12 flex flex-col justify-center mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-200 md:text-5xl lg:text-6xl dark:text-white">
                <h1 class="text-3xl md:text-4xl lg:text-5xl">Looking for a Venue?</h1>
                <span class="text-blue-600 dark:text-blue-500">People Center Tacloban</span>
                <h1>Where Moments become Memories.</h1>
            </div>
        </div>
        <div class="bg-white bg-opacity-95">
            <div class="sm:mx-4 py-4 flex justify-evenly flex-col">
                <h1 class="text-l md:text-xl lg:text-2xl text-center">Checkout Successful Events!</h1>

                <div
                    class="m-12 flex justify-center flex-col md:justify-evenly sm:justify-center md:flex-row sm:flex-col">
                    <video class="object-cover w-full rounded-2xl h-96 md:h-full sm:w-full md:w-1/2 md:rounded-2xl"
                        src="/videos/vid1.mp4" autoplay controls muted loop></video>
                    <div class="flex flex-col justify-center p-4 leading-normal md:w-1/3">
                        <h5 class="text-sm mb-2 md:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">DOT
                            Eastern
                            Visayas</h5>
                        <p class="text-sm mb-3 font-normal text-gray-700 dark:text-gray-400">Kultura Sinirangan event
                            held at
                            the People’s Center and Library in Tacloban City! 🎶</p>
                        <p class="text-sm mb-3 font-normal text-gray-700 dark:text-gray-400">We highlighted the rich
                            culture,
                            arts, and tourism of Eastern Visayas with stunning
                            performances in the Kanta Binisaya Choral Competition and the LOVE Eastern Visayas
                            Infomercial Music Video Competition. 🎤🎬</p>
                    </div>
                </div>
                <div
                    class="m-12 flex justify-center flex-col md:justify-evenly sm:justify-center md:flex-row sm:flex-col">
                    <div class="flex flex-col justify-center p-4 leading-normal md:w-1/3">
                        <h5 class="text-sm mb-2 md:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">JCI
                            TEMIONG AWARDS 2023</h5>
                    </div>
                    <div class="md:w-1/2 sm:w-full">
                        <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                            <div class="grid gap-4">
                                <div>
                                    <img class="h-auto max-w-full rounded-lg" src="/images/jci/jci1.jpg" alt="">
                                </div>
                                <div>
                                    <img class="h-auto max-w-full rounded-lg" src="/images/jci/jci2.jpg" alt="">
                                </div>
                            </div>
                            <div class="grid gap-4">
                                <div>
                                    <img class="h-auto max-w-full rounded-lg" src="/images/jci/jci3.jpg" alt="">
                                </div>
                                <div>
                                    <img class="h-auto max-w-full rounded-lg" src="/images/jci/jci4.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="m-12 flex justify-center flex-col md:justify-evenly sm:justify-center md:flex-row sm:flex-col">

                    <div class="md:w-1/2 sm:w-full">
                        <div class="grid gap-4">
                            <div>
                                <img class="h-auto max-w-full rounded-lg" src="/images/pfh/fh1.jpg" alt="">
                            </div>
                            <div class="grid grid-cols-4 gap-4">
                                <div>
                                    <img class="h-auto max-w-full rounded-lg" src="/images/pfh/fh2.jpg"
                                        alt="">
                                </div>
                                <div>
                                    <img class="h-auto max-w-full rounded-lg" src="/images/pfh/fh3.jpg"
                                        alt="">
                                </div>
                                <div>
                                    <img class="h-auto max-w-full rounded-lg" src="/images/pfh/fh4.jpg"
                                        alt="">
                                </div>
                                <div>
                                    <img class="h-auto max-w-full rounded-lg" src="/images/pfh/fh5.jpg"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col justify-center p-4 leading-normal md:w-1/3">
                        <h5 class="text-sm mb-2 md:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Pipols Food Hub Tacloban</h5>
                        <p class="text-sm mb-3 font-normal text-gray-700 dark:text-gray-400">Food Place event
                            held at
                            the People’s Center in Tacloban City!</p>
                    </div>
                </div>


                <h1 class="text-l md:text-xl lg:text-2xl text-center">And Many More!</h1>
                <div class="flex justify-center">
                    <div id="default-carousel" class="relative w-2/3" data-carousel="slide">
                        <!-- Carousel wrapper -->
                        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                            <?php
                        for ($i=0; $i < 6; $i++) {
                            ?>
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="/images/carousel/<?php echo $i + 1; ?>.jpg"
                                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                    alt="<?php echo $i + 1; ?>">
                            </div>
                            <?php
                        }
                        ?>

                        </div>
                        <!-- Slider indicators -->
                        <div
                            class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                            <?php
                            for ($i=0; $i < 6; $i++) {
                                ?>
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false"
                                aria-label="Slide 2" data-carousel-slide-to="<?php echo $i + 1; ?>"></button>
                            <?php
                            }
                        ?>
                        </div>
                        <!-- Slider controls -->
                        <button type="button"
                            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                            data-carousel-prev>
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 1 1 5l4 4" />
                                </svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button"
                            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                            data-carousel-next>
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
