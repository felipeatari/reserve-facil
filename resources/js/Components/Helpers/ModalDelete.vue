<script setup>
import DeleteIcon from '../../Components/Icons/Delete.vue'
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'

defineProps({
    entityId: String,
    entityName: String,
    entityType: String
})

const closeModalDelete = ref(false)
</script>

<template>
    <button @click="closeModalDelete = !closeModalDelete" class="border px-3 py-2 bg-red-500 hover:bg-red-700 text-white rounded shadow-sm">
        <DeleteIcon />
    </button>

    <div v-if="closeModalDelete" class="w-full flex justify-center fixed inset-0 bg-black bg-opacity-80">
        <div class="w-[30em] h-[12em] mt-10 shadow-lg flex items-center justify-center flex-col bg-white">

            <div class="w-full text-center">
                <h1 v-if="entityType == 'hotel'" class="font-bold mb-10">Apagar hotel {{ entityName }}?</h1>
                <h1 v-if="entityType == 'room'" class="font-bold mb-10">Apagar quarto {{ entityName }}?</h1>
            </div>

            <div class="w-[200px] flex justify-evenly">
                <Link v-if="entityType == 'hotel'" :href="`/hotel/apagar/${entityId}`" class="border px-4 py-1 font-semibold bg-red-500 hover:bg-red-700 text-white rounded shadow-sm">Sim</Link>
                <Link v-if="entityType == 'room'" :href="`/quarto/apagar/${entityId}`" class="border px-4 py-1 font-semibold bg-red-500 hover:bg-red-700 text-white rounded shadow-sm">Sim</Link>

                <button @click="closeModalDelete = !closeModalDelete" class="border px-3 py-1 bg-gray-500 hover:bg-gray-700 text-white rounded shadow-sm">Não</button>
            </div>
        </div>
    </div>
</template>
