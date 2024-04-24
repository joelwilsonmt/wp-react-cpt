import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [react()],
    build: {
        outDir: './plugin/includes/js',
        rollupOptions: {
            output: {
                inlineDynamicImports: true,
                entryFileNames: 'main.js',
                assetFileNames: 'main.[ext]', // for css files
            },
        },
        cssCodeSplit: false,
    },
})
