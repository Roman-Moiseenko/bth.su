<script lang="ts" setup>
import type {FormInstance} from "element-plus";
import {FormProduct, useProduct} from "../../../Composables/useProduct";
import {useAuthStore} from "../../../Stores/auth";
import {useCategoriesStore} from "../../../Stores/categories";
import {defineProps, ref} from "vue";
import {Head, router} from "@inertiajs/vue3";

const auth = useAuthStore()
const categories = useCategoriesStore()
const product = useProduct()
const form = ref<FormProduct>(product.getInitialFormState())
const formRef = ref<FormInstance>()
const isSaving = ref(false)
const props = defineProps({
    title: {
        default: 'BTH.SU',
        type: String
    }
})
const submitForm = async (formEl: FormInstance | undefined) => {
    if (!formEl) return
    await formEl.validate((valid, fields) => {
        if (valid) {
            isSaving.value = true
            product.create(form.value).then(id => {
                isSaving.value = false
                if (id !== null) router.get(`/admin/products`, {}, auth.getHeader())
                    //router.get(`/admin/products/${id}`, {}, auth.getHeader())
            })
        }
    })
}
const resetForm = (formEl: FormInstance | undefined) => {
    if (!formEl) return
    formEl.resetFields()
}
</script>

<template>
    <Head><title>{{ title }} | Создать товар</title></Head>
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
            <el-button type="primary" @click="submitForm(formRef)">Добавить</el-button>
        </template>
    </el-card>
</template>

<style scoped>

</style>
