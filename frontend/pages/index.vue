<script setup="ts">
definePageMeta({
    layout: 'auth',
    middleware: ['auth']
})

// pedidos do cliente
const orders = await useApi("/api/order/orders")

const getOrders = orders.data.value

const newOrder = async () => {
    navigateTo('/pedido/novopedido')
}

</script>
<template>
    <h1 class="text-3xl text-green-700 font-bold underline text-center">
        Meus pedidos
    </h1>
    <div class="container mx-auto px-5 py-10">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                            Produto
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                            Category
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                            Valor do Pedido
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr v-for="(order, index) in getOrders" :key="index">
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-b border-gray-200">
                            {{ order.id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b border-gray-200">{{
                            order.status }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b border-gray-200">R$ {{
                            order.valor_total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-4 text-right">
            <button @click="newOrder"
                class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Novo Pedido
            </button>
        </div>
    </div>
</template>