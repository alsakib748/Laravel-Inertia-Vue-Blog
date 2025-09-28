<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import { mdiMinus, mdiPlus } from '@mdi/js'
import { getButtonColor } from '@/colors.js'
import BaseIcon from '@/components/BaseIcon.vue'
import AsideMenuList from '@/components/AsideMenuList.vue'

const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
    isDropdownList: Boolean,
})

const emit = defineEmits(['menu-click'])

const hasColor = computed(() => props.item && props.item.color)

const asideMenuItemActiveStyle = computed(() =>
    hasColor.value ? '' : 'aside-menu-item-active font-bold',
)

const isDropdownActive = ref(false)

const componentClass = computed(() => [
    props.isDropdownList ? 'py-3 px-6 text-sm' : 'py-3',
    hasColor.value
        ? getButtonColor(props.item.color, false, true)
        : `aside-menu-item dark:text-slate-300 dark:hover:text-white`,
])

const hasDropdown = computed(() => !!props.item.menu)

const menuClick = (event) => {
    emit('menu-click', event, props.item)

    if (hasDropdown.value) {
        isDropdownActive.value = !isDropdownActive.value
    }
}

// Add itemHref - use 'to' instead of 'route'
const itemHref = computed(() => (props.item.to ? props.item.to : props.item.href))

// Use Inertia Link for internal links (to avoid full reload)
const isInternalHref = computed(() => {
    return !!props.item.href && props.item.href.startsWith('/') && !props.item.target
})

// Add activeInactiveStyle - use 'to' instead of 'route'
const activeInactiveStyle = computed(() =>
    props.item.to && route().current(props.item.to)
        ? asideMenuItemActiveStyle.value
        : ''
)
</script>

<template>
    <li>
        <component :is="item.to || isInternalHref ? Link : 'a'" :href="itemHref" :target="item.target ?? null"
            class="flex cursor-pointer" :class="componentClass" @click="menuClick">
            <BaseIcon v-if="item.icon" :path="item.icon" class="flex-none" :class="activeInactiveStyle" w="w-16"
                :size="18" />
            <span class="grow text-ellipsis line-clamp-1" :class="[{ 'pr-12': !hasDropdown }, activeInactiveStyle]">
                {{ item.label }}
            </span>
            <BaseIcon v-if="hasDropdown" :path="isDropdownActive ? mdiMinus : mdiPlus" class="flex-none"
                :class="activeInactiveStyle" w="w-12" />
        </component>
        <AsideMenuList v-if="hasDropdown" :menu="item.menu"
            :class="['aside-menu-dropdown', isDropdownActive ? 'block dark:bg-slate-800/50' : 'hidden']"
            is-dropdown-list />
    </li>
</template>
