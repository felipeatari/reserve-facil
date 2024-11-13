<script setup>
import BackIcon from '../../Components/Icons/Back.vue'
import Layout from '../../Components/Layouts/App.vue'
import { ref } from 'vue'

const props = defineProps({
    hotel: Object,
    countRooms: Number,
    rooms: Object,
    user: Object,
})

const more = ref(3)
const loadRooms = ref(props.rooms)

const moreRooms = async (event) => {
    more.value += 3

    await axios
        .get(`/mais-vagas/${props.hotel.id}/${more.value}`)
        .then(response => {
            if (!response.data) return

            loadRooms.value = response.data
        })
        .catch(error => {
            console.log(error.message)
        })
}

const backToPage = () => window.history.back()

const legendRooms = (countRooms) => {
    if (countRooms == 1) {
        return 'quarto disponível.'
    }

    return 'quartos disponíveis.'
}
</script>

<template>
    <Layout :name="user.name">
        <div class="w-full h-full flex flex-col items-center">
            <div class="w-[60em] flex flex-col mt-10 pt-6 pl-6 pr-6 text-bg-slate-950 bg-white shadow">
                <div class="mb-6">
                    <button @click="backToPage()" class="border px-3 py-2 bg-gray-500 hover:bg-gray-700 text-white rounded shadow-sm">
                        <BackIcon />
                    </button>
                </div>

                <div class="flex items-start justify-between m-3">
                    <div>
                        <h1 class="font-semibold text-2xl">Hotel {{ hotel.name }}</h1>
                        <p>Possuí {{ countRooms }} {{ legendRooms(countRooms) }}</p>
                    </div>

                    <button v-if="countRooms > more" @click="moreRooms" class="border px-3 py-2 font-semibold bg-blue-500 hover:bg-blue-700 text-white rounded shadow-sm">Mais Quartos</button>
                </div>

                <div class="w-full h-[20em] mt-6 mb-6 p-4 overflow-auto scrollbar">
                    <div v-for="(room, i) in loadRooms" :key="i" class="w-full flex flex-col mb-2 mt-2 p-6 border">

                        <div class="mb-1">
                            <span class="font-semibold">Quarto: </span>
                            <span>{{ i + 1 }}</span>
                        </div>

                        <div class="mb-1">
                            <span class="font-semibold">Nome: </span>
                            <span>{{ room.name }}</span>
                        </div>

                        <div>
                            <span class="font-semibold">Decrição: </span>
                            <span>{{ room.description }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
