import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

export default defineConfig({
  plugins: [react()],
  base: './',
  build: {
    outDir: 'dist',
    emptyOutDir: true,
    manifest: true,
  },
  server: {
    port: 5174,
    proxy: {
      '/E-COMMERCE-SITE': {
        target: 'http://localhost',
        changeOrigin: true,
      },
    },
  },
})
