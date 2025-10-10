<script setup>

import "./assets/css/style.css";


import hero1 from "./assets/images/hero-slider/banner-slider.jpg"
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { Head, Link } from "@inertiajs/vue3";

import { ref, defineProps } from "vue";

import Layout from "./Layout.vue";

const props = defineProps({
    post: {
        type: Array,
        default: () => []
    },
    categories: {
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

</script>

<template>

    <Head title="Blog Details" />
    <Layout>

        <!-- <pre>
            {{ props.categories }}
        </pre> -->

        <main>
            <section class="news-section">
                <div class="w-full px-4 md:px-14 lg:px-22">
                    <div class="news grid grid-cols-1 grid-cols-12 gap-4">
                        <div class="col-span-2 md:col-span-2">
                            <div class="flex items-center justify-around px-2 md:px-6">
                                <span class="text-white text-md md:text-xl pe-3 md:pe-0">Blog Details</span>
                                <div class="w-0.5 bg-gray-300 h-12"></div>
                            </div>
                        </div>
                        <div class="col-span-10 md:col-span-10 flex flex-col items-end justify-center">
                            <div class="flex flex-row items-center justify-end gap-4">
                                <a href="javascript:void(0)" class="text-medium text-indigo-600">Home</a>
                                <span class="text-white">/</span>
                                <Link :href="route('frontend.blog')" class="me-3 text-medium text-indigo-600">Blog
                                </Link>
                                <span class="text-white">/</span>
                                <span class="me-3 text-medium text-gray-700">Blog Details</span>
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
                        <!-- todo: Blog Details Page -->
                        <div class="bg-white px-4 py-6">
                            <div class="flex flex-wrap items-center justify-start gap-3 md:gap-5">
                                <div class="">{{ formatPublishedAt(post?.published_at, post?.updated_at) }}</div>
                                <a href="javascript:void(0)"
                                    class="bg-indigo-500 text-white px-3 md:px-4 py-2 rounded-full transition-all duration-300 ease-in-out">
                                    Post By: {{ post?.author?.name }}
                                </a>
                                <a href="javascript:void(0)"
                                    class="bg-indigo-500 text-white px-3 md:px-4 py-2 rounded-full transition-all duration-300 ease-in-out">
                                    {{ post?.category?.name }}
                                </a>
                            </div>

                            <h3 class="py-6 font-bold text-4xl">
                                {{ post?.title }}
                            </h3>

                            <div class="">
                                <img :src="post?.image" alt="" class="w-full h-56 md:h-80 lg:h-96" />
                            </div>

                            <!-- <p class="py-3 text-md">

                            </p> -->

                            <br />

                            <div v-html="post?.content"></div>

                            <br />

                            <!-- <h4 class="font-bold text-xl text-indigo-600 py-2">
                                New mindset and thriving ecosystem drive future applications
                            </h4>

                            <p class="py-3">
                                Integration As both examples illustrate, a data integration
                                strategy is key to deeply understanding your user base,
                                Integration Is Critical A data integration plan, working
                                alongside a tool, such as social login, can have enormous
                                benefits. Talent team focus Huawei is cultivating an ecosystem
                                that brings together global and local, or "glocal" business
                                partners to boost industry Free Business Tips If you have an
                                uneasy feeling that you may be paying too much for your Business
                                Insurance, check it out here. There’s a very good chance that
                                you could save hundreds of pounds in just a few minutes.Business
                                Insurance calc Until one Thursday afternoon the importance of
                                Business Insurance had always passed me by. By the end of the
                                day I had found out that I was throwing away big bucks that I
                                could ill afford to lose. Are you doing the same?
                            </p> -->

                            <div class="flex items-center justify-between">
                                <div class="flex flex-wrap items-center justify-start gap-5">
                                    <span class="">Share:</span>
                                    <a href="javascript:void(0)" class="group"><i
                                            class="fa-brands fa-facebook-f text-gray-500 group-hover:text-indigo-600 text-md"></i></a>
                                    <a href="javascript:void(0)" class="group"><i
                                            class="fa-brands fa-google-plus-g text-gray-500 group-hover:text-indigo-600 text-md"></i></a>
                                    <a href="javascript:void(0)" class="group"><i
                                            class="fa-brands fa-linkedin-in text-gray-500 group-hover:text-indigo-600 text-md"></i></a>
                                    <a href="javascript:void(0)" class="group"><i
                                            class="fa-brands fa-twitter text-gray-500 group-hover:text-indigo-600 text-md"></i></a>
                                </div>
                                <div class="">
                                    <a href="javascript:void(0)" class="text-indigo-600 font-bold hover:scale-120">
                                        <span class=""><i class="fa-solid fa-arrow-left"></i></span>
                                        <span class="font-bold">Back To Blog</span>
                                    </a>
                                </div>
                            </div>

                            <div class="py-12">
                                <!-- todo: Featured Blog Section -->
                                <section class="">
                                    <div class="featured-blog grid grid-cols-1 md:grid-cols-12 gap-4 w-full">
                                        <div class="col-span-1 md:col-span-6 mb-4 md:mb-0">
                                            <div
                                                class="group featured-blog-item relative all-transition duration-500 ease-in-out">
                                                <div class="featured-blog-img h-38 px-12" style="
                            background-image: url('./assets/images/blog-details/sub-post-1.jpg');
                            background-repeat: no-repeat;
                            background-position: center;
                            background-size: cover;
                          ">
                                                    <div class="group-hover:featured-blog-item-overlay"></div>
                                                </div>
                                                <div
                                                    class="content absolute inset-0 p-4 flex flex-col items-start justify-center text-white">
                                                    <a href="javascript:void(0)"
                                                        class="font-bold text-2xl py-2 hover:text-yellow-500 hidden group-hover:block">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing
                                                        elit,
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-1 md:col-span-6">
                                            <div
                                                class="group featured-blog-item relative all-transition duration-500 ease-in-out">
                                                <div class="featured-blog-img h-38 px-12" style="
                            background-image: url('./assets/images/blog-details/sub-post-2.jpg');
                            background-repeat: no-repeat;
                            background-position: center;
                            background-size: cover;
                          ">
                                                    <div class="featured-blog-item-overlay"></div>
                                                </div>
                                                <div
                                                    class="content absolute inset-0 p-4 flex flex-col items-start justify-center text-white">
                                                    <a href="javascript:void(0)"
                                                        class="font-bold text-2xl py-2 hover:text-yellow-500 hidden group-hover:block">
                                                        Ut enim ad minim veniam, quis nostrud exercitation
                                                        ullamco laboris nisi
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <!-- todo: Comment Section -->
                            <div class="">
                                <div class="font-medium text-xl pe-3 flex items-center justify-start gap-3">
                                    <span class="">Author</span>
                                    <span class="w-16 h-1 bg-yellow-500 mt-2"></span>
                                </div>

                                <br /><br />

                                <!-- todo: Author Details -->
                                <div class="grid grid-cols-12 pb-6 border-b border-gray-300">
                                    <div class="col-span-2">
                                        <img src="./assets/images/author/author-1.jpg" class="w-26 h-26" alt="" />
                                        <p class="pt-3 pb-1 font-medium">Al Sakib Ayon</p>
                                    </div>
                                    <div class="col-span-10 ms-3">
                                        <h3 class="text-lg text-indigo-600 font-bold">
                                            22 feb,2025
                                        </h3>
                                        <p class="pt-5 pb-3">
                                            This incident opened my eyes to the value of Insurance in
                                            general, so I decided to examine my personal and business
                                            insurance.
                                        </p>
                                    </div>
                                </div>

                                <br /><br />

                                <!-- todo: Comment -->
                                <div class="font-medium text-xl pe-3 flex items-center justify-start gap-3 pb-8">
                                    <span class="">Comment(3)</span>
                                </div>

                                <!-- todo: All Comments -->
                                <div class="all-comments">
                                    <div class="main-comment-item grid grid-cols-12 pb-6">
                                        <div class="col-span-2">
                                            <img src="./assets/images/comment/author-2.jpg"
                                                class="w-26 h-26 rounded-full" alt="" />
                                            <p class="pt-3 pb-1 font-medium">Asfia Asfia</p>
                                        </div>
                                        <div class="col-span-10 ms-3 border-b border-gray-300">
                                            <p class="py-2">
                                                The payments are made directly from one person to
                                                another without passing through a central bank or
                                                clearing house.
                                            </p>
                                            <div class="flex items-center justify-starg gap-12">
                                                <h3 class="text-lg text-gray-400 font-medium">
                                                    22 feb,2025
                                                </h3>
                                                <a href="javascript:void(0)"
                                                    class="text-lg text-gray-400 font-medium hover:bg-indigo-600 py-1 px-4 hover:text-white">Reply</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="comment-feedback-item grid grid-cols-12 pt-3 pb-6 ms-18">
                                        <div class="col-span-2">
                                            <img src="./assets/images/comment/author-3.jpg"
                                                class="w-26 h-26 rounded-full" alt="" />
                                            <p class="pt-3 pb-1 font-medium">Asfia Asfia</p>
                                        </div>
                                        <div class="col-span-10 ms-3 border-b border-gray-300">
                                            <p class="py-2">
                                                The payments are made directly from one person to
                                                another without passing through a central bank or
                                                clearing house.
                                            </p>
                                            <div class="flex items-center justify-starg gap-12">
                                                <h3 class="text-lg text-gray-400 font-medium">
                                                    22 feb,2025
                                                </h3>
                                                <a href="javascript:void(0)"
                                                    class="text-lg text-gray-400 font-medium hover:bg-indigo-600 py-1 px-4 hover:text-white">Reply</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="main-comment-item grid grid-cols-12 pt-3 pb-6">
                                        <div class="col-span-2">
                                            <img src="./assets/images/comment/author-4.jpg"
                                                class="w-26 h-26 rounded-full" alt="" />
                                            <p class="pt-3 pb-1 font-medium">Youma Luv</p>
                                        </div>
                                        <div class="col-span-10 ms-3">
                                            <p class="py-2">
                                                Youma Luv By eliminating the middle man, BuyBitcoin.ph
                                                offers a cheaper and faster alternative to banks or
                                                money transfer companies.
                                            </p>
                                            <div class="flex items-center justify-starg gap-12">
                                                <h3 class="text-lg text-gray-400 font-medium">
                                                    22 feb,2025
                                                </h3>
                                                <a href="javascript:void(0)"
                                                    class="text-lg text-gray-400 font-medium hover:bg-indigo-600 py-1 px-4 hover:text-white">Reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- todo: Leave a Reply -->
                                <div class="leave-a-reply">
                                    <form action="">
                                        <div class="">
                                            <div class="mb-8">
                                                <textarea id="message" rows="8"
                                                    class="block p-2.5 w-full text-sm text-gray-900 border-gray-300"
                                                    placeholder="Your Comment"></textarea>
                                            </div>
                                            <div class="mb-8">
                                                <input type="text" id="first_name"
                                                    class="text-gray-900 text-sm block w-full p-2.5 border-gray-300"
                                                    placeholder="Name" required />
                                            </div>
                                            <div class="mb-8">
                                                <input type="email" id="first_name"
                                                    class="text-gray-900 text-sm block w-full p-2.5 border-gray-300"
                                                    placeholder="Email" required />
                                            </div>
                                            <div class="mb-6">
                                                <button type="submit"
                                                    class="group cursor-pointer px-12 py-3 border-none outline-none bg-gradient-to-r from-yellow-600 to-indigo-600 text-white hover:bg-indigo-800">
                                                    <span class="text-lg">Submit Reply</span>
                                                    <span class="ms-2 mt-2"><i
                                                            class="fa-solid fa-arrow-right text-lg group-hover:translate-x-2 transition-all duration-300 ease-in-out"></i></span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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

                                <div v-for="category in props.categories" class="mb-6">
                                    <a href="javascript:void(0)" class="">
                                        <div
                                            class="w-full bg-gradient-to-r from-indigo-600 to-yellow-600 flex items-center justify-between py-3">
                                            <span class="px-5 text-xl text-white">{{ category?.name }}</span>
                                            <span class="px-5 text-xl text-white">{{ category?.posts_count }}</span>
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
                                <div v-for="trendingPost in props.trendingPosts" :key="trendingPost.id"
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
                                    <br />
                                    <hr class="border-gray-300" />
                                </div>


                                <!-- <a href="javascript:void(0)" class="group">
                                    <div
                                        class="p-4 bg-white text-center font-medium text-md group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 ease-in-out">
                                        Load More...
                                    </div>
                                </a> -->
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
                                                {{ firstPriorityCategory?.name }}
                                            </button>
                                        </li>
                                        <li class="group col-span-1 bg-yellow-600 hover:bg-yellow-800 cursor-pointer text-white"
                                            role="presentation">
                                            <button
                                                class="inline-block p-2 text-lg rounded-t-lg text-white cursor-pointer group-hover:text-white group-active:text-white group-focus:text-white"
                                                id="dashboard-styled-tab" data-tabs-target="#styled-dashboard"
                                                type="button" role="tab" aria-controls="dashboard"
                                                aria-selected="false">
                                                {{ secondPriorityCategory?.name }}
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div id="default-styled-tab-content">
                                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile"
                                        role="tabpanel" aria-labelledby="profile-tab">

                                        <div v-for="firstPriorityCategoryPost in props.firstPriorityCategoryPosts"
                                            class="sidebar-tabs-item py-2 mb-4 border-b border-gray-200">
                                            <a :href="route('frontend.blog.details', firstPriorityCategoryPost?.slug)"
                                                class="font-bold py-2 text-lg text-gray-700 hover:text-indigo-700">
                                                {{ firstPriorityCategoryPost?.title }}
                                            </a>
                                            <div class="my-2 flex items-center justify-start gap-6">
                                                <span class="text-yellow-500">{{
                                                    formatPublishedAt(firstPriorityCategoryPost?.published_at,
                                                        firstPriorityCategoryPost?.updated_at) }}</span>
                                                <span class="text-white bg-red-400 text-sm p-1">{{
                                                    firstPriorityCategoryPost?.category?.name }}</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard"
                                        role="tabpanel" aria-labelledby="dashboard-tab">
                                        <div v-for="secondPriorityCategoryPost in props.secondPriorityCategoryPosts"
                                            class="sidebar-tabs-item py-2 mb-4">
                                            <Link
                                                :href="route('frontend.blog.details', secondPriorityCategoryPost?.slug)"
                                                class="font-bold py-2 text-lg text-gray-700 hover:text-indigo-700">
                                            {{ secondPriorityCategoryPost?.title }}
                                            </Link>
                                            <div class="my-2 flex items-center justify-start gap-6">
                                                <span class="text-yellow-500">
                                                    {{
                                                        formatPublishedAt(secondPriorityCategoryPost?.published_at,
                                                            secondPriorityCategoryPost?.updated_at) }}
                                                </span>
                                                <span class="text-white bg-red-800 text-sm p-1">{{
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

        <!-- todo: Topic Section -->

        <section class="topic-section py-16 bg-white px-4 md:px-14 lg:px-22">
            <div class="topic">
                <h3 class="text-4xl text-indigo-600 font-medium text-center pt-3 pb-8">
                    Topics
                </h3>
                <div class="grid grid-cols-3 gap-4">
                    <a v-for="category in props.categories" href="javascript:void(0)"
                        class="bg-gray-200/60 rounded-full py-3 px-3 text-center hover:bg-gradient-to-r hover:from-yellow-600 hover:to-indigo-600 hover:text-white transition-all duration-300 ease-in-out mb-3">
                        <div class="text-medium text-xl">{{ category?.name }}</div>
                    </a>
                    <!-- <a href="javascript:void(0)"
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
                    </a> -->
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
