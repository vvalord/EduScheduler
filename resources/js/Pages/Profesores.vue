<template>
    <Table :data="profesores" :route="name"/>
</template>

<script setup>
import Table from "../Shared/DataTable.vue"
const props = defineProps({
    profesores: Object
})
const name = '/profesores';
</script>
