<template>
    <Table :data="asignaturas" :route="name"/>
</template>

<script setup>
import Table from "../Shared/DataTable.vue"
const props = defineProps({
    asignaturas: Object
})
const name = '/asignaturas';
</script>
