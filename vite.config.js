import { defineConfig } from "vitest/config";
import { readdirSync } from "node:fs";
import laravel from "laravel-vite-plugin";
import { bunny } from "laravel-vite-plugin/fonts";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/images/people/benjamin-crozat.webp",
                "resources/images/screenshots/queries-inspector-desktop-dark.png",
                "resources/images/social/newdebugbar-og.png",
                ...readdirSync("resources/images/screenshots/docs")
                    .filter((file) => file.endsWith(".png"))
                    .map((file) => `resources/images/screenshots/docs/${file}`),
            ],
            refresh: true,
            fonts: [
                bunny("Instrument Sans", {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ["**/storage/framework/views/**"],
        },
    },
    test: {
        environment: "jsdom",
        include: ["tests/js/**/*.test.js"],
        clearMocks: true,
        restoreMocks: true,
    },
});
