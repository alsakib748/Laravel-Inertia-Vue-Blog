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
        extend: {},
    },
    plugins: [
        require("@tailwindcss/typography"),
        require("flowbite/plugin"), // Add this line
    ],
};
