<template>
    <div style="max-width: 100%; margin: 1rem">
        <el-table :data="profesores" max-height="800" border>
            <el-table-column prop="nombre" label="Nombre" width="90"/>
            <el-table-column label="Asignaturas">
                <template #default="scope">
                    <el-table :data="scope.row.asignaturas" border>
                        <el-table-column prop="asignatura" label="Asignatura"></el-table-column>
                        <el-table-column prop="curso" label="Curso"></el-table-column>
                        <el-table-column prop="horas" label="Horas"></el-table-column>
                        <el-table-column>
                            <template #default="nestedScope">
                                <el-button type="danger" @click="handleDelete(nestedScope.row.id)">Eliminar</el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                    <el-button type="primary" @click="subjectDialog(scope.row)">
                        Añadir asignatura
                    </el-button>
                </template>
            </el-table-column>
            <el-table-column prop="reduccion" label="Reducción por cargo" width="120" align="center"/>
            <el-table-column prop="horasTotales" label="Total Horas" width="90" align="center"/>
        </el-table>
    </div>
    <el-dialog v-model="dialogFormVisible" title="Asignar asignatura" align-center>
        <el-form>
            <el-form-item label="Curso" :error="errors.cursoId">
                <!-- El-select para elegir el curso -->
                <el-select v-model="selectedCourse" placeholder="Selecciona un curso" @change="onCourseChange">
                    <el-option v-for="curso in cursos" :key="curso.id" :label="curso.cod"
                               :value="curso.id"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="Asignatura" :error="errors.asignaturaId">
                <!-- El-select para elegir la asignatura -->
                <el-select v-model="selectedSubject" placeholder="Selecciona una asignatura"
                           :disabled="!selectedCourse">
                    <el-option v-for="asignatura in selectedCourseSubjects" :key="asignatura.id"
                               :label="asignatura.nombre" :value="asignatura.id"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="Horas" :error="errors.horas">
                <el-input-number label="Horas" v-model="horas"/>
            </el-form-item>
        </el-form>
        <div class="dialog-footer">
            <el-button @click="dialogFormVisible = false">Cancel</el-button>
            <el-button type="primary" @click="submit(selectedRow.id)">
                Confirm
            </el-button>
        </div>
    </el-dialog>
    <el-button type="warning" style="width: 7rem; justify-self: center" @click="pdf">Generar PDF</el-button>
</template>

<script setup>
import {ref, computed, reactive} from 'vue';
import {ElMessage, ElMessageBox, ElNotification} from 'element-plus';
import {router} from "@inertiajs/vue3";

const props = defineProps({
    profesores: Array,
    asignaturas: Object,
    cursos: Array
});
console.log(props.profesores);
const dialogFormVisible = ref(false);
const selectedRow = ref({});

const selectedCourse = ref(null);
const selectedSubject = ref(null);
const horas = ref(null);

const selectedCourseSubjects = computed(() => {
    const curso = props.cursos.find(curso => curso.id === selectedCourse.value);
    return curso ? curso.asignaturas : [];
});

const onCourseChange = () => {
    selectedSubject.value = null; // Reiniciar la selección de asignatura cuando se cambia el curso
};

const subjectDialog = (row) => {
    selectedRow.value = {...row};
    console.log(props.cursos);
    dialogFormVisible.value = true;
};

const submit = (id) => {
    router.post('/asignarAsignatura', {
            profesorId: id,
            cursoId: selectedCourse.value,
            asignaturaId: selectedSubject.value,
            horas: horas.value
        },
        {
            preserveState: "errors",
            onSuccess: () => {
                notification('Success', 'Se ha creado el registro correctamente', 'success')
            },
            onError: (errorBag) => {
                for (const key in errors) {
                    errors[key] = null;
                }
                for (const key in errorBag) {
                    errors[key] = errorBag[key]; // Mostrar solo el primer error
                }
            }
        });
};

const handleDelete = (id) => {
    open(id)
};

const pdf = () => {
    router.get('pdf')
};

const open = (row) => {
    ElMessageBox.confirm('¿Seguro que quiere eliminar este registro?', 'Warning', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
    })
        .then(() => {
            router.delete(`/desasignarAsignatura/${row}`,
                {
                    onSuccess: () => {
                        notification('Información', 'Se ha eliminado la asignación de la asignatura', 'info')
                    }
                });
        })
        .catch(() => {
            ElMessage({
                type: 'info',
                message: 'Delete canceled',
            })
        })
}

const notification = (title, message, type) => {
    ElNotification({
        title: title,
        message: message,
        type: type,
    })
};

let errors = reactive({
    asignaturaId: null,
    cursoId: null,
    horas: null
});
const totalHours = (subjects) => {
    return subjects.reduce((total, subject) => total + subject.hours, 0);
};
</script>

<style scoped>
.el-table {
    max-width: 99%;
}
</style>
