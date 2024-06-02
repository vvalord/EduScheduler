<template>
    <teleport to="body">
        <slot name="default"></slot>
        <div v-if="isVisible" class="dialog-overlay">
            <div class="dialog">
                <h2>{{ $page.component }}</h2>
                <form @submit.prevent="submit" method="POST">
                    <div class="dialog-form">
                        <el-form-item
                            label="Nombre"
                            :error="errors.nombre"
                            v-if="$page.component === 'Profesores'||$page.component === 'Cargos' || $page.component === 'Asignaturas'||$page.component === 'Cursos'">
                            <el-input type="text" v-model="form.nombre" name="nombre" id="nombre" maxlength="30"/>
                        </el-form-item>
                        <el-form-item
                            label="Clave"
                            :error="errors.cod"
                            v-if="$page.component === 'Profesores' || $page.component === 'Asignaturas'||$page.component === 'Cursos'">
                            <el-input type="text" v-model="form.cod" name="cod" id="cod" maxlength="30"/>
                        </el-form-item>
                        <el-form-item
                            label="Email"
                            :error="errors.email"
                            v-if="$page.component === 'Profesores'">
                            <el-input type="text" v-model="form.email" name="email" id="email" maxlength="30"/>
                        </el-form-item>
                        <el-form-item
                            label="Especialidad"
                            :error="errors.especialidad"
                            v-if="$page.component === 'Profesores'">
                            <el-input type="text" v-model="form.especialidad" name="especialidad" id="especialidad"
                                      maxlength="30"/>
                        </el-form-item>
                        <el-form-item
                            label="Departamento"
                            :error="errors.departamento"
                            v-if="$page.component === 'Profesores'">
                            <el-input type="text" v-model="form.departamento" name="departamento" id="departamento"
                                      maxlength="30"/>
                        </el-form-item>
                        <el-form-item
                            label="Cargo"
                            :error="errors.cargo"
                            v-if="$page.component === 'Profesores'">
                            <select v-model="form.cargo_id" name="cargo" id="cargo">
                                <option v-for="cargo in cargos.data" :key="cargo.id" :value="cargo.id">{{ cargo.nombre }}</option>
                            </select>
                        </el-form-item>
                        <el-form-item
                            label="Horas"
                            :error="errors.horas"
                            v-if="$page.component === 'Profesores'">
                            <el-input type="number" v-model="form.horas" name="horas" id="horas" value="1" :disabled="!form.cargo_id"/>
                        </el-form-item>
                        <el-form-item
                            label="Turno"
                            :error="errors.turno"
                            v-if="$page.component === 'Profesores'">
                            <el-select v-model="form.turno" name="horario" id="horario" :disabled="!form.cargo_id">
                                <el-option value="mañana">Mañana</el-option>
                                <el-option value="tarde">Tarde</el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item
                            label="Horas"
                            :error="errors.horas"
                            v-if="$page.component === 'Asignaturas'">
                            <el-input type="number" v-model="form.horas" name="horas" id="horas" max="10" min="1"/>
                        </el-form-item>
                    </div>
                    <el-button v-if="action === 'edit'" type="primary" @click="submit(form)">Editar</el-button>
                    <el-button v-if="action === 'add'" type="primary" @click="submit(form)">Añadir</el-button>
                </form>
                <footer class="dialog-footer">
                    <slot name="footer">
                        <button>Cerrar</button>
                    </slot>
                </footer>
            </div>
        </div>
    </teleport>
</template>

<script setup>
import {ref, watch, onMounted, reactive } from 'vue'
import {router} from "@inertiajs/vue3";
import { ElNotification } from 'element-plus'
import axios from 'axios';

let cargos=ref();


const props = defineProps({
    isVisible: Boolean,
    data: Object,
    action: String,
    route: String
});

const form = ref({})
watch(() => props.data, (newValue) => {
    form.value = {...newValue};
});

let errors = reactive({
    nombre: null,
    cod: null,
    email: null,
    departamento: null,
    turno: null,
    especialidad: null,
    horas: null,
    cargo: null
});

const submit = (form) => {
    if (props.action === 'edit') {
        router.put(`${props.route}/${props.data.id}`, form, {
            preserveState: "errors",
            onSuccess: () => {
                notification('Info', 'Se ha actualizado el registro correctamente', 'info')
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
        console.log(form.cargo)
    } else if (props.action === 'add') {
        router.post(props.route, form, {
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
        })
    }
};
onMounted(() => {
    axios
      .get('/cargosAll')
      .then(response => (cargos = response));

});

const notification = (title, message, type) => {
    ElNotification({
        title: title,
        message: message,
        type: type,
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

.close-button {
    background: none;
    border: none;
    font-size: 1.5em;
    cursor: pointer;
}
</style>
