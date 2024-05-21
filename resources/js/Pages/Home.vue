<template>
    <h1>
        Home
    </h1>
    <p v-text="test"></p>
    <Table :data="profesores"/>
</template>

<script setup>
import Table from "../Shared/DataTable.vue";

const props = defineProps({
    profesores: Object,
    test: String
})
</script>
