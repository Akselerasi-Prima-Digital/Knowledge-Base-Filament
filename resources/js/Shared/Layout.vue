<script setup>
    import Header from './Header.vue';
    import Footer from './Footer.vue';
</script>

<template>
    <div>
        <Header />
        <main class="flex flex-col min-h-screen antialiased bg-white main-content dark:bg-neutral-900">
            <slot />
        </main>
        <Footer />
    </div>
</template>
