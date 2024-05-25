<template>
    <Table :data="profesores"/>
</template>

<script setup>
import Table from "../Shared/DataTable.vue"
const props = defineProps({
    profesores: Object
})
</script>
