<script setup>
import { computed } from 'vue'
import { Head } from '@inertiajs/vue3';

const props = defineProps({ status: Number })

const title = computed(() => {
  return {
    503: '503 Service Unavailable',
    500: '500 Server Error',
    404: '404 Page Not Found',
    403: '403 Forbidden',
  }[props.status]
})

const description = computed(() => {
  return {
    503: 'Sorry, we are doing some maintenance. Please check back soon.',
    500: 'Whoops, something went wrong on our servers.',
    404: 'Sorry, the page you are looking for could not be found.',
    403: 'Sorry, you are forbidden from accessing this page.',
  }[props.status]
})

const backToPage = () => window.history.back()
</script>

<template>
    <Head>
        <title>{{ title }}</title>
    </Head>
  <div class="w-full h-screen bg-gray-50 text-gray-700 flex flex-col items-center">
            <img class="h-16 mt-20" src="/public/images/logo.png" alt="Logo RF">

            <div class="px-4 text-xl mt-20 mb-20 text-center">
                <h1 class="font-semibold text-2xl mb-5">{{ title }}</h1>
                <span class="text-lg">{{ description }}</span>
            </div>

            <button @click="backToPage()" class="hover:underline">Voltar para a página anterior</button>
        </div>
</template>
