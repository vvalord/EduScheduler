<template>
    <Table :data="cursos" :route="name"/>
    <Form :is-visible="showDialog" :route="name" :action='action'>
        <template #default>
            <div class="add-button">
                <el-button @click="showDialog = true" type="success" >Añadir</el-button>
            </div>
        </template>
        <template #footer>
            <button @click="showDialog = false">Cerrar</button>
        </template>
    </Form>
</template>

<script setup>
import Table from "../Shared/DataTable.vue"
import Form from "../Forms/EditForm.vue";
import {ref} from "vue";

const props = defineProps({
    cursos: Object
})
const name = '/cursos';
const action = ref('add')
let showDialog = ref(false);
</script>

