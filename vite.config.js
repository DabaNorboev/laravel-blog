import { defineConfig } from 'vite'; // <--- ЭТОЙ СТРОКИ У ВАС НЕ ХВАТАЛО
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'localhost',
        },
        watch: {
            usePolling: true, // Важно для Docker
        },
    },
});
