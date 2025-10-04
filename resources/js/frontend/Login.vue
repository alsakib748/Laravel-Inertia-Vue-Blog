<script setup>

import "./assets/css/style.css";


import hero1 from "./assets/images/hero-slider/banner-slider.jpg"

import { Head, Link } from "@inertiajs/vue3";

import { ref } from "vue";

import Layout from "./Layout.vue";

// Simple slider state
const currentSlide = ref(0);
const goToSlide = (i) => {
    currentSlide.value = i;
    // If you have a track you want to translate, do it here with refs instead of document.getElementById
};

const mobileOpen = ref(false);

const toggleMobile = () => (mobileOpen.value = !mobileOpen.value);

</script>

<template>

    <Head title="Login" />
    <Layout>

        <main class="bg-gray-100">
            <section class="news-section">
                <div class="w-full px-4 md:px-14 lg:px-22">
                    <div class="news grid grid-cols-1 grid-cols-12 gap-4">
                        <div class="col-span-2 md:col-span-2">
                            <div class="flex items-center justify-around px-2 md:px-6">
                                <span class="text-white text-md md:text-xl pe-3 md:pe-0">Login</span>
                                <div class="w-0.5 bg-gray-300 h-12"></div>
                            </div>
                        </div>
                        <div class="col-span-10 md:col-span-10 flex flex-col items-end justify-center">
                            <div class="flex flex-row items-center justify-end gap-4">
                                <a href="javascript:void(0)" class="text-medium text-indigo-600">Home</a>
                                <span class="text-white">/</span>
                                <span class="me-3 text-medium text-gray-700">Login</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="register-section bg-white mx-4 md:mx-24 lg:mx-68 mt-8 mb-18">
                <div class="register p-8 md:p-16">
                    <form action="">
                        <div class="mb-8">
                            <input type="email" name="email" id="" placeholder="Email Address"
                                class="w-full border-1 border-gray-200 text-md text-gray-400 py-5 focus:border-1 focus:border-indigo-700 px-8" />
                        </div>
                        <div class="mb-8">
                            <input type="password" name="password" id="" placeholder="Password"
                                class="w-full border-1 border-gray-200 text-md text-gray-400 py-5 focus:border-1 focus:border-indigo-700 px-8" />
                        </div>
                        <div class="">
                            <button type="submit"
                                class="border-none outline-none w-full p-4 text-white text-lg font-bold bg-yellow-500 hover:bg-indigo-600 text-center cursor-pointer transition-all duration-300 ease-in-out">
                                Login
                            </button>
                        </div>

                        <div class="my-10 grid grid-cols-2 gap-6">
                            <a href="javascript:void(0)"
                                class="bg-gray-100 w-full py-4 text-center hover:bg-indigo-600 hover:text-white transition-all duration-300 ease-in-out">Reset
                                Password</a>
                            <a href="javascript:void(0)"
                                class="bg-gray-100 w-full py-4 text-center hover:bg-indigo-600 hover:text-white transition-all duration-300 ease-in-out">Login</a>
                        </div>

                        <div class="mt-0 mb-8 text-center text-md">or Login in With</div>

                        <div class="my-10 grid grid-cols-2 gap-6">
                            <a href="javascript:void(0)"
                                class="group bg-gray-50 w-full py-4 text-center border-1 border-indigo-600 text-xl text-gray-500 font-medium hover:bg-indigo-600 hover:text-white transition-all duration-300 ease-in-out">
                                <span class="me-2"><i
                                        class="fa-brands fa-google text-lg text-gray-500 group-hover:text-white font-medium"></i></span>
                                <span class="">Google</span>
                            </a>
                            <a href="javascript:void(0)"
                                class="group bg-gray-50 w-full py-4 text-center border-1 border-indigo-600 text-xl text-gray-500 font-medium hover:bg-indigo-600 hover:text-white transition-all duration-300 ease-in-out">
                                <span class="me-2"><i
                                        class="fa-brands fa-facebook-f text-lg text-gray-500 group-hover:text-white font-medium"></i></span>
                                <span class="">Facebook</span>
                            </a>
                        </div>
                    </form>
                </div>
            </section>

            <!-- connect with us  -->
            <section class="connect-with-us-section py-12">
                <div class="connect-with-us">
                    <h3 class="text-center text-white text-4xl font-bold">
                        Connect with us
                    </h3>

                    <br />

                    <div class="py-3 flex items-center justify-center gap-6">
                        <a href="javascript:void(0)" class="group">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-white rounded-full group-hover:bg-indigo-600 transition-all duration-300 ease-in-out">
                                <i
                                    class="fa-brands fa-google-plus-g text-2xl text-orange-700/60 group-hover:text-white"></i>
                            </div>
                        </a>
                        <a href="javascript:void(0)" class="group">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-white rounded-full group-hover:bg-indigo-600 transition-all duration-300 ease-in-out">
                                <i
                                    class="fa-brands fa-linkedin-in text-2xl text-orange-700/60 group-hover:text-white"></i>
                            </div>
                        </a>
                        <a href="javascript:void(0)" class="group">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-white rounded-full group-hover:bg-indigo-600 transition-all duration-300 ease-in-out">
                                <i
                                    class="fa-brands fa-instagram text-2xl text-orange-700/60 group-hover:text-white"></i>
                            </div>
                        </a>
                        <a href="javascript:void(0)" class="group">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-white rounded-full group-hover:bg-indigo-600 transition-all duration-300 ease-in-out">
                                <i class="fa-brands fa-twitter text-2xl text-orange-700/60 group-hover:text-white"></i>
                            </div>
                        </a>
                        <a href="javascript:void(0)" class="group">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-white rounded-full group-hover:bg-indigo-600 transition-all duration-300 ease-in-out">
                                <i class="fa-brands fa-youtube text-2xl text-orange-700/60 group-hover:text-white"></i>
                            </div>
                        </a>
                    </div>

                    <!-- ****************************** -->
                </div>
            </section>
        </main>

    </Layout>

</template>