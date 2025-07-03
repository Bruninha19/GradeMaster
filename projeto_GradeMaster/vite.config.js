import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'; // <-- Importe o plugin do Vue

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({ // <-- Adicione o plugin do Vue aqui
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: { // <-- Adicione este bloco 'resolve'
        alias: {
            'vue': 'vue/dist/vue.esm-bundler.js' // Alias para a versão com compilador
        }
    }
});