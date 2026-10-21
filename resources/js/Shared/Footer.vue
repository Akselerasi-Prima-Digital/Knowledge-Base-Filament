<template>
    <footer class="bg-white dark:bg-neutral-900">
        <div class="mx-auto max-w-5xl px-6 py-8 flex items-center justify-center lg:px-8">

            <p class="mt-0 text-center text-sm/6 text-neutral-700 dark:text-neutral-300">&copy; {{ currentYear }}
                {{ appName }}. All rights reserved.</p>
        </div>
    </footer>
</template>

<script setup>
    import {
        computed,
    } from 'vue'
    import {
        usePage
    } from '@inertiajs/vue3'
    const page = usePage()
    const appName = computed(() => page.props.appName)
    const currentYear = new Date().getFullYear()
</script>
