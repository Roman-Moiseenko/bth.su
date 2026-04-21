<script lang="ts" setup>
import {defineProps, ref} from "vue";
import {Head, router} from "@inertiajs/vue3";
import {useAuthStore} from "../../../Stores/auth";
import {useProduct} from "../../../Composables/useProduct";
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
const showDelete = ref(false)

function handleDelete() {
    showDelete.value = true
}
function onDelete() {
    const productUse = useProduct()
    productUse.remove(props.product.id).then(v => {
        showDelete.value = false
        router.get(`/admin/products`, {}, auth.getHeader())
    })
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
            <el-descriptions-item label="Удален">{{ product.trashed ? 'Да' : 'Нет' }}</el-descriptions-item>

        </el-descriptions>
        <template #footer>
            <el-button type="success" plain @click="handleEdit">
                Редактировать
            </el-button>
            <el-button type="danger"  :plain="!product.trashed" @click="handleDelete">
                Удалить
            </el-button>
        </template>
    </el-card>

    <el-dialog v-model="showDelete" title="Удаление" width="400">

        <template #header>
            Удаление товара
        </template>

        <template #default>
            Вы уверены, что хотите удалить товар?
        </template>

        <template #footer>
            <el-button type="info" plain @click="showDelete = false">Отмена</el-button>
            <el-button type="danger" plain @click="onDelete">Удалить</el-button>
        </template>
    </el-dialog>
</template>

<style scoped>

</style>
