<script setup>
import Layout from '../../Components/Layouts/App.vue'
import { Link } from '@inertiajs/vue3'
import Pagination from '../../Components/Helpers/Pagination.vue'

defineProps({
    hotel: Object,
    pagination: Object,
    user: Object,
})

const legendRooms = (hotelVacancies) => {
    if (hotelVacancies == 1) {
        return 'quarto disponível.'
    }

    return 'quartos disponíveis.'
}
</script>

<template>
    <Layout :name="user.name">
        <div class="w-full flex flex-col items-center mt-5">
            <div class="w-[80em] h-[30em] flex items-center justify-center flex-wrap mb-5">
                <div v-for="hotelItem in hotel.data" :key="hotelItem.id" class="w-80 flex flex-col bg-white shadow m-2">
                    <Link :href="`/vagas/${hotelItem.id}`" class="w-full p-8">
                        <h1 class="font-semibold mb-2">{{ hotelItem.name }}</h1>
                        <p>Possuí {{ hotelItem.roomsCount }} {{ legendRooms(hotelItem.roomsCount) }}</p>
                    </Link>
                </div>
            </div>

            <Pagination :pagination="pagination" />
        </div>
    </Layout>
</template>
