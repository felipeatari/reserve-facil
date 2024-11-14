<script setup>
import Layout from '../../Components/Layouts/App.vue'
import axios from 'axios'
import { router, useForm } from '@inertiajs/vue3'

defineProps({
    user: Object,
    errors: Object,
})

const form = useForm({
    name: null,
    zip_code: null,
    city: null,
    state: null,
    address: null,
    website: null,
})

const search = async (event) => {
    form.zip_code = event.target.value

    await axios
        .get(`https://viacep.com.br/ws/${form.zip_code}/json/`)
        .then(response => {
            if (response.data.erro) return

            form.zip_code = response.data.cep
            form.city = response.data.localidade
            form.state = response.data.estado
            form.address = response.data.logradouro
        })
        .catch(error => {
            console.log(error.message)
        })
}

const store = () => router.post('/hotel/cadastar-salvar', form)

const backToPage = () => window.history.back()
</script>

<template>
    <Layout :name="user.name">
        <div class="w-full flex justify-center mt-10">
            <div class="bg-white w-[50em] px-10 py-10 shadow">
                <h1 class="font-semibold text-xl mb-5">Cadastrar um Hotel</h1>

                <form @submit.prevent="store">
                    <div class="flex flex-col">
                        <span class="text-sm border border-red-200 bg-red-100 text-red-600 px-2 py-1 mt-1 mb-1"
                            v-for="error in errors">{{ error }}</span>
                    </div>

                    <div class="flex flex-col">
                        <div class="mt-3 mb-3 flex">
                            <span class="px-2 py-1 font-semibold">Nome:</span>
                            <input v-model="form.name" class="w-full px-2 py-1 border rounded-md" type="text">
                        </div>

                        <div class="flex">
                            <div class="mt-3 mb-3 flex">
                                <span class="px-2 py-1 font-semibold">CEP:</span>
                                <input v-model="form.zip_code" @input="search" class="w-full px-2 py-1 border rounded-md"
                                    type="text">
                            </div>

                            <div class="mt-3 mb-3 flex">
                                <span class="px-2 py-1 font-semibold">Cidade:</span>
                                <input v-model="form.city" class="w-full px-2 py-1 border rounded-md" type="text">
                            </div>

                            <div class="mt-3 mb-3 flex">
                                <span class="px-2 py-1 font-semibold">Estado:</span>
                                <input v-model="form.state" class="w-full px-2 py-1 border rounded-md" type="text">
                            </div>
                        </div>

                        <div class="mt-3 mb-3 flex">
                            <span class="px-2 py-1 font-semibold">Endereço:</span>
                            <input v-model="form.address" class="w-full px-2 py-1 border rounded-md" type="text">
                        </div>

                        <div class="mt-3 mb-3 flex">
                            <span class="px-2 py-1 font-semibold">Site:</span>
                            <input v-model="form.website" class="w-full px-2 py-1 border rounded-md" type="text">
                        </div>
                    </div>

                    <button class="border px-3 py-1 mt-5 mr-2 font-semibold bg-blue-500 hover:bg-blue-700 text-white rounded shadow-sm">Salvar</button>
                    <button @click="backToPage()" class="border px-3 py-1 mt-5 font-semibold bg-yellow-500 hover:bg-yellow-700 text-white rounded shadow-sm">Cancelar</button>
                </form>
            </div>
        </div>
    </Layout>
</template>
