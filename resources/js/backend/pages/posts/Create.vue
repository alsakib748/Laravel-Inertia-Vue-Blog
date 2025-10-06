<script setup>

import { ref } from 'vue';
import LayoutAuthenticated from '@/layouts/LayoutAuthenticated.vue';
import { useForm, Link } from '@inertiajs/vue3';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

const editor = ClassicEditor;

// Props passed from controller

const props = defineProps({
    categories: Array,
    tags: Array,
});

const form = useForm({
    title: '',
    slug: '',
    excerpt: '',
    content: '',
    category_id: '',
    tags: [],
    status: 'draft',
    published_at: '',
    thumbnail: null,
    image: null,
    is_featured: false,
    is_trending: false,
    is_slider: false,
})

// File uploads
const handleFile = (e, field) => {
    form[field] = e.target.files[0]
}

function submit() {
    form.post(route('posts.store'), {
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
                    <h3 class="text-2xl font-medium text-gray-800">Create Post</h3>
                    <Link :href="route('posts.index')"
                        class="px-4 py-2 text-lg rounded-md font-normal tracking-tight bg-indigo-700 hover:bg-indigo-500 text-white dark:text-white cursor-pointer">
                    Post List
                    </Link>

                </div>

                <div class="">

                    <form @submit.prevent="submit" enctype="multipart/form-data">
                        <div class="">
                            <!-- <div class="mb-6">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                                    name</label>
                                <input type="text" v-model="form.name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    :class="{ 'border-red-500': form.errors.name }" placeholder="Category Name" />
                                <p v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</p>
                            </div> -->

                            <!-- Title -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                                <input v-model="form.title" type="text"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Enter post title" />
                                <div v-if="form.errors.title" class="text-red-600 text-sm mt-1">{{ form.errors.title }}
                                </div>
                            </div>

                            <!-- Slug -->
                            <!-- <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug</label>
                                <input v-model="form.slug" type="text"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="auto-generated or edit" />
                                <div v-if="form.errors.slug" class="text-red-600 text-sm mt-1">{{ form.errors.slug }}
                                </div>
                            </div> -->

                            <!-- Excerpt -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Excerpt</label>
                                <textarea v-model="form.excerpt" rows="3"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Short summary"></textarea>
                                <div v-if="form.errors.excerpt" class="text-red-600 text-sm mt-1">{{ form.errors.excerpt
                                }}</div>
                            </div>

                            <!-- Content -->
                            <!-- <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content</label>
                                <textarea v-model="form.content" rows="6"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Full post content"></textarea>
                                <div v-if="form.errors.content" class="text-red-600 text-sm mt-1">{{ form.errors.content
                                }}</div>
                            </div> -->
                            <div class="mb-6">
                                <div class="">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 pb-1">Content</label>
                                    <ckeditor :editor="editor" v-model="form.content"
                                        :class="{ 'border-red-500': form.errors.content }"
                                        :config="{ placeholder: 'Write your blog content here...' }"></ckeditor>
                                </div>
                                <p v-if="form.errors.content" class="text-sm text-red-500">{{ form.errors.content }}
                                </p>
                            </div>

                            <!-- Category -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                                <select v-model="form.category_id"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">-- Select Category --</option>
                                    <option v-for="cat in props.categories" :key="cat.id" :value="cat.id">{{ cat.name }}
                                    </option>
                                </select>
                                <div v-if="form.errors.category_id" class="text-red-600 text-sm mt-1">{{
                                    form.errors.category_id }}</div>
                            </div>

                            <!-- Tags -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tags</label>
                                <select v-model="form.tags" multiple
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option v-for="tag in props.tags" :key="tag.id" :value="tag.id">{{ tag.name }}
                                    </option>
                                </select>
                                <div v-if="form.errors.tags" class="text-red-600 text-sm mt-1">{{ form.errors.tags }}
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                <select v-model="form.status"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="draft">Draft</option>
                                    <option value="pending">Pending</option>
                                    <option value="published">Published</option>
                                </select>
                            </div>

                            <!-- Published At -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Publish
                                    Date</label>
                                <input v-model="form.published_at" type="datetime-local"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                            </div>

                            <!-- Thumbnail -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Thumbnail</label>
                                <input type="file" @change="e => handleFile(e, 'thumbnail')"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            </div>

                            <!-- Image -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Main
                                    Image</label>
                                <input type="file" @change="e => handleFile(e, 'image')"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            </div>

                            <div class="mb-6 flex items-center justify-between w-full">

                                <div class="flex items-center me-4">
                                    <input id="purple-checkbox" type="checkbox" value="1" v-model="form.is_featured"
                                        class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="purple-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Is
                                        Featured</label>
                                </div>
                                <div class="flex items-center me-4">
                                    <input id="teal-checkbox" type="checkbox" value="1" v-model="form.is_trending"
                                        class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="teal-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Is
                                        Trending</label>
                                </div>

                                <div class="flex items-center me-4">
                                    <input id="orange-checkbox" type="checkbox" value="1" v-model="form.is_slider"
                                        class=" w-4 h-4 text-orange-500 bg-gray-100 border-gray-300 rounded-sm
                                        focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-800
                                        focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="orange-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Is
                                        Slider</label>
                                </div>

                            </div>

                            <!-- <div class="mb-6">

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


                            </div> -->

                        </div>

                        <button type="submit" :disabled="form.processing"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-6">Save
                            Post</button>
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
