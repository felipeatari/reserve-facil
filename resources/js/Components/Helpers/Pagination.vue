<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({ pagination: Object })

const currentPageChecked = (page, pageChecked) => {
    return page == pageChecked
}
</script>

<template>
    <div class="w-full flex items-center justify-center">
        <Link v-if="pagination.nextPage" class="border px-3 py-1 ml-1 font-semibold" :href="`${pagination.previousPageUrl}`"> < </Link>
        <a v-else class="border px-3 py-1 ml-1 font-semibold text-gray-400"> < </a>

        <Link v-for="page in pagination.pages" :href="`?pagina=${page}`" class="border px-3 py-1 ml-1 mr-1" :class="[currentPageChecked(page, pagination.currentPageChecked) ? 'bg-gray-300' : '']">{{ page }}</Link>

        <Link v-if="pagination.previousPage" class="border px-3 py-1 ml-1 font-semibold" :href="`${pagination.nextPageUrl}`"> > </Link>
        <a v-else class="border px-3 py-1 ml-1 font-semibold text-gray-400"> > </a>
    </div>
</template>
