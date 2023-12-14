import { defineConfig, loadEnv, configEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';



export default (configEnv) => {

    process.env = { ...process.env, ...loadEnv(configEnv.mode, process.cwd(), '') }
    return defineConfig({
        base: process.env.VITE_BASE_PATH+'build/',
        plugins: [
            laravel({
                input: ['resources/plugins/fontawesome/css/all.min.css','resources/css/app.css', 'resources/scss/style.scss',  'resources/js/app.js'],
                refresh: true,
            }),
            vue(),
        ]
    })
}
