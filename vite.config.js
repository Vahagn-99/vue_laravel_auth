import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  resolve: {
    alias: {
      '@': '/resources/js/vue',
    },
  },
  plugins: [
    laravel(
      ['resources/js/app.js', 'resources/css/app.css'],
    ),
    vue({
    }),
  ],
});