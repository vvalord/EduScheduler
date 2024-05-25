<template>
    <h1>
        Home
    </h1>
</template>

<script setup>
import Table from "../Shared/DataTable.vue";

const props = defineProps({
    profesores: Object,
    test: String
})
</script>
