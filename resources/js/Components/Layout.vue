<script lang="ts" setup>
import {usePage, router, Link} from '@inertiajs/vue3'
import {type LoginForm, useAuthStore} from "../Stores/auth";
import {ref} from "vue";
const auth = useAuthStore()
const showLoginDialog = ref(false)
const form = ref<LoginForm>(auth.getInitLoginForm())

function handleLogin() {
    form.value = auth.getInitLoginForm()
    showLoginDialog.value = true
}
function onLogin() {
    auth.login(form.value).then(v => {
        showLoginDialog.value = false
    }).catch(reason => {
        //ElMessage
    })
}
function onManage()
{
    router.get('/admin/products', {}, auth.getHeader())
}
</script>

<template>

    <div class="container mx-auto">
        <div class="flex m-3 p-3">
            <div class="font-bold text-green-700 text-lg">
                <Link href="/" >API</Link>
            </div>
            <div class="ml-auto">
                <el-button v-if="auth.logged" type="success" @click="onManage" class="shadow shadow-slate-400">Управление товарами</el-button>
                <el-button v-if="auth.logged" type="danger" @click="auth.logout()" class="shadow shadow-slate-400">Logout</el-button>
                <el-button v-if="!auth.logged" @click="handleLogin" class="shadow shadow-slate-400" type="primary">Login</el-button>
            </div>
        </div>
        <slot/>

    </div>



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
