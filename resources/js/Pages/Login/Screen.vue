<script setup>
import { router, useForm } from '@inertiajs/vue3'

defineProps({ errors: Object })

const form = useForm({
    email: null,
    password: null,
})

const login = () => router.post('/authenticate', form)
</script>
<template>
    <div class="w-full h-screen flex flex-col items-center bg-gray-50">

        <div class="w-80 flex flex-col items-center justify-between bg-white shadow mb-5 mt-20">
            <img class="h-[4em] mt-10" src="/public/images/logo.png" alt="">

            <form class="px-8 mt-5 mb-5" @submit.prevent="login">
                <div class="flex flex-col">
                    <span class="text-sm border border-red-200 bg-red-100 text-red-600 px-2 py-1 mt-1 mb-1"
                        v-for="error in errors">{{ error }}</span>
                </div>

                <input v-model="form.email" class="w-full px-3 py-2 mt-2 mb-2 text-sm border rounded-md"
                    placeholder="E-Mail" type="text">

                <input v-model="form.password" class="w-full px-3 py-2 mt-2 mb-2 text-sm border rounded-md"
                    placeholder="Senha" type="password">

                <button
                    class="w-full px-3 py-2 mt-2 mb-2 border rounded-md font-semibold bg-blue-500 hover:bg-blue-700 text-white">Login</button>
            </form>
        </div>

    </div>
</template>
