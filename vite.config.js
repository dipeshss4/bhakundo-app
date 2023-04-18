import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/sass/main.scss', 
                'resources/js/dashmix/app.js',
                'resources/js/pages/datatables.js',
                'resources/js/pages/ckEditor.js',
                'resources/js/pages/Validation.js',
                'resources/js/pages/ImagePreview.js'
            ],
            refresh: true,
            rollupInputOptions: {
                external: ['resources/js/pages/Validation.js']

            }

        }),

    ],
});
