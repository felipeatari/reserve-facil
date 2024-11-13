<script setup>
import Layout from '../../Components/Layouts/App.vue'
import axios from 'axios'
import { onMounted, ref } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

const props = defineProps({
    user: Object,
    errors: Object,
    hotel: Object,
})

const name = ref(props.hotel.name)
const zipCode = ref(props.hotel.zip_code)
const city = ref(props.hotel.city)
const state = ref(props.hotel.state)
const address = ref(props.hotel.address)
const website = ref(props.hotel.website)


const search = async (event) => {
    zipCode.value = event.target.value

    await axios
        .get(`https://viacep.com.br/ws/${zipCode.value}/json/`)
        .then(response => {
            if (response.data.erro) return

            zipCode.value = response.data.cep
            city.value = response.data.localidade
            state.value = response.data.estado
            address.value = response.data.logradouro
        })
        .catch(error => {
            console.log(error.message)
        })
}

const update = () => {
    const page = usePage()

    const form = ref({
        _token: page.props.csrf_token,
        name: name.value,
        zip_code: zipCode.value,
        city: city.value,
        state: state.value,
        address: address.value,
        website: website.value,
    })

    router.post(`/hotel/editar-salvar/${props.hotel.id}`, form.value)
}

const backToPage = () => router.get(`/hotel/ver/${props.hotel.id}`)
</script>

<template>
    <Layout :name="user.name">
        <div class="w-full flex justify-center mt-10">
            <div class="bg-white w-[50em] px-10 py-10 shadow">
                <h1 class="font-semibold text-xl mb-5">Editar um Hotel</h1>
                <form @submit.prevent="update">
                    <div class="flex flex-col">
                        <span class="text-sm border border-red-200 bg-red-100 text-red-600 px-2 py-1 mt-1 mb-1"
                            v-for="error in errors">{{ error }}</span>
                    </div>

                    <div class="flex flex-col">
                        <div class="mt-3 mb-3 flex">
                            <span class="px-2 py-1 font-semibold">Nome:</span>
                            <input v-model="name" class="w-full px-2 py-1 border rounded-md" type="text">
                        </div>

                        <div class="flex">
                            <div class="mt-3 mb-3 flex">
                                <span class="px-2 py-1 font-semibold">CEP:</span>
                                <input v-model="zipCode" @input="search" class="w-full px-2 py-1 border rounded-md"
                                    type="text">
                            </div>

                            <div class="mt-3 mb-3 flex">
                                <span class="px-2 py-1 font-semibold">Cidade:</span>
                                <input v-model="city" class="w-full px-2 py-1 border rounded-md" type="text">
                            </div>

                            <div class="mt-3 mb-3 flex">
                                <span class="px-2 py-1 font-semibold">Estado:</span>
                                <input v-model="state" class="w-full px-2 py-1 border rounded-md" type="text">
                            </div>
                        </div>

                        <div class="mt-3 mb-3 flex">
                            <span class="px-2 py-1 font-semibold">Endereço:</span>
                            <input v-model="address" class="w-full px-2 py-1 border rounded-md" type="text">
                        </div>

                        <div class="mt-3 mb-3 flex">
                            <span class="px-2 py-1 font-semibold">Site:</span>
                            <input v-model="website" class="w-full px-2 py-1 border rounded-md" type="text">
                        </div>
                    </div>

                    <button class="border px-3 py-1 mt-5 mr-2 font-semibold bg-blue-500 hover:bg-blue-700 text-white rounded shadow-sm">Salvar</button>
                    <button @click="backToPage()" class="border px-3 py-1 mt-5 font-semibold bg-yellow-500 hover:bg-yellow-700 text-white rounded shadow-sm">Cancelar</button>
                </form>
            </div>
        </div>
    </Layout>
</template>
