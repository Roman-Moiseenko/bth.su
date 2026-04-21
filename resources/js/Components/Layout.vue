<script lang="ts" setup>
import { usePage } from '@inertiajs/vue3'
import {type LoginForm, useAuthStore} from "../Stores/auth";
import {ref} from "vue";
const auth = useAuthStore()

console.log('auth.logged', auth.logged)

const showLoginDialog = ref(false)
const form = ref<LoginForm>(auth.getInitLoginForm())
function handleLogin() {
    form.value = auth.getInitLoginForm()
    showLoginDialog.value = true
}
function onLogin() {
    auth.login(form.value).then(v => {
        console.log(v)
        showLoginDialog.value = false
    }).catch(reason => {
        //ElMessage
    })
}
</script>

<template>
    <div>
        Меню админа
        <el-button v-if="auth.logged" type="danger" @click="auth.logout()">Logout</el-button>
        <el-button v-else @click="handleLogin">Login</el-button>
    </div>
    <slot/>


    <el-dialog v-model="showLoginDialog" title="Login" width="400" :modal="true">
        <el-form :model="form" label-width="auto">
            <el-form-item label="Логин/Email">
                <el-input v-model="form.email" />
            </el-form-item>
            <el-form-item label="Пароль">
                <el-input v-model="form.password" type="password"/>
            </el-form-item>
            <el-form-item label="Запомнить меня">
                <el-checkbox v-model="form.remember" />
            </el-form-item>
        </el-form>

        <template #footer>
            <el-button type="danger" plain @click="showLoginDialog = false">Cancel</el-button>
            <el-button type="success" @click="onLogin">Login</el-button>
        </template>
    </el-dialog>
</template>

<style scoped>

</style>
