<script setup>
import Layout from '../../Components/Layouts/App.vue'
import { router, useForm } from '@inertiajs/vue3'

const props = defineProps({
    errors: Object,
    room: Object,
    hotels: Object,
    userName: String,
})

const form = useForm({
    hotel_id: props.room.hotel_id,
    name: props.room.name,
    description: props.room.description,
})

const update = () => router.post(`/quarto/editar-salvar/${props.room.id}`, form)

const backToPage = () => router.get(`/quarto/ver/${props.room.id}`)
</script>

<template>
    <Layout :name="userName">
        <div class="w-full flex justify-center mt-10">
            <div class="bg-white w-[50em] px-10 py-10 shadow">

                <h1 class="font-semibold text-xl mb-5">Editar um Quarto</h1>

                <form @submit.prevent="update">
                    <div class="flex flex-col">
                        <span v-for="error in errors" class="text-sm border border-red-200 bg-red-100 text-red-600 px-2 py-1 mt-1 mb-1">{{ error }}</span>
                    </div>

                    <div class="flex flex-col">
                        <div class="mt-3 mb-3 flex">
                            <span class="py-1 mr-2 font-semibold">Hotel:</span>
                            <select v-model="form.hotel_id" class="w-full border px-2 py-1 overflow-auto scrollbar">
                                <option></option>
                                <option v-for="hotel in hotels" :key="hotel.id" :value="hotel.id">{{ hotel.name }}
                                </option>
                            </select>
                        </div>

                        <div class="mt-3 mb-3 flex">
                            <span class="py-1 mr-2 font-semibold">Nome:</span>
                            <input v-model="form.name" class="w-full px-2 py-1 border rounded-md" type="text">
                        </div>

                        <div class="mt-3 mb-3 flex">
                            <div class="w-full">
                                <span class="py-1 font-semibold">Descricao:</span>
                                <textarea v-model="form.description"
                                    class="w-full h-32 border rounded-md px-2 py-1"></textarea>
                            </div>
                        </div>
                    </div>

                    <button class="border px-3 py-1 mt-5 mr-2 font-semibold bg-blue-500 hover:bg-blue-700 text-white rounded shadow-sm">Salvar</button>
                    <button @click="backToPage()" class="border px-3 py-1 mt-5 font-semibold bg-yellow-500 hover:bg-yellow-700 text-white rounded shadow-sm">Cancelar</button>
                </form>
            </div>
        </div>
    </Layout>
</template>
