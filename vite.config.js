import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        //host: 'localhost',  // Ensure it binds to localhost
        port: 3000,
        hmr:{
            host:'localhost'
        }         // Default port for Vite
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
