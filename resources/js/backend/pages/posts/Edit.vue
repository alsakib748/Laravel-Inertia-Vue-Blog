<script setup>

import { ref } from 'vue';
import LayoutAuthenticated from '@/layouts/LayoutAuthenticated.vue';
import { useForm, Link } from '@inertiajs/vue3';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

const editor = ClassicEditor;

const props = defineProps({
    post: Object,
    categories: Array,
    tags: Array,
});

function toLocalDateTimeInput(value) {
    if (!value) return '';
    const date = new Date(value);
    if (isNaN(date.getTime())) return '';
    const tzOffsetMinutes = date.getTimezoneOffset();
    const local = new Date(date.getTime() - tzOffsetMinutes * 60000);
    return local.toISOString().slice(0, 16);
}

const form = useForm({
    title: props.post.title || '',
    slug: props.post.slug || '',
    excerpt: props.post.excerpt || '',
    content: props.post.content || '',
    category_id: props.post.category_id || '',
    tags: props.post.tags?.map(t => t.id) || [],
    status: props.post.status || 'draft',
    published_at: toLocalDateTimeInput(props.post.published_at) || '',
    thumbnail: null,
    image: null,
})

const handleFile = (e, field) => {
    form[field] = e.target.files[0]
}

function submit() {
    form
        .transform((data) => ({ ...data, _method: 'put' }))
        .post(route('posts.update', props.post), {
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
                    <h3 class="text-2xl font-medium text-gray-800">Edit Post</h3>
                    <Link :href="route('posts.index')"
                        class="px-4 py-2 text-lg rounded-md font-normal tracking-tight bg-indigo-700 hover:bg-indigo-500 text-white dark:text-white cursor-pointer">
                    Post List
                    </Link>

                </div>

                <div class="">

                    <form @submit.prevent="submit">
                        <div class="">
                            <!-- <div class="mb-6">
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

                            </div> -->

                            <!-- Title -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                                <input v-model="form.title" type="text"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                                <div v-if="form.errors.title" class="text-red-600 text-sm mt-1">{{ form.errors.title }}
                                </div>
                            </div>

                            <!-- Excerpt -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Excerpt</label>
                                <textarea v-model="form.excerpt" rows="3"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                                <div v-if="form.errors.excerpt" class="text-red-600 text-sm mt-1">{{ form.errors.excerpt
                                }}</div>
                            </div>

                            <div class="mb-6">
                                <div class="">
                                    <ckeditor :editor="editor" v-model="form.content"
                                        :config="{ placeholder: 'Write your blog content here...' }"
                                        :class="{ 'border-red-500': form.errors.content }"></ckeditor>
                                </div>
                                <p v-if="form.errors.content" class="text-sm text-red-500">{{
                                    form.errors.content }}</p>
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
                                <input v-model="form.published_at" type="datetime-local" step="1"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                            </div>

                            <!-- Thumbnail -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Thumbnail</label>
                                <input type="file" @change="e => handleFile(e, 'thumbnail')"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                <!-- Current Thumbnail Preview -->
                                <div v-if="props.post.thumbnail" class="mt-3">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Current Thumbnail:</p>
                                    <img :src="props.post.thumbnail" alt="Current thumbnail"
                                        class="w-32 h-20 object-cover rounded-lg border border-gray-300 dark:border-gray-600" />
                                </div>
                            </div>

                            <!-- Image -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Main
                                    Image</label>
                                <input type="file" @change="e => handleFile(e, 'image')"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                <!-- Current Image Preview -->
                                <div v-if="props.post.image" class="mt-3">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Current Main Image:</p>
                                    <img :src="props.post.image" alt="Current main image"
                                        class="w-48 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600" />
                                </div>
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
<style scoped>
:deep(.ck-editor__editable_inline) {
    min-height: 300px;
}
</style>
