<template>
    <header class="sticky top-0 z-50 bg-white dark:bg-neutral-900 backdrop-blur-md shadow-sm">
        <nav class="mx-auto flex max-w-5xl items-center justify-between px-6 py-5 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <Link :href="appUrl" class="-m-1.5">
                <span class="sr-only">{{ appName }}</span>
                <img preload loading="eager" class="h-10 w-auto" :src="logoPath" width="175" height="40"
                    densities="x1" alt="{{ appName }}" />
                </Link>
            </div>
            <div class="flex items-center justify-between gap-2 sm:gap-5">
                <div class="relative grow shrink-0 px-1 py-2 cursor-pointer">
                    <button
                        class="hidden lg:flex justify-between min-w-[76px] flex-row items-center stroke-neutral-700 dark:stroke-neutral-100 text-neutral-700 dark:text-neutral-100 gap-2"
                        type="button" @click="toggleDropdown">
                        <!-- System Theme Icon -->
                        <div v-show="currentTheme === 'system'" class="flex flex-row items-center gap-1">
                            <svg width="18" height="18" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 4H4C3.44772 4 3 4.44773 3 5.00002V10.0001C3 10.5524 3.44772 11.0002 4 11.0002H12C12.5523 11.0002 13 10.5524 13 10.0001V5.00002C13 4.44773 12.5523 4 12 4Z"
                                    stroke-width="1.00001" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M6 13H10" stroke-width="1.00001" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M8 11V13" stroke-width="1.00001" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            <span class="text-sm font-medium">Sistem</span>
                        </div>

                        <!-- Light Theme Icon -->
                        <div v-show="currentTheme === 'light'" class="flex flex-row items-center gap-1">
                            <svg width="18" height="18" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.0001 10.3998C9.32559 10.3998 10.4001 9.32529 10.4001 7.99982C10.4001 6.67436 9.32559 5.59985 8.0001 5.59985C6.67462 5.59985 5.6001 6.67436 5.6001 7.99982C5.6001 9.32529 6.67462 10.3998 8.0001 10.3998Z"
                                    stroke-width="1.19999" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M8 2V3.19998" stroke-width="1.19999" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M8 12.8V14" stroke-width="1.19999" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M3.75806 3.75781L4.60406 4.6038" stroke-width="1.19999" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M11.396 11.3958L12.242 12.2417" stroke-width="1.19999" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M2 7.99976H3.2" stroke-width="1.19999" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M12.8 7.99976H14.0001" stroke-width="1.19999" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M4.60406 11.3958L3.75806 12.2417" stroke-width="1.19999" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M12.242 3.75781L11.396 4.6038" stroke-width="1.19999" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            <span class="text-sm font-medium">Terang</span>
                        </div>

                        <!-- Dark Theme Icon -->
                        <div v-show="currentTheme === 'dark'" class="flex flex-row items-center gap-1">
                            <svg width="18" height="18" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 3C7.33696 3.66304 6.96447 4.56232 6.96447 5.5C6.96447 6.43768 7.33696 7.33696 8 8C8.66304 8.66304 9.56232 9.03553 10.5 9.03553C11.4377 9.03553 12.337 8.66304 13 8C13 8.9889 12.7068 9.9556 12.1573 10.7778C11.6079 11.6001 10.827 12.241 9.91342 12.6194C8.99979 12.9978 7.99446 13.0969 7.02455 12.9039C6.05465 12.711 5.16373 12.2348 4.46447 11.5355C3.76521 10.8363 3.289 9.94535 3.09608 8.97545C2.90315 8.00555 3.00217 7.00021 3.3806 6.08658C3.75904 5.17295 4.39991 4.39206 5.22215 3.84265C6.0444 3.29324 7.01109 3 8 3Z"
                                    stroke-width="1.11111" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <span class="text-sm font-medium">Gelap</span>
                        </div>

                        <!-- Chevron Down -->
                        <div class="flex items-center px-1 pointer-events-none">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg" :class="{ 'rotate-180': dropdownOpen }"
                                class="transition-transform duration-200">
                                <path d="M3 4.5L6 7.5L9 4.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    </button>

                    <button
                        class="flex lg:hidden justify-center items-center rounded-lg stroke-neutral-700 dark:stroke-neutral-100 text-neutral-700 dark:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-800"
                        type="button" @click="toggleDropdown" :aria-label="'Theme: ' + currentTheme">

                        <!-- System Theme Icon -->
                        <svg v-show="currentTheme === 'system'" width="20" height="20" viewBox="0 0 16 16"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4H4C3.44772 4 3 4.44773 3 5.00002V10.0001C3 10.5524 3.44772 11.0002 4 11.0002H12C12.5523 11.0002 13 10.5524 13 10.0001V5.00002C13 4.44773 12.5523 4 12 4Z"
                                stroke-width="1.00001" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M6 13H10" stroke-width="1.00001" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                            <path d="M8 11V13" stroke-width="1.00001" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>

                        <!-- Light Theme Icon -->
                        <svg v-show="currentTheme === 'light'" width="20" height="20" viewBox="0 0 16 16"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.0001 10.3998C9.32559 10.3998 10.4001 9.32529 10.4001 7.99982C10.4001 6.67436 9.32559 5.59985 8.0001 5.59985C6.67462 5.59985 5.6001 6.67436 5.6001 7.99982C5.6001 9.32529 6.67462 10.3998 8.0001 10.3998Z"
                                stroke-width="1.19999" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M8 2V3.19998" stroke-width="1.19999" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M8 12.8V14" stroke-width="1.19999" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M3.75806 3.75781L4.60406 4.6038" stroke-width="1.19999" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M11.396 11.3958L12.242 12.2417" stroke-width="1.19999" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M2 7.99976H3.2" stroke-width="1.19999" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M12.8 7.99976H14.0001" stroke-width="1.19999" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M4.60406 11.3958L3.75806 12.2417" stroke-width="1.19999" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M12.242 3.75781L11.396 4.6038" stroke-width="1.19999" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>

                        <!-- Dark Theme Icon -->
                        <svg v-show="currentTheme === 'dark'" width="20" height="20" viewBox="0 0 16 16"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8 3C7.33696 3.66304 6.96447 4.56232 6.96447 5.5C6.96447 6.43768 7.33696 7.33696 8 8C8.66304 8.66304 9.56232 9.03553 10.5 9.03553C11.4377 9.03553 12.337 8.66304 13 8C13 8.9889 12.7068 9.9556 12.1573 10.7778C11.6079 11.6001 10.827 12.241 9.91342 12.6194C8.99979 12.9978 7.99446 13.0969 7.02455 12.9039C6.05465 12.711 5.16373 12.2348 4.46447 11.5355C3.76521 10.8363 3.289 9.94535 3.09608 8.97545C2.90315 8.00555 3.00217 7.00021 3.3806 6.08658C3.75904 5.17295 4.39991 4.39206 5.22215 3.84265C6.0444 3.29324 7.01109 3 8 3Z"
                                stroke-width="1.11111" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <Transition enter-active-class="transition ease-out duration-100"
                        enter-from-class="transform opacity-0 scale-95"
                        enter-to-class="transform opacity-100 scale-100"
                        leave-active-class="transition ease-in duration-75"
                        leave-from-class="transform opacity-100 scale-100"
                        leave-to-class="transform opacity-0 scale-95">
                        <div v-show="dropdownOpen"
                            class="absolute flex flex-col w-36 h-auto bg-white border border-solid rounded-lg dark:bg-neutral-900 top-12 right-1 border-neutral-100 dark:border-neutral-700 shadow-lg">

                            <!-- System Option -->
                            <button
                                class="flex flex-row items-center justify-between gap-2 px-2 py-2 border-b border-solid border-neutral-100 dark:border-neutral-700 stroke-neutral-700 dark:stroke-neutral-100 text-neutral-700 dark:text-neutral-100 hover:bg-neutral-50 dark:hover:bg-neutral-700 transition-colors rounded-t"
                                @click="setTheme('system')">
                                <div class="flex flex-row items-center gap-2">
                                    <svg width="18" height="18" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 4H4C3.44772 4 3 4.44773 3 5.00002V10.0001C3 10.5524 3.44772 11.0002 4 11.0002H12C12.5523 11.0002 13 10.5524 13 10.0001V5.00002C13 4.44773 12.5523 4 12 4Z"
                                            stroke-width="1.00001" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                        <path d="M6 13H10" stroke-width="1.00001" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M8 11V13" stroke-width="1.00001" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Sistem</span>
                                </div>
                                <span v-show="currentTheme === 'system'"
                                    class="stroke-neutral-700 dark:stroke-neutral-100">
                                    <svg width="18" height="18" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.2121 5L5.87879 11.3333L3 8.45455" stroke-width="1.2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </button>

                            <!-- Light Option -->
                            <button
                                class="flex flex-row items-center justify-between gap-2 px-2 py-2 border-b border-solid border-neutral-100 dark:border-neutral-700 stroke-neutral-700 dark:stroke-neutral-100 text-neutral-700 dark:text-neutral-100 hover:bg-neutral-50 dark:hover:bg-neutral-700 transition-colors"
                                @click="setTheme('light')">
                                <div class="flex flex-row items-center gap-2">
                                    <svg width="18" height="18" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.0001 10.3998C9.32559 10.3998 10.4001 9.32529 10.4001 7.99982C10.4001 6.67436 9.32559 5.59985 8.0001 5.59985C6.67462 5.59985 5.6001 6.67436 5.6001 7.99982C5.6001 9.32529 6.67462 10.3998 8.0001 10.3998Z"
                                            stroke-width="1.19999" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                        <path d="M8 2V3.19998" stroke-width="1.19999" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M8 12.8V14" stroke-width="1.19999" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M3.75806 3.75781L4.60406 4.6038" stroke-width="1.19999"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M11.396 11.3958L12.242 12.2417" stroke-width="1.19999"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M2 7.99976H3.2" stroke-width="1.19999" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M12.8 7.99976H14.0001" stroke-width="1.19999" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M4.60406 11.3958L3.75806 12.2417" stroke-width="1.19999"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.242 3.75781L11.396 4.6038" stroke-width="1.19999"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Terang</span>
                                </div>
                                <span v-show="currentTheme === 'light'"
                                    class="stroke-neutral-700 dark:stroke-neutral-100">
                                    <svg width="18" height="18" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.2121 5L5.87879 11.3333L3 8.45455" stroke-width="1.2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </button>

                            <!-- Dark Option -->
                            <button
                                class="flex flex-row items-center justify-between gap-2 px-2 py-2 stroke-neutral-700 dark:stroke-neutral-100 text-neutral-700 dark:text-neutral-100 hover:bg-neutral-50 dark:hover:bg-neutral-700 transition-colors rounded-b"
                                @click="setTheme('dark')">
                                <div class="flex flex-row items-center gap-2">
                                    <svg width="18" height="18" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8 3C7.33696 3.66304 6.96447 4.56232 6.96447 5.5C6.96447 6.43768 7.33696 7.33696 8 8C8.66304 8.66304 9.56232 9.03553 10.5 9.03553C11.4377 9.03553 12.337 8.66304 13 8C13 8.9889 12.7068 9.9556 12.1573 10.7778C11.6079 11.6001 10.827 12.241 9.91342 12.6194C8.99979 12.9978 7.99446 13.0969 7.02455 12.9039C6.05465 12.711 5.16373 12.2348 4.46447 11.5355C3.76521 10.8363 3.289 9.94535 3.09608 8.97545C2.90315 8.00555 3.00217 7.00021 3.3806 6.08658C3.75904 5.17295 4.39991 4.39206 5.22215 3.84265C6.0444 3.29324 7.01109 3 8 3Z"
                                            stroke-width="1.11111" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                    </svg>
                                    <span class="text-sm font-medium">Gelap</span>
                                </div>
                                <span v-show="currentTheme === 'dark'"
                                    class="stroke-neutral-700 dark:stroke-neutral-100">
                                    <svg width="18" height="18" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.2121 5L5.87879 11.3333L3 8.45455" stroke-width="1.2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </Transition>
                </div>
            </div>
        </nav>
    </header>
