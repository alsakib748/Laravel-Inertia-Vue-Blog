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

const props = defineProps(['news']);

// console.log(props);

// Debug: Log the categories prop to see what's being passed
// console.log('Categories prop:', props.categories);

// const categoriesList = computed(() => {
//     return props.tags?.data || props.tags || [];
// });

// Add pagination data if needed
const currentPage = computed(() => props.tags?.current_page || 1);
const pagesList = computed(() => {
    if (!props.tags?.last_page) return [];
    return Array.from({ length: props.tags.last_page }, (_, i) => i);
});
const currentPageHuman = computed(() => currentPage.value);
const numPages = computed(() => props.tags?.last_page || 1);

// Add checkable functionality if needed
const checkable = false;

const checked = (event, category) => {
    // Handle checkbox logic here
    console.log('Checked:', event, category);
};

const form = useForm({});

function destroyTag(id) {
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
            form.delete(route('news.destroy', id));
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
                <Link :href="route('news.create')" class="px-4 py-2 rounded bg-indigo-700 text-white cursor-pointer">Add
                News</Link>
            </div>

            <CardBox class="mb-6" has-table>

                <table>
                    <thead>
                        <tr>
                            <th v-if="checkable" />
                            <th />
                            <th>SL</th>
                            <th>News Headline</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="props.news.data && props.news.data.length > 0"
                            v-for="(newsItem, index) in props.news.data" :key="newsItem?.id || index">
                            <TableCheckboxCell v-if="checkable" @checked="checked($event, newsItem)" />
                            <td class="border-b-0 lg:w-6 before:hidden">
                                <UserAvatar :username="newsItem?.headline" class="w-24 h-24 mx-auto lg:w-6 lg:h-6" />
                            </td>
                            <td data-label="SL">
                                {{ index + 1 }}
                            </td>
                            <td data-label="Headline">
                                {{ newsItem?.headline || 'N/A' }}
                            </td>
                            <td data-label="Action" class="lg:w-1 whitespace-nowrap">
                                <BaseButtons type="justify-start lg:justify-end" no-wrap>
                                    <BaseButton :href="route('news.edit', newsItem?.id)" color="info" :icon="mdiEye"
                                        small @click="isModalActive = true" />
                                    <BaseButton @click="destroyTag(newsItem?.id)" color="danger" :icon="mdiTrashCan"
                                        small />
                                </BaseButtons>
                            </td>
                        </tr>
                        <tr v-else>
                            <td colspan="5" class="text-center py-4 text-yellow-500">
                                No News Found.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </CardBox>

        </SectionMain>

    </LayoutAuthenticated>

</template>
