import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/js/store/create.js' ,'resources/js/store/edit.js'],
            refresh: true,
        }),
    ],
});