</template>

<script setup>
    import {
        ref,
        computed,
        onMounted,
        onUnmounted
    } from 'vue'
    import {
        Link,
        usePage
    } from '@inertiajs/vue3'

    const page = usePage()
    const logoPath = computed(() => page.props.logoPath)
    const appName = computed(() => page.props.appName)
    const appUrl = computed(() => page.props.appUrl)

    const currentTheme = ref('light')
    const dropdownOpen = ref(false)

    const toggleDropdown = () => {
        dropdownOpen.value = !dropdownOpen.value
    }

    const setTheme = (theme) => {
        currentTheme.value = theme
        localStorage.setItem('color-theme', theme)

        if (theme === 'dark') {
            document.documentElement.classList.add('dark')
        } else if (theme === 'light') {
            document.documentElement.classList.remove('dark')
        } else if (theme === 'system') {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches
            document.documentElement.classList.toggle('dark', prefersDark)
        }

        dropdownOpen.value = false
    }

    const handleClickOutside = (event) => {
        const dropdown = event.target.closest('.relative')
        if (!dropdown && dropdownOpen.value) {
            dropdownOpen.value = false
        }
    }

    onMounted(() => {
        const savedTheme = localStorage.getItem('color-theme') || 'system'
        currentTheme.value = savedTheme

        if (savedTheme === 'dark') {
            document.documentElement.classList.add('dark')
        } else if (savedTheme === 'light') {
            document.documentElement.classList.remove('dark')
        } else {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches
            document.documentElement.classList.toggle('dark', prefersDark)
        }

        document.addEventListener('click', handleClickOutside)
    })

    onUnmounted(() => {
        document.removeEventListener('click', handleClickOutside)
    })
</script>
