<script setup="ts">
definePageMeta({
    layout: 'guest',
    middleware: ['guest']
})

const authStore = useAuthStore()

const form = ref({
    email: "test@example.com",
    password: "password",
})

const handleLogin = async () => {

    await authStore.login(form.value)

    navigateTo("/")
}

/* const getUser = async () => {
    console.log(authStore.user)
} */
</script>

<template>
    <div class="container mx-auto max-w-sm p-8 rounded-md shadow-md bg-white">
        <form @submit.prevent="handleLogin">
            <h2 class="text-2xl font-semibold text-center mb-4">Login</h2>

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

            <div class="flex justify-between items-center">
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-blue-500 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <span class="inline-flex items-center">
                        Login
                    </span>
                </button>
                <!-- <button @click="getUser" type="button"
                    class="px-4 py-2 rounded-md bg-blue-500 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Get User
                </button> -->
                <NuxtLink href="/register"
                    class="px-4 py-2 rounded-md bg-blue-500 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Register
                </NuxtLink>
            </div>
        </form>
    </div>
</template>

<script>

</script>