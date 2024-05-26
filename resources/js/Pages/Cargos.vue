<template>
    <Table :data="cargos" :route="name"/>
</template>

<script setup>
import Table from "../Shared/DataTable.vue"

const props = defineProps({
    cargos: Object
})
const name = '/cargos';
</script>
