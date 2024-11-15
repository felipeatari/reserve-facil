<script setup>
import Layout from '../../Components/Layouts/App.vue'
import { Link } from '@inertiajs/vue3'
import Pagination from '../../Components/Helpers/Pagination.vue'
import { ref } from 'vue'
import Table from '../../Components/Helpers/Table.vue'

defineProps({
    room: Object,
    page: String,
    userName: String,
})

const entityType = ref('room')
</script>

<template>
    <Layout :name="userName">
        <div class="w-full flex justify-center mt-10">
            <div v-if="room.data" class="bg-white w-full p-10 ml-10 mr-10 shadow">
                <Link :href="'/quarto/cadastrar'">
                    <button class="border px-3 py-1 mb-7 font-semibold bg-blue-500 hover:bg-blue-700 text-white rounded shadow-sm">Cadastrar</button>
                </Link>

                <div class="w-full h-[22em] flex flex-col justify-between">
                    <Table :entity="room" :entityType="entityType" :page="page" />

                    <Pagination :pagination="room" />
                </div>
            </div>
            <div v-else class="bg-white w-full p-10 shadow">
                <span>Nenhum quarto cadastrado.</span>
            </div>
        </div>
    </Layout>
</template>
