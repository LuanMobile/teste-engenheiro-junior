<script setup>
const authStore = useAuthStore()
const user = authStore.user

const handleLogout = async () => {
    const store = useAuthStore()

    await store.logout()

    navigateTo('/login')
}
</script>

<template>
    <header class="bg-gray-800 text-white p-4 flex justify-between items-center">
        <div class="text-xl font-bold">Marketplace</div>
        <div class="flex items-center">
            <div class="mr-4">{{ user.name }}</div>
            <div class="relative">
                <button @click="handleLogout" class=" flex items-centerborder-2 p-2">Logout</button>

            </div>
        </div>
    </header>
    <slot />
</template>