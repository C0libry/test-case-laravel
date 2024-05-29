import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'
export default defineConfig({
    server: {
        host: true,
        hmr: {
            host: 'localhost',
        },
        port: 3000,
    },
    plugins: [
        vue({
            template: {
                compilerOptions: {
                    isCustomElement: (tag) => ['ion-icon'].includes(tag),
                },
            },
        }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts'],
            refresh: true,
        }),
    ],
})
