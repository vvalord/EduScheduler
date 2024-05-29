<template>
    <el-button class="add-button" @click="isVisible = true" type="success">Añadir</el-button>
    <teleport to="body">
        <div v-if="isVisible" class="dialog-overlay">
            <div class="dialog">
                <h2>{{ $page.component }}</h2>
                <form @submit.prevent="submit" method="POST">
                    <div class="dialog-form">
                        <div v-if="$page.component === 'Profesores'||$page.component === 'Cargos' || $page.component === 'Asignaturas'||$page.component === 'Cursos'">
                            <label for="nombre">Nombre:</label>
                            <el-input type="text" v-model="form.nombre" name="nombre" id="nombre" maxlength="30"/>
                        </div>
                        <div v-if="$page.component === 'Profesores' || $page.component === 'Asignaturas'||$page.component === 'Cursos'">
                            <label for="cod">Clave:</label>
                            <el-input type="text" v-model="form.cod" name="cod" id="cod" maxlength="30"/>
                        </div>
                        <div v-if="$page.component === 'Profesores'">
                            <label for="email">Email:</label>
                            <el-input type="text" v-model="form.email" name="email" id="email" maxlength="30"/>
                        </div>
                        <div v-if="$page.component === 'Profesores'">
                            <label for="especialidad">Especialidad:</label>
                            <el-input type="text" v-model="form.especialidad" name="especialidad" id="especialidad" maxlength="30"/>
                        </div>
                        <div v-if="$page.component === 'Profesores'">
                            <label for="departamento">Departamento:</label>
                            <el-input type="text" v-model="form.departamento" name="departamento" id="departamento" maxlength="30"/>
                        </div>
                        <div v-if="$page.component === 'Profesores' || $page.component === 'Asignaturas'">
                            <label for="horas">Total de horas:</label>
                            <el-input type="number" v-model="form.horas" name="horas" id="horas" maxlength="30"/>
                        </div>
                    </div>
                    <el-button type="primary" @click="">Añadir</el-button>
                </form>
                <footer class="dialog-footer">
                    <button @click="isVisible = false">Cerrar</button>
                </footer>
            </div>
        </div>
    </teleport>
</template>

<script setup>
import {ref, watch} from 'vue'
import {router} from "@inertiajs/vue3";

const props = defineProps({
    data: Object,
    route: String
})
defineEmits(['submit'])

let isVisible = ref(false);
const form = ref({
    nombre: "",
    cod: "",
    email: "",
    especialidad: "",
    departamento: "",
    horas: 0,

})

const submit = (form) => {
    router.post(props.route, form, {
        preserveState: "errors"
    })
}

</script>

<style scoped>
.dialog-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2000;
}

.dialog {
    background: white;
    padding: 20px;
    border-radius: 8px;
    max-width: 500px;
    width: 100%;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.dialog-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1rem;
}

.dialog-footer {
    border-top: 1px solid #ddd;
    padding-top: 10px;
    text-align: right;
}

.add-button {
    margin-top: 1rem;
    max-width: 25%;
    justify-self: center;
}
</style>
