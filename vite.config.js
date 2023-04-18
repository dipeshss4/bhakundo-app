import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/sass/main.scss', 
                'resources/js/dashmix/app.js'
            ],
            refresh: true,
            rollupInputOptions: {
                external: ['resources/js/pages/Validation.js']

            }

        }),

    ],
});
