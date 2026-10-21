<template>

    <Head>
        <title>{{ appName }}</title>
        <meta name="description" :content="appDescription">
    </Head>
    <Layout>
        <section
            class="w-full shadow-inner bg-linear-to-b from-indigo-200 to-white dark:from-indigo-950 dark:to-neutral-900">
            <div class="pt-8 pb-8 md:pt-14 md:pb-6 min-h-60 md:min-h-[260px]">
                <div class="mx-auto max-w-5xl px-4 md:px-8 flex flex-col items-start">
                    <h1 class="text-2xl md:text-4xl text-neutral-900 dark:text-white font-semibold leading-normal">
                        {{ appName }}
                    </h1>
                    <p class="text-neutral-600 dark:text-neutral-200 text-start text-lg leading-normal pt-2 pb-4">Cari
                        artikel di sini atau telusuri kategori di bawah ini.</p>
                    <div class="w-full" data-v-app="">
                        <div class="relative w-full max-w-5xl my-4">
                            <div
                                class="w-full flex items-center rounded-lg border-solid border h-12 bg-white dark:bg-neutral-900 px-5 py-2 text-neutral-600 dark:text-neutral-200 border-neutral-300 dark:border-neutral-800 hover:border-indigo-600 focus-within:border-indigo-600 active:border-indigo-600 shadow-sm">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10 2.75a7.25 7.25 0 0 1 5.63 11.819l4.9 4.9a.75.75 0 0 1-.976 1.134l-.084-.073-4.901-4.9A7.25 7.25 0 1 1 10 2.75Zm0 1.5a5.75 5.75 0 1 0 0 11.5 5.75 5.75 0 0 0 0-11.5Z"
                                        fill="currentColor"></path>
                                </svg>
                                <input type="text" v-model="searchQuery" @input="handleInput"
                                    class="w-full focus:outline-none text-base h-full bg-white dark:bg-neutral-900 px-2 py-2 text-neutral-700 dark:text-neutral-100 placeholder-neutral-500"
                                    placeholder="Cari artikel berdasarkan judul atau isi..." role="search">
                            </div>
                            <!-- Dropdown hasil pencarian -->
                            <div v-if="showResults"
                                class="absolute w-full top-14 transition-opacity duration-300 ease-in-out"
                                :class="{
                                    'opacity-0': loading && results.length === 0,
                                    'opacity-100': !loading || results
                                        .length > 0
                                }">
                                <div class="p-5 mt-2 overflow-y-auto text-sm bg-white border border-solid rounded-lg shadow-xl hover:shadow-lg dark:bg-neutral-900 max-h-96 scroll-py-2 text-neutral-700 dark:text-neutral-100 border-neutral-300 dark:border-neutral-800"
                                    results-title="Search results">
                                    <ul v-if="results.length > 0"
                                        class="flex flex-col gap-4 text-sm bg-white dark:bg-neutral-900 text-neutral-700 dark:text-neutral-100"
                                        role="listbox">
                                        <li v-for="article in results.slice(0, maxResults)" :key="article.id"
                                            class="flex items-center p-4 border border-solid rounded-lg cursor-pointer select-none group hover:bg-neutral-50 dark:hover:bg-neutral-800 border-neutral-300 dark:border-neutral-800 bg-white dark:bg-neutral-900"
                                            role="option" tabindex="-1">
                                            <a class="flex flex-col gap-1 overflow-y-hidden" :href="article.slug">
                                                <span
                                                    class="flex-auto w-full overflow-hidden text-base font-semibold leading-6 truncate text-ellipsis whitespace-nowrap"
                                                    v-html="highlight(article.title, searchQuery)"></span>
                                                <div class="overflow-hidden text-sm line-clamp-2 text-ellipsis whitespace-nowrap text-neutral-600 dark:text-neutral-300"
                                                    v-html="highlight(previewContent(article.content), searchQuery)">
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <p v-else-if="!loading" class="text-neutral-500 dark:text-neutral-400">
                                        No results found for "{{ searchQuery }}".</p>
                                    <p v-if="loading" class="text-neutral-500 dark:text-neutral-400">
                                        Searching...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="max-w-5xl w-full flex flex-col grow mx-auto py-8 px-4 md:px-8 gap-6">
            <div v-if="featuredArticles && featuredArticles.length > 0">
                <section class="flex flex-col w-full h-full lg:container">
                    <div
                        class="flex flex-col gap-5 px-3 py-5 border group border-solid rounded-lg border-neutral-300 dark:border-neutral-800 hover:border-indigo-600">
                        <div class="flex items-center justify-between w-full">
                            <div class="flex flex-col items-start gap-1">
                                <div class="flex flex-row items-center gap-2 px-2">
                                    <h2
                                        class="text-xl font-semibold leading-relaxed text-neutral-800 dark:text-neutral-50 group-hover:text-indigo-600">
                                        Artikel Pilihan
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-2 md:grid-cols-2 gap-x-2 gap-y-2">
                            <Link v-for="item in featuredArticles" :key="item.slug"
                                class="leading-7 text-neutral-700 dark:text-neutral-100" :href="item.slug">
                            <div
                                class="flex items-start justify-between gap-6 px-2 py-1 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-600/15">
                                {{ item . title }}
                                <span class="flex items-center font-normal mt-1.5">
                                    <svg class="w-4 h-4 fill-current text-neutral-500 dark:text-neutral-400"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.47 4.22a.75.75 0 0 0 0 1.06L15.19 12l-6.72 6.72a.75.75 0 1 0 1.06 1.06l7.25-7.25a.75.75 0 0 0 0-1.06L9.53 4.22a.75.75 0 0 0-1.06 0Z">
                                        </path>
                                    </svg>
                                </span>
                            </div>
                            </Link>
                        </div>
                    </div>
                </section>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                <section v-for="item in categories" :key="item.slug"
                    class="flex flex-col w-full h-full lg:container">
                    <div
                        class="flex h-full flex-col gap-5 px-3 py-5 border group border-solid rounded-lg border-neutral-300 dark:border-neutral-800 hover:border-indigo-600">
                        <div class="flex items-center justify-between w-full">
                            <div class="flex flex-col items-start gap-1">
                                <div class="flex flex-row items-center gap-2 px-2">
                                    <Link :href="item.slug">
                                    <h2
                                        class="text-xl font-semibold leading-relaxed text-neutral-800 dark:text-neutral-50 group-hover:text-indigo-600">
                                        {{ item . name }}
                                    </h2>
                                    </Link>
                                </div>

                                <span
                                    class="text-base text-neutral-600 dark:text-neutral-400 prose dark:prose-invert px-2"
                                    v-html="sanitizedDescription(item.description)"></span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 grow false">
                            <a v-for="article in item.articles" :key="article.slug"
                                class="leading-7 text-neutral-700 dark:text-neutral-100" :href="article.slug">
                                <div
                                    class="flex items-start justify-between gap-6 px-2 py-1 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-600/15">
                                    {{ article . title }}
                                    <span class="flex items-center font-normal mt-1.5">
                                        <svg class="w-4 h-4 fill-current text-neutral-500 dark:text-neutral-400"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.47 4.22a.75.75 0 0 0 0 1.06L15.19 12l-6.72 6.72a.75.75 0 1 0 1.06 1.06l7.25-7.25a.75.75 0 0 0 0-1.06L9.53 4.22a.75.75 0 0 0-1.06 0Z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>
                            </a>

                        </div>
                        <div class="flex justify-between flex-row items-center px-2">
                            <div class="flex flex-row items-center gap-1">
                                <span class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                                    {{ item . articles_count }} artikel
                                </span>
                            </div>
                            <div>
                                <Link :href="item.slug"
                                    class="flex flex-row items-center text-sm font-medium text-neutral-600 dark:text-neutral-400 hover:text-neutral-700 dark:hover:text-neutral-100">
                                Lihat semua
                                </Link>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </Layout>
