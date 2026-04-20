<script lang="ts" setup>
import {defineProps} from 'vue'
const props = defineProps({
    products: Array
})
</script>

<template>
    <h1>Tittle</h1>
    <el-tag v-for="product in products">{{product.name}}</el-tag>
</template>

<style scoped>

</style>
