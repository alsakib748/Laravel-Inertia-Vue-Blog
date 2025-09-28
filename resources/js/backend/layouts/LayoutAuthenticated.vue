<script setup>
import { mdiForwardburger, mdiBackburger, mdiMenu } from '@mdi/js'
import { ref, watch, onMounted } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
// import { useRouter } from 'vue-router'
import menuAside from '@/menuAside.js'
import menuNavBar from '@/menuNavBar.js'
import { useDarkModeStore } from '@/stores/darkMode.js'
import BaseIcon from '@/components/BaseIcon.vue'
import FormControl from '@/components/FormControl.vue'
import NavBar from '@/components/NavBar.vue'
import NavBarItemPlain from '@/components/NavBarItemPlain.vue'
import AsideMenu from '@/components/AsideMenu.vue'
import FooterBar from '@/components/FooterBar.vue'
import { useToast } from 'vue-toastification'

const page = usePage()
const toast = useToast()

onMounted(() => {
    const flash = page.props.flash || {}
    if (flash.success) toast.success(flash.success)
    if (flash.error) toast.error(flash.error)
});

// Also react to flash changes on subsequent Inertia navigations
watch(() => page.props.flash?.success, (msg) => { if (msg) toast.success(msg) })
watch(() => page.props.flash?.error, (msg) => { if (msg) toast.error(msg) })

const layoutAsidePadding = 'lg:pl-60'

const darkModeStore = useDarkModeStore()

// const router = useRouter()

const isAsideMobileExpanded = ref(false)
const isAsideLgActive = ref(true)

// router.beforeEach(() => {
//     isAsideMobileExpanded.value = false
//     isAsideLgActive.value = false
// })

router.on('navigate', () => {
    isAsideMobileExpanded.value = false
    // Don't reset isAsideLgActive on navigation to keep sidebar open
})

const menuClick = (event, item) => {
    if (item.isToggleLightDark) {
        darkModeStore.set()
    }

    if (item.isLogout) {
        //
        router.post(route('logout'))
    }
}
</script>

<template>
    <div :class="{
        'overflow-hidden lg:overflow-visible': isAsideMobileExpanded,
    }">
        <div :class="[layoutAsidePadding, { 'ml-60 lg:ml-0': isAsideMobileExpanded }]"
            class="pt-14 min-h-screen w-screen transition-position lg:w-auto bg-gray-50 dark:bg-slate-800 dark:text-slate-100">
            <NavBar :menu="menuNavBar" :class="[layoutAsidePadding, { 'ml-60 lg:ml-0': isAsideMobileExpanded }]"
                @menu-click="menuClick">
                <NavBarItemPlain display="flex lg:hidden"
                    @click.prevent="isAsideMobileExpanded = !isAsideMobileExpanded">
                    <BaseIcon :path="isAsideMobileExpanded ? mdiBackburger : mdiForwardburger" size="24" />
                </NavBarItemPlain>
                <NavBarItemPlain display="hidden lg:flex xl:hidden" @click.prevent="isAsideLgActive = true">
                    <BaseIcon :path="mdiMenu" size="24" />
                </NavBarItemPlain>
                <NavBarItemPlain use-margin>
                    <FormControl placeholder="Search (ctrl+k)" ctrl-k-focus transparent borderless />
                </NavBarItemPlain>
            </NavBar>
            <AsideMenu :is-aside-mobile-expanded="isAsideMobileExpanded" :is-aside-lg-active="isAsideLgActive"
                :menu="menuAside" @menu-click="menuClick" @aside-lg-close-click="isAsideLgActive = false" />
            <slot />
            <FooterBar>

            </FooterBar>
        </div>
    </div>
</template>
