<script setup>
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({ pagination: Object })
</script>

<template>
    <div v-if="pagination.data.length > 0" class="w-full flex items-center justify-center">
        <div v-for="link in pagination.links">
            <Link v-if="link.label == 'pagination.previous' && link.url != null"
            class="border px-3 py-1 ml-1 font-semibold"
            :href="`${link.url}`"
            > < </Link>

            <a v-if="link.label == 'pagination.previous' && link.url == null"
            class="border px-3 py-1 ml-1 font-semibold text-gray-400"
            > < </a>

            <Link
            v-if="link.label != 'pagination.previous' && link.label != 'pagination.next' && link.url"
            class="border px-3 py-1 ml-1 font-semibold"
            :class="[link.active ? 'bg-gray-300' : '']"
            :href="`${link.url}`"
            > {{ link.label }} </Link>

            <Link v-if="link.label == 'pagination.next' && link.url != null"
            class="border px-3 py-1 ml-1 font-semibold"
            :href="`${link.url}`"
            :disabled="true"
            > > </Link>

            <a v-if="link.label == 'pagination.next' && link.url == null"
            class="border px-3 py-1 ml-1 font-semibold text-gray-400"
            > > </a>
        </div>
    </div>
</template>
