<template>
    <nav v-if="links && links.length > 3"
        class="w-full flex items-center justify-between border-t border-neutral-300 dark:border-neutral-800 px-4 mt-8 sm:px-0">

        <div class="-mt-px flex w-0 flex-1">
            <component :is="prevLink.url ? Link : 'span'" :href="prevLink.url"
                class="inline-flex items-center border-t-2 border-transparent pt-4 pr-1 text-base font-normal transition-colors duration-200"
                :class="prevLink.url ?
                    'text-neutral-600 dark:text-neutral-200 hover:border-neutral-300 dark:hover:border-neutral-800 hover:text-neutral-700 dark:hover:text-neutral-100' :
                    'text-neutral-400 dark:text-neutral-600 cursor-not-allowed'">
                <ArrowLongLeftIcon class="mr-3 size-5"
                    :class="prevLink.url ? 'text-neutral-600 dark:text-neutral-200' : 'text-neutral-400 dark:text-neutral-600'"
                    aria-hidden="true" />
                Sebelumnya
            </component>
        </div>

        <div class="hidden md:-mt-px md:flex">
            <template v-for="(link, key) in links">
                <template v-if="key !== 0 && key !== links.length - 1">

                    <span v-if="link.url === null" :key="`ellipsis-${key}`"
                        class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-base font-normal text-neutral-600 dark:text-neutral-200">
                        ...
                    </span>

                    <Link v-else-if="link.active" :key="`active-${key}`" :href="link.url"
                        class="inline-flex items-center border-t-2 border-indigo-600 px-4 pt-4 text-base font-normal text-indigo-600"
                        aria-current="page">
                    {{ link . label }}
                    </Link>

                    <Link v-else :key="`link-${key}`" :href="link.url"
                        class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-base font-normal text-neutral-600 dark:text-neutral-200 hover:border-neutral-300 dark:hover:border-neutral-800 hover:text-neutral-700 dark:hover:text-neutral-100 transition-colors duration-200">
                    {{ link . label }}
                    </Link>

                </template>
            </template>
        </div>

        <div class="-mt-px flex w-0 flex-1 justify-end">
            <component :is="nextLink.url ? Link : 'span'" :href="nextLink.url"
                class="inline-flex items-center border-t-2 border-transparent pt-4 pl-1 text-base font-normal transition-colors duration-200"
                :class="nextLink.url ?
                    'text-neutral-600 dark:text-neutral-200 hover:border-neutral-300 dark:hover:border-neutral-800 hover:text-neutral-700 dark:hover:text-neutral-100' :
                    'text-neutral-400 dark:text-neutral-600 cursor-not-allowed'">
                Selanjutnya
                <ArrowLongRightIcon class="ml-3 size-5"
                    :class="nextLink.url ? 'text-neutral-600 dark:text-neutral-200' : 'text-neutral-400 dark:text-neutral-600'"
                    aria-hidden="true" />
            </component>
        </div>

    </nav>
</template>

<script setup>
    import {
        computed
    } from 'vue';
    import {
        Link
    } from '@inertiajs/vue3';
    import {
        ArrowLongLeftIcon,
        ArrowLongRightIcon
    } from '@heroicons/vue/20/solid';

    const props = defineProps({
        links: Array,
    });

    const prevLink = computed(() => props.links?.[0] || {});
    const nextLink = computed(() => props.links?.[props.links.length - 1] || {});
</script>
