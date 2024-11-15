<script setup>
import { computed } from 'vue'
import { Head } from '@inertiajs/vue3';

const props = defineProps({ status: Number })

const title = computed(() => {
  return {
    401: '401 Unauthorized',
    402: '402 Payment Required',
    403: '403 Forbidden',
    404: '404 Page Not Found',
    419: '419 Page Expired',
    429: '429 Too Many Requests',
    500: '500 Server Error',
    503: '503 Service Unavailable',
  }[props.status]
})

const description = computed(() => {
  return {
    401: 'Sorry, you do not have authorization to access.',
    402: 'Sorry, request requires payment.',
    404: 'Sorry, the page you are looking for could not be found.',
    403: 'Sorry, you are forbidden from accessing this page.',
    419: 'Sorry, the page expired, please try again.',
    429: 'Sorry, you made a lot of requests.',
    500: 'Whoops, something went wrong on our servers.',
    503: 'Sorry, we are doing some maintenance. Please check back soon.',
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
