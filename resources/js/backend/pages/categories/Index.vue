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

const props = defineProps(['categories']);

// Debug: Log the categories prop to see what's being passed
// console.log('Categories prop:', props.categories);

const categoriesList = computed(() => {
    return props.categories?.data || props.categories || [];
});

// Add pagination data if needed
const currentPage = computed(() => props.categories?.current_page || 1);
const pagesList = computed(() => {
    if (!props.categories?.last_page) return [];
    return Array.from({ length: props.categories.last_page }, (_, i) => i);
});
const currentPageHuman = computed(() => currentPage.value);
const numPages = computed(() => props.categories?.last_page || 1);

// Add checkable functionality if needed
const checkable = false;

const checked = (event, category) => {
    // Handle checkbox logic here
    console.log('Checked:', event, category);
};

const form = useForm({});

function destroyCategory(id) {
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
            form.delete(route('categories.destroy', id));
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
                <Link :href="categories.create || '/categories/create'"
                    class="px-4 py-2 rounded bg-indigo-700 text-white cursor-pointer">Add
                Category</Link>
            </div>

            <CardBox class="mb-6" has-table>

                <table>
                    <thead>
                        <tr>
                            <th v-if="checkable" />
                            <th />
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Category Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(category, index) in categoriesList" :key="category?.id || index">
                            <TableCheckboxCell v-if="checkable" @checked="checked($event, category)" />
                            <td class="border-b-0 lg:w-6 before:hidden">
                                <UserAvatar :username="category.name" class="w-24 h-24 mx-auto lg:w-6 lg:h-6" />
                            </td>
                            <td data-label="SL">
                                {{ index + 1 }}
                            </td>
                            <td data-label="Name">
                                {{ category?.name || 'N/A' }}
                            </td>
                            <td data-label="Image">
                                <img v-if="category?.image" :src="(category.image)" alt="category?.name || 'Category'"
                                    class="w-10 h-10 rounded">
                                <div v-else class="w-10 h-10 bg-gray-200 rounded flex items-center justify-center">
                                    <span class="text-gray-400 text-xs">No Image</span>
                                </div>
                            </td>
                            <td data-label="Action" class="lg:w-1 whitespace-nowrap">
                                <BaseButtons type="justify-start lg:justify-end" no-wrap>
                                    <BaseButton :href="route('categories.edit', category.id)" color="info"
                                        :icon="mdiEye" small @click="isModalActive = true" />
                                    <BaseButton @click="destroyCategory(category.id)" color="danger" :icon="mdiTrashCan"
                                        small />
                                </BaseButtons>
                            </td>
                            <!-- <td data-label="City">
                                {{ category.city }}
                            </td>
                            <td data-label="Progress" class="lg:w-32">
                                <progress class="flex w-2/5 self-center lg:w-full" max="100" :value="category.progress">
                                    {{ category.progress }}
                                </progress>
                            </td>
                            <td data-label="Created" class="lg:w-1 whitespace-nowrap">
                                <small class="text-gray-500 dark:text-slate-400" :title="category.created">{{
                                    category.created
                                }}</small>
                            </td>
                            <td class="before:hidden lg:w-1 whitespace-nowrap">
                                <BaseButtons type="justify-start lg:justify-end" no-wrap>
                                    <BaseButton color="info" :icon="mdiEye" small @click="isModalActive = true" />
                                    <BaseButton color="danger" :icon="mdiTrashCan" small
                                        @click="isModalDangerActive = true" />
                                </BaseButtons>
                            </td> -->
                        </tr>
                    </tbody>
                </table>
                <!-- <div class="p-3 lg:px-6 border-t border-gray-100 dark:border-slate-800">
                    <BaseLevel>
                        <BaseButtons>
                            <BaseButton v-for="page in pagesList" :key="page" :active="page === currentPage"
                                :label="page + 1" :color="page === currentPage ? 'lightDark' : 'whiteDark'" small
                                @click="currentPage = page" />
                        </BaseButtons>
                        <small>Page {{ currentPageHuman }} of {{ numPages }}</small>
                    </BaseLevel>
                </div> -->

            </CardBox>

        </SectionMain>

    </LayoutAuthenticated>

</template>
