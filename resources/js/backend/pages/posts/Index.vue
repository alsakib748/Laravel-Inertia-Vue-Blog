<script setup>

import { computed } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import { mdiMonitorCellphone, mdiTableBorder, mdiTableOff, mdiGithub } from '@mdi/js'
import SectionMain from '@/components/SectionMain.vue'
import NotificationBar from '@/components/NotificationBar.vue'
import TableSampleClients from '@/components/TableSampleClients.vue'
import CardBox from '@/components/CardBox.vue'
import LayoutAuthenticated from '@/layouts/LayoutAuthenticated.vue'
import SectionTitleLineWithButton from '@/components/SectionTitleLineWithButton.vue'
import BaseButtons from '@/components/BaseButtons.vue'
import BaseButton from '@/components/BaseButton.vue'
import CardBoxComponentEmpty from '@/components/CardBoxComponentEmpty.vue'
import TableCheckboxCell from '@/components/TableCheckboxCell.vue'
import { mdiEye, mdiTrashCan } from '@mdi/js'
import CardBoxModal from '@/components/CardBoxModal.vue'
import UserAvatar from '@/components/UserAvatar.vue'
import { useMainStore } from '@/stores/main'

const props = defineProps({ posts: Object });

// Add pagination data if needed
const currentPage = computed(() => props.posts?.current_page || 1);
const pagesList = computed(() => {
    if (!props.posts?.last_page) return [];
    return Array.from({ length: props.posts.last_page }, (_, i) => i);
});
const currentPageHuman = computed(() => currentPage.value);
const numPages = computed(() => props.posts?.last_page || 1);

// Add checkable functionality if needed
const checkable = false;

const checked = (event, category) => {
    // Handle checkbox logic here
    console.log('Checked:', event, category);
};

const form = useForm({});

function destroyPost(id) {
    // SweetAlert2 confirmation
    // eslint-disable-next-line no-undef
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this item.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('posts.destroy', id));
        }
    });
}

</script>

<template>

    <LayoutAuthenticated>

        <SectionMain>

            <div class="flex items-center justify-end my-3 cursor-pointer">
                <!-- <BaseButtons type="justify-start lg:justify-end" no-wrap>
                    <BaseButton color="info" :icon="mdiEye" :label="AddCategory" :href="categories.create" small
                        @click="isModalActive = true" />
                </BaseButtons> -->
                <Link :href="route('posts.create')" class="px-4 py-2 rounded bg-indigo-700 text-white cursor-pointer">
                Add Post
                </Link>
            </div>

            <CardBox class="mb-6" has-table>

                <table>
                    <thead>
                        <tr>
                            <th v-if="checkable" />
                            <th />
                            <th class="p-2">SL</th>
                            <th class="p-2">Title</th>
                            <th class="p-2">Image</th>
                            <th class="p-2">Category</th>
                            <th class="p-2">Author</th>
                            <th class="p-2">Status</th>
                            <th class="p-2">Views</th>
                            <th class="p-2">Featured</th>
                            <th class="p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(post, index) in posts.data" :key="post?.id || index">
                            <TableCheckboxCell v-if="checkable" @checked="checked($event, post)" />
                            <td class="border-b-0 lg:w-6 before:hidden">
                                <UserAvatar :username="post?.title" class="w-24 h-24 mx-auto lg:w-6 lg:h-6" />
                            </td>
                            <td data-label="SL">
                                {{ index + 1 }}
                            </td>
                            <td class="p-2">{{ post?.title }}</td>
                            <td class="p-2">
                                <img :src="post?.thumbnail" alt="" class="w-20 h-16">
                            </td>
                            <td class="p-2">{{ post?.category?.name }}</td>
                            <td class="p-2">{{ post?.author?.name }}</td>
                            <td class="p-2"> <span
                                    class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-md dark:bg-blue-900 dark:text-blue-300"
                                    :class="{ 'bg-green-100 text-green-800': post?.status === 'published', 'bg-red-100 text-red-800': post?.status === 'draft', 'bg-yellow-100 text-yellow-800': post?.status === 'pending', 'bg-gray-100 text-gray-800': post?.status === 'archived', 'bg-purple-100 text-purple-800': post?.status === 'deleted' }">{{
                                        post?.status }}</span>
                            </td>
                            <td class="p-2">{{ post?.views }}</td>
                            <td class="p-2">
                                <span
                                    class="bg-purple-100 text-purple-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-md dark:bg-blue-900 dark:text-blue-300"
                                    :class="{ 'bg-purple-100 text-purple-800': post?.is_featured == 1, 'bg-indigo-100 text-indigo-800': post?.is_featured != 1 }">
                                    {{ post?.is_featured ? 'Yes' : 'No' }} </span>
                            </td>
                            <!-- <td class="p-2">
                                <Link :href="`/posts/${post.id}/edit`" class="text-blue-500">Edit</Link>
                                <Link as="button" method="delete" :href="`/posts/${post.id}`" class="text-red-500 ml-2">
                                Delete</Link>
                            </td> -->
                            <td data-label="Action" class="lg:w-1 whitespace-nowrap">
                                <BaseButtons type="justify-start lg:justify-end" no-wrap>
                                    <BaseButton :href="route('posts.edit', post)" color="info" :icon="mdiEye" small
                                        @click="isModalActive = true" />
                                    <BaseButton @click="destroyPost(post)" color="danger" :icon="mdiTrashCan" small />
                                </BaseButtons>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </CardBox>

        </SectionMain>

    </LayoutAuthenticated>

</template>
