import "../css/main.css";
import "./frontend/assets/css/style.css";
import "./bootstrap.js";
import "flowbite";
import { initFlowbite } from "flowbite";

import { createPinia } from "pinia";
// import { useDarkModeStore } from '@/stores/darkMode.js'
import { createApp, h } from "vue";
import { createInertiaApp, router } from "@inertiajs/vue3";
import NProgress from "nprogress";
import "nprogress/nprogress.css";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/index.esm.js";
import { CkeditorPlugin } from "@ckeditor/ckeditor5-vue";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";

dayjs.extend(relativeTime);

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

const pinia = createPinia();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const pages = {
            ...import.meta.glob("./backend/**/*.vue"),
            ...import.meta.glob("./frontend/**/*.vue"),
            ...import.meta.glob("./Pages/**/*.vue"),
        };

        const tryResolve = (candidate) =>
            pages[candidate] ? pages[candidate]() : null;

        // 1) Try exact match (handles names like 'frontend/About' or 'Pages/Login')
        const exact = tryResolve(`./${name}.vue`);
        if (exact) return exact;

        // 2) Normalize the name to avoid double prefixes like 'Pages/Pages/Login'
        const bareName = name
            .replace(/^\.\//, "")
            .replace(/^(backend|frontend|Pages)\//, "")
            .replace(/\.vue$/, "");

        // 3) Try common locations
        const candidates = [
            `./backend/${bareName}.vue`,
            `./frontend/${bareName}.vue`,
            `./Pages/${bareName}.vue`,
            `./${bareName}.vue`,
        ];

        for (const path of candidates) {
            const resolved = tryResolve(path);
            if (resolved) return resolved;
        }

        // 4) Fallback to default resolver to surface a meaningful error
        return resolvePageComponent(
            `./Pages/${bareName}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        );
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            .use(ZiggyVue, Ziggy)
            .use(CkeditorPlugin)
            .use(Toast, {
                position: "top-right",
                timeout: 3000,
                closeOnClick: true,
            });

        // Mount the app and initialize Flowbite
        app.mount(el);

        // Initialize Flowbite components after the app is mounted
        setTimeout(() => {
            initFlowbite();
        }, 100);

        return app;
    },
    progress: {
        color: "#4B5563",
    },
});

// NProgress for Inertia navigations
router.on("start", () => NProgress.start());
router.on("finish", () => {
    NProgress.done();
    // Re-initialize Flowbite components after each navigation
    setTimeout(() => {
        initFlowbite();
    }, 100);
});

// const darkModeStore = useDarkModeStore(pinia)

// if (
//   (!localStorage['darkMode'] && window.matchMedia('(prefers-color-scheme: dark)').matches) ||
//   localStorage['darkMode'] === '1'
// ) {
//   darkModeStore.set(true)
// }
