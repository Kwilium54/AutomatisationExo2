import { defineConfig } from 'vite';


export default defineConfig({
    root: './assets',
    base: '/build/',
    server: {
        port: 3000,
    },
    build: {
        assetsDir: '',
        outDir: '../public/build/',
        rollupOptions: {
            input: {
                'main.js': './assets/main.js',
            }
        }
    },
});