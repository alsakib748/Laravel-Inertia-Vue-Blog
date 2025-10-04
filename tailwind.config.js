/* eslint-env node */

const plugin = require("tailwindcss/plugin");

export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./resources/js/**/*.js",
        "./node_modules/flowbite/**/*.js", // Add this for Flowbite components
    ],
    darkMode: "class", // or 'media' or 'class'
    theme: {
        extend: {
            height: {
                86: "21.5rem",
                90: "22.5rem",
                102: "25.5rem",
                120: "30rem",
                128: "32rem",
            },
            spacing: {
                86: "21.5rem",
                90: "22.5rem",
                102: "25.5rem",
                120: "30rem",
                128: "32rem",
            },
        },
    },
    plugins: [
        require("@tailwindcss/typography"),
        require("flowbite/plugin"), // Add this line
        plugin(function ({ addUtilities }) {
            addUtilities({
                ".line-clamp-2": {
                    display: "-webkit-box",
                    "-webkit-line-clamp": "2",
                    "-webkit-box-orient": "vertical",
                    overflow: "hidden",
                },
                ".line-clamp-3": {
                    display: "-webkit-box",
                    "-webkit-line-clamp": "3",
                    "-webkit-box-orient": "vertical",
                    overflow: "hidden",
                },
            });
        }),
    ],
};
