<script setup>

import { reactive, ref, watch } from 'vue';
import { router, useForm } from '@inertiajs/vue3';

import LayoutAuthenticated from '@/layouts/LayoutAuthenticated.vue';

import { mdiBallotOutline, mdiAccount, mdiImage, mdiArrowLeft } from '@mdi/js'
import SectionMain from '@/components/SectionMain.vue'
import CardBox from '@/components/CardBox.vue'
import FormField from '@/components/FormField.vue'
import FormControl from '@/components/FormControl.vue'
import FormFilePicker from '@/components/FormFilePicker.vue'
import BaseButton from '@/components/BaseButton.vue'
import BaseButtons from '@/components/BaseButtons.vue'
import SectionTitleLineWithButton from '@/components/SectionTitleLineWithButton.vue'
import TiptapEditor from '@/components/TiptapEditor.vue'

// Form data using Inertia's useForm
const form = useForm({
    name: '',
    description: '',
    image: null,
    status: 'active'
});

// Watch form changes for debugging
watch(() => form.data(), (newData) => {
    console.log('Form data changed:', newData);
}, { deep: true });

// Submit form
const submit = (event) => {
    console.log('Submit function called!', event);
    console.log('Form data:', form.data());
    console.log('Form processing:', form.processing);

    // Prevent default form submission
    if (event) {
        event.preventDefault();
    }

    form.post('/categories', {
        onSuccess: (page) => {
            console.log('Success:', page);
            // Redirect to categories index on success
            router.visit('/categories');
        },
        onError: (error) => {
            console.log('Error:', error);
        },
        onFinish: () => {
            console.log('Request finished');
        }
    });
};

// Go back to categories list
const goBack = () => {
    router.visit('/categories');
};

</script>

<template>
    <LayoutAuthenticated>
        <SectionMain>
            <SectionTitleLineWithButton :icon="mdiBallotOutline" title="Create Category" main>
                <BaseButton :icon="mdiArrowLeft" label="Back to Categories" color="contrast" rounded-full small
                    @click="goBack" />
            </SectionTitleLineWithButton>

            <!-- Test Button -->
            <div class="mb-4">
                <button @click="submit" class="px-4 py-2 bg-red-500 text-white rounded">Test Submit</button>
            </div>

            <CardBox>
                <form @submit.prevent="submit">
                    <!-- Category Name -->
                    <FormField label="Category Name" :error="form.errors.name" help="Enter the category name">
                        <FormControl v-model="form.name" :icon="mdiAccount" placeholder="Enter category name"
                            :error="!!form.errors.name" />
                    </FormField>

                    <!-- Category Description -->
                    <FormField label="Description" :error="form.errors.description"
                        help="Enter a detailed description of the category using the rich text editor">
                        <TiptapEditor v-model="form.description" :error="!!form.errors.description"
                            placeholder="Enter category description..." />
                    </FormField>

                    <!-- Category Image -->
                    <FormField label="Category Image" :error="form.errors.image"
                        help="Upload an image for the category (optional)">
                        <FormFilePicker v-model="form.image" :icon="mdiImage" accept="image/*" />
                    </FormField>

                    <!-- Status -->
                    <FormField label="Status" :error="form.errors.status" help="Set the category status">
                        <FormControl v-model="form.status" :options="[
                        { value: 'active', label: 'Active' },
                        { value: 'inactive', label: 'Inactive' }
                    ]" />
                    </FormField>

                    <!-- Form Actions -->
                    <template #footer>
                        <BaseButtons>
                            <BaseButton type="submit" color="info" label="Create Category" :disabled="form.processing"
                                :loading="form.processing" />
                            <BaseButton type="button" color="info" outline label="Reset" @click="() => {
                            form.reset();
                        }" />
                            <BaseButton type="button" color="contrast" outline label="Cancel" @click="goBack" />
                        </BaseButtons>
                    </template>
                </form>
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>
</template>
