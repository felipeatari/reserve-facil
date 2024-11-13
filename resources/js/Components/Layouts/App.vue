<script setup>
import HomeIcon from '../Icons/Home.vue'
import HotelIcon from '../Icons/Hotel.vue'
import { Link } from '@inertiajs/vue3'
import LogoutIcon from '../Icons/Logout.vue'
import RoomIcon from '../Icons/Room.vue'

const props = defineProps({
    name: {
        type: String,
        default: ''
    }
})

const firstLetterName = props.name.charAt(0).toUpperCase()
</script>

<template>
  <main class="w-full h-screen flex bg-gray-50 text-gray-900">
    <div class="w-72 h-full flex flex-col justify-between p-4 border-r bg-white">
        <header class="w-full h-full py-3 font-semibold">
            <div class="w-full flex flex-col items-center mb-12">
                <img class="h-20" src="/public/images/logo.png" alt="">
            </div>

            <nav class="w-full px-2 flex flex-col">
                <Link href="/" class="mt-1 mb-1 px-2 py-2 hover:bg-slate-100">
                    <div class="flex">
                        <HomeIcon />
                        <span class="ml-10">Home</span>
                    </div>
                </Link>

                <Link href="/hotel/listar" class="mt-1 mb-1 px-2 py-2 hover:bg-slate-100">
                    <div class="flex">
                        <HotelIcon />
                        <span class="ml-10">Hotel</span>
                    </div>
                </Link>

                <Link href="/quarto/listar" class="mt-1 mb-1 px-2 py-2 hover:bg-slate-100">
                    <div class="flex">
                        <RoomIcon />
                        <span class="ml-10">Quarto</span>
                    </div>
                </Link>
            </nav>
        </header>

        <footer class="w-full flex justify-center">
            <span class="text-sm text-gray-600">&copy; Teste Bukly</span>
        </footer>
    </div>

    <div class="w-full h-full flex flex-col">
        <div class="w-full flex items-center justify-between border-b font-semibold py-6 px-4 bg-white relative">
            <span class="font-semibold">Olá, {{ name }}</span>
            <div class="flex items-center">
                <Link href="/logout" class="mr-5 flex items-center">
                    <LogoutIcon />
                </Link>
                <div class="bg-gray-800 text-white w-8 h-8 flex items-center justify-center rounded-full">{{ firstLetterName }}</div>
            </div>
        </div>

        <article class="w-full h-full">
            <slot />
        </article>
    </div>
  </main>
</template>
