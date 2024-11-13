<script setup>
import { Link, router } from '@inertiajs/vue3'
import Layout from '../../Components/Layouts/App.vue'
import BackIcon from '../../Components/Icons/Back.vue'
import UpdateIcon from '../../Components/Icons/Update.vue'
import ModalDelete from '../../Components/Helpers/ModalDelete.vue'

const props = defineProps({
    hotel: Object,
    user: Object,
    page: String,
})

const backToPage = () => router.get(`/hotel/listar?pagina=${props.page}`)
</script>

<template>
    <Layout :name="user.name">
        <div class="w-full flex justify-center mt-10">
            <div class="bg-white w-[900px] px-10 py-10 shadow">
                <div class="w-full mb-5">
                    <div class="w-full flex items-center justify-between mb-10">
                        <button @click="backToPage()" class="border px-3 py-2 font-semibold bg-gray-500 hover:bg-gray-700 text-white rounded shadow-sm">
                            <BackIcon />
                        </button>

                        <div class="flex">
                            <Link :href="`/hotel/editar/${hotel.id}`" class="border px-3 py-2 mr-2 bg-yellow-500 hover:bg-yellow-700 text-white rounded shadow-sm">
                                <UpdateIcon />
                            </Link>

                            <ModalDelete :entityId="`${hotel.id}`" :entityName="`${hotel.name}`" :entityType="'hotel'" />
                        </div>
                    </div>
                </div>

                <h1 class="font-semibold text-xl mb-5">Dados do Hotel</h1>

                <div class="w-full flex flex-col">
                    <div class="w-full flex items-center mt-3 mb-3">
                        <span class="font-semibold px-2 py-1">Nome: </span>
                        <div class="w-full border px-2 py-1 rounded-md">{{ hotel.name }}</div>
                    </div>

                    <div class="w-full flex items-center justify-between mt-3 mb-3">
                        <div class="flex w-full">
                            <span class="font-semibold px-2 py-1">CEP: </span>
                            <div class="w-full border px-2 py-1 rounded-md">{{ hotel.zip_code }}</div>
                        </div>
                        <div class="flex w-full">
                            <span class="font-semibold px-2 py-1">Cidade: </span>
                            <div class="w-full border px-2 py-1 rounded-md">{{ hotel.city }}</div>
                        </div>
                        <div class="flex w-full">
                            <span class="font-semibold px-2 py-1">Estado: </span>
                            <div class="w-full border px-2 py-1 rounded-md">{{ hotel.state }}</div>
                        </div>
                    </div>

                    <div class="w-full flex items-center mt-3 mb-3">
                        <span class="font-semibold px-2 py-1">Endereço: </span>
                        <div class="w-full border px-2 py-1 rounded-md">{{ hotel.address }}</div>
                    </div>

                    <div class="w-full flex items-center mt-3 mb-3">
                        <span class="font-semibold px-2 py-1">Site: </span>
                        <div class="w-full border px-2 py-1 rounded-md">{{ hotel.website ?? 'Não informado' }}</div>
                    </div>

                    <div class="w-full flex items-center justify-between mt-3 mb-3">
                        <div class="flex w-full">
                            <span class="font-semibold px-2 py-1">Criado: </span>
                            <div class="w-full border px-2 py-1 rounded-md">{{ hotel.created }}</div>
                        </div>
                        <div class="flex w-full">
                            <span class="font-semibold px-2 py-1">Editado: </span>
                            <div class="w-full border px-2 py-1 rounded-md">{{ hotel.updated }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
