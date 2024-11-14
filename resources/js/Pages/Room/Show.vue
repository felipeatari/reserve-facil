<script setup>
import BackIcon from '../../Components/Icons/Back.vue'
import Layout from '../../Components/Layouts/App.vue'
import { Link, router } from '@inertiajs/vue3'
import ModalDelete from '../../Components/Helpers/ModalDelete.vue'
import UpdateIcon from '../../Components/Icons/Update.vue'

const props = defineProps({
    hotelName: String,
    room: Object,
    page: String,
    userName: String,
})

const backToPage = () => router.get(`/quarto/listar?pagina=${props.page}`)
</script>

<template>
    <Layout :name="userName">
        <div class="w-full flex justify-center mt-10">
            <div class="bg-white w-[900px] px-10 py-10 shadow">
                <div class="w-full mb-5">
                    <div class="w-full flex items-center justify-between mb-10">
                        <button @click="backToPage()" class="border px-3 py-2 font-semibold bg-gray-500 hover:bg-gray-700 text-white rounded shadow-sm">
                            <BackIcon />
                        </button>

                        <div class="flex">
                            <Link :href="`/quarto/editar/${room.id}`" class="border px-3 py-2 mr-2 bg-yellow-500 hover:bg-yellow-700 text-white rounded shadow-sm">
                            <UpdateIcon />
                            </Link>

                            <ModalDelete :entityId="`${room.id}`" :entityName="`${room.name}`" :entityType="'room'" />
                        </div>
                    </div>
                </div>

                <h1 class="font-semibold text-xl mb-5">Dados do Quarto</h1>

                <div class="w-full flex flex-col">
                    <div class="w-full flex items-center mt-3 mb-3">
                        <span class="font-semibold px-2 py-1">Hotel: </span>
                        <div class="w-full border px-2 py-1 rounded-md">{{ hotelName ?? 'Não informado' }}</div>
                    </div>

                    <div class="w-full flex items-center mt-3 mb-3">
                        <span class="font-semibold px-2 py-1">Nome: </span>
                        <div class="w-full border px-2 py-1 rounded-md">{{ room.name }}</div>
                    </div>

                    <div class="w-full mt-3 mb-3">
                        <span class="font-semibold px-2 py-1">Descrição: </span>
                        <div class="w-full h-32 border px-2 py-1 rounded-md">{{ room.description }}</div>
                    </div>

                    <div class="w-full flex items-center justify-between mt-3 mb-3">
                        <div class="flex w-full">
                            <span class="font-semibold px-2 py-1">Criado: </span>
                            <div class="w-full border px-2 py-1 rounded-md">{{ room.created }}</div>
                        </div>
                        <div class="flex w-full">
                            <span class="font-semibold px-2 py-1">Editado: </span>
                            <div class="w-full border px-2 py-1 rounded-md">{{ room.updated }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
