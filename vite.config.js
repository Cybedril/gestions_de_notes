import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';  // Utilisation de la syntaxe correcte

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/css/app.css'],  // Tes fichiers d'entrée
        }),
    ],
});
