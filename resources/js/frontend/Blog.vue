<script setup>

import "./assets/css/style.css";
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

import hero1 from "./assets/images/hero-slider/banner-slider.jpg"

import { Head, Link } from "@inertiajs/vue3";

import { ref, defineProps, computed } from "vue";

import Layout from "./Layout.vue";
// import { route } from "vendor/tightenco/ziggy/src/js";
// import route from 'ziggy-js';

const props = defineProps({
    categories: {
        type: Array,
        default: () => []
    },
    posts: {
        type: Array,
        default: () => []
    },
    trendingPosts: {
        type: Array,
        default: () => []
    },
    firstPriorityCategory: {
        type: Array,
        default: () => []
    },
    firstPriorityCategoryPosts: {
        type: Array,
        default: () => []
    },
    secondPriorityCategory: {
        type: Array,
        default: () => []
    },
    secondPriorityCategoryPosts: {
        type: Array,
        default: () => []
    },
});

function formatPublishedAt(published, updated) {
    if (!published) return ''
    const formattedDate = dayjs(published).format('MMMM D, YYYY')
    const updatedText = updated ? `, ${dayjs(updated).fromNow()}` : ''
    return formattedDate + updatedText
}

const getCategoryName = (categoryId) => {
    const category = props.categories.find(cat => cat.id === categoryId);
    return category?.name;
}

const selectedCategoryId = ref(
    props.categories.find(c => c.priority === 1)?.id ?? props.categories[0]?.id ?? null
);

const filteredPosts = computed(() =>
    props.posts.filter(p => p.category_id === selectedCategoryId.value)
);

</script>

<template>

    <Head title="Blog" />
    <Layout>

        <!-- <pre>
            {{ props.firstPriorityCategory.name }}
        </pre> -->

        <main>
            <section class="news-section">
                <div class="w-full px-4 md:px-14 lg:px-22">
                    <div class="news grid grid-cols-1 grid-cols-12 gap-4">
                        <div class="col-span-2 md:col-span-2">
                            <div class="flex items-center justify-around px-2 md:px-6">
                                <span class="text-white text-md md:text-xl pe-3 md:pe-0">Blog List</span>
                                <div class="w-0.5 bg-gray-300 h-12"></div>
                            </div>
                        </div>
                        <div class="col-span-10 md:col-span-10 flex flex-col items-end justify-center">
                            <div class="flex flex-row items-center justify-end gap-4">
                                <a href="javascript:void(0)" class="text-medium text-indigo-600">Home</a>
                                <span class="text-white">/</span>
                                <Link :href="route('frontend.blog')" class="me-3 text-medium text-indigo-600">Blog
                                </Link>
                            </div>
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
                        <!-- todo: Travel Post -->
                        <div class="travel-post">
                            <br />
                            <br />

                            <div class="top-heading flex items-center justify-between">
                                <h2 class="text-2xl font-bold heading">{{ getCategoryName(selectedCategoryId) }} POST
                                </h2>
                                <div class="hr-line"></div>
                                <div href="" class="group">
                                    <select id="blog-post-select" v-model.number="selectedCategoryId"
                                        class="post_select text-gray-900 text-md block w-full px-6 py-2 border-none bg-white">
                                        <option v-for="category in props.categories" :key="category.id"
                                            :class="{ selected: category.priority === 1 }" :value="category?.id"
                                            class="option">
                                            {{ category?.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <br /><br />

                            <!-- Dynamic posts based on selected category -->
                            <!-- <div class="travel-post group item flex flex-col md:flex-row items-start bg-white mb-6">
                                <a href="#"
                                    class="bg-white hover:bg-white dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <div
                                        class="relative overflow-hidden w-full h-56 md:w-52 md:h-56 lg:w-52 lg:h-56 xl:w-80 xl:h-60">
                                        <img class="w-full h-56 md:w-52 md:h-56 lg:w-52 lg:h-56 xl:w-80 xl:h-60 group-hover:transform group-hover:scale-110 transition-all duration-300 ease-in-out"
                                            src="'./assets/images/travel-post/travel-post-1.jpg'" alt="post title" />
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
                                            class="mb-2 text-2xl font-medium tracking-tight text-gray-900 group-hover:text-indigo-700 dark:text-white">{{
                                                'Lorem ipsum dolor sit amet, consectetur adipiscing elit'
                                            }}</a>
                                        <div
                                            class="flex items-center justify-start gap-2 text-sm md:text-md lg:text-md xl:text-lg">
                                            <span class="">Dec 10, 2018 at 19:35
                                            </span>
                                            <span class="">|</span>
                                            <span class="">Emran Khan</span>
                                        </div>
                                        <p class="pt-2 mb-3 text-md font-normal text-gray-700 dark:text-gray-400">At
                                            vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum.</p>
                                    </div>
                                </a>
                            </div> -->

                            <div v-for="post in filteredPosts" :key="post.id"
                                class="travel-post group item flex flex-col md:flex-row items-start bg-white mb-6">

                                <!-- {{ post }} -->

                                <Link :href="route('frontend.blog.details', post.slug)"
                                    class="bg-white hover:bg-white dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 w-full flex flex-col md:flex-row items-start">
                                <div
                                    class="relative overflow-hidden w-full h-56 md:w-52 md:h-56 lg:w-52 lg:h-56 xl:w-80 xl:h-60">
                                    <img class="w-full h-56 md:w-52 md:h-56 lg:w-52 lg:h-56 xl:w-80 xl:h-60 group-hover:transform group-hover:scale-110 transition-all duration-300 ease-in-out"
                                        :src="post?.thumbnail" alt="" />
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
                                    <Link :href="route('frontend.blog.details', post?.slug)"
                                        class="mb-2 text-2xl font-medium tracking-tight text-gray-900 group-hover:text-indigo-700 dark:text-white">
                                    {{ post?.title }}
                                    </Link>
                                    <div
                                        class="flex items-center justify-start gap-2 text-sm md:text-md lg:text-md xl:text-lg">
                                        <span class="">Dec 10, 2018 at 19:35</span>
                                        <span class="">|</span>
                                        <span class="">{{ post?.author?.name }}</span>
                                    </div>
                                    <p class="pt-2 mb-3 text-md font-normal text-gray-700 dark:text-gray-400">
                                        {{ post?.excerpt }}
                                    </p>
                                </div>
                                </Link>
                            </div>

                            <!-- Show message when no posts found -->
                            <div class="text-center py-8" v-if="filteredPosts.length === 0">
                                <p class="text-gray-500 text-lg">No posts found for this category.</p>
                            </div>

                            <br /><br /><br />

                        </div>

                        <!--  **************************************************************************************************** -->
                    </div>
                    <div class="sidebar-post col-span-1 md:col-span-12 lg:col-span-4">
                        <!-- todo: Sidebar -->
                        <br />
                        <div class="bg-white group">
                            <form action="">
                                <div class="grid grid-cols-10 w-full">
                                    <div class="col-span-8">
                                        <input type="text" name="search"
                                            class="border-none outline-none w-full shadow-none sidebar-search py-3"
                                            placeholder="Search" id="" />
                                    </div>
                                    <div
                                        class="sidebar-search-icon col-span-2 hover:bg-indigo-700 flex items-center justify-center py-3 transition-all duration-300 ease-in-out cursor-pointer text-gray-700">
                                        <button type="submit" class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="size-6 text-gray-700 hover:text-white transition-all duration-300 ease-in-out">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br />

                        <!-- todo: Post Categories -->

                        <div class="py-8">
                            <h3 class="font-medium text-2xl pb-6">Post Categories</h3>
                            <div class="">
                                <div v-for="category in props.categories" :key="category.id" class="mb-6">
                                    <a href="javascript:void(0)" class="">
                                        <div
                                            class="w-full bg-gradient-to-r from-indigo-600 to-yellow-600 flex items-center justify-between py-3">
                                            <span class="px-5 text-xl text-white">{{ category?.name }}</span>
                                            <span class="px-5 text-xl text-white">
                                                {{ category.posts_count }}
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Trending News -->
                        <div class="trending-news-section">
                            <h3 class="font-medium text-2xl border-b border-gray-300 pb-2">
                                Trending News
                            </h3>
                            <div class="">
                                <div v-for="trendingPost in trendingPosts"
                                    class="group trending-news-item bg-white my-6">
                                    <Link :href="route('frontend.blog.details', trendingPost?.slug)" class="m-0 p-0">
                                    <div class="overflow-hidden">
                                        <img :src="trendingPost?.thumbnail" alt=""
                                            class="w-full h-42 md:h-48 lg:h-42 2xl:h-64 group-hover:transform group-hover:scale-110 transition-all duration-300 ease-in-out" />
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-lg font-bold group-hover:text-indigo-800 hover:text-indigo-800">
                                            {{ trendingPost?.title }}
                                        </h3>
                                    </div>
                                    </Link>
                                    <hr class="border-indigo-500" />
                                </div>
                            </div>

                            <!-- <div class="my-12">
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
                            </div> -->

                            <!-- todo: Advertisment -->
                            <!-- <div class="my-12 advertisment">
                                <a href="" class="">
                                    <img src="./assets/images/advertisement/advertisement-1.jpg" alt=""
                                        class="w-full h-auto" />
                                </a>
                            </div> -->

                            <!-- todo: Video Blog -->
                            <!-- <div class="my-12">
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
                                    <div class="pt-3">
                                        <a href="javascript:void(0)"
                                            class="font-bold text-md md:text-xl hover:text-indigo-700">
                                            Nullam neque leo, placerat eu ante vitae, vehicula rhoncus
                                            quam.
                                        </a>
                                    </div>
                                </div>
                            </div> -->

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
                                                {{ props.firstPriorityCategory.name }}
                                            </button>
                                        </li>
                                        <li class="group col-span-1 bg-yellow-600 hover:bg-yellow-800 cursor-pointer text-white"
                                            role="presentation">
                                            <button
                                                class="inline-block p-2 text-lg rounded-t-lg text-white cursor-pointer group-hover:text-white group-active:text-white group-focus:text-white"
                                                id="dashboard-styled-tab" data-tabs-target="#styled-dashboard"
                                                type="button" role="tab" aria-controls="dashboard"
                                                aria-selected="false">
                                                {{ props.secondPriorityCategory.name }}
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div id="default-styled-tab-content">
                                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile"
                                        role="tabpanel" aria-labelledby="profile-tab">
                                        <div v-for="firstPriorityCategoryPost in props.firstPriorityCategoryPosts"
                                            :key="firstPriorityCategoryPost.id"
                                            class="sidebar-tabs-item py-2 mb-4 border-b border-gray-200">
                                            <Link
                                                :href="route('frontend.blog.details', firstPriorityCategoryPost?.slug)"
                                                class="font-bold py-2 text-lg text-gray-700 hover:text-indigo-700">
                                            {{ firstPriorityCategoryPost?.title }}
                                            </Link>
                                            <div class="my-2 flex items-center justify-start gap-6">
                                                <span class="text-yellow-500">{{
                                                    formatPublishedAt(firstPriorityCategoryPost.published_at,
                                                        firstPriorityCategoryPost.updated_at)
                                                }}</span>
                                                <span class="text-white bg-red-400 text-sm p-1">{{
                                                    firstPriorityCategoryPost?.category?.name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard"
                                        role="tabpanel" aria-labelledby="dashboard-tab">
                                        <div v-for="secondPriorityCategoryPost in secondPriorityCategoryPosts"
                                            :key="secondPriorityCategoryPost.id"
                                            class="sidebar-tabs-item py-2 mb-4 border-b border-gray-200">
                                            <Link
                                                :href="route('frontend.blog.details', secondPriorityCategoryPost?.slug)"
                                                class="font-bold py-2 text-lg text-gray-700 hover:text-indigo-700">
                                            {{ secondPriorityCategoryPost?.title }}
                                            </Link>
                                            <div class="my-2 flex items-center justify-start gap-6">
                                                <span class="text-yellow-500">{{
                                                    formatPublishedAt(secondPriorityCategoryPost.published_at,
                                                        secondPriorityCategoryPost.updated_at)
                                                }}</span>
                                                <span class="text-white bg-yellow-500 text-sm p-1">{{
                                                    secondPriorityCategoryPost?.category?.name }}</span>
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
