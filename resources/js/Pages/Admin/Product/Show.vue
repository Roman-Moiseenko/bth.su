<script lang="ts" setup>
import {defineProps} from "vue";
import {Head, router} from "@inertiajs/vue3";
import {useAuthStore} from "../../../Stores/auth";
const auth = useAuthStore()

const props = defineProps({
    product: Object,
    title: {
        default: 'BTH.SU',
        type: String
    }
})

function goBack() {
    router.get(`/admin/products`, {}, auth.getHeader())
}
function handleEdit() {
    router.get(`/admin/products/${props.product.id}/edit`, {}, auth.getHeader())
}
function handleDelete() {
    console.log('DEL')
}

</script>

<template>
    <Head><title>{{ title }} | {{ product.name }}</title></Head>

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
            <el-button type="success" plain @click="handleEdit">
                Edit
            </el-button>
            <el-button type="danger"  :plain="!product.trashed" @click="handleDelete">
                Del
            </el-button>
        </template>
    </el-card>
</template>

<style scoped>

</style>