</template>

<script setup>
    import {
        ref,
        watch,
        onMounted,
        computed
    } from 'vue';
    import DOMPurify from 'dompurify';
    import {
        Head,
        Link,
        usePage
    } from '@inertiajs/vue3';
    import Layout from '../Shared/Layout.vue';

    const page = usePage()
    const appName = computed(() => page.props.appName)
    const appDescription = computed(() => page.props.appDescription)

    const props = defineProps({
        categories: Object,
        featuredArticles: Array,
        searchUrl: String,
    });

    const sanitizedDescription = (description) => {
        return DOMPurify.sanitize(description);
    };

    const searchQuery = ref('');
    const results = ref([]);
    const loading = ref(false);
    const debounceTimer = ref(null);
    const maxResults = ref(10);
    const showResults = ref(false);

    watch(searchQuery, (newQuery) => {
        showResults.value = Boolean(newQuery.trim());

        if (debounceTimer.value) clearTimeout(debounceTimer.value);
        debounceTimer.value = setTimeout(() => search(), 300);
    });

    const search = async () => {
        if (!searchQuery.value.trim()) {
            results.value = [];
            loading.value = false;
            return;
        }
        loading.value = true;
        try {
            const response = await axios.get(props.searchUrl, {
                params: {
                    query: searchQuery.value
                }
            });
            results.value = response.data;
        } catch (error) {
            console.error('Search error:', error);
            results.value = [];
        } finally {
            loading.value = false;
        }
    };


    const highlight = (text, query) => {
        if (!query) return DOMPurify.sanitize(text);
        const regex = new RegExp(`(${query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
        const highlighted = text.replace(regex, '<mark>$1</mark>');
        return DOMPurify.sanitize(highlighted);
    };

    const previewContent = (content) => {
        const maxLength = 125;
        return content.length > maxLength ? content.substring(0, maxLength) + '...' : content;
    };

    onMounted(() => {
        if (searchQuery.value.trim()) search();
    });
</script>
