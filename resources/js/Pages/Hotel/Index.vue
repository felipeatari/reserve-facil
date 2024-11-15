<script setup>
import Layout from '../../Components/Layouts/App.vue'
import { Link } from '@inertiajs/vue3'
import Pagination from '../../Components/Helpers/Pagination.vue'
import { ref } from 'vue'
import Table from '../../Components/Helpers/Table.vue'

defineProps({
    hotel: Object,
    pagination: Object,
    userName: String,
    page: String,
})

const entityType = ref('hotel')
</script>

<template>
    <Layout :name="userName">
        <div class="w-full flex justify-center mt-10">
            <div v-if="hotel.data" class="bg-white w-full p-10 ml-10 mr-10 shadow">
                <Link :href="'/hotel/cadastrar'">
                    <button class="border px-3 py-1 mb-7 font-semibold bg-blue-500 hover:bg-blue-700 text-white rounded shadow-sm">Cadastrar</button>
                </Link>

                <div class="w-full h-[22em] flex flex-col justify-between">
                    <Table :entity="hotel" :entityType="entityType" :page="page" />

                    <Pagination :pagination="hotel" />
                </div>
            </div>
            <div v-else class="bg-white w-full p-10 shadow">
                <span>Nenhum hotel cadastrado.</span>
            </div>
        </div>
    </Layout>
</template>
