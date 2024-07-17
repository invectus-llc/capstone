<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>People Center</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-hero-pattern bg-no-repeat bg-cover bg-fixed" id="top">
    <nav
        class="backdrop-blur bg-opacity-25 bg-white dark:bg-gray-900 fixed w-full z-50 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#top" class="flex items-center space-x-3 rtl:space-x-reverse">
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
                        <a href="#top"
                            class="block py-2 px-3 text-gray-900 rounded hover:scale-110 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#events"
                            class="block py-2 px-3 text-gray-900 rounded hover:scale-110 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Events</a>
                    </li>
                    <li>
                        <a href="#about"
                            class="block py-2 px-3 text-gray-900 rounded hover:scale-110 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                    </li>
                    <li>
                        <a href="#contact"
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
        <div class="bg-white bg-opacity-95" id="events">
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
                <div id="about"></div>
                <div
                    class="m-12 flex justify-center flex-col md:justify-evenly sm:justify-center md:flex-row sm:flex-col">
                    <div class="flex flex-col justify-center p-4 leading-normal md:w-full">
                        <h5 class="text-sm md:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            About Us</h5>
                        <p class="text-md font-normal text-gray-700 dark:text-gray-400 text-justify">Welcome to
                            People Center,
                            a cherished historical landmark centrally located in Tacloban City. Established in 1979,
                            this architectural gem combines timeless elegance with modern amenities, offering a
                            versatile venue for a variety of event celebrations. Whether you're planning a wedding
                            reception, corporate gala, birthday party, or cultural event, People Center's historic charm
                            and customizable spaces provide the perfect backdrop. Our dedicated event staff ensures a
                            seamless experience from planning to execution, promising unforgettable memories in a
                            setting steeped in community history. Contact us today to explore how People Center can host
                            your next special occasion, and join us in creating lasting moments in this beloved city
                            landmark.</p>
                    </div>
                </div>
                <div
                    class="mx-12 flex justify-center flex-col md:justify-evenly sm:justify-center md:flex-row sm:flex-col">
                    <div class="flex flex-col justify-center p-4 leading-normal md:w-full">
                        <h5 class="text-sm mb-2 md:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Find Us Here!</h5>
                        <div id='map' class="p-36 z-10"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="contact"></div>
        <div class="bg-gray-300">
            <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
                <div class="md:flex md:justify-between">
                    <div class="mb-6 md:mb-0">
                        <div class="flex items-center">
                            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">People
                                Center</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Contact Us
                            </h2>
                            <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                <li class="mb-4">
                                    <p>(+63) 968-785-0645</p>
                                </li>
                                <li class="mb-4">
                                    <p>(+63) 945-763-9773</p>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                            <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                <li class="mb-4">
                                    <button data-modal-target="privacy-modal" data-modal-toggle="privacy-modal"
                                        class="hover:underline">Privacy Policy</button>
                                </li>
                                <li>
                                    <button data-modal-target="terms-modal" data-modal-toggle="terms-modal"
                                        class="hover:underline">Terms &amp; Conditions</button>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Resources
                            </h2>
                            <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                <li class="mb-4">
                                    <a href="https://flowbite.com/" class="hover:underline">Flowbite</a>
                                </li>
                                <li class="mb-4">
                                    <a href="https://tailwindcss.com/" class="hover:underline">Tailwind CSS</a>
                                </li>
                                <li class="mb-4">
                                    <a href="https://laravel.com/" class="hover:underline">Laravel</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <div class="sm:flex sm:items-center sm:justify-between">
                    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a href="#"
                            class="hover:underline">People Center™</a>. All Rights Reserved.
                    </span>
                    <div class="flex mt-4 sm:justify-center sm:mt-0">
                        <a href="https://facebook.com/"
                            class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 8 19">
                                <path fill-rule="evenodd"
                                    d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Facebook page</span>
                        </a>
                        <a href="https://discord.com"
                            class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 21 16">
                                <path
                                    d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z" />
                            </svg>
                            <span class="sr-only">Discord community</span>
                        </a>
                        <a href="https://x.com/" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 17">
                                <path fill-rule="evenodd"
                                    d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Twitter page</span>
                        </a>
                        <a href="https://github.com/"
                            class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">GitHub account</span>
                        </a>
                        <a href="https://dribbble.com/"
                            class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Dribbble account</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- privacy policy modal -->
    <div id="privacy-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Privacy Policy
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="privacy-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <ul>
                        <li class="text-base leading-relaxed text-gray-500 dark:text-gray-400 m-2">
                            At People Center, safeguarding your privacy is paramount. Our Privacy Policy governs
                            how we collect, utilize, and protect your personal information when you engage with our
                            online booking platform. The types of data we gather include personal details such as your
                            name, contact information, and booking preferences, alongside transactional data like
                            payment details necessary for completing reservations. We employ stringent security measures
                            to safeguard your information from unauthorized access or disclosure.
                        </li>
                        <li class="text-base leading-relaxed text-gray-500 dark:text-gray-400 m-2">
                            Your data is utilized primarily to facilitate bookings, manage reservations effectively, and
                            provide customer support. Additionally, we may analyze usage patterns to enhance our
                            services and user experience. We may share your information with trusted third parties, such
                            as payment processors or service providers, to fulfill these purposes. Rest assured, we only
                            disclose your data when necessary or with your explicit consent.
                        </li>
                        <li class="text-base leading-relaxed text-gray-500 dark:text-gray-400 m-2">
                            You have rights concerning your personal information, including the ability to access,
                            correct, or delete data. We also respect your preferences regarding communications and data
                            processing activities. Our use of cookies and similar technologies helps personalize your
                            experience and improve our platform's functionality.
                        </li>
                        <li class="text-base leading-relaxed text-gray-500 dark:text-gray-400 m-2">
                            It's important to note that our services are intended for users aged 18 and above, and we do
                            not knowingly collect information from minors. As our platform evolves, updates to this
                            Privacy Policy may occur, and we will notify you of any significant changes. If you have any
                            questions or concerns about our practices or this Policy, please contact us. By using our
                            online booking platform, you signify your acceptance of this Privacy Policy and its terms.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- tnc modal -->
    <div id="terms-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Terms &amp; Conditions
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="terms-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <ul>
                        <li class="text-base leading-relaxed text-gray-500 dark:text-gray-400 m-2">
                            <h2>1. Booking and Reservation</h2>
                            <p>1.1. Our platform allows you to make bookings and reservations for various services
                                offered
                                by third-party providers.</p>
                            <p>1.2. You agree to provide accurate, current, and complete information during the booking
                                process.</p>
                            <p>1.3. Bookings are subject to availability, and confirmation is contingent upon acceptance
                                by
                                the service provider.</p>
                        </li>
                        <li class="text-base leading-relaxed text-gray-500 dark:text-gray-400 m-2">
                            <h2>2. User Responsibilities</h2>
                            <p>2.1. You are responsible for maintaining the confidentiality of your account information
                                and
                                for all activities that occur under your account.</p>
                            <p>2.2. You agree to use the platform only for lawful purposes and in accordance with these
                                Terms and any applicable laws or regulations.</p>
                            <p>2.3. You must not use the platform in any way that could impair its performance,
                                interfere
                                with other users’ access, or compromise security.</p>
                        </li>
                        <li class="text-base leading-relaxed text-gray-500 dark:text-gray-400 m-2">
                            <h2>3. Payment and Cancellations</h2>
                            <p>3.1. Payment terms and cancellation policies are determined by the respective service
                                providers.</p>
                            <p>3.2. You agree to pay all fees and charges incurred through your use of the platform.</p>
                            <p>3.3. Cancellations or changes to bookings may be subject to fees or penalties as
                                specified by
                                the service provider.</p>
                        </li>
                        <li class="text-base leading-relaxed text-gray-500 dark:text-gray-400 m-2">
                            <h2>4. Intellectual Property</h2>
                            <p>4.1. The platform and its original content, features, and functionality are owned by
                                People Center and are protected by intellectual property laws.</p>
                            <p>4.2. You may not modify, reproduce, distribute, create derivative works of, publicly
                                display,
                                or exploit any part of the platform without our prior written consent.</p>
                        </li>
                        <li class="text-base leading-relaxed text-gray-500 dark:text-gray-400 m-2">
                            <h2>5. Limitation of Liability</h2>
                            <p>5.1. People Center acts solely as an intermediary between users and service
                                providers.
                                We do not provide the services offered directly and are not liable for any acts, errors,
                                omissions, representations, warranties, breaches, or negligence of any service provider.
                            </p>
                            <p>5.2. In no event shall People Center be liable for any indirect, incidental,
                                special,
                                consequential, or punitive damages arising out of or related to your use of the
                                platform.
                            </p>
                        </li>
                        <li class="text-base leading-relaxed text-gray-500 dark:text-gray-400 m-2">
                            <h2>6. Privacy Policy</h2>
                            <p>6.1. Your use of the platform is also governed by our Privacy Policy, which outlines how
                                we
                                collect, use, and protect your personal information.</p>
                        </li>
                        <li class="text-base leading-relaxed text-gray-500 dark:text-gray-400 m-2">
                            <h2>7. Governing Law and Dispute Resolution</h2>
                            <p>7.1. These Terms shall be governed by and construed in accordance with the laws of the
                                Republic of the Philippines, without regard to its conflict of law principles.</p>
                            <p>7.2. Any dispute arising out of or relating to these Terms or your use of the platform
                                shall
                                be resolved exclusively in the competent courts of the Republic of the Philippines.</p>
                        </li>
                        <li class="text-base leading-relaxed text-gray-500 dark:text-gray-400 m-2">
                            <h2>8. Changes to Terms</h2>
                            <p>8.1. People Center reserves the right to modify or replace these Terms at any time.
                                The
                                most current version of the Terms will be posted on the platform.</p>
                            <p>8.2. By continuing to access or use the platform after revisions become effective, you
                                agree
                                to be bound by the revised Terms.</p>
                        </li>
                        <li class="text-base leading-relaxed text-gray-500 dark:text-gray-400 m-2">
                            <h2>9. Contact Us</h2>
                            <p>9.1. If you have any questions about these Terms and Conditions, please contact us at
                                (+63) 968-785-0645.</p>
                        </li>
                        <li class="text-base leading-relaxed text-gray-500 dark:text-gray-400 m-2">
                            <p>By using our online booking platform, you acknowledge that you have read, understood, and
                                agree to be bound by these Terms and Conditions.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>


</html>
