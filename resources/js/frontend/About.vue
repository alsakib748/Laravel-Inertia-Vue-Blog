<script setup>

import hero1 from "./assets/images/hero-slider/banner-slider.jpg"

import { Head, Link } from "@inertiajs/vue3";

import { ref, defineProps } from "vue";

import Layout from "./Layout.vue";

const props = defineProps({
    about: Array,
    categories: Array
})

</script>

<template>

    <!-- <pre>
        {{ props.about }}
    </pre> -->

    <Head title="Contact Us" />
    <Layout>

        <main>
            <section class="news-section">
                <div class="w-full px-4 md:px-14 lg:px-22">
                    <div class="news grid grid-cols-12 gap-4">
                        <div class="col-span-2">
                            <div class="flex items-center justify-around px-2 md:px-6">
                                <span class="text-white text-md md:text-xl pe-3 md:pe-0">About Us
                                </span>
                                <div class="w-0.5 bg-gray-300 h-12"></div>
                            </div>
                        </div>
                        <div class="col-span-10 flex flex-col items-end justify-center">
                            <div class="flex flex-row items-center justify-end gap-4">
                                <a href="javascript:void(0)" class="text-medium text-indigo-600">Home</a>
                                <span class="text-white">/</span>
                                <span class="me-3 text-medium text-gray-700">About</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="px-4 md:px-14 lg:px-22">
                <h2 class="text-2xl font-medium text-center pt-12 pb-4">
                    {{ props.about?.title }}
                </h2>
                <div class="">
                    <img :src="props.about?.image" class="w-full pt-6 pb-4" alt="" />
                </div>

                <div v-html="props.about?.content"></div>

                <!-- <p class="py-6 text-lg">
                    The mission of the Stellar Development Foundation (SDF) is to promote
                    global financial access, literacy, and inclusion. SDF accomplishes
                    this by expanding worldwide access to low-cost financial services
                    through the development and maintenance of technology and
                    partnerships. SDF’s vision is an open and affordable financial system
                    where people of all income levels can access simple-to-use, secure,
                    and low cost finan-cial services. SDF also aims to empower developers
                    with useful technology to create financial products and services for
                    their communities.
                </p> -->

            </section>

            <!-- todo: Topic Section -->
            <section class="topic-section py-16 bg-white px-4 md:px-14 lg:px-22">
                <div class="topic">
                    <h3 class="text-4xl text-indigo-600 font-medium text-center pt-3 pb-8">
                        Topics
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <a v-for="category in props.categories" :key="category.id" href="javascript:void(0)"
                            class="bg-gray-200/60 rounded-full py-3 px-3 text-center hover:bg-gradient-to-r hover:from-yellow-600 hover:to-indigo-600 hover:text-white transition-all duration-300 ease-in-out mb-3">
                            <div class="text-medium text-xl">{{ category?.name }}</div>
                        </a>
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
