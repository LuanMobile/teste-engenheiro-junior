<script setup="ts">
definePageMeta({
    layout: 'guest',
    middleware: ['guest']
})

const handleRegister = async () => {
    await useApi('/register', { mehod: 'POST', body: form.value })
}

</script>

<template>
    <div class="container mx-auto max-w-sm p-8 rounded-md shadow-md bg-white">
        <form @submit.prevent="handleRegister">
            <h2 class="text-2xl font-semibold text-center mb-4">Register</h2>

            <div class="flex flex-col mb-4">
                <label for="name" class="text-sm font-medium text-gray-700">Full Name:</label>
                <input v-model="form.name" type="text" id="name"
                    class="rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            </div>

            <div class="flex flex-col mb-4">
                <label for="email" class="text-sm font-medium text-gray-700">Email:</label>
                <input v-model="form.email" type="email" id="email"
                    class="rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            </div>

            <div class="flex flex-col mb-4">
                <label for="password" class="text-sm font-medium text-gray-700">Password:</label>
                <input v-model="form.password" type="password" id="password"
                    class="rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            </div>

            <div class="flex flex-col mb-4">
                <label for="confirmPassword" class="text-sm font-medium text-gray-700">Confirm Password:</label>
                <input v-model="form.confirmPassword" type="password" id="confirmPassword"
                    class="rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            </div>

            <div class="flex justify-between items-center">
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-blue-500 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <span class="inline-flex items-center">
                        Register
                    </span>
                </button>
            </div>
        </form>
    </div>
</template>