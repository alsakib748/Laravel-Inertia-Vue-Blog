<script setup>

import { ref } from 'vue';
import LayoutAuthenticated from '@/layouts/LayoutAuthenticated.vue';
import { useForm, Link } from '@inertiajs/vue3';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

const editor = ClassicEditor;

const props = defineProps({
    category: Object
});

const form = useForm({
    priority: props.category?.priority ?? null,
    id: props.category?.id ?? null,
    name: props.category?.name ?? '',
    image: null,
    description: props.category?.description ?? ''
})

function submit() {
    form
        .transform((data) => ({ ...data, _method: 'put' }))
        .post(route('categories.update', props.category), {
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
                    <h3 class="text-2xl font-medium text-gray-800">Edit Category</h3>
                    <Link :href="route('categories.index')"
                        class="px-4 py-2 text-lg rounded-md font-normal tracking-tight bg-indigo-700 hover:bg-indigo-500 text-white dark:text-white cursor-pointer">
                    Category List
                    </Link>

                </div>

                <div class="">

                    <form @submit.prevent="submit">
                        <div class="">

                            <div class="mb-6">
                                <label for="priority"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                                    priority</label>
                                <input type="text" v-model="form.priority" id="priority"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    :class="{ 'border-red-500': form.errors.priority }"
                                    placeholder="Category Priority" />
                                <p v-if="form.errors.priority" class="text-sm text-red-500">{{ form.errors.priority }}
                                </p>
                            </div>

                            <div class="mb-6">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                                    name</label>
                                <input type="text" v-model="form.name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    :class="{ 'border-red-500': form.errors.name }" placeholder="Category Name" />
                                <p v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</p>
                            </div>

                            <div class="mb-6">

                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                                    Image</label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="dropzone-file"
                                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                                        :class="{ 'border-red-500': form.errors.image }">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                    class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF
                                                (MAX. 800x400px)</p>
                                        </div>
                                        <input id="dropzone-file" type="file" class="hidden"
                                            @change="form.image = $event.target.files[0]" />
                                    </label>
                                </div>
                                <p v-if="form.errors.image" class="text-sm text-red-500">{{ form.errors.image }}</p>

                            </div>

                            <div class="">
                                <ckeditor :editor="editor" v-model="form.description"
                                    :config="{ placeholder: 'Write your blog content here...' }"
                                    :class="{ 'border-red-500': form.errors.description }"></ckeditor>
                            </div>
                            <p v-if="form.errors.description" class="text-sm text-red-500">{{
                                form.errors.description }}</p>

                        </div>

                        <button type="submit" :disabled="form.processing"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-6">Submit</button>
                    </form>

                </div>

            </div>

        </section>


    </LayoutAuthenticated>
</template>
<style scoped>
:deep(.ck-editor__editable_inline) {
    min-height: 300px;
}
</style>
