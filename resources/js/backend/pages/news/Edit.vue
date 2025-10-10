<script setup>

import { ref } from 'vue';
import LayoutAuthenticated from '@/layouts/LayoutAuthenticated.vue';
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    news: Object
});

const form = useForm({
    id: props.news?.id ?? null,
    headline: props.news?.headline ?? null,
})

function submit() {
    form
        .transform((data) => ({ ...data, _method: 'put' }))
        .post(route('news.update', props.news), {
            forceFormData: true,
        })
}

</script>

<template>
    <LayoutAuthenticated>


        <section class="p-6">

            <div
                class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between mt-3 mb-5">
                    <h3 class="text-2xl font-medium text-gray-800">Edit News</h3>
                    <Link :href="route('news.index')"
                        class="px-4 py-2 text-lg rounded-md font-normal tracking-tight bg-indigo-700 hover:bg-indigo-500 text-white dark:text-white cursor-pointer">
                    News List
                    </Link>

                </div>

                <div class="">

                    <form @submit.prevent="submit">
                        <div class="">
                            <!-- <div class="mb-6">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">News Headline
                                </label>
                                <input type="text" v-model="form.name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    :class="{ 'border-red-500': form.errors.name }" placeholder="Tag Name" />
                                <p v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</p>
                            </div> -->

                            <div class="mb-6">
                                <label for="message"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">News
                                    Headline</label>
                                <textarea id="message" rows="4" v-model="form.headline"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Write the news headline"></textarea>


                                <p v-if="form.errors.headline" class="text-sm text-red-500">{{ form.errors.headline }}
                                </p>
                            </div>

                        </div>

                        <button type="submit" :disabled="form.processing"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-6">Submit</button>
                    </form>

                </div>

            </div>

        </section>


    </LayoutAuthenticated>
</template>
