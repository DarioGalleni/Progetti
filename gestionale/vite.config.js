import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/cleaning-print.css',
                'resources/js/cleaning-print.js',
                'resources/css/print-expenses.css',
                'resources/js/print-expenses.js',
                'resources/css/receipt.css',
                'resources/js/receipt.js',
                'resources/css/restaurant.css',
                'resources/js/groups.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
