import {defineConfig} from "vite";
import laravel, {refreshPaths} from "laravel-vite-plugin";
import {viteStaticCopy} from 'vite-plugin-static-copy'

export default defineConfig({
    server: {
        hmr: {
            host: 'localhost'
        },
    },
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",// Assets admin
                "resources/views/admin/assets/scss/reset.scss",
                "resources/views/admin/assets/scss/boot.scss",
                "resources/views/admin/assets/scss/login.scss",
                "resources/views/admin/assets/scss/home.scss",
                "resources/views/admin/assets/scss/style.scss",
                "resources/views/admin/assets/css/curriculum.css",
                "resources/views/admin/assets/js/login.js",
                "resources/views/admin/assets/js/scripts.js",

                "resources/views/admin/assets/js/datatables/css/jquery.dataTables.min.css",
                "resources/views/admin/assets/js/datatables/css/responsive.dataTables.min.css",
                "resources/views/admin/assets/js/select2/css/select2.min.css",
                // -> "public/backend/assets/css/libs.css"

                "resources/views/admin/assets/js/jquery.min.js",
                // -> "public/backend/assets/js/jquery.js"

                "resources/views/admin/assets/js/datatables/js/jquery.dataTables.min.js",
                "resources/views/admin/assets/js/datatables/js/dataTables.responsive.min.js",
                "resources/views/admin/assets/js/select2/js/select2.min.js",
                "resources/views/admin/assets/js/select2/js/i18n/pt-BR.js",
                "resources/views/admin/assets/js/jquery.form.js",
                "resources/views/admin/assets/js/jquery.mask.js",
                // -> "public/backend/assets/js/libs.js"
            ],
            refresh: [...refreshPaths, "app/Livewire/**"],
        }),
        viteStaticCopy({
            targets: [
                {
                    src: [
                        "resources/views/admin/assets/js/datatables",
                        "resources/views/admin/assets/js/select2",
                        "resources/views/admin/assets/js/tinymce",
                        "resources/views/admin/assets/css/fonts",
                        "resources/views/admin/assets/images"
                    ],
                    dest: './assets'
                }
            ]
        }),
    ],
})
;
