<script lang="ts" setup>
import {defineProps} from "vue";
import {Head} from "@inertiajs/vue3";

const props = defineProps({
    product: Object,
    title: {
        default: 'BTH.SU',
        type: String
    }
})
</script>

<template>
    <Head><title>{{ title }} | {{ product.name }}</title></Head>
    <el-card shadow="always" class="mt-5">
        <el-form label-width="auto">



        </el-form>
    </el-card>
</template>

<style scoped>

</style>
