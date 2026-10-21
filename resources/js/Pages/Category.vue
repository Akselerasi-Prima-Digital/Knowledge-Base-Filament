<template>

    <Head>
        <title>{{ category . name }} - {{ appName }}</title>
        <meta name="description" :content="metaDescription">
    </Head>
    <Layout>
        <section
            class="w-full shadow-inner bg-linear-to-b from-indigo-200 to-white dark:from-indigo-950 dark:to-neutral-900">
            <div class="pt-8 pb-8 md:pt-14 md:pb-6 min-h-60 md:min-h-[260px]">
                <div class="mx-auto max-w-5xl px-4 md:px-8 flex flex-col items-start gap-6">
                    <div class="flex items-center flex-row">
                        <Link
                            class="text-neutral-500 dark:text-neutral-200 text-sm gap-1 hover:cursor-pointer false leading-8 font-semibold"
                            :href="appUrl">
                        Beranda
                        </Link>
                        <span
                            class="w-4 h-4 [&amp;&gt;svg]:w-3 [&amp;&gt;svg]:h-3 flex items-center justify-center text-xs text-neutral-500 dark:text-neutral-300"><svg
                                class="w-4 h-4 fill-current text-neutral-500 dark:text-neutral-400" width="24"
                                height="24" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.47 4.22a.75.75 0 0 0 0 1.06L15.19 12l-6.72 6.72a.75.75 0 1 0 1.06 1.06l7.25-7.25a.75.75 0 0 0 0-1.06L9.53 4.22a.75.75 0 0 0-1.06 0Z">
                                </path>
                            </svg>
                        </span>
                        <span
                            class="text-sm text-neutral-800 dark:text-neutral-100 font-semibold">{{ category . name }}</span>
                    </div>
                    <div class="flex justify-start flex-col items-start w-full gap-2">
                        <div class="flex flex-col gap-2">
                            <h1
                                class="text-2xl md:text-4xl text-neutral-900 dark:text-white font-semibold leading-normal">
                                {{ category . name }}
                            </h1>
                            <span
                                class="font-medium text-neutral-700 dark:text-neutral-300 text-base leading-5 max-w-none prose dark:prose-invert"
                                v-html="sanitizedDescription(category.description)"></span>

                        </div>
                        <div class="flex flex-row items-center gap-1">
                            <span
                                class="flex items-center text-base text-neutral-600 dark:text-neutral-400 font-medium">
                                {{ category . articles_count }}
                                artikel
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <section class="max-w-5xl w-full mx-auto px-4 md:px-8 py-6 flex flex-col items-center justify-center grow">
            <div class="w-full flex flex-col gap-6 grow">
                <div v-for="item in category.articles.data" :key="item.slug"
                    class="border group border-solid border-neutral-300 dark:border-neutral-800 hover:border-indigo-600 rounded-lg">
                    <Link
                        class="p-4 text-neutral-800 dark:text-neutral-50 flex justify-between content-center hover:cursor-pointer"
                        :href="item.slug">
                    <div class="flex flex-col gap-5">
                        <div class="flex flex-col gap-1">
                            <h2
                                class="text-lg text-neutral-800 dark:text-neutral-50 group-hover:text-indigo-600 tracking-[0.28px]  font-semibold ">
                                {{ item . title }}</h2>
                            <p
                                class="text-base font-normal text-neutral-600 dark:text-neutral-200 line-clamp-1 break-all">
                                {{ item . content }}
                            </p>
                        </div>
                        <span
                            class="text-sm text-neutral-600 dark:text-neutral-400 font-medium flex items-center">Diperbarui
                            terakhir pada {{ item . updated_at }}</span>
                    </div>
                    </Link>
                </div>

            </div>
            <div class="mt-6 flex justify-center w-full">
                <Pagination :links="category.articles.links" />
            </div>
        </section>
    </Layout>
</template>

<script setup>
    import {
        computed
    } from 'vue';
    import DOMPurify from 'dompurify';
    import {
        Head,
        Link,
        usePage
    } from '@inertiajs/vue3';
    import Layout from '../Shared/Layout.vue';
    import Pagination from '../Shared/Pagination.vue';

    const props = defineProps({
        category: Object,
    });

    const page = usePage()
    const appName = computed(() => page.props.appName)
    const appUrl = computed(() => page.props.appUrl)
    const metaDescription = computed(() => {
        if (props.category && props.category.meta_description) {
            return props.category.meta_description;
        }
        return page.props.appDescription;
    });

    const sanitizedDescription = (description) => {
        return DOMPurify.sanitize(description);
    };
</script>
