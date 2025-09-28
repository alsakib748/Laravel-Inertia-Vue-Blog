import {
    mdiAccountCircle,
    mdiMonitor,
    mdiFolder,
    mdiGithub,
    mdiLock,
    mdiAlertCircle,
    mdiSquareEditOutline,
    mdiTable,
    mdiViewList,
    mdiTelevisionGuide,
    mdiResponsive,
    mdiPalette,
    mdiReact,
    mdiTag,
    mdiFolderMultiple,
    mdiPost,
} from "@mdi/js";

export default [
    {
        to: "dashboard",
        icon: mdiMonitor,
        label: "Dashboard",
    },
    {
        href: "/categories",
        icon: mdiFolderMultiple,
        label: "Category",
    },
    {
        href: "/tags",
        icon: mdiTag,
        label: "Tag",
    },
    {
        href: "/posts",
        icon: mdiPost,
        label: "Post",
    },
    {
        href: "/tables",
        label: "Tables",
        icon: mdiTable,
    },
    {
        href: "/forms",
        label: "Forms",
        icon: mdiSquareEditOutline,
    },
    {
        href: "/ui",
        label: "UI",
        icon: mdiTelevisionGuide,
    },
    {
        href: "/responsive",
        label: "Responsive",
        icon: mdiResponsive,
    },
    {
        href: "/",
        label: "Styles",
        icon: mdiPalette,
    },
    {
        href: "/profile",
        label: "Profile",
        icon: mdiAccountCircle,
    },
    {
        href: "/login",
        label: "Login",
        icon: mdiLock,
    },
    {
        href: "/error",
        label: "Error",
        icon: mdiAlertCircle,
    },
    {
        label: "Dropdown",
        icon: mdiViewList,
        menu: [
            {
                label: "Item One",
            },
            {
                label: "Item Two",
            },
        ],
    },
    {
        href: "https://github.com/justboil/admin-one-vue-tailwind",
        label: "GitHub",
        icon: mdiGithub,
        target: "_blank",
    },
    {
        href: "https://github.com/justboil/admin-one-react-tailwind",
        label: "React version",
        icon: mdiReact,
        target: "_blank",
    },
];
