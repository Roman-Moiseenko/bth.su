<script lang="ts" setup>
import {defineProps, ref} from "vue";
import {Head, router} from "@inertiajs/vue3";
import type {FormInstance} from "element-plus";
import {FormProduct, useProduct} from "../../../Composables/useProduct";
import {useCategoriesStore} from "../../../Stores/categories";
import {useAuthStore} from "../../../Stores/auth";
import {useMessage} from "../../../Composables/useMessage";

const props = defineProps({
    product: Object,
    title: {
        default: 'BTH.SU',
        type: String
    }
})
const auth = useAuthStore()
const msg = useMessage()

const categories = useCategoriesStore()
const product = useProduct()
const form = ref<FormProduct>({
    name: props.product.name,
    description: props.product.description,
    price: props.product.price,
    category_id: props.product.category_id,
})

const formRef = ref<FormInstance>()
const isSaving = ref(false)
const submitForm = async (formEl: FormInstance | undefined) => {
    if (!formEl) return
    await formEl.validate((valid, fields) => {
        if (valid) {
            isSaving.value = true
            product.update(props.product.id, form.value).then(result => {
                isSaving.value = false
                if (result === "success") {
                    router.get(`/admin/products`, {}, auth.getHeader())
                    msg.success('Сохранено')
                } else {
                    msg.error('Ошибка сохранения')
                }
            }).catch(error => {
                msg.error(error)
            })
        }
    })
}
const resetForm = (formEl: FormInstance | undefined) => {
    if (!formEl) return
    router.get(`/admin/products/${props.product.id}`, {}, auth.getHeader())
}
</script>

<template>
    <Head><title>{{ title }} | {{ $props.product.name }} Редактировать товар</title></Head>
    <el-card>
        <el-form
            :rules="product.rulesForm"
            :model="form"
            ref="formRef"
            label-width="auto"
        >
            <el-form-item label="Товар" prop="name" >
                <el-input v-model="form.name" class="w-full" placeholder="Название товара" :disabled="isSaving"/>
            </el-form-item>
            <el-form-item label="Цена" prop="price">
                <el-input-number v-model="form.price" class="w-full" placeholder="0" :disabled="isSaving"/>
            </el-form-item>
            <el-form-item label="Категория" prop="category_id">
                <el-select v-model="form.category_id"  filterable :disabled="isSaving"
                           class="w-full">
                    <el-option v-for="item in categories.list" :key="item.id" :value="item.id" :label="item.name"/>
                </el-select>
            </el-form-item>
            <el-form-item label="Описание" prop="description">
                <el-input v-model="form.description" class="w-full" type="textarea" :rows="5" :disabled="isSaving"/>
            </el-form-item>
        </el-form>
        <template #footer=>
            <el-button type="info" plain @click="resetForm(formRef)">Отмена</el-button>
            <el-button type="primary" @click="submitForm(formRef)">Сохранить</el-button>
        </template>
    </el-card>
</template>

<style scoped>

</style>
