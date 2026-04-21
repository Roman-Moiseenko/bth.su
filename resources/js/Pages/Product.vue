<script lang="ts" setup>
import {defineProps} from "vue";
import {Head, Link, router} from "@inertiajs/vue3";
import {useAuthStore} from "../Stores/auth";

const props = defineProps({
    product: Object,
    title: {
        default: 'BTH.SU',
        type: String
    }
})
const auth = useAuthStore()

function goBack() {
    router.get(`/`)
}
</script>

<template>
    <Head><title>{{ title }} | {{ product.name }}</title></Head>

    <div class="p-2">
        <el-button @click="goBack" type="info" dark class="mt-5  shadow shadow-slate-400">К товарам</el-button>
    </div>
    <el-card shadow="always" class="mt-5">
        <el-descriptions
            title="Карточка товара"
            direction="vertical"
            :column="1"
            border
        >
            <el-descriptions-item label="Товар">{{ product.name }}</el-descriptions-item>
            <el-descriptions-item label="Категория">{{ product.category }}</el-descriptions-item>
            <el-descriptions-item label="Цена">
                <el-tag size="large" type="success">{{ product.price }} руб.</el-tag>
            </el-descriptions-item>
            <el-descriptions-item label="Описание">{{ product.description }}</el-descriptions-item>


        </el-descriptions>
        <template #footer>
            <div v-if="auth.logged">
                Edit Delete
            </div>
        </template>
    </el-card>
</template>

<style scoped>

</style>
