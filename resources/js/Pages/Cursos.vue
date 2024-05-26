<template>
    <Table :data="cursos" :route="name"/>
</template>

<script setup>
import Table from "../Shared/DataTable.vue"
const props = defineProps({
    cursos: Object
})
const name = '/cursos';
</script>

