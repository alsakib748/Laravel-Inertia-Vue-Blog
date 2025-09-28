<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { useMainStore } from '@/stores/main'
import UserAvatar from '@/components/UserAvatar.vue'

const mainStore = useMainStore()

const userName = computed(() => usePage().props.auth?.user?.name || 'User')


</script>

<template>
    <UserAvatar :username="userName" api="initials" :avatar="mainStore.userAvatar">
        <slot />
    </UserAvatar>
</template>
