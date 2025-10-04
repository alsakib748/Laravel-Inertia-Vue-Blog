<script setup>

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
                    Mora.org connects people to low-cost financial services to fight
                    poverty and develop individual potential. Interested? We’re hiring!
                    Explore jobs at Mora.org
                </h2>
                <div class="">
                    <img src="./assets/images/about/about.jpg" class="w-full pt-6 pb-4" alt="" />
                </div>
                <p class="py-6 text-lg">
                    The mission of the Stellar Development Foundation (SDF) is to promote
                    global financial access, literacy, and inclusion. SDF accomplishes
                    this by expanding worldwide access to low-cost financial services
                    through the development and maintenance of technology and
                    partnerships. SDF’s vision is an open and affordable financial system
                    where people of all income levels can access simple-to-use, secure,
                    and low cost finan-cial services. SDF also aims to empower developers
                    with useful technology to create financial products and services for
                    their communities.
                </p>

                <div class="pt-8 pb-4">
                    <div class="grid grid-cols-1 md:grid-cols-10 gap-2 md:gap-4">
                        <div
                            class="col-span-1 md:col-span-3 lg:col-span-2 mb-4 border-b-1 mb-1 pb-3 mb:pb-0 md:mb-0 md:border-b-0 md:border-r-1 border-gray-300">
                            <ul class="flex flex-row flex-wrap gap-3 md:flex-col flex-wrap -mb-px text-sm font-medium text-start"
                                id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                                <li class="me-2" role="presentation">
                                    <button
                                        class="inline-block py-2 text-lg lg:text-xl text-gray-500 font-normal hover:text-indigo-600 cursor-pointer"
                                        id="profile-tab" data-tabs-target="#profile" type="button" role="tab"
                                        aria-controls="profile" aria-selected="false">
                                        Mission
                                    </button>
                                </li>
                                <li class="me-2" role="presentation">
                                    <button
                                        class="inline-block py-2 text-lg lg:text-xl text-gray-500 font-normal hover:text-indigo-600 cursor-pointer"
                                        id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                                        aria-controls="dashboard" aria-selected="false">
                                        Organization
                                    </button>
                                </li>
                                <li class="me-2" role="presentation">
                                    <button
                                        class="inline-block py-2 text-lg lg:text-xl text-gray-500 font-normal hover:text-indigo-600 cursor-pointer"
                                        id="settings-tab" data-tabs-target="#settings" type="button" role="tab"
                                        aria-controls="settings" aria-selected="false">
                                        Responsibilites
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button
                                        class="inline-block py-2 text-lg lg:text-xl text-gray-500 font-normal hover:text-indigo-600 cursor-pointer"
                                        id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab"
                                        aria-controls="contacts" aria-selected="false">
                                        Funding
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button
                                        class="inline-block py-2 text-lg lg:text-xl text-gray-500 font-normal hover:text-indigo-600 cursor-pointer"
                                        id="lumens-tab" data-tabs-target="#lumens" type="button" role="tab"
                                        aria-controls="lumens" aria-selected="false">
                                        Lumens
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button
                                        class="inline-block py-2 text-lg lg:text-xl text-gray-500 font-normal hover:text-indigo-600 cursor-pointer"
                                        id="lumen-tab" data-tabs-target="#lumen" type="button" role="tab"
                                        aria-controls="lumen" aria-selected="false">
                                        Lumen Distribution
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button
                                        class="inline-block py-2 text-lg lg:text-xl text-gray-500 font-normal hover:text-indigo-600 cursor-pointer"
                                        id="signup-tab" data-tabs-target="#signup" type="button" role="tab"
                                        aria-controls="signup" aria-selected="false">
                                        Direct Signup Program
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button
                                        class="inline-block py-2 text-lg lg:text-xl text-gray-500 font-normal hover:text-indigo-600 cursor-pointer"
                                        id="job-tab" data-tabs-target="#job" type="button" role="tab"
                                        aria-controls="job" aria-selected="false">
                                        Job
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button
                                        class="inline-block py-2 text-lg lg:text-xl text-gray-500 font-normal hover:text-indigo-600 cursor-pointer"
                                        id="team-tab" data-tabs-target="#team" type="button" role="tab"
                                        aria-controls="team" aria-selected="false">
                                        Team
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="col-span-1 md:col-span-7 lg:col-span-8 ps-2 md:ps-4 lg:ps-6"
                            id="default-tab-content">
                            <div class="hidden p-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="">
                                    <h3 class="font-medium text-2xl border-b-1 border-gray-300 inline-block">
                                        Mission
                                    </h3>
                                    <p class="text-md lg:text-lg text-gray-600 py-4">
                                        SDF employs full-time and part-time employees, as well as
                                        contractors, to develop and execute programs that promote
                                        global financial access, literacy, and inclusion. Aside from
                                        personnel costs, other operational expenses include the
                                        costs of office rent, office amenities, hardware, software,
                                        and partnership and educational programs. Websites exist to
                                        make engagement between companies or individuals and their
                                        website visitors happen more easily and effectively. The
                                        most effective way for a website to indicate which action
                                        they’d like visitors to take is what’s called a Call to
                                        Action In this Divi tutorial, we’ll be showing you how to
                                        create a vibrant CTA section using Divi and Photoshop. You
                                        can use this design on any website by changing the images
                                        and colors that are being used.
                                    </p>
                                </div>
                            </div>
                            <div class="hidden p-4" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                <div class="">
                                    <h3 class="font-medium text-2xl border-b-1 border-gray-300 inline-block">
                                        Organization
                                    </h3>
                                    <p class="text-md lg:text-lg text-gray-600 py-4">
                                        Websites exist to make engagement between companies or
                                        individuals and their website visitors happen more easily
                                        and effectively. The most effective way for a website to
                                        indicate which action they’d like visitors to take is what’s
                                        called a Call to Action In this Divi tutorial, we’ll be
                                        showing you how to create a vibrant CTA section using Divi
                                        and Photoshop. You can use this design on any website by
                                        changing the images and colors that are being used.
                                    </p>
                                </div>
                            </div>
                            <div class="hidden p-4" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <div class="">
                                    <h3 class="font-medium text-2xl border-b-1 border-gray-300 inline-block">
                                        Responsibilities
                                    </h3>
                                    <p class="text-md lg:text-lg text-gray-600 py-4">
                                        Websites exist to make engagement between companies or
                                        individuals and their website visitors happen more easily
                                        and effectively. The most effective way for a website to
                                        indicate which action they’d like visitors to take is what’s
                                        called a Call to Action In this Divi tutorial, we’ll be
                                        showing you how to create a vibrant CTA section using Divi
                                        and Photoshop. You can use this design on any website by
                                        changing the images and colors that are being used.
                                    </p>
                                </div>
                            </div>
                            <div class="hidden p-4" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                                <div class="">
                                    <h3 class="font-medium text-2xl border-b-1 border-gray-300 inline-block">
                                        Funding
                                    </h3>
                                    <p class="text-md lg:text-lg text-gray-600 py-4">
                                        SDF employs full-time and part-time employees, as well as
                                        contractors, to develop and execute programs that promote
                                        global financial access, literacy, and inclusion. Aside from
                                        personnel costs, other operational expenses include the
                                        costs of office rent, office amenities, hardware, software,
                                        and partnership and educational programs.
                                    </p>
                                </div>
                            </div>
                            <div class="hidden p-4" id="lumens" role="tabpanel" aria-labelledby="lumens-tab">
                                <div class="">
                                    <h3 class="font-medium text-2xl border-b-1 border-gray-300 inline-block">
                                        Lumens
                                    </h3>
                                    <p class="text-md lg:text-lg text-gray-600 py-4">
                                        Websites exist to make engagement between companies or
                                        individuals and their website visitors happen more easily
                                        and effectively. The most effective way for a website to
                                        indicate which action they’d like visitors to take is what’s
                                        called a Call to Action In this Divi tutorial, we’ll be
                                        showing you how to create a vibrant CTA section using Divi
                                        and Photoshop. You can use this design on any website by
                                        changing the images and colors that are being used.
                                    </p>
                                </div>
                            </div>
                            <div class="hidden p-4" id="lumen" role="tabpanel" aria-labelledby="lumen-tab">
                                <div class="">
                                    <h3 class="font-medium text-2xl border-b-1 border-gray-300 inline-block">
                                        Lumen Distribution
                                    </h3>
                                    <p class="text-md lg:text-lg text-gray-600 py-4">
                                        Websites exist to make engagement between companies or
                                        individuals and their website visitors happen more easily
                                        and effectively. The most effective way for a website to
                                        indicate which action they’d like visitors to take is what’s
                                        called a Call to Action In this Divi tutorial, we’ll be
                                        showing you how to create a vibrant CTA section using Divi
                                        and Photoshop. You can use this design on any website by
                                        changing the images and colors that are being used.
                                    </p>
                                </div>
                            </div>
                            <div class="hidden p-4" id="signup" role="tabpanel" aria-labelledby="signup-tab">
                                <div class="">
                                    <h3 class="font-medium text-2xl border-b-1 border-gray-300 inline-block">
                                        Direct Signup Program
                                    </h3>
                                    <p class="text-md lg:text-lg text-gray-600 py-4">
                                        Websites exist to make engagement between companies or
                                        individuals and their website visitors happen more easily
                                        and effectively. The most effective way for a website to
                                        indicate which action they’d like visitors to take is what’s
                                        called a Call to Action
                                    </p>
                                </div>
                            </div>
                            <div class="hidden p-4" id="job" role="tabpanel" aria-labelledby="job-tab">
                                <div class="">
                                    <h3 class="font-medium text-2xl border-b-1 border-gray-300 inline-block">
                                        Jobs
                                    </h3>
                                    <p class="text-md lg:text-lg text-gray-600 py-4">
                                        SDF employs full-time and part-time employees, as well as
                                        contractors, to develop and execute programs that promote
                                        global financial access, literacy, and inclusion. Aside from
                                        personnel costs, other operational expenses include the
                                        costs of office rent, office amenities, hardware, software,
                                        and partnership and educational programs. Websites exist to
                                        make engagement between companies or individuals and their
                                        website visitors happen more easily and effectively. The
                                        most effective way for a website to indicate which action
                                        they’d like visitors to take is what’s called a Call to
                                        Action In this Divi tutorial, we’ll be showing you how to
                                        create a vibrant CTA section using Divi and Photoshop. You
                                        can use this design on any website by changing the images
                                        and colors that are being used.
                                    </p>
                                </div>
                            </div>
                            <div class="hidden p-4" id="team" role="tabpanel" aria-labelledby="team-tab">
                                <div class="">
                                    <h3 class="font-medium text-2xl border-b-1 border-gray-300 inline-block">
                                        Team
                                    </h3>
                                    <p class="text-md lg:text-lg text-gray-600 py-4">
                                        SDF employs full-time and part-time employees, as well as
                                        contractors, to develop and execute programs that promote
                                        global financial access, literacy, and inclusion. Aside from
                                        personnel costs, other operational expenses include the
                                        costs of office rent, office amenities, hardware, software,
                                        and partnership and educational programs. Websites exist to
                                        make engagement between companies or individuals and their
                                        website visitors happen more easily and effectively. The
                                        most effective way for a website to indicate which action
                                        they’d like visitors to take is what’s called a Call to
                                        Action In this Divi tutorial, we’ll be showing you how to
                                        create a vibrant CTA section using Divi and Photoshop. You
                                        can use this design on any website by changing the images
                                        and colors that are being used.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- todo: Topic Section -->
            <section class="topic-section py-16 bg-white px-4 md:px-14 lg:px-22">
                <div class="topic">
                    <h3 class="text-4xl text-indigo-600 font-medium text-center pt-3 pb-8">
                        Topics
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <a href="javascript:void(0)"
                            class="bg-gray-200/60 rounded-full py-3 px-3 text-center hover:bg-gradient-to-r hover:from-yellow-600 hover:to-indigo-600 hover:text-white transition-all duration-300 ease-in-out mb-3">
                            <div class="text-medium text-xl">Fashion</div>
                        </a>
                        <a href="javascript:void(0)"
                            class="bg-gray-200/60 rounded-full py-3 px-3 text-center hover:bg-gradient-to-r hover:from-yellow-600 hover:to-indigo-600 hover:text-white transition-all duration-300 ease-in-out mb-3">
                            <div class="text-medium text-xl">Technology</div>
                        </a>
                        <a href="javascript:void(0)"
                            class="bg-gray-200/60 rounded-full py-3 px-3 text-center hover:bg-gradient-to-r hover:from-yellow-600 hover:to-indigo-600 hover:text-white transition-all duration-300 ease-in-out mb-3">
                            <div class="text-medium text-xl">Foundation</div>
                        </a>
                        <a href="javascript:void(0)"
                            class="bg-gray-200/60 rounded-full py-3 px-3 text-center hover:bg-gradient-to-r hover:from-yellow-600 hover:to-indigo-600 hover:text-white transition-all duration-300 ease-in-out mb-3">
                            <div class="text-medium text-xl">Game</div>
                        </a>
                        <a href="javascript:void(0)"
                            class="bg-gray-200/60 rounded-full py-3 px-3 text-center hover:bg-gradient-to-r hover:from-yellow-600 hover:to-indigo-600 hover:text-white transition-all duration-300 ease-in-out mb-3">
                            <div class="text-medium text-xl">Design & Development</div>
                        </a>
                        <a href="javascript:void(0)"
                            class="bg-gray-200/60 rounded-full py-3 px-3 text-center hover:bg-gradient-to-r hover:from-yellow-600 hover:to-indigo-600 hover:text-white transition-all duration-300 ease-in-out mb-3">
                            <div class="text-medium text-xl">Politics</div>
                        </a>
                        <a href="javascript:void(0)"
                            class="bg-gray-200/60 rounded-full py-3 px-3 text-center hover:bg-gradient-to-r hover:from-yellow-600 hover:to-indigo-600 hover:text-white transition-all duration-300 ease-in-out mb-3">
                            <div class="text-medium text-xl">Travel</div>
                        </a>
                        <a href="javascript:void(0)"
                            class="bg-gray-200/60 rounded-full py-3 px-3 text-center hover:bg-gradient-to-r hover:from-yellow-600 hover:to-indigo-600 hover:text-white transition-all duration-300 ease-in-out mb-3">
                            <div class="text-medium text-xl">Business</div>
                        </a>
                        <a href="javascript:void(0)"
                            class="bg-gray-200/60 rounded-full py-3 px-3 text-center hover:bg-gradient-to-r hover:from-yellow-600 hover:to-indigo-600 hover:text-white transition-all duration-300 ease-in-out mb-3">
                            <div class="text-medium text-xl">Architech</div>
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
