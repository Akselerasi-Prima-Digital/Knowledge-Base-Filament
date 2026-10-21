<template>

    <Head>
        <title>{{ article . title }} - {{ appName }}</title>
        <meta name="description" :content="metaDescription">
    </Head>
    <Layout>
        <section
            class="w-full shadow-inner bg-linear-to-b from-indigo-200 to-white dark:from-indigo-950 dark:to-neutral-900">
            <div class="pt-8 pb-8 md:pt-14 md:pb-6 min-h-60 md:min-h-[260px]">
                <div class="mx-auto max-w-5xl px-4 md:px-8 flex flex-col items-start">
                    <div class="flex flex-row items-center gap-px mb-6">
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
                        <Link
                            class="text-neutral-500 dark:text-neutral-200 text-sm gap-1 whitespace-nowrap hover:cursor-pointer false leading-8 font-semibold"
                            :href="article.category.slug">
                        {{ article . category . name }}
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
                            class="block truncate overflow-hidden whitespace-nowrap text-ellipsis text-sm font-semibold text-neutral-800 dark:text-neutral-100 max-w-[clamp(120px,40vw,320px)] md:max-w-none">
                            {{ article . title }}
                        </span>
                    </div>
                    <h1 class="text-2xl md:text-4xl text-neutral-900 dark:text-white font-semibold leading-normal">
                        {{ article . title }}
                    </h1>
                    <div class="flex flex-col items-start justify-between w-full pt-6 md:flex-row md:items-center">
                        <div class="flex items-start space-x-1">
                            <span
                                class="flex items-center text-base font-medium text-neutral-600 dark:text-neutral-400">
                                Diperbarui terakhir pada {{ article . updated_at }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <div class="flex max-w-5xl w-full px-4 md:px-8 mx-auto">
            <div>

                <article :class="tableOfContents && tableOfContents.length > 0 ? 'max-w-3xl' : 'max-w-5xl'"
                    class="grow flex-auto mx-auto text-neutral-700 dark:text-neutral-100 prose-h1:text-2xl prose-h2:text-xl prose-h2:mt-0 prose-h3:text-lg overflow-x-auto prose-code:p-1 prose-code:rounded-sm prose-code:bg-neutral-100 dark:prose-code:bg-neutral-700 prose-code:after:content-none prose-code:before:content-none prose-blockquote:bg-neutral-100 dark:prose-blockquote:bg-neutral-700 prose-li:marker:text-neutral-500 dark:prose-li:marker:text-neutral-300 prose dark:prose-invert wrap-break-word w-full pt-8 pb-12"
                    v-html="processedContent">
                </article>

                <div v-if="article.tags && article.tags.length > 0" class="border-neutral-200 dark:border-neutral-700">
                    <h3
                        class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-700 dark:text-neutral-300">
                        #Tags
                    </h3>

                    <div class="flex flex-wrap gap-2">
                        <Link v-for="item in article.tags" :key="item.name" :href="item.slug"
                            class="inline-flex items-center rounded-full bg-indigo-400/10 px-3 py-1 text-xs font-medium text-indigo-600 ring-1 ring-inset ring-indigo-400/20 hover:bg-indigo-400/20 cursor-pointer dark:text-indigo-400 dark:hover:bg-indigo-400/30">
                        {{ item . name }}
                        </Link>
                    </div>
                </div>
            </div>
            <div v-if="tableOfContents && tableOfContents.length > 0" class="flex-1" data-v-app="">
                <div class="hidden lg:block flex-1 py-6 scroll-mt-24 ltr:pl-4 rtl:pr-4 sticky top-24">
                    <div class="py-2 overflow-auto">
                        <nav class="max-w-2xl">
                            <ol role="list"
                                class="flex flex-col gap-2 text-base ltr:border-l-2 rtl:border-r-2 border-solid border-neutral-100 dark:border-neutral-800">
                                <li v-for="item in tableOfContents" :key="item.id"
                                    class="leading-6 ltr:border-l-2 rtl:border-r-2 relative ltr:-left-0.5 rtl:-right-0.5 border-solid transition-colors duration-200"
                                    :class="activeId === item.id ? 'border-neutral-400 dark:border-neutral-50' :
                                        'border-neutral-100 dark:border-neutral-800'">
                                    <p class="py-1 px-3">
                                        <Link :href="`#${item.id}`" data-turbolinks="false"
                                            class="font-medium text-sm tracking-[0.28px] cursor-pointer transition-colors duration-200"
                                            :class="activeId === item.id ? 'text-neutral-900 dark:text-neutral-100' :
                                                'text-neutral-700 dark:text-neutral-100'">
                                        {{ item . text }}
                                        </Link>
                                    </p>
                                    <!-- Nested children -->
                                    <ol v-if="item.children && item.children.length > 0" class="mt-1">
                                        <li v-for="child in item.children" :key="child.id"
                                            class="leading-6 ltr:border-l-2 rtl:border-r-2 relative ltr:-left-0.5 rtl:-right-0.5 border-solid transition-colors duration-200"
                                            :class="activeId === child.id ? 'border-neutral-400 dark:border-neutral-50' :
                                                'border-neutral-100 dark:border-neutral-800'">
                                            <p class="py-1 px-3 ml-4">
                                                <Link :href="`#${child.id}`" data-turbolinks="false"
                                                    class="font-medium text-sm tracking-[0.28px] cursor-pointer transition-colors duration-200"
                                                    :class="activeId === child.id ? 'text-neutral-900 dark:text-neutral-100' :
                                                        'text-neutral-700 dark:text-neutral-100'">
                                                {{ child . text }}
                                                </Link>
                                            </p>
                                            <!-- Recursive for deeper levels if needed -->
                                            <ol v-if="child.children && child.children.length > 0" class="mt-1">
                                                <li v-for="grandchild in child.children" :key="grandchild.id"
                                                    class="leading-6 ltr:border-l-2 rtl:border-r-2 relative ltr:-left-0.5 rtl:-right-0.5 border-solid transition-colors duration-200"
                                                    :class="activeId === grandchild.id ?
                                                        'border-neutral-400 dark:border-neutral-50' :
                                                        'border-neutral-100 dark:border-neutral-800'">
                                                    <p class="py-1 px-3 ml-8">
                                                        <Link :href="`#${grandchild.id}`" data-turbolinks="false"
                                                            class="font-medium text-sm tracking-[0.28px] cursor-pointer transition-colors duration-200"
                                                            :class="activeId === grandchild.id ?
                                                                'text-neutral-900 dark:text-neutral-100' :
                                                                'text-neutral-700 dark:text-neutral-100'">
                                                        {{ grandchild . text }}
                                                        </Link>
                                                    </p>
                                                </li>
                                            </ol>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
    import {
        ref,
        onMounted,
        onUnmounted,
        nextTick,
        computed,
    } from 'vue';
    import DOMPurify from 'dompurify';
    import {
        Head,
        Link,
        usePage
    } from '@inertiajs/vue3'
    import Layout from '../Shared/Layout.vue';

    const props = defineProps({
        article: Object,
        category_url: String,
    });

    const page = usePage()
    const appName = computed(() => page.props.appName)
    const appUrl = computed(() => page.props.appUrl)
    const metaDescription = computed(() => {
        if (props.article && props.article.meta_description) {
            return props.article.meta_description;
        }
        return page.props.appDescription;
    });

    const sanitizedContent = computed(() => {
        return DOMPurify.sanitize(props.article.content);
    });

    const slugify = (text) => {
        return text
            .toString()
            .toLowerCase()
            .trim()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    };

    const processedContent = computed(() => {
        let content = sanitizedContent.value;
        const parser = new DOMParser();
        const doc = parser.parseFromString(content, 'text/html');
        const headings = doc.querySelectorAll('h1, h2, h3, h4, h5, h6');
        const usedIds = new Set();
        headings.forEach((heading) => {
            if (!heading.id) {
                const text = heading.textContent.trim();
                let id = slugify(text);
                let counter = 1;
                let originalId = id;
                while (usedIds.has(id)) {
                    id = `${originalId}-${counter}`;
                    counter++;
                }
                usedIds.add(id);
                heading.id = id;
            }
            heading.classList.add('scroll-mt-[100px]');
        });
        return doc.body.innerHTML;
    });

    const tableOfContents = computed(() => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(processedContent.value, 'text/html');
        const headings = doc.querySelectorAll('h1, h2, h3, h4, h5, h6');

        const toc = [];
        const build = [];
        const stack = [];

        headings.forEach((heading) => {
            const level = parseInt(heading.tagName.charAt(1));
            const text = heading.textContent.trim();
            const id = heading.id || slugify(text);
            const item = {
                id,
                text,
                level,
                children: []
            };

            while (stack.length && stack[stack.length - 1].level >= level) stack.pop();
            if (!stack.length) build.push(item);
            else stack[stack.length - 1].children.push(item);
            stack.push(item);

            toc.push(item);
        });

        return build;
    });

    const activeId = ref('')
    const observer = ref(null)

    const HEADER_SELECTOR = 'header, .header, .sticky-header, [data-header]'

    const getHeaderHeight = () => {
        const el = document.querySelector(HEADER_SELECTOR)
        if (!el) return 0
        const rect = el.getBoundingClientRect()
        return Math.max(0, rect.height)
    }

    const calcRefY = () => {
        return getHeaderHeight() + 12
    }

    let rafId = null
    const requestUpdateActive = (cb) => {
        if (rafId) cancelAnimationFrame(rafId)
        rafId = requestAnimationFrame(() => {
            rafId = null
            cb && cb()
        })
    }

    onMounted(async () => {
        onUnmounted(() => {
            if (observer.value) observer.value.disconnect()
            window.removeEventListener('scroll', onScroll)
        })

        await nextTick()

        const headings = Array.from(
            document.querySelectorAll('h1, h2, h3, h4, h5, h6')
        ).filter(h => h.id)

        if (headings.length) activeId.value = headings[0].id

        const pickNearest = (force = false) => {
            if (!headings.length) return
            const refY = calcRefY()
            let nearest = null
            let nearestDist = Infinity

            for (const h of headings) {
                const r = h.getBoundingClientRect()
                if (r.top <= getHeaderHeight() - 2) continue
                const d = Math.abs(r.top - refY)
                if (d < nearestDist) {
                    nearest = h
                    nearestDist = d
                }
            }

            if (!nearest) {
                nearest = headings.reduce((acc, h) => {
                    const r = h.getBoundingClientRect()
                    const ra = acc.getBoundingClientRect()
                    return r.top < ra.top ? h : acc
                }, headings[0])
            }

            const id = nearest?.id
            if (id && (force || activeId.value !== id)) {
                activeId.value = id
            }
        }

        observer.value = new IntersectionObserver(
            (entries) => {
                requestUpdateActive(() => pickNearest())
            }, {
                root: null,
                rootMargin: '25% 0px -15% 0px',
                threshold: [0, 0.25, 0.5, 0.75, 1],
            }
        )

        headings.forEach(h => observer.value.observe(h))

        requestUpdateActive(() => pickNearest(true))

        const onScroll = () => requestUpdateActive(() => pickNearest())
        window.addEventListener('scroll', onScroll, {
            passive: true
        })


    })
</script>
