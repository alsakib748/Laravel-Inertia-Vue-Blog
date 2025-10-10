<script setup>

import { ref } from 'vue';
import LayoutAuthenticated from '@/layouts/LayoutAuthenticated.vue';
import { useForm, Link } from '@inertiajs/vue3';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

const editor = ClassicEditor;

const props = defineProps({
    about: Object,
    categories: Array,
});

const form = useForm({
    title: props.about.title || '',
    content: props.about.content || '',
    image: props.about.image || null
})

const handleFile = (e, field) => {
    form[field] = e.target.files[0]
}

function submit() {
    form
        .transform((data) => ({ ...data, _method: 'put' }))
        .post(route('about.update', props.about), {
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
                    <h3 class="text-2xl font-medium text-gray-800">Edit About</h3>
                </div>

                <div class="">

                    <form @submit.prevent="submit">
                        <div class="">
                            <!-- Title -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                                <input v-model="form.title" type="text"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                                <div v-if="form.errors.title" class="text-red-600 text-sm mt-1">{{ form.errors.title }}
                                </div>
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

                            <!-- Image -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Main
                                    Image</label>
                                <input type="file" @change="e => handleFile(e, 'image')"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                <!-- Current Image Preview -->
                                <div v-if="props.about.image" class="mt-3">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Current Main Image:</p>
                                    <img :src="props.about.image" alt="Current main image"
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
