<template>
    <teleport to="body">
        <div v-if="isVisible" class="dialog-overlay">
            <div class="dialog">
                <h2>{{ $page.component }}</h2>
                <form @submit.prevent="submit" method="POST">
                    <div class="dialog-form">
                        <div v-if="data.nombre">
                            <label for="nombre">Nombre:</label>
                            <el-input type="text" v-model="form.nombre" name="nombre" id="nombre" maxlength="30"/>
                        </div>
                        <div v-if="data.cod">
                            <label for="cod">Clave:</label>
                            <el-input type="text" v-model="form.cod" name="cod" id="cod" maxlength="30"/>
                        </div>
                        <div v-if="data.email">
                            <label for="email">Email:</label>
                            <el-input type="text" v-model="form.email" name="email" id="email" maxlength="30"/>
                        </div>
                        <div v-if="data.especialidad">
                            <label for="especialidad">Especialidad:</label>
                            <el-input type="text" v-model="form.especialidad" name="especialidad" id="especialidad" maxlength="30"/>
                        </div>
                        <div v-if="data.departamento">
                            <label for="departamento">Departamento:</label>
                            <el-input type="text" v-model="form.departamento" name="departamento" id="departamento" maxlength="30"/>
                        </div>
                        <div v-if="data.horas">
                            <label for="horas">Total de horas:</label>
                            <el-input type="number" v-model="form.horas" name="horas" id="horas" maxlength="30"/>
                        </div>
                    </div>
                    <el-button type="primary" @click="$emit('submit', form)">Añadir</el-button>
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
import {ref, watch} from 'vue'

const props = defineProps({
    isVisible: Boolean,
    data: Object,
    submit: Function
})
defineEmits(['submit'])

const form = ref({})
watch(() => props.data, (newValue) => {
    form.value = {...newValue};
});

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
