<script setup>

import { Head, Link, usePage } from "@inertiajs/vue3";
import { ref, onMounted, onUnmounted, computed } from "vue";

const mobileOpen = ref(false);
const headerScrolled = ref(false);

// Header scroll functionality
const handleScroll = () => {
    headerScrolled.value = window.scrollY > 10;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});

const page = usePage();

const categories = computed(() => page.props.categories ?? []);

</script>

<template>

    <div>
        <header class="sticky top-0 z-[999]" id="main-header">
            <section class="header" :class="{ 'scrolled': headerScrolled }">
                <nav class="bg-white border-gray-200 dark:bg-gray-900 md:px-14 lg:px-22">
                    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                        <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                            <img src="./assets/images/logo/logo.png" class="md:h-4 lg:h-8" alt="Flowbite Logo" />
                        </a>
                        <div class="flex md:order-2">
                            <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search"
                                aria-expanded="false"
                                class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                            <div
                                class="group hidden md:flex flex items-center justify-between bg-[#F1F1F1] m-0 p-0 border border-transparent hover:border-indigo-700">
                                <div class="">
                                    <input type="search" id=""
                                        class="search-box md:w-36 lg:w-full p-1 md:p-2.5 text-gray-900 focus:border-0 focus:outline-none dark:bg-gray-700 border-0 dark:placeholder-gray-400 dark:text-white text-sm md:text-md bg-transparent focus:border-transparent"
                                        placeholder="Type and hit enter" />
                                </div>

                                <div
                                    class="md:py-2 lg:py-4 md:px-2 lg:px-3 group-hover:bg-indigo-700 group-hover:text-white m-0 cursor-pointer search-icon">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                    <span class="sr-only">Search icon</span>
                                </div>
                            </div>
                            <div class="p-3">
                                <a href="/login" class="">
                                    <i class="fas fa-user"></i>
                                </a>
                            </div>
                            <button data-collapse-toggle=" navbar-search" type="button"
                                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                aria-controls="navbar-search" aria-expanded="false">
                                <span class="sr-only">Open main menu</span>
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 17 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                                </svg>
                            </button>
                        </div>
                        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
                            id="navbar-search">
                            <!-- <div class="relative mt-3 md:hidden">
                      <div
                        class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"
                      >
                        <svg
                          class="w-4 h-4 text-gray-500 dark:text-gray-400"
                          aria-hidden="true"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 20 20"
                        >
                          <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                          />
                        </svg>
                      </div>
                      <input
                        type="text"
                        id="search-navbar"
                        class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search..."
                      />
                    </div> -->

                            <div
                                class="group mt-3 md:hidden flex items-center justify-between bg-[#F1F1F1] m-0 p-0 border border-transparent hover:border-indigo-700">
                                <div class="w-full">
                                    <input type="search" id=""
                                        class="search-box w-full p-1 md:p-2.5 text-gray-900 focus:border-0 focus:outline-none dark:bg-gray-700 border-0 dark:placeholder-gray-400 dark:text-white text-sm md:text-md bg-transparent focus:border-transparent"
                                        placeholder="Type and hit enter" />
                                </div>

                                <div
                                    class="p-2 group-hover:bg-indigo-700 group-hover:text-white m-0 cursor-pointer search-icon">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 group-hover:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                    <span class="sr-only">Search icon</span>
                                </div>
                            </div>

                            <ul
                                class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                                <li>
                                    <Link :href="route('frontend.home')"
                                        class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 text-sm md:text-md"
                                        aria-current="page">HOME</Link>
                                </li>
                                <li>
                                    <Link :href="route('frontend.blog')"
                                        class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-sm md:text-md">
                                    BLOG</Link>
                                </li>
                                <li>
                                    <Link :href="route('frontend.about')"
                                        class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-sm md:text-md">
                                    ABOUT
                                    US</Link>
                                </li>
                                <!-- <li>
                                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                                        class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent text-sm md:text-md">
                                        CATEGORY
                                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg>
                                    </button>
                                    <div id="dropdownNavbar"
                                        class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow-md w-[93%] md:w-56 dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-400"
                                            aria-labelledby="dropdownLargeButton">
                                            <li v-for="(name, slug) in categories" :key="slug">
                                                <a href="#"
                                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white sm:text-md text-md">{{
                                                        name }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li> -->

                                <li>
                                    <Link :href="route('frontend.contact')"
                                        class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 text-sm md:text-md">
                                    CONTACT US</Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </section>
        </header>

        <slot />

        <footer>
            <section class="footer-section">
                <div class="w-full px-6 md:px-14 lg:px-22 grid grid-cols-1 md:grid-cols-12 gap-12">
                    <div class="col-span-1 col-span-5">
                        <a href="" class="">
                            <img src="./assets/images/logo.png" alt="" class="" />
                        </a>
                        <br /><br />
                        <p class="my-3 text-gray-400">
                            Established in 2013 as the first cloud mining provider, Blog has
                            become a multi-functional Blog Categories, trusted by over a
                            million users.
                        </p>

                        <br />
                        <h4 class="text-yellow-700 text-xl font-bold">Location</h4>
                        <br />
                        <p class="text-gray-300">12/4 New Yourk R Block Street 2101 USA</p>
                    </div>
                    <div class="col-span-1 col-span-4">
                        <h5 class="uppercase text-white text-xl font-bold">Subscribe</h5>
                        <p class="pt-10 text-gray-300">
                            Sign up for our mailing list to get latest updates and offers
                        </p>
                        <br /><br />
                        <!-- <div class="group message w-full">
                    <div class="flex items-center justify-between">
                      <div class="">
                        <input type="text" name="message" class="py-4" id="" />
                      </div>
                      <div class="">
                        <div class="bg-indigo-700 group-hover:bg-yellow-700 py-4">
                          <i class="fa-solid fa-paper-plane text-white"></i>
                        </div>
                      </div>
                    </div>
                  </div> -->
                        <div class="">
                            <div class="pb-4 group">
                                <form action="" class="">
                                    <div
                                        class="grid grid-cols-5 md:grid-cols-5 bg-[#272130] border border-[#272130] group-hover:border-yellow-600 focus:border-yellow-600">
                                        <div class="col-span-4 md:col-span-4">
                                            <input type="email"
                                                class="newsletter-input w-full border-none outline-none px-3 py-3 h-full text-gray-700 bg-[#272130] focus:border-yellow-600 active:border-yellow-600"
                                                placeholder="" />
                                        </div>
                                        <div class="col-span-1 md:col-span-1 my-0.5 me-0.5">
                                            <button type="submit"
                                                class="w-full bg-indigo-600 text-white py-3 group-hover:bg-yellow-600 hover:bg-yellow-600 transition-all duration-300 ease-in-out cursor-pointer">
                                                <i class="fa-solid fa-paper-plane text-white"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="">
                            <span class="font-bold text-gray-100">Working Hours : </span>
                            <span class="text-gray-100">Monday-Saturday</span>
                        </div>
                        <div class="pt-1">
                            <span class="font-bold text-yellow-600">Close : </span>
                            <span class="text-yellow-600">Sunday</span>
                        </div>
                    </div>
                    <div class="col-span-1 col-span-3">
                        <h3 class="text-lg font-bold text-gray-100 uppercase">
                            Short Link
                        </h3>
                        <div class="flex flex-col items-start justify-start gap-3 pt-10">
                            <a href="javascript:void(0)" class="text-gray-300 hover:text-yellow-400">About</a>
                            <a href="javascript:void(0)" class="text-gray-300 hover:text-yellow-400">Contact</a>
                            <a href="javascript:void(0)" class="text-gray-300 hover:text-yellow-400">Bug Bounty
                                Program</a>
                            <a href="javascript:void(0)" class="text-gray-300 hover:text-yellow-400">Policy</a>
                            <a href="javascript:void(0)" class="text-gray-300 hover:text-yellow-400">FAQ</a>
                            <a href="javascript:void(0)" class="text-gray-300 hover:text-yellow-400">Shop</a>
                        </div>
                    </div>
                </div>
            </section>
        </footer>
    </div>

</template>
