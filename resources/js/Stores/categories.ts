import { useFetch } from '@vueuse/core'
import {defineStore} from "pinia";
import {ref} from "vue";
export const useCategoriesStore = defineStore('categories', () => {
    // @ts-ignore
    const url = import.meta.env.VITE_API_BASE_URL
    const loaded = ref<Boolean>(true)
    const list = ref([])
    fetch(`${url}/categories`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
    }).then(response => {
        if (!response.ok) {
            throw new Error(`Ошибка HTTP: ${response.status}`);
        }
        return response.json();
    }).then(results => {
        list.value = [...results]
        loaded.value = false
    });

    return {
        list,
        loaded
    }
})
