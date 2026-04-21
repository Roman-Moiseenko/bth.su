<script lang="ts" setup>
import {defineProps} from 'vue'
import {Head} from "@inertiajs/vue3";
import {useAuthStore} from "../Stores/auth";
const auth = useAuthStore()

const props = defineProps({
    products: Array,
    title: {
        default: 'BTH.SU',
        type: String
    }
})

</script>

<template>
    <Head><title>{{ title }}</title></Head>
    <h1>Tittle</h1>
    <el-tag v-for="product in products">
        {{product.name}}
        <span v-if="auth.logged"> *</span>
    </el-tag>
</template>

<style scoped>

</style>
