import { useAuthStore } from "~/stores/useAuthStore";

export default defineNuxtPlugin(async (nuxtApp) => {
  const store = useAuthStore();

  try {
    await store.fetchUser();
    navigateTo("/");
  } catch (e) {
    console.error(e);
    navigateTo("/login");
  }
});
