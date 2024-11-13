<script setup>
import { Link } from '@inertiajs/vue3'
import ShowIcon from '../Icons/Show.vue'

defineProps({
    entity: Object,
    entityType: String,
    page: String,
})
</script>

<template>
    <div class="w-full flex justify-center">
        <div class="w-full border">
            <div class="w-full flex justify-between bg-slate-200">
                <div class="flex-1 flex justify-center items-center p-2 border font-semibold">ID</div>
                <div class="flex-1 flex justify-center items-center p-2 border font-semibold">Nome</div>
                <div class="flex-1 flex justify-center items-center p-2 border font-semibold">Ver</div>
            </div>

            <div v-for="entityItem in entity.data" :key="entityItem.id" class="w-full flex">
                <div class="flex-1 flex justify-center items-center p-2 border">{{ entityItem.id }}</div>
                <div class="flex-1 flex justify-center items-center p-2 border">{{ entityItem.name }}</div>
                <div class="flex-1 flex justify-center items-center p-2 border">
                    <Link v-if="entityType == 'hotel'" :href="`/hotel/ver/${entityItem.id}?pagina=${page}`">
                        <ShowIcon />
                    </Link>
                    <Link v-else-if="entityType == 'room'" :href="`/quarto/ver/${entityItem.id}?pagina=${page}`">
                        <ShowIcon />
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
