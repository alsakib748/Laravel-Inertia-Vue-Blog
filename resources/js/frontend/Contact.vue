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

    <Head title="Contact Us" />
    <Layout>

        <main class="bg-gray-100" style="
        background-image: url('./assets/images/contact/contact-bg.jpg');
        background-position: center;
        background-repeat: no-repeat;
      ">
            <section class="news-section">
                <div class="w-full px-4 md:px-14 lg:px-22">
                    <div class="news grid grid-cols-1 grid-cols-12 gap-4">
                        <div class="col-span-2 md:col-span-2">
                            <div class="flex items-center justify-around px-2 md:px-6">
                                <span class="text-white text-md md:text-xl pe-3 md:pe-0">Contact Us</span>
                                <div class="w-0.5 bg-gray-300 h-12"></div>
                            </div>
                        </div>
                        <div class="col-span-10 md:col-span-10 flex flex-col items-end justify-center">
                            <div class="flex flex-row items-center justify-end gap-4">
                                <a href="javascript:void(0)" class="text-medium text-indigo-600">Home</a>
                                <span class="text-white">/</span>
                                <span class="me-3 text-medium text-gray-700">Contact Us</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="register-section mx-4 md:mx-14 lg:mx-22 mt-8 mb-18">
                <div class="register p-4">
                    <form action="">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="mb-8 col-span-1">
                                <input type="text" name="name" id="" placeholder="Your Name"
                                    class="w-full border-1 border-gray-200 text-md text-gray-400 py-5 focus:border-1 focus:border-indigo-700 px-8" />
                            </div>
                            <div class="mb-8 col-span-1">
                                <input type="email" name="email" id="" placeholder="Your Email"
                                    class="w-full border-1 border-gray-200 text-md text-gray-400 py-5 focus:border-1 focus:border-indigo-700 px-8" />
                            </div>
                            <div class="mb-8 col-span-1">
                                <input type="text" name="company" id="" placeholder="Company"
                                    class="w-full border-1 border-gray-200 text-md text-gray-400 py-5 focus:border-1 focus:border-indigo-700 px-8" />
                            </div>
                            <div class="mb-8 col-span-1">
                                <select name="" id=""
                                    class="w-full border-1 border-gray-200 bg-white text-md text-gray-400 py-5 px-8">
                                    <option value="" class="text-lg font-bold">
                                        <strong>Select request</strong>
                                    </option>
                                    <option value="" class="text-lg">Travel Post</option>
                                    <option value="" class="text-lg">Finance Post</option>
                                    <option value="" class="text-lg">Business Post</option>
                                    <option value="" class="text-lg">Trading Post</option>
                                    <option value="" class="text-lg">Tech Post</option>
                                </select>
                            </div>
                            <div class="mb-8 col-span-2">
                                <textarea name="" id="" cols="30" rows="10"
                                    class="w-full bg-white border-1 border-gray-200 text-md text-gray-400 py-5 focus:border-1 focus:border-indigo-700 px-8"
                                    placeholder="Message"></textarea>
                            </div>
                            <div class="col-span-2">
                                <div class="w-56 m-auto">
                                    <button type="submit"
                                        class="group border-none outline-none w-full px-4 py-3 text-white text-lg font-medium bg-gradient-to-r from-yellow-600 to-indigo-600 hover:bg-indigo-600 text-center cursor-pointer transition-all duration-300 ease-in-out">
                                        <span class="uppercase">Send Request</span>
                                        <span class="ms-2"><i
                                                class="fa-solid fa-arrow-right group-hover:translate-x-3 transition-all duration-300 ease-in-out"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <section class="bg-white py-12">
                <div class="px-4 md:px-8 lg:px-62 xl:px-76">
                    <div class="subscribe-section contact-page bg-white">
                        <div class="px-6 py-8 md:p-10 subscribe bg-white">
                            <form action="" class="">
                                <div class="grid grid-cols-5 md:grid-cols-4">
                                    <div class="col-span-3 md:col-span-3">
                                        <input type="email"
                                            class="w-full border-none outline-none px-3 py-3 text-gray-700"
                                            placeholder="Enter your email" />
                                    </div>
                                    <div class="col-span-2 md:col-span-1">
                                        <button type="submit"
                                            class="w-full bg-yellow-600 text-white py-3 hover:bg-indigo-600 transition-all duration-300 ease-in-out cursor-pointer">
                                            Subscribe
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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