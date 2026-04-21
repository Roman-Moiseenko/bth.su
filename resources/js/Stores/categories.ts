import { useFetch } from '@vueuse/core'
import {defineStore} from "pinia";
export const useCategoriesStore = defineStore('auth', () => {
    // @ts-ignore
    const url = import.meta.env.VITE_API_BASE_URL


    const {data: category} = useFetch(`${url}/categories`)

    return {
        list: category
    }
})
