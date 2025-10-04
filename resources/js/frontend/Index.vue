<script setup>

import hero1 from "./assets/images/hero-slider/banner-slider.jpg"
import featuredBlog1 from "./assets/images/featured-blog/banner-item-1.jpg"
import featuredBlog2 from "./assets/images/featured-blog/banner-item-2.jpg"

import { Head, Link } from "@inertiajs/vue3";

import { ref, onMounted, onUnmounted } from "vue";

import Layout from "./Layout.vue";

// Slider state
const currentSlide = ref(0);
const totalSlides = ref(3); // Adjust based on your number of slides
const sliderInterval = ref(null);

// News slider state  
const currentNewsSlide = ref(0);
const newsSlides = ref(3); // Adjust based on your news slides

// Hero slider functions
const goToSlide = (index) => {
    currentSlide.value = index;
    stopAutoPlay();

    // Trigger Flowbite carousel if available
    const carousel = document.getElementById('controls-carousel');
    if (carousel && window.FlowbiteInstances) {
        const carouselInstance = window.FlowbiteInstances.getInstance('Carousel', 'controls-carousel');
        if (carouselInstance) {
            carouselInstance.slideTo(index);
        }
    }

    // Restart autoplay after a delay
    setTimeout(() => {
        startAutoPlay();
    }, 5000);
};

const nextSlide = () => {
    currentSlide.value = (currentSlide.value + 1) % totalSlides.value;
};

const prevSlide = () => {
    currentSlide.value = (currentSlide.value - 1 + totalSlides.value) % totalSlides.value;
};

// News slider functions
const goToNewsSlide = (index) => {
    currentNewsSlide.value = index;
};

// Auto-play slider
const startAutoPlay = () => {
    sliderInterval.value = setInterval(() => {
        nextSlide();
    }, 4000); // 4 seconds
};

const stopAutoPlay = () => {
    if (sliderInterval.value) {
        clearInterval(sliderInterval.value);
    }
};

onMounted(() => {
    startAutoPlay();

    // Initialize Flowbite carousel if available
    if (window.initFlowbite) {
        window.initFlowbite();
    }

    // Expose functions globally for any remaining HTML onclick references
    window.goToSlide = goToSlide;
    window.goToNewsSlide = goToNewsSlide;
}); onUnmounted(() => {
    stopAutoPlay();
});

const mobileOpen = ref(false);
const toggleMobile = () => (mobileOpen.value = !mobileOpen.value);

</script>

