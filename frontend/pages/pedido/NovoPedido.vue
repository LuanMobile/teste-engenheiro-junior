<script setup="tss">

definePageMeta({
    layout: 'auth',
    middleware: ['auth']
})

const products = await useApi("/api/product/all")

const getProducts = products.data.value


const desconto = ref(15)
const quantity = ref([])
console.log(quantity.value);

const productId = quantity.value


const enviarDados = async () => {
    await useApi("/api/order/create", {
        method: 'POST',
        body: {
            itens: {
                products: quantity.value,
                quantidade: quantity.value,
            },
            desconto: desconto.value
        }
    })
}

</script>

<template>
    <h1 class="text-3xl text-green-700 font-bold underline text-center">
        Novo pedido
    </h1>
    <div class="container mx-auto px-5 py-10" id="app">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200 w-1/3">
                            Produto
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200 w-1/3">
                            Categoria
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200 w-1/3">
                            Valor do Produto
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200 w-1/3">
                            Quantidade
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr v-for="(product, index) in getProducts" :key="index">
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-b border-gray-200 w-1/3">
                            {{ product.name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b border-gray-200 w-1/3">
                            {{ product.category }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b border-gray-200 w-1/3">
                            R$ {{ product.price }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b border-gray-200 w-1/3">
                            <input type="number" v-model="quantity[product.id]" class="w-16 px-2 py-1 border rounded">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <label for="desconto" class="block text-sm font-medium text-gray-700">Desconto:</label>
            <input type="number" id="desconto" v-model="desconto" class="mt-1 block w-full px-3 py-2 border rounded-md">
        </div>
        <button @click="enviarDados" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Enviar Dados
        </button>
    </div>
</template>