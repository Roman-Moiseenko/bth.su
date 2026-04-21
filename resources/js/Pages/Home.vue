<script lang="ts" setup>
import {computed, defineProps, ref, watch} from 'vue'
import {Head} from "@inertiajs/vue3";
import {useAuthStore} from "../Stores/auth";
import {useCategoriesStore} from "../Stores/categories";
import {getProducts, Product} from "../Composables/useProducts";
const auth = useAuthStore()

const categories = useCategoriesStore()
let pageData = getProducts(1, null)
const list = computed(() => categories.list)

const props = defineProps({
    home: Boolean,
    title: {
        default: 'BTH.SU',
        type: String
    }
})
const categoryId = ref(null)
const tableData = ref(pageData.products)

const CurrentPage = ref(1)
const TotalPages = computed(() =>  pageData.pages.value)
const loadedTable = computed(() => pageData.loaded.value)


function handleCurrentChange(page) {
    CurrentPage.value = page
    pageData.reloadProducts(page, categoryId.value)
}
function filterCategory() {
    console.log(categoryId.value)
    pageData.reloadProducts(1, categoryId.value)
}
</script>

<template>
    <Head><title>{{ title }}</title></Head>
    <div class="flex">
        <h1 class="font-medium text-xl">Товары</h1>

        <el-select v-model="categoryId" clearable @change="filterCategory">
            <el-option v-for="category in list" :label="category.name" :key="category.id" :value="category.id"/>
        </el-select>
    </div>
    <el-table
        :data="tableData"
        row-key="id"
        v-loading="loadedTable"
    >
        <el-table-column prop="name" label="Товар" width="120"/>
        <el-table-column prop="price" label="Цена" width="120"/>
        <el-table-column prop="category" label="Категория" width="120"/>
        <el-table-column prop="description" label="Описание" show-overflow-tooltip/>
        <el-table-column v-if="auth.logged" label="Действия" width="180" align="right">
            edit del
        </el-table-column>

    </el-table>
    <div class="mt-3">
        <el-pagination background  layout="prev, pager, next" :page-size="10" :total="TotalPages" @current-change="handleCurrentChange" />
    </div>

</template>

<style scoped>

</style>