<template>

    <Head title="Home" />
    <Layout>

        <main>
            <section class="news-section">
                <div class="w-full px-4 md:px-14 lg:px-22">
                    <div class="news grid grid-cols-1 grid-cols-12 gap-4">
                        <div class="col-span-2 md:col-span-2">
                            <div class="flex items-center justify-around px-2 md:px-6">
                                <span class="text-white text-md md:text-xl pe-3 md:pe-0">News</span>
                                <div class="w-0.5 bg-gray-300 h-12"></div>
                            </div>
                        </div>
                        <div class="col-span-10 md:col-span-10">
                            <!-- Slider Container -->
                            <div class="relative overflow-hidden rounded-lg">
                                <!-- Slider Track -->
                                <div class="flex transition-transform duration-500 ease-in-out" id="slider-track">
                                    <!-- Slide 1 -->
                                    <div class="w-full flex-shrink-0">
                                        <div class="text-center text-white">
                                            <p class="text-sm md:text-xl opacity-90 max-w-2xl mx-auto">
                                                Discover the latest insights, stories, and updates from
                                                around the world. Stay informed with our curated content
                                                and expert analysis.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Slide 2 -->
                                    <div class="w-full flex-shrink-0">
                                        <div class="text-center text-white">
                                            <p class="text-sm md:text-xl opacity-90 max-w-2xl mx-auto">
                                                Get real-time updates on the most important stories
                                                happening right now. Our team works around the clock to
                                                bring you the latest developments.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Slide 3 -->
                                    <div class="w-full flex-shrink-0">
                                        <div class="text-center text-white">
                                            <p class="text-sm md:text-xl opacity-90 max-w-2xl mx-auto">
                                                Dive deep into complex topics with our expert
                                                contributors. Gain new perspectives and understanding on
                                                the issues that matter most.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Slide Indicators (Pagination) -->
                                <div
                                    class="absolute bottom-1 md:bottom-4 right-0 md:right-1 transform -translate-x-1/2 flex space-x-3">
                                    <button
                                        class="w-2 h-2 bg-white/60 hover:bg-white rounded-full transition-all duration-200 indicator active"
                                        @click="goToSlide(0)" aria-label="Go to slide 1" title="Go to slide 1"></button>
                                    <button
                                        class="w-2 h-2 bg-white/60 hover:bg-white rounded-full transition-all duration-200 indicator"
                                        @click="goToSlide(1)" aria-label="Go to slide 2" title="Go to slide 2"></button>
                                    <button
                                        class="w-2 h-2 bg-white/60 hover:bg-white rounded-full transition-all duration-200 indicator"
                                        @click="goToSlide(2)" aria-label="Go to slide 3" title="Go to slide 3"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- todo: Hero Slider Section -->
            <section class="hero-slider-section">
                <div class="w-full px-4 md:px-14 lg:px-22">
                    <div id="controls-carousel" class="relative w-full group" data-carousel="static">
                        <!-- Carousel wrapper -->
                        <div class="relative h-56 overflow-hidden md:h-90 lg:h-120">
                            <!-- Item 1 -->
                            <div class="hidden duration-700 ease-in-out home-slider-inner z-[300]" data-carousel-item>
                                <img src="./assets/images/hero-slider/banner-item-1.jpg"
                                    class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                    alt="..." />

                                <div class="absolute inset-0 bg-black/40 flex items-center px-4 md:px-12">
                                    <div class="grid grid-cols-1 md:grid-cols-12 items-center z-[400]">
                                        <div class="col-span-1 md:col-span-10 lg:col-span-8 md:p-6 text-white">
                                            <h5 class="text-white text-sm md:text-md py-1 md:py-1">
                                                February 21, 2018 , Updated 3 hours ago
                                            </h5>
                                            <h2
                                                class="hover:text-indigo-600 text-sm md:text-md md:text-2xl lg:text-5xl py-1 md:py-4">
                                                <a href="jabascript:void(0)" class="hover:text-indigo-600 font-bold">
                                                    Lorem Ipsum is simply dummy text of the printing.
                                                </a>
                                            </h2>
                                            <p class="text-xs md:text-md py-1 md:py-2">
                                                Lorem Ipsum has been the industry's standard dummy text
                                                ever since the 1500s, when an unknown printer took a
                                                galley of type and scrambled it to make a type specimen
                                                book.
                                            </p>
                                            <div class="py-3 md:py-3">
                                                <a href=""
                                                    class="px-6 py-2 bg-indigo-600 border-none text-white text-xs md:text-sm outline-none rounded-full hover:bg-yellow-600 transition-all duration-300 ease-in-out">Investing</a>
                                            </div>
                                        </div>

                                        <div class="col-span-1 md:col-span-2 lg:col-span-4 text-white text-end h-full">
                                            <div class="flex items-start justify-start md:justify-end px-3">
                                                <div class="flex items-start justify-end gap-3 md:gap-6">
                                                    <a href="javascript:void(0)" class="group">
                                                        <svg class="w-4 h-4 lg:w-6 lg:h-6 fill-current text-white group-hover:text-yellow-600 transition-all duration-300 ease-in-out"
                                                            role="img" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg" aria-label="Twitter">
                                                            <title>Twitter</title>
                                                            <path
                                                                d="M23.953 4.57a10 10 0 0 1-2.825.775 4.932 4.932 0 0 0 2.163-2.723 9.864 9.864 0 0 1-3.127 1.195 4.92 4.92 0 0 0-8.384 4.482A13.978 13.978 0 0 1 1.671 3.149a4.822 4.822 0 0 0-.664 2.475 4.92 4.92 0 0 0 2.188 4.1 4.903 4.903 0 0 1-2.229-.616v.06a4.925 4.925 0 0 0 3.946 4.827 4.996 4.996 0 0 1-2.224.084 4.936 4.936 0 0 0 4.6 3.417A9.868 9.868 0 0 1 .96 19.54a13.94 13.94 0 0 0 7.548 2.213c9.057 0 14.01-7.513 14.01-14.026 0-.213-.006-.425-.016-.636A9.936 9.936 0 0 0 24 4.59a9.85 9.85 0 0 1-2.047.56z" />
                                                        </svg>
                                                    </a>
                                                    <a href="javascript:void(0)" class="group">
                                                        <svg class="w-4 h-4 lg:w-6 lg:h-6 fill-current text-white group-hover:text-yellow-600 transition-all duration-300 ease-in-out"
                                                            role="img" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg" aria-label="LinkedIn">
                                                            <title>LinkedIn</title>
                                                            <path
                                                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.026-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.35V9h3.414v1.561h.049c.476-.9 1.637-1.852 3.37-1.852 3.602 0 4.268 2.371 4.268 5.455v6.288zM5.337 7.433a2.062 2.062 0 11.001-4.124 2.062 2.062 0 01-.001 4.124zM6.765 20.452H3.911V9h2.854v11.452zM22.225 0H1.771C.792 0 0 .771 0 1.723v20.555C0 23.228.792 24 1.771 24h20.451C23.2 24 24 23.228 24 22.277V1.723C24 .771 23.2 0 22.222 0h.003z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Item 2 -->
                            <div class="hidden duration-700 ease-in-out home-slider-inner z-[300]" data-carousel-item>
                                <img src="./assets/images/hero-slider/banner-item-2.jpg"
                                    class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                    alt="..." />

                                <div class="absolute inset-0 bg-black/40 flex items-center px-4 md:px-12">
                                    <div class="grid grid-cols-1 md:grid-cols-12 items-center z-[400]">
                                        <div class="col-span-1 md:col-span-10 lg:col-span-8 md:p-6 text-white">
                                            <h5 class="text-white text-sm md:text-md py-1 md:py-1">
                                                February 21, 2018 , Updated 3 hours ago
                                            </h5>
                                            <h2
                                                class="hover:text-indigo-600 text-sm md:text-md md:text-2xl lg:text-5xl py-1 md:py-4">
                                                <a href="jabascript:void(0)" class="hover:text-indigo-600 font-bold">
                                                    Lorem Ipsum is simply dummy text of the printing.
                                                </a>
                                            </h2>
                                            <p class="text-xs md:text-md py-1 md:py-2">
                                                Lorem Ipsum has been the industry's standard dummy text
                                                ever since the 1500s, when an unknown printer took a
                                                galley of type and scrambled it to make a type specimen
                                                book.
                                            </p>
                                            <div class="py-3 md:py-3">
                                                <a href=""
                                                    class="px-6 py-2 bg-indigo-600 border-none text-white text-xs md:text-sm outline-none rounded-full hover:bg-yellow-600 transition-all duration-300 ease-in-out">Investing</a>
                                            </div>
                                        </div>

                                        <div class="col-span-1 md:col-span-2 lg:col-span-4 text-white text-end h-full">
                                            <div class="flex items-start justify-start md:justify-end px-3">
                                                <div class="flex items-start justify-end gap-3 md:gap-6">
                                                    <a href="javascript:void(0)" class="group">
                                                        <svg class="w-4 h-4 lg:w-6 lg:h-6 fill-current text-white group-hover:text-yellow-600 transition-all duration-300 ease-in-out"
                                                            role="img" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg" aria-label="Twitter">
                                                            <title>Twitter</title>
                                                            <path
                                                                d="M23.953 4.57a10 10 0 0 1-2.825.775 4.932 4.932 0 0 0 2.163-2.723 9.864 9.864 0 0 1-3.127 1.195 4.92 4.92 0 0 0-8.384 4.482A13.978 13.978 0 0 1 1.671 3.149a4.822 4.822 0 0 0-.664 2.475 4.92 4.92 0 0 0 2.188 4.1 4.903 4.903 0 0 1-2.229-.616v.06a4.925 4.925 0 0 0 3.946 4.827 4.996 4.996 0 0 1-2.224.084 4.936 4.936 0 0 0 4.6 3.417A9.868 9.868 0 0 1 .96 19.54a13.94 13.94 0 0 0 7.548 2.213c9.057 0 14.01-7.513 14.01-14.026 0-.213-.006-.425-.016-.636A9.936 9.936 0 0 0 24 4.59a9.85 9.85 0 0 1-2.047.56z" />
                                                        </svg>
                                                    </a>
                                                    <a href="javascript:void(0)" class="group">
                                                        <svg class="w-4 h-4 lg:w-6 lg:h-6 fill-current text-white group-hover:text-yellow-600 transition-all duration-300 ease-in-out"
                                                            role="img" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg" aria-label="LinkedIn">
                                                            <title>LinkedIn</title>
                                                            <path
                                                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.026-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.35V9h3.414v1.561h.049c.476-.9 1.637-1.852 3.37-1.852 3.602 0 4.268 2.371 4.268 5.455v6.288zM5.337 7.433a2.062 2.062 0 11.001-4.124 2.062 2.062 0 01-.001 4.124zM6.765 20.452H3.911V9h2.854v11.452zM22.225 0H1.771C.792 0 0 .771 0 1.723v20.555C0 23.228.792 24 1.771 24h20.451C23.2 24 24 23.228 24 22.277V1.723C24 .771 23.2 0 22.222 0h.003z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Item 3 -->
                            <div class="hidden duration-700 ease-in-out home-slider-inner z-[300]" data-carousel-item>
                                <img src="./assets/images/hero-slider/banner-slider-2.jpg"
                                    class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                    alt="..." />

                                <div class="absolute inset-0 bg-black/40 flex items-center px-4 md:px-12">
                                    <div class="grid grid-cols-1 md:grid-cols-12 items-center z-[400]">
                                        <div class="col-span-1 md:col-span-10 lg:col-span-8 md:p-6 text-white">
                                            <h5 class="text-white text-sm md:text-md py-1 md:py-1">
                                                February 21, 2018 , Updated 3 hours ago
                                            </h5>
                                            <h2
                                                class="hover:text-indigo-600 text-sm md:text-md md:text-2xl lg:text-5xl py-1 md:py-4">
                                                <a href="jabascript:void(0)" class="hover:text-indigo-600 font-bold">
                                                    Lorem Ipsum is simply dummy text of the printing.
                                                </a>
                                            </h2>
                                            <p class="text-xs md:text-md py-1 md:py-2">
                                                Lorem Ipsum has been the industry's standard dummy text
                                                ever since the 1500s, when an unknown printer took a
                                                galley of type and scrambled it to make a type specimen
                                                book.
                                            </p>
                                            <div class="py-3 md:py-3">
                                                <a href=""
                                                    class="px-6 py-2 bg-indigo-600 border-none text-white text-xs md:text-sm outline-none rounded-full hover:bg-yellow-600 transition-all duration-300 ease-in-out">Investing</a>
                                            </div>
                                        </div>

                                        <div class="col-span-1 md:col-span-2 lg:col-span-4 text-white text-end h-full">
                                            <div class="flex items-start justify-start md:justify-end px-3">
                                                <div class="flex items-start justify-end gap-3 md:gap-6">
                                                    <a href="javascript:void(0)" class="group">
                                                        <svg class="w-4 h-4 lg:w-6 lg:h-6 fill-current text-white group-hover:text-yellow-600 transition-all duration-300 ease-in-out"
                                                            role="img" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg" aria-label="Twitter">
                                                            <title>Twitter</title>
                                                            <path
                                                                d="M23.953 4.57a10 10 0 0 1-2.825.775 4.932 4.932 0 0 0 2.163-2.723 9.864 9.864 0 0 1-3.127 1.195 4.92 4.92 0 0 0-8.384 4.482A13.978 13.978 0 0 1 1.671 3.149a4.822 4.822 0 0 0-.664 2.475 4.92 4.92 0 0 0 2.188 4.1 4.903 4.903 0 0 1-2.229-.616v.06a4.925 4.925 0 0 0 3.946 4.827 4.996 4.996 0 0 1-2.224.084 4.936 4.936 0 0 0 4.6 3.417A9.868 9.868 0 0 1 .96 19.54a13.94 13.94 0 0 0 7.548 2.213c9.057 0 14.01-7.513 14.01-14.026 0-.213-.006-.425-.016-.636A9.936 9.936 0 0 0 24 4.59a9.85 9.85 0 0 1-2.047.56z" />
                                                        </svg>
                                                    </a>
                                                    <a href="javascript:void(0)" class="group">
                                                        <svg class="w-4 h-4 lg:w-6 lg:h-6 fill-current text-white group-hover:text-yellow-600 transition-all duration-300 ease-in-out"
                                                            role="img" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg" aria-label="LinkedIn">
                                                            <title>LinkedIn</title>
                                                            <path
                                                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.026-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.35V9h3.414v1.561h.049c.476-.9 1.637-1.852 3.37-1.852 3.602 0 4.268 2.371 4.268 5.455v6.288zM5.337 7.433a2.062 2.062 0 11.001-4.124 2.062 2.062 0 01-.001 4.124zM6.765 20.452H3.911V9h2.854v11.452zM22.225 0H1.771C.792 0 0 .771 0 1.723v20.555C0 23.228.792 24 1.771 24h20.451C23.2 24 24 23.228 24 22.277V1.723C24 .771 23.2 0 22.222 0h.003z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Item 4 -->
                            <div class="hidden duration-700 ease-in-out home-slider-inner z-[300]" data-carousel-item>
                                <img src="./assets/images/hero-slider/banner-slider.jpg"
                                    class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                    alt="..." />

                                <div class="absolute inset-0 bg-black/40 flex items-center px-4 md:px-12">
                                    <div class="grid grid-cols-1 md:grid-cols-12 items-center z-[400]">
                                        <div class="col-span-1 md:col-span-10 lg:col-span-8 md:p-6 text-white">
                                            <h5 class="text-white text-sm md:text-md py-1 md:py-1">
                                                February 21, 2018 , Updated 3 hours ago
                                            </h5>
                                            <h2
                                                class="hover:text-indigo-600 text-sm md:text-md md:text-2xl lg:text-5xl py-1 md:py-4">
                                                <a href="jabascript:void(0)" class="hover:text-indigo-600 font-bold">
                                                    Lorem Ipsum is simply dummy text of the printing.
                                                </a>
                                            </h2>
                                            <p class="text-xs md:text-md py-1 md:py-2">
                                                Lorem Ipsum has been the industry's standard dummy text
                                                ever since the 1500s, when an unknown printer took a
                                                galley of type and scrambled it to make a type specimen
                                                book.
                                            </p>
                                            <div class="py-3 md:py-3">
                                                <a href=""
                                                    class="px-6 py-2 bg-indigo-600 border-none text-white text-xs md:text-sm outline-none rounded-full hover:bg-yellow-600 transition-all duration-300 ease-in-out">Investing</a>
                                            </div>
                                        </div>

                                        <div class="col-span-1 md:col-span-2 lg:col-span-4 text-white text-end h-full">
                                            <div class="flex items-start justify-start md:justify-end px-3">
                                                <div class="flex items-start justify-end gap-3 md:gap-6">
                                                    <a href="javascript:void(0)" class="group">
                                                        <svg class="w-4 h-4 lg:w-6 lg:h-6 fill-current text-white group-hover:text-yellow-600 transition-all duration-300 ease-in-out"
                                                            role="img" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg" aria-label="Twitter">
                                                            <title>Twitter</title>
                                                            <path
                                                                d="M23.953 4.57a10 10 0 0 1-2.825.775 4.932 4.932 0 0 0 2.163-2.723 9.864 9.864 0 0 1-3.127 1.195 4.92 4.92 0 0 0-8.384 4.482A13.978 13.978 0 0 1 1.671 3.149a4.822 4.822 0 0 0-.664 2.475 4.92 4.92 0 0 0 2.188 4.1 4.903 4.903 0 0 1-2.229-.616v.06a4.925 4.925 0 0 0 3.946 4.827 4.996 4.996 0 0 1-2.224.084 4.936 4.936 0 0 0 4.6 3.417A9.868 9.868 0 0 1 .96 19.54a13.94 13.94 0 0 0 7.548 2.213c9.057 0 14.01-7.513 14.01-14.026 0-.213-.006-.425-.016-.636A9.936 9.936 0 0 0 24 4.59a9.85 9.85 0 0 1-2.047.56z" />
                                                        </svg>
                                                    </a>
                                                    <a href="javascript:void(0)" class="group">
                                                        <svg class="w-4 h-4 lg:w-6 lg:h-6 fill-current text-white group-hover:text-yellow-600 transition-all duration-300 ease-in-out"
                                                            role="img" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg" aria-label="LinkedIn">
                                                            <title>LinkedIn</title>
                                                            <path
                                                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.026-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.35V9h3.414v1.561h.049c.476-.9 1.637-1.852 3.37-1.852 3.602 0 4.268 2.371 4.268 5.455v6.288zM5.337 7.433a2.062 2.062 0 11.001-4.124 2.062 2.062 0 01-.001 4.124zM6.765 20.452H3.911V9h2.854v11.452zM22.225 0H1.771C.792 0 0 .771 0 1.723v20.555C0 23.228.792 24 1.771 24h20.451C23.2 24 24 23.228 24 22.277V1.723C24 .771 23.2 0 22.222 0h.003z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Item 5 -->
                            <div class="hidden duration-700 ease-in-out home-slider-inner z-[300]" data-carousel-item>
                                <img src="./assets/images/hero-slider/banner-item-2.jpg"
                                    class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                    alt="..." />

                                <div class="absolute inset-0 bg-black/40 flex items-center px-4 md:px-12">
                                    <div class="grid grid-cols-1 md:grid-cols-12 items-center z-[400]">
                                        <div class="col-span-1 md:col-span-10 lg:col-span-8 md:p-6 text-white">
                                            <h5 class="text-white text-sm md:text-md py-1 md:py-1">
                                                February 21, 2018 , Updated 3 hours ago
                                            </h5>
                                            <h2
                                                class="hover:text-indigo-600 text-sm md:text-md md:text-2xl lg:text-5xl py-1 md:py-4">
                                                <a href="jabascript:void(0)" class="hover:text-indigo-600 font-bold">
                                                    Lorem Ipsum is simply dummy text of the printing.
                                                </a>
                                            </h2>
                                            <p class="text-xs md:text-md py-1 md:py-2">
                                                Lorem Ipsum has been the industry's standard dummy text
                                                ever since the 1500s, when an unknown printer took a
                                                galley of type and scrambled it to make a type specimen
                                                book.
                                            </p>
                                            <div class="py-3 md:py-3">
                                                <a href=""
                                                    class="px-6 py-2 bg-indigo-600 border-none text-white text-xs md:text-sm outline-none rounded-full hover:bg-yellow-600 transition-all duration-300 ease-in-out">Investing</a>
                                            </div>
                                        </div>

                                        <div class="col-span-1 md:col-span-2 lg:col-span-4 text-white text-end h-full">
                                            <div class="flex items-start justify-start md:justify-end px-3">
                                                <div class="flex items-start justify-end gap-3 md:gap-6">
                                                    <a href="javascript:void(0)" class="group">
                                                        <svg class="w-4 h-4 lg:w-6 lg:h-6 fill-current text-white group-hover:text-yellow-600 transition-all duration-300 ease-in-out"
                                                            role="img" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg" aria-label="Twitter">
                                                            <title>Twitter</title>
                                                            <path
                                                                d="M23.953 4.57a10 10 0 0 1-2.825.775 4.932 4.932 0 0 0 2.163-2.723 9.864 9.864 0 0 1-3.127 1.195 4.92 4.92 0 0 0-8.384 4.482A13.978 13.978 0 0 1 1.671 3.149a4.822 4.822 0 0 0-.664 2.475 4.92 4.92 0 0 0 2.188 4.1 4.903 4.903 0 0 1-2.229-.616v.06a4.925 4.925 0 0 0 3.946 4.827 4.996 4.996 0 0 1-2.224.084 4.936 4.936 0 0 0 4.6 3.417A9.868 9.868 0 0 1 .96 19.54a13.94 13.94 0 0 0 7.548 2.213c9.057 0 14.01-7.513 14.01-14.026 0-.213-.006-.425-.016-.636A9.936 9.936 0 0 0 24 4.59a9.85 9.85 0 0 1-2.047.56z" />
                                                        </svg>
                                                    </a>
                                                    <a href="javascript:void(0)" class="group">
                                                        <svg class="w-4 h-4 lg:w-6 lg:h-6 fill-current text-white group-hover:text-yellow-600 transition-all duration-300 ease-in-out"
                                                            role="img" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg" aria-label="LinkedIn">
                                                            <title>LinkedIn</title>
                                                            <path
                                                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.026-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.35V9h3.414v1.561h.049c.476-.9 1.637-1.852 3.37-1.852 3.602 0 4.268 2.371 4.268 5.455v6.288zM5.337 7.433a2.062 2.062 0 11.001-4.124 2.062 2.062 0 01-.001 4.124zM6.765 20.452H3.911V9h2.854v11.452zM22.225 0H1.771C.792 0 0 .771 0 1.723v20.555C0 23.228.792 24 1.771 24h20.451C23.2 24 24 23.228 24 22.277V1.723C24 .771 23.2 0 22.222 0h.003z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Slider controls -->
                        <button type="button"
                            class="hidden group-hover:block absolute top-0 start-0 z-[300] flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none transition-all duration-300 ease-in-out"
                            data-carousel-prev>
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 bg-indigo-600 dark:bg-gray-800/30 group-hover:bg-indigo/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-indigo dark:group-focus:ring-gray-800/70 group-focus:outline-none transition-all duration-300 ease-in-out">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 1 1 5l4 4" />
                                </svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button"
                            class="hidden group-hover:block absolute top-0 end-0 z-[300] flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none transition-all duration-300 ease-in-out"
                            data-carousel-next>
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 bg-indigo-600 dark:bg-gray-800/30 group-hover:bg-indigo/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-indigo dark:group-focus:ring-gray-800/70 group-focus:outline-none transition-all duration-300 ease-in-out">
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
            </section>

            <!-- todo: Featured Blog Section -->
            <section class="featured-blog-section">
                <div class="featured-blog grid grid-cols-1 md:grid-cols-12 gap-4 w-full px-4 md:px-14 lg:px-22">
                    <div class="col-span-1 md:col-span-6 mb-4 md:mb-0">
                        <div
                            class="featured-blog-item relative overflow-hidden rounded-lg shadow-lg group cursor-pointer">
                            <div class="featured-blog-img h-86 relative">
                                <img :src="featuredBlog1" alt="Featured Blog 1"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" />
                                <div
                                    class="featured-blog-item-overlay absolute inset-0 bg-gradient-to-r from-indigo-600/80 to-yellow-600/80 opacity-80 group-hover:opacity-0 transition-opacity duration-300">
                                </div>
                            </div>
                            <div
                                class="content absolute inset-0 p-6 flex flex-col items-start justify-center text-white z-10">
                                <p class="text-sm opacity-90 mb-2">August 25, 2025</p>
                                <a href="javascript:void(0)"
                                    class="font-bold text-xl lg:text-2xl mb-6 hover:text-yellow-300 transition-colors duration-300 line-clamp-2">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                </a>
                                <a href="javascript:void(0)"
                                    class="rounded-full px-6 py-2 bg-indigo-600 hover:bg-yellow-600 text-white text-sm font-medium transition-all duration-300 shadow-lg">Finance</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1 md:col-span-6">
                        <div
                            class="featured-blog-item relative overflow-hidden rounded-lg shadow-lg group cursor-pointer">
                            <div class="featured-blog-img h-86 relative">
                                <img :src="featuredBlog2" alt="Featured Blog 2"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" />
                                <div
                                    class="featured-blog-item-overlay absolute inset-0 bg-gradient-to-r from-indigo-600/80 to-yellow-600/80 opacity-80 group-hover:opacity-0 transition-opacity duration-300">
                                </div>
                            </div>
                            <div
                                class="content absolute inset-0 p-6 flex flex-col items-start justify-center text-white z-10">
                                <p class="text-sm opacity-90 mb-2">August 25, 2025</p>
                                <a href="javascript:void(0)"
                                    class="font-bold text-xl lg:text-2xl mb-6 hover:text-yellow-300 transition-colors duration-300 line-clamp-2">
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                </a>
                                <a href="javascript:void(0)"
                                    class="rounded-full px-6 py-2 bg-indigo-600 hover:bg-yellow-600 text-white text-sm font-medium transition-all duration-300 shadow-lg">Business</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- todo: Campaign Section -->
            <section class="campaign-section">
                <div class="w-full px-4 md:px-14 lg:px-22">
                    <div class="campaign py-4 bg-[#111931] grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="campaign-item p-4 rounded-md">
                            <a href="javascript:void(0)" class="text-lg font-bold text-white hover:text-yellow-500">
                                Earned $9,000,000 per Year with a Magazine Wesbite
                            </a>
                        </div>
                        <div class="campaign-item p-4 rounded-md">
                            <a href="javascript:void(0)" class="text-lg font-bold text-white hover:text-yellow-500">
                                The man who builds up private libraries - book by rare book
                            </a>
                        </div>
                        <div class="campaign-item p-4 rounded-md">
                            <a href="javascript:void(0)" class="text-lg font-bold text-white hover:text-yellow-500">
                                Futures Firm Cboe Filed for 6 Bitcoin ETFs This Week
                            </a>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <!-- todo: Main-Post and Sidebar-Post Section -->
        <section class="main-post-section sidebar-post-section">
            <div class="w-full px-4 md:px-14 lg:px-22">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                    <div class="main-post col-span-1 md:col-span-12 lg:col-span-8">
                        <!-- todo: BUSINESS Post -->
                        <div class="business-post">
                            <h2 class="text-2xl font-bold heading">BUSINESS POST</h2>
                            <br />
                            <a href="" class="group flex items-center justify-end">
                                <span class="group-hover:text-indigo-700 font-bold">View More</span>
                                <span
                                    class="mt-1 font-bold text-indigo-700 group-hover:transform group-hover:translate-x-[-4px]">
                                    <svg class="w-4 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </span>
                            </a>
                            <br />
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                                <div class="business-post-item col-span-1 md:col-span-6 lg:col-span-6">
                                    <div class="group bg-white dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
                                        <div class="relative">
                                            <a href="#">
                                                <img class="w-full md:h-48 lg:h-56 xl:h-60 2xl:h-96 group-hover:scale-110 transition-transform duration-300"
                                                    src="./assets/images/business-post/business-post-1.jpg" alt="" />
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="absolute top-3 left-3 px-6 py-1 bg-indigo-600 hover:bg-yellow-500 text-white rounded-full text-md transition-all duration-300 ease-in-out">Finance</a>
                                        </div>

                                        <div class="p-5">
                                            <a href="#">
                                                <h5
                                                    class="mb-2 md:text-md lg:text-xl font-medium tracking-tight text-gray-900 hover:text-indigo-700 dark:text-white">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    elit, sed do
                                                </h5>
                                            </a>

                                            <div
                                                class="flex items-center justify-start md:gap-1 lg:gap-2 md:text-xs lg:text-sm xl:text-md">
                                                <span class="text-gray-600">Dec 22, 2018 at 19:35</span>
                                                <span class="text-gray-600">|</span>
                                                <a href=""
                                                    class="text-gray-600 font-normal hover:text-indigo-700">Mahfuz
                                                    Riad</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="business-post-item col-span-1 md:col-span-6 lg:col-span-6">
                                    <div class="group bg-white dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
                                        <div class="relative">
                                            <a href="#">
                                                <img class="w-full md:h-48 lg:h-56 xl:h-60 2xl:h-96 group-hover:scale-110 transition-transform duration-300"
                                                    src="./assets/images/business-post/business-post-2.jpg" alt="" />
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="absolute top-3 left-3 px-6 py-1 bg-indigo-600 hover:bg-yellow-500 text-white rounded-full text-md transition-all duration-300 ease-in-out">Trading</a>
                                        </div>

                                        <div class="p-5">
                                            <a href="#">
                                                <h5
                                                    class="mb-2 md:text-md lg:text-xl font-medium tracking-tight text-gray-900 hover:text-indigo-700 dark:text-white">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    elit, sed do
                                                </h5>
                                            </a>

                                            <div
                                                class="flex items-center justify-start gap-2 md:text-xs lg:text-sm xl:text-md">
                                                <span class="text-gray-600">Dec 22, 2018 at 19:35</span>
                                                <span class="text-gray-600">|</span>
                                                <a href=""
                                                    class="text-gray-600 font-normal hover:text-indigo-700">Mahfuz
                                                    Riad</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="business-post-item col-span-1 md:col-span-6 lg:col-span-6">
                                    <div class="group bg-white py-2 dark:bg-gray-800 dark:border-gray-700 overflow-hidden"
                                        style="
                      background-image: url('./assets/images/business-post/post-bg.png');
                    ">
                                        <div class="p-5">
                                            <a href="#">
                                                <h5
                                                    class="mb-2 md:text-md lg:text-xl font-medium tracking-tight text-gray-900 hover:text-indigo-700 dark:text-white">
                                                    A Love Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing
                                                </h5>
                                            </a>

                                            <div
                                                class="flex items-center justify-start gap-2 md:text-xs lg:text-sm xl:text-md">
                                                <span class="text-gray-600">Dec 22, 2018 at 19:35</span>
                                                <span class="text-gray-600">|</span>
                                                <a href=""
                                                    class="text-gray-600 font-normal hover:text-indigo-700">Mahfuz
                                                    Riad</a>
                                            </div>
                                        </div>
                                        <div class="px-5 pb-6">
                                            <a href="javascript:void(0)"
                                                class="px-6 py-1 bg-indigo-600 hover:bg-yellow-500 text-white rounded-full text-md transition-all duration-300 ease-in-out">Trading</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="business-post-item col-span-1 md:col-span-6 lg:col-span-6">
                                    <div class="group bg-white py-2 dark:bg-gray-800 dark:border-gray-700 overflow-hidden"
                                        style="
                      background-image: url('./assets/images/business-post/post-bg.png');
                    ">
                                        <div class="p-5">
                                            <a href="#">
                                                <h5
                                                    class="mb-2 md:text-md lg:text-xl font-medium tracking-tight text-gray-900 hover:text-indigo-700 dark:text-white">
                                                    Inside Sports Building a Magazine for the Digital Eye
                                                    Strain
                                                </h5>
                                            </a>

                                            <div
                                                class="flex items-center justify-start gap-2 md:text-xs lg:text-sm xl:text-md">
                                                <span class="text-gray-600">Dec 22, 2018 at 19:35</span>
                                                <span class="text-gray-600">|</span>
                                                <a href="" class="text-gray-600 font-normal hover:text-indigo-700">Emran
                                                    Khan</a>
                                            </div>
                                        </div>
                                        <div class="px-5 pb-6">
                                            <a href="javascript:void(0)"
                                                class="px-6 py-1 bg-indigo-600 hover:bg-yellow-500 text-white rounded-full text-md transition-all duration-300 ease-in-out">Tech</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- todo: Travel Post -->
                        <div class="travel-post">

                            <br />
                            <br />

                            <div class="top-heading flex items-center justify-between">
                                <h2 class="text-2xl font-bold heading">TRAVEL POST</h2>
                                <div class="hr-line"></div>
                                <a href="" class="group flex items-center justify-end">
                                    <span class="group-hover:text-indigo-700 font-bold">View More</span>
                                    <span
                                        class="mt-1 font-bold text-indigo-700 group-hover:transform group-hover:translate-x-[-4px]">
                                        <svg class="w-4 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>

                            <br /><br />

                            <div class="travel-post group item flex flex-col md:flex-row items-start bg-white mb-6">
                                <a href="#"
                                    class="bg-white hover:bg-white dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 w-full flex flex-col md:flex-row items-start">
                                    <div
                                        class="relative overflow-hidden w-full h-56 md:w-52 md:h-56 lg:w-52 lg:h-56 xl:w-80 xl:h-60">
                                        <img class="w-full h-56 md:w-52 md:h-56 lg:w-52 lg:h-56 xl:w-80 xl:h-60 group-hover:transform group-hover:scale-110 transition-all duration-300 ease-in-out"
                                            src="./assets/images/travel-post/travel-post-1.jpg" alt="" />
                                        <div
                                            class="hidden group-hover:flex absolute top-3 right-3 flex items-center justify-end gap-5">
                                            <a href="" class="text-white hover:text-yellow-600 text-xl"><i
                                                    class="fab fa-twitter"></i></a>
                                            <a href="" class="text-white hover:text-yellow-600 text-xl"><i
                                                    class="fab fa-facebook"></i></a>
                                            <a href="" class="text-white hover:text-yellow-600 text-xl"><i
                                                    class="fab fa-google-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-between p-4">
                                        <a href="javascript:void(0)"
                                            class="mb-2 text-2xl font-medium tracking-tight text-gray-900 group-hover:text-indigo-700 dark:text-white">Lorem
                                            ipsum dolor sit amet, consectetur adipiscing
                                            elit</a>
                                        <div
                                            class="flex items-center justify-start gap-2 text-sm md:text-md lg:text-md xl:text-lg">
                                            <span class="">Dec 10, 2018 at 19:35</span>
                                            <span class="">|</span>
                                            <span class="">Emran Khan</span>
                                        </div>
                                        <p class="pt-2 mb-3 text-md font-normal text-gray-700 dark:text-gray-400">
                                            At vero eos et accusamus et iusto odio dignissimos ducimus
                                            qui blanditiis praesentium voluptatum.
                                        </p>
                                    </div>
                                </a>
                            </div>

                            <div class="travel-post group item flex flex-col md:flex-row items-start bg-white mb-6">
                                <a href="#"
                                    class="bg-white hover:bg-white dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 w-full flex flex-col md:flex-row items-start">
                                    <div
                                        class="relative overflow-hidden w-full h-56 md:w-52 md:h-56 lg:w-52 lg:h-56 xl:w-80 xl:h-60">
                                        <img class="w-full h-56 md:w-52 md:h-56 lg:w-52 lg:h-56 xl:w-80 xl:h-60 group-hover:transform group-hover:scale-110 transition-all duration-300 ease-in-out"
                                            src="./assets/images/travel-post/travel-post-2.jpg" alt="" />
                                        <div
                                            class="hidden group-hover:flex absolute top-3 right-3 flex items-center justify-end gap-5">
                                            <a href="" class="text-white hover:text-yellow-600 text-xl"><i
                                                    class="fab fa-twitter"></i></a>
                                            <a href="" class="text-white hover:text-yellow-600 text-xl"><i
                                                    class="fab fa-facebook"></i></a>
                                            <a href="" class="text-white hover:text-yellow-600 text-xl"><i
                                                    class="fab fa-google-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-between p-4">
                                        <a href="javascript:void(0)"
                                            class="mb-2 text-2xl font-medium tracking-tight text-gray-900 group-hover:text-indigo-700 dark:text-white">Bitcoin
                                            ETFs seek approval of skeptical regulator</a>
                                        <div
                                            class="flex items-center justify-start gap-2 text-sm md:text-md lg:text-md xl:text-lg">
                                            <span class="">Dec 10, 2018 at 19:35</span>
                                            <span class="">|</span>
                                            <span class="">Emran Khan</span>
                                        </div>
                                        <p class="pt-2 mb-3 text-md font-normal text-gray-700 dark:text-gray-400">
                                            At vero eos et accusamus et iusto odio dignissimos ducimus
                                            qui blanditiis praesentium voluptatum.
                                        </p>
                                    </div>
                                </a>
                            </div>

                            <div class="travel-post group item flex flex-col md:flex-row items-start bg-white mb-6">
                                <a href="#"
                                    class="bg-white hover:bg-white dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 w-full flex flex-col md:flex-row items-start">
                                    <div
                                        class="relative overflow-hidden w-full h-56 md:w-52 md:h-56 lg:w-52 lg:h-56 xl:w-80 xl:h-60">
                                        <img class="w-full h-56 md:w-52 md:h-56 lg:w-52 lg:h-56 xl:w-80 xl:h-60 group-hover:transform group-hover:scale-110 transition-all duration-300 ease-in-out"
                                            src="./assets/images/travel-post/travel-post-3.jpg" alt="" />
                                        <div
                                            class="hidden group-hover:flex absolute top-3 right-3 flex items-center justify-end gap-5">
                                            <a href="" class="text-white hover:text-yellow-600 text-xl"><i
                                                    class="fab fa-twitter"></i></a>
                                            <a href="" class="text-white hover:text-yellow-600 text-xl"><i
                                                    class="fab fa-facebook"></i></a>
                                            <a href="" class="text-white hover:text-yellow-600 text-xl"><i
                                                    class="fab fa-google-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-between p-4">
                                        <a href="javascript:void(0)"
                                            class="mb-2 text-2xl font-medium tracking-tight text-gray-900 group-hover:text-indigo-700 dark:text-white">Lorem
                                            ipsum dolor sit amet, consectetur adipiscing
                                            elit</a>
                                        <div
                                            class="flex items-center justify-start gap-2 text-sm md:text-md lg:text-md xl:text-lg">
                                            <span class="">Dec 10, 2018 at 19:35</span>
                                            <span class="">|</span>
                                            <span class="">Emran Khan</span>
                                        </div>
                                        <p class="pt-2 mb-3 text-md font-normal text-gray-700 dark:text-gray-400">
                                            At vero eos et accusamus et iusto odio dignissimos ducimus
                                            qui blanditiis praesentium voluptatum.
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- First magazine section -->
                        <!-- todo: First Magazine Section -->
                        <div class="magazine-section">
                            <div class="">
                                <div class="relative">
                                    <img src="./assets/images/font-load-1.jpg" alt="" class="w-full img-fluid" />
                                    <div
                                        class="absolute inset-0 flex flex-col items-start justify-center px-4 md:px-12">
                                        <a href=""
                                            class="px-8 py-1 bg-indigo-600 text-white rounded-full text-md hover:bg-yellow-600 transition-all duration-300 ease-in-out mb-6">Travel</a>
                                        <a href="" class="">
                                            <div
                                                class="p-8 text-md md:text-4xl font-bold text-white hover:text-indigo-700 bg-slate-900/60">
                                                Why It Pays to Front-Load Your 529 Plan
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href=""
                            class="px-8 py-1 bg-indigo-600 text-white rounded-full text-md hover:bg-yellow-600 transition-all duration-300 ease-in-out mb-6">Travel</a>

                        <br /><br />

                        <a href="" class="font-bold text-md md:text-4xl hover:text-indigo-700 py-2">
                            On the other hand, we denounce with righteous indignation and
                            dislike men who are so beguiled
                        </a>

                        <p class="py-3 text-md text-gray-700">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent
                            placerat turpis nec lectus congue, sed varius ligula iaculis. Orci
                            varius natoque penatibus.
                        </p>

                        <!-- todo: First add image caption -->
                        <div class="">
                            <div class="">
                                <img src="./assets/images/font-load-2.jpg" alt=""
                                    class="w-full h-56 md:h-72 lg:h-86 xl:102 2xl:h-128" />
                            </div>
                        </div>

                        <div class="subscribe-section">
                            <div class="px-6 py-8 md:p-10 subscribe">
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

                        <!-- todo: Watch It -->
                        <div class="travel-post watch-it-section">
                            <div class="top-heading flex items-center justify-between">
                                <h2 class="text-2xl font-bold heading uppercase">Watch It</h2>
                                <div class="hr-line"></div>
                                <a href="" class="group flex items-center justify-end">
                                    <span class="group-hover:text-indigo-700 font-bold">View More</span>
                                    <span
                                        class="mt-1 font-bold text-indigo-700 group-hover:transform group-hover:translate-x-[-4px]">
                                        <svg class="w-4 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>

                            <br /><br />

                            <div class="watch-it-post grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="watch-it-post-item col-span-1 md:col-span-1 overflow-hidden mb-6">
                                    <div class="group relative">
                                        <a href="" class="">
                                            <div class="overflow-hidden w-full h-56 md:h-52 lg:h-62 xl:72 2xl:h-92">
                                                <img src="./assets/images//watch-it/wathc-1.jpg" alt=""
                                                    class="w-full h-56 md:h-52 lg:h-62 xl:72 2xl:h-92 group-hover:transform group-hover:scale-110 transition-all duration-500 ease-in-out" />
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="absolute bottom-4 left-4 flex items-center justify-start gap-2 text-white group-hover:text-indigo-700 text-lg">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                                                </svg>
                                            </span>
                                            <span class="">3.16</span>
                                        </a>
                                    </div>
                                    <!-- <br /> -->
                                    <div class="pt-3">
                                        <a href="javascript:void(0)"
                                            class="font-bold text-md md:text-xl hover:text-indigo-700">
                                            Nullam neque leo, placerat eu ante vitae, vehicula rhoncus
                                            quam.
                                        </a>
                                    </div>
                                </div>

                                <div class="watch-it-post-item col-span-1 md:col-span-1 overflow-hidden mb-6">
                                    <div class="group relative">
                                        <a href="" class="">
                                            <div class="overflow-hidden w-full h-56 md:h-52 lg:h-62 xl:72 2xl:h-92">
                                                <img src="./assets/images//watch-it/wathc-2.jpg" alt=""
                                                    class="w-full h-56 md:h-52 lg:h-62 xl:72 2xl:h-92 group-hover:transform group-hover:scale-110 transition-all duration-500 ease-in-out" />
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="absolute bottom-4 left-4 flex items-center justify-start gap-2 text-white group-hover:text-indigo-700 text-lg">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                                                </svg>
                                            </span>
                                            <span class="">3.16</span>
                                        </a>
                                    </div>
                                    <!-- <br /> -->
                                    <div class="pt-3">
                                        <a href="javascript:void(0)"
                                            class="font-bold text-md md:text-xl hover:text-indigo-700">
                                            Nullam neque leo, placerat eu ante vitae.
                                        </a>
                                    </div>
                                </div>

                                <div class="watch-it-post-item col-span-1 md:col-span-1 overflow-hidden mb-6">
                                    <div class="group relative">
                                        <a href="" class="">
                                            <div class="overflow-hidden w-full h-56 md:h-52 lg:h-62 xl:72 2xl:h-92">
                                                <img src="./assets/images//watch-it/wathc-3.jpg" alt=""
                                                    class="w-full h-56 md:h-52 lg:h-62 xl:72 2xl:h-92 group-hover:transform group-hover:scale-110 transition-all duration-500 ease-in-out" />
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="absolute bottom-4 left-4 flex items-center justify-start gap-2 text-white group-hover:text-indigo-700 text-lg">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                                                </svg>
                                            </span>
                                            <span class="">3.16</span>
                                        </a>
                                    </div>
                                    <!-- <br /> -->
                                    <div class="pt-3">
                                        <a href="javascript:void(0)"
                                            class="font-bold text-md md:text-xl hover:text-indigo-700">
                                            Kristin Addis, our solo female travel expert,
                                        </a>
                                    </div>
                                </div>

                                <div class="watch-it-post-item col-span-1 md:col-span-1 overflow-hidden mb-6">
                                    <div class="group relative">
                                        <a href="" class="">
                                            <div class="overflow-hidden w-full h-56 md:h-52 lg:h-62 xl:72 2xl:h-92">
                                                <img src="./assets/images//watch-it/wathc-4.jpg" alt=""
                                                    class="w-full h-56 md:h-52 lg:h-62 xl:72 2xl:h-92 group-hover:transform group-hover:scale-110 transition-all duration-500 ease-in-out" />
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="absolute bottom-4 left-4 flex items-center justify-start gap-2 text-white group-hover:text-indigo-700 text-lg">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                                                </svg>
                                            </span>
                                            <span class="">3.16</span>
                                        </a>
                                    </div>
                                    <!-- <br /> -->
                                    <div class="pt-3">
                                        <a href="javascript:void(0)"
                                            class="font-bold text-md md:text-xl hover:text-indigo-700">
                                            expert, 4.56 Nullam neque leo, placerat eu ante vitae,
                                            vehicula.
                                        </a>
                                    </div>
                                </div>

                                <!-- technology and trending posts -->
                                <div class="col-span-1">
                                    <div class="p-8 bg-white">
                                        <a href="" class="font-bold text-lg hover:text-indigo-700">Stocks Climb as
                                            Yields Hold Dollar Falls: Markets Wrap</a>
                                        <div class="flex items-center justify-start gap-4 pt-4">
                                            <a href="javascript:void(0)"
                                                class="py-1 px-6 bg-indigo-600 hover:bg-yellow-600 text-white rounded-full text-sm">Technology</a>
                                            <span class="text-md"> january 21, 2018</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="p-8 bg-white">
                                        <a href="" class="font-bold text-lg hover:text-indigo-700">Nullam neque leo,
                                            placerat eu ante vitae, vehicula.</a>
                                        <div class="flex items-center justify-start gap-4 pt-4">
                                            <a href="javascript:void(0)"
                                                class="py-1 px-6 bg-indigo-600 hover:bg-yellow-600 text-white rounded-full text-sm">Trending</a>
                                            <span class="text-md"> january 21, 2018</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- todo: Fashion Section -->
                        <div class="travel-post">
                            <div class="top-heading flex items-center justify-between">
                                <h2 class="text-2xl font-bold heading uppercase">Fashion</h2>
                                <div class="hr-line"></div>
                                <a href="" class="group flex items-center justify-end">
                                    <span class="group-hover:text-indigo-700 font-bold">View More</span>
                                    <span
                                        class="mt-1 font-bold text-indigo-700 group-hover:transform group-hover:translate-x-[-4px]">
                                        <svg class="w-4 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>

                            <br /><br />

                            <!-- todo: BUSINESS Post -->
                            <div class="business-post">
                                <br />
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                                    <div class="business-post-item col-span-1 md:col-span-6 lg:col-span-6">
                                        <div
                                            class="group bg-white dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
                                            <div
                                                class="relative w-full md:h-48 lg:h-50 xl:h-56 2xl:h-96 overflow-hidden">
                                                <a href="#">
                                                    <img class="w-full md:h-48 lg:h-50 xl:h-56 2xl:h-96 group-hover:scale-110 transition-transform duration-300"
                                                        src="./assets/images/business-post/business-post-1.jpg"
                                                        alt="" />
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="absolute top-3 left-3 px-6 py-1 bg-indigo-600 hover:bg-yellow-500 text-white rounded-full text-md transition-all duration-300 ease-in-out">Fashion</a>
                                            </div>

                                            <div class="p-5">
                                                <a href="#">
                                                    <h5
                                                        class="mb-2 md:text-md lg:text-xl font-medium tracking-tight text-gray-900 hover:text-indigo-700 dark:text-white">
                                                        Nam convallis lacus volutpat risus luctus, et
                                                        consectetur massa pharetra.
                                                    </h5>
                                                </a>

                                                <div
                                                    class="flex items-center justify-start md:gap-1 lg:gap-2 md:text-xs lg:text-sm xl:text-md">
                                                    <span class="text-gray-600">Dec 22, 2018 at 19:35</span>
                                                    <span class="text-gray-600">|</span>
                                                    <a href=""
                                                        class="text-gray-600 font-normal hover:text-indigo-700">Mahfuz
                                                        Riad</a>
                                                </div>

                                                <br />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="business-post-item col-span-1 md:col-span-6 lg:col-span-6">
                                        <div
                                            class="group bg-white dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
                                            <div
                                                class="relative w-full md:h-48 lg:h-50 xl:h-56 2xl:h-96 overflow-hidden">
                                                <a href="#">
                                                    <img class="w-full md:h-48 lg:h-50 xl:h-56 2xl:h-96 group-hover:scale-110 transition-transform duration-300"
                                                        src="./assets/images/business-post/business-post-2.jpg"
                                                        alt="" />
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="absolute top-3 left-3 px-6 py-1 bg-indigo-600 hover:bg-yellow-500 text-white rounded-full text-md transition-all duration-300 ease-in-out">Trading</a>
                                            </div>

                                            <div class="p-5">
                                                <a href="#">
                                                    <h5
                                                        class="mb-2 md:text-md lg:text-xl font-medium tracking-tight text-gray-900 hover:text-indigo-700 dark:text-white">
                                                        Trine Kjer has been running her blog for
                                                        approximately ten years
                                                    </h5>
                                                </a>

                                                <div
                                                    class="flex items-center justify-start gap-2 md:text-xs lg:text-sm xl:text-md">
                                                    <span class="text-gray-600">Dec 22, 2018 at 19:35</span>
                                                    <span class="text-gray-600">|</span>
                                                    <a href=""
                                                        class="text-gray-600 font-normal hover:text-indigo-700">Mahfuz
                                                        Riad</a>
                                                </div>

                                                <br />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="business-post-item col-span-1 md:col-span-6 lg:col-span-6">
                                        <div
                                            class="group bg-white py-2 dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
                                            <div class="p-5">
                                                <a href="#">
                                                    <h5
                                                        class="mb-2 md:text-md lg:text-xl font-medium tracking-tight text-gray-900 hover:text-indigo-700 dark:text-white">
                                                        A Love Lorem ipsum dolor sit amet, consectetur
                                                        adipiscing
                                                    </h5>
                                                </a>

                                                <div
                                                    class="flex items-center justify-start gap-2 text-sm lg:text-md xl:text-md">
                                                    <span class="text-gray-600">Dec 22, 2018 at 19:35</span>
                                                    <span class="text-gray-600">|</span>
                                                    <a href=""
                                                        class="text-gray-600 font-normal hover:text-indigo-700">Mahfuz
                                                        Riad</a>
                                                </div>
                                            </div>
                                            <div class="px-5 pb-6">
                                                <a href="javascript:void(0)"
                                                    class="px-6 py-1 bg-indigo-600 hover:bg-yellow-500 text-white rounded-full text-md transition-all duration-300 ease-in-out">Trading</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="business-post-item col-span-1 md:col-span-6 lg:col-span-6">
                                        <div
                                            class="group bg-white py-2 dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
                                            <div class="p-5">
                                                <a href="#">
                                                    <h5
                                                        class="mb-2 md:text-md lg:text-xl font-medium tracking-tight text-gray-900 hover:text-indigo-700 dark:text-white">
                                                        Inside Sports Building a Magazine for the Digital
                                                        Eye Strain
                                                    </h5>
                                                </a>

                                                <div
                                                    class="flex items-center justify-start gap-2 text-sm lg:text-md xl:text-md">
                                                    <span class="text-gray-600">Dec 22, 2018 at 19:35</span>
                                                    <span class="text-gray-600">|</span>
                                                    <a href=""
                                                        class="text-gray-600 font-normal hover:text-indigo-700">Emran
                                                        Khan</a>
                                                </div>
                                            </div>
                                            <div class="px-5 pb-6">
                                                <a href="javascript:void(0)"
                                                    class="px-6 py-1 bg-indigo-600 hover:bg-yellow-500 text-white rounded-full text-md transition-all duration-300 ease-in-out">Tech</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- First magazine section -->
                        <!-- todo: First Magazine Section -->
                        <div class="magazine-section">
                            <div class="">
                                <div class="relative">
                                    <img src="./assets/images/font-load-3.jpg" alt="" class="w-full img-fluid" />
                                    <div
                                        class="absolute inset-0 flex flex-col items-start justify-center px-4 md:px-12">
                                        <a href=""
                                            class="px-8 py-1 bg-indigo-600 text-white rounded-full text-md hover:bg-yellow-600 transition-all duration-300 ease-in-out mb-6">Travel</a>
                                        <a href="" class="">
                                            <div
                                                class="p-8 text-md md:text-4xl font-bold text-white hover:text-indigo-700 bg-gradient-to-r from-yellow-600/60 to-indigo-600/60">
                                                Neque porro quisquam est qui dolorem
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--  **************************************************************************************************** -->
                    </div>
                    <div class="sidebar-post col-span-1 md:col-span-12 lg:col-span-4">
                        <!-- todo: Sidebar -->
                        <!-- Trending News -->
                        <div class="trending-news-section">
                            <h3 class="font-medium text-2xl border-b border-gray-300 pb-2">
                                Trending News
                            </h3>
                            <div class="">
                                <div class="group trending-news-item bg-white my-6">
                                    <a href="" class="m-0 p-0">
                                        <div class="overflow-hidden">
                                            <img src="./assets/images/trending-news/lnw-1.jpg" alt=""
                                                class="w-full h-42 md:h-48 lg:h-42 2xl:h-64 group-hover:transform group-hover:scale-110 transition-all duration-300 ease-in-out" />
                                        </div>
                                        <div class="p-6">
                                            <h3
                                                class="text-lg font-bold group-hover:text-indigo-800 hover:text-indigo-800">
                                                Envion – Digital Currency Mint in Exploits World’s
                                                Lowest Cost Power
                                            </h3>
                                        </div>
                                    </a>
                                </div>
                                <hr class="border-gray-300" />
                                <div class="group trending-news-item bg-white my-6">
                                    <a href="" class="m-0 p-0">
                                        <div class="overflow-hidden">
                                            <img src="./assets/images/trending-news/lnw-2.jpg" alt=""
                                                class="w-full h-42 md:h-48 lg:h-42 2xl:h-64 group-hover:transform group-hover:scale-110 transition-all duration-300 ease-in-out" />
                                        </div>
                                        <div class="p-6">
                                            <h3
                                                class="text-lg font-bold group-hover:text-indigo-800 hover:text-indigo-800">
                                                Bitcoin Cash Price Hits Record $2,500 to pierce $300
                                                billion for the first time
                                            </h3>
                                        </div>
                                    </a>
                                </div>
                                <hr class="border-gray-300" />
                                <div class="group trending-news-item bg-white my-6">
                                    <a href="" class="m-0 p-0">
                                        <div class="overflow-hidden">
                                            <img src="./assets/images/trending-news/lnw-3.jpg" alt=""
                                                class="w-full h-42 md:h-48 lg:h-42 2xl:h-64 group-hover:transform group-hover:scale-110 transition-all duration-300 ease-in-out" />
                                        </div>
                                        <div class="p-6">
                                            <h3
                                                class="text-lg font-bold group-hover:text-indigo-800 hover:text-indigo-800">
                                                HOLD the Kitten! New Year Gift for Every Crypto Cuttie
                                            </h3>
                                        </div>
                                    </a>
                                </div>

                                <a href="javascript:void(0)" class="group">
                                    <div
                                        class="p-4 bg-white text-center font-medium text-md group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 ease-in-out">
                                        Load More...
                                    </div>
                                </a>
                            </div>

                            <div class="my-12">
                                <div class="bg-white p-4">
                                    <div class="pb-3 mb-4 border-b border-gray-300">
                                        <a href="" class="font-bold text-xl hover:text-indigo-700">
                                            Nam ornare ultricies dui in finibus. Vivamus in neque vel
                                            ipsum accumsan pharetra.
                                        </a>
                                        <p class="py-2 text-yellow-500">10:29, Press Releases</p>
                                    </div>
                                    <div class="pb-3 mb-4 border-b border-gray-300">
                                        <a href="" class="font-bold text-xl hover:text-indigo-700">
                                            Phasellus mauris tellus, suscipit ac lectus vitae,
                                            faucibus vehicula diam.
                                        </a>
                                        <p class="py-2 text-yellow-500">12:29, Press Releases</p>
                                    </div>
                                    <div class="pb-3 mb-4 border-b border-gray-300">
                                        <a href="" class="font-bold text-xl hover:text-indigo-700">
                                            Buffett Warns Investors That Safe-Looking Bonds Can Be
                                            Risky.
                                        </a>
                                        <p class="py-2 text-yellow-500">02:37, Press Releases</p>
                                    </div>
                                    <div class="mb-3">
                                        <a href="" class="font-bold text-xl hover:text-indigo-700">
                                            Nam ornare ultricies dui in finibus. Vivamus in neque vel
                                            ipsum accumsan pharetra.
                                        </a>
                                        <p class="py-2 text-yellow-500">11:45, Press Releases</p>
                                    </div>
                                </div>
                            </div>

                            <!-- todo: Advertisment -->
                            <div class="my-12 advertisment">
                                <a href="" class="">
                                    <img src="./assets/images/advertisement/advertisement-1.jpg" alt=""
                                        class="w-full h-auto" />
                                </a>
                            </div>

                            <!-- todo: Video Blog -->
                            <div class="my-12">
                                <div class="watch-it-post-item col-span-1 md:col-span-1 overflow-hidden mb-6">
                                    <div class="group relative">
                                        <a href="" class="">
                                            <div class="overflow-hidden w-full h-56 md:h-52 lg:h-62 xl:72 2xl:h-92">
                                                <img src="./assets/images//watch-it/wathc-1.jpg" alt=""
                                                    class="w-full h-56 md:h-52 lg:h-62 xl:72 2xl:h-92 group-hover:transform group-hover:scale-110 transition-all duration-500 ease-in-out" />
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="absolute bottom-4 left-4 flex items-center justify-start gap-2 text-white group-hover:text-indigo-700 text-lg">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                                                </svg>
                                            </span>
                                            <span class="">3.16</span>
                                        </a>
                                    </div>
                                    <!-- <br /> -->
                                    <div class="pt-3">
                                        <a href="javascript:void(0)"
                                            class="font-bold text-md md:text-xl hover:text-indigo-700">
                                            Nullam neque leo, placerat eu ante vitae, vehicula rhoncus
                                            quam.
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- todo: Banner -->
                            <div class="my-12">
                                <div class="bg-white p-8">
                                    <a href="javascript:void(0)" class="">
                                        <img src="./assets/images/banner/advertisement-2.jpg" alt=""
                                            class="w-full h-auto" />
                                    </a>
                                </div>
                            </div>

                            <!-- todo: Social Media Links -->
                            <div class="social-media-links">
                                <div class="flex flex-wrap items-center justify-between gap-2">
                                    <a href="javascript:void(0)"
                                        class="facebook-icon w-12 h-12 text-white flex items-center justify-center">
                                        <i class="fa-brands fa-facebook-f text-lg"></i>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="twitter-icon w-12 h-12 text-white flex items-center justify-center">
                                        <i class="fa-brands fa-twitter text-lg"></i>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="pinterest-icon w-12 h-12 text-white flex items-center justify-center">
                                        <i class="fa-brands fa-pinterest text-lg"></i>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="linkedin-icon w-12 h-12 text-white flex items-center justify-center">
                                        <i class="fa-brands fa-linkedin text-lg"></i>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="google-plus-icon w-12 h-12 text-white flex items-center justify-center">
                                        <i class="fa-brands fa-google-plus-g text-lg"></i>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="instagram-icon w-12 h-12 text-white flex items-center justify-center">
                                        <i class="fa-brands fa-instagram text-lg"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="pt-6">
                                <div class="sidebar-tabs">
                                    <ul class="grid grid-cols-2 -mb-px text-sm font-medium text-center"
                                        id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content"
                                        data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
                                        data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                                        role="tablist">
                                        <li class="group col-span-1 bg-indigo-600 hover:bg-indigo-800 text-white cursor-pointer"
                                            role="presentation">
                                            <button
                                                class="inline-block p-2 text-lg rounded-t-lg cursor-pointer text-white group-hover:text-white group-active:text-white group-focus:text-white"
                                                id="profile-styled-tab" data-tabs-target="#styled-profile" type="button"
                                                role="tab" aria-controls="profile" aria-selected="false">
                                                Technology
                                            </button>
                                        </li>
                                        <li class="group col-span-1 bg-yellow-600 hover:bg-yellow-800 cursor-pointer text-white"
                                            role="presentation">
                                            <button
                                                class="inline-block p-2 text-lg rounded-t-lg text-white cursor-pointer group-hover:text-white group-active:text-white group-focus:text-white"
                                                id="dashboard-styled-tab" data-tabs-target="#styled-dashboard"
                                                type="button" role="tab" aria-controls="dashboard"
                                                aria-selected="false">
                                                Gaming
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div id="default-styled-tab-content">
                                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile"
                                        role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="sidebar-tabs-item py-2 mb-4 border-b border-gray-200">
                                            <a href=""
                                                class="font-bold py-2 text-lg text-gray-700 hover:text-indigo-700">
                                                How to secure peace of mind and income that beats banks
                                            </a>
                                            <div class="my-2 flex items-center justify-start gap-6">
                                                <span class="text-yellow-500">10:29, Press Releases</span>
                                                <span class="text-white bg-red-400 text-sm p-1">Technology</span>
                                            </div>
                                        </div>

                                        <div class="sidebar-tabs-item py-2 mb-4 border-b border-gray-200">
                                            <a href=""
                                                class="font-bold py-2 text-lg text-gray-700 hover:text-indigo-700">
                                                Token Launch Date Announced for Dether, World’s First
                                                Peer-To-Peer Ecosystem of Crypto Buyers, Sellers, and
                                                Shops
                                            </a>
                                            <div class="my-2 flex items-center justify-start gap-6">
                                                <span class="text-yellow-500">10:29, Press Releases</span>
                                                <span class="text-white bg-red-800 text-sm p-1">Hot</span>
                                            </div>
                                        </div>

                                        <div class="sidebar-tabs-item py-2 mb-4 border-b border-gray-200">
                                            <a href=""
                                                class="font-bold py-2 text-lg text-gray-700 hover:text-indigo-700">
                                                Buffett Warns Investors That Safe-Looking Bonds Can Be
                                                Risky
                                            </a>
                                            <div class="my-2 flex items-center justify-start gap-6">
                                                <span class="text-yellow-500">10:29, Press Releases</span>
                                                <span class="text-white bg-yellow-500 text-sm p-1">Gaming</span>
                                            </div>
                                        </div>

                                        <div class="sidebar-tabs-item py-2 mb-4">
                                            <a href=""
                                                class="font-bold py-2 text-lg text-gray-700 hover:text-indigo-700">
                                                Falls Below $16,400, Loses Nearly 15% in Major
                                                Correction
                                            </a>
                                            <div class="my-2 flex items-center justify-start gap-6">
                                                <span class="text-yellow-500">10:29, Press Releases</span>
                                                <span class="text-white bg-indigo-600 text-sm p-1">Fashion</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard"
                                        role="tabpanel" aria-labelledby="dashboard-tab">
                                        <div class="sidebar-tabs-item py-2 mb-4 border-b border-gray-200">
                                            <a href=""
                                                class="font-bold py-2 text-lg text-gray-700 hover:text-indigo-700">
                                                Buffett Warns Investors That Safe-Looking Bonds Can Be
                                                Risky
                                            </a>
                                            <div class="my-2 flex items-center justify-start gap-6">
                                                <span class="text-yellow-500">10:29, Press Releases</span>
                                                <span class="text-white bg-yellow-500 text-sm p-1">Gaming</span>
                                            </div>
                                        </div>

                                        <div class="sidebar-tabs-item py-2 mb-4 border-b border-gray-200">
                                            <a href=""
                                                class="font-bold py-2 text-lg text-gray-700 hover:text-indigo-700">
                                                Falls Below $16,400, Loses Nearly 15% in Major
                                                Correction
                                            </a>
                                            <div class="my-2 flex items-center justify-start gap-6">
                                                <span class="text-yellow-500">10:29, Press Releases</span>
                                                <span class="text-white bg-indigo-600 text-sm p-1">Fashion</span>
                                            </div>
                                        </div>

                                        <div class="sidebar-tabs-item py-2 mb-4 border-b border-gray-200">
                                            <a href=""
                                                class="font-bold py-2 text-lg text-gray-700 hover:text-indigo-700">
                                                How to secure peace of mind and income that beats banks
                                            </a>
                                            <div class="my-2 flex items-center justify-start gap-6">
                                                <span class="text-yellow-500">10:29, Press Releases</span>
                                                <span class="text-white bg-red-500 text-sm p-1">Technology</span>
                                            </div>
                                        </div>

                                        <div class="sidebar-tabs-item py-2 mb-4">
                                            <a href=""
                                                class="font-bold py-2 text-lg text-gray-700 hover:text-indigo-700">
                                                Token Launch Date Announced for Dether, World’s First
                                                Peer-To-Peer Ecosystem of Crypto Buyers, Sellers, and
                                                Shops
                                            </a>
                                            <div class="my-2 flex items-center justify-start gap-6">
                                                <span class="text-yellow-500">10:29, Press Releases</span>
                                                <span class="text-white bg-red-800 text-sm p-1">Hot</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            <i class="fa-brands fa-linkedin-in text-2xl text-orange-700/60 group-hover:text-white"></i>
                        </div>
                    </a>
                    <a href="javascript:void(0)" class="group">
                        <div
                            class="flex items-center justify-center w-12 h-12 bg-white rounded-full group-hover:bg-indigo-600 transition-all duration-300 ease-in-out">
                            <i class="fa-brands fa-instagram text-2xl text-orange-700/60 group-hover:text-white"></i>
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

    </Layout>

</template>
