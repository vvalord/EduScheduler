<template>
    <el-table :data="filterTableData" style="width: 100%; margin-top: 2rem">
        <el-table-column label="Nombre" prop="nombre" />
        <el-table-column  label="Cod" prop="cod" />
        <el-table-column  label="Email" prop="email" />
        <el-table-column  label="Especialidad" prop="especialidad" />
        <el-table-column  label="Departamento" prop="departamento" />
        <el-table-column  label="Horas" prop="total_horas" />
        <el-table-column align="right">
            <template #header>
                <el-input v-model="search" size="small" placeholder="Type to search" />
            </template>
            <template #default="scope">
                <el-button size="small" @click="handleEdit(scope.$index, scope.row)">
                    Edit
                </el-button>
                <el-button
                    size="small"
                    type="danger"
                    @click="handleDelete(scope.$index, scope.row)"
                >
                    Delete
                </el-button>
            </template>
        </el-table-column>
    </el-table>
</template>

<script lang="ts" setup>
import { computed, ref } from 'vue'

const props = defineProps({
    data: Object
})


const search = ref('')
const filterTableData = computed(() =>
    props.data.filter(
        (data) =>
            !search.value ||
            data.nombre.toLowerCase().includes(search.value.toLowerCase()) ||
            data.cod.toLowerCase().includes(search.value.toLowerCase())
    )
)
const handleEdit = (index: number, row) => {
    console.log(index, row)
}
const handleDelete = (index: number, row) => {
    console.log(index, row)
}

</script>
