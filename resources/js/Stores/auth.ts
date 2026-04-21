import { defineStore } from 'pinia'
import { useCookies } from 'vue3-cookies';
import {computed, ref, watch} from "vue";
export type User = {
    id: number
    name: string
    email: string
}
export type LoginForm = {
    email: string
    password: string
    remember: boolean
}
export const useAuthStore = defineStore('auth', () => {

    // @ts-ignore
    const url = import.meta.env.VITE_API_BASE_URL
    const tokenCookie = ref(useCookies().cookies.get('token'));

    const loggedCookie= computed(() => {
        return tokenCookie.value !== undefined && tokenCookie.value !== null
    })

    const getInitLoginForm = ()=> (<LoginForm>{
        email: null,
        password: null,
        remember: false
    })

    async function login(data: LoginForm) {

        const response = await fetch(`${url}/login`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(data),
        });
        if (!response.ok) {
            const errorData = await response.json().catch(() => ({}));
            throw new Error(errorData.message || `Ошибка входа: ${response.status}`);
        }
        const token = (await response.json()).token;
        tokenCookie.value = token
        useCookies().cookies.set('token', token, 3600 * 24 * 30)
        return 'success'
    }
    async function logout() {
        const response = await fetch(`${url}/logout`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${tokenCookie.value}`,
                'Accept': 'application/json',
            },
        });
        if (!response.ok) {
            const errorData = await response.json().catch(() => ({}));
            throw new Error(errorData.message || `Ошибка выхода: ${response.status}`);
        }
        tokenCookie.value = null;
        useCookies().cookies.set('token', '', -1)
        return 'success'
    }

    return {
        login,
        token: tokenCookie,
        logged: loggedCookie,
        logout,
        getInitLoginForm
    }
})
