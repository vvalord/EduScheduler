<template>
    <Table :data="cargos"/>
</template>

<script setup>
import Table from "../Shared/DataTable.vue";

defineProps({
    cargos: Object
})
</script>

<style scoped>

</style>
