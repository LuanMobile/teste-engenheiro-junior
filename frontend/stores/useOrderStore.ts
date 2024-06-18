import type { Order } from "~/types/order";

export const useOrderStore = defineStore("order", () => {
  const order = ref<Order | null>(null);

  async function fetchOrders() {
    const orders = await useApi("/api/order/orders");

    order.value = orders.data.value as Order;
  }

  return { fetchOrders };
});
