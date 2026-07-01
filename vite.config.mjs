import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react-swc';
import tailwindcss from '@tailwindcss/vite';
import path from 'path';

export default defineConfig({
    plugins: [
        tailwindcss(),
        react(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/react-app.jsx'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: [
            { find: /^gsap\/(.+)$/, replacement: path.resolve(__dirname, 'gsap-public/src/$1.js') },
            { find: /^gsap$/, replacement: path.resolve(__dirname, 'gsap-public/src/index.js') },
        ],
    },
    optimizeDeps: {
        include: [],
        exclude: [],
    },
});
