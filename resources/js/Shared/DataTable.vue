<template>
    <el-table :data="filterTableData" style="width: 100%; margin-top: 2rem">
        <el-table-column v-if="props.data[0].nombre" label="Nombre" prop="nombre" />
        <el-table-column v-if="props.data[0].cod" label="Clave" prop="cod" />
        <el-table-column v-if="props.data[0].cargo" label="Cargo" prop="cargo" />
        <el-table-column v-if="props.data[0].curso" label="Curso" prop="curso" />
        <el-table-column v-if="props.data[0].email" label="Email" prop="email" />
        <el-table-column v-if="props.data[0].especialidad" label="Especialidad" prop="especialidad" />
        <el-table-column v-if="props.data[0].departamento" label="Departamento" prop="departamento" />
        <el-table-column v-if="props.data[0].horas" label="Horas" prop="horas" />
        <el-table-column align="right">
            <template #header>
                <el-input v-model="search" size="small" placeholder="Type to search" />
            </template>
            <template #default="scope">
                <el-button size="small" type="primary" @click="handleEdit(scope.row)">Editar</el-button>
                <el-button size="small" type="danger" @click="handleDelete(scope.row)">Delete</el-button>
            </template>
        </el-table-column>
    </el-table>
    <Form :isVisible="showDialog" :data="row" :route="route" :action='action'>
        <template #footer>
            <button @click="showDialog = false">Cerrar</button>
        </template>
    </Form>
</template>

<script lang="ts" setup>
import { computed, ref } from 'vue'
import Form from "../Forms/EditForm.vue"
import {router} from "@inertiajs/vue3";


const props = defineProps({
    data: Object,
    route: String
})

let row = ref({})
let showDialog = ref(false);
const action = ref('edit')
const search = ref('')
const filterTableData = computed(() =>
    props.data.filter(
        (data) =>
            !search.value ||
            data.nombre.toLowerCase().includes(search.value.toLowerCase()) ||
            (data.cod && data.cod.toLowerCase().includes(search.value.toLowerCase()))
    )
)
const handleEdit = (ScopeRow) => {
    row = ScopeRow;
    showDialog.value = true;
}
const handleDelete = (row) => {
    //const confirmed = await dialog.confirm(message)
    if(confirm("Do you really want to delete?")){
        // do the thing needing confirming

        console.log(`${props.route}/${row.id}`)
        router.delete(`${props.route}/${row.id}`, {
            preserveState: "errors"
        })
    }
}



</script>
