
<script setup>
import { ref } from 'vue'

const departamentos = ref([
  {  title: 'Departamento de informatica', value:'Informatica' },
  {  title: 'Departamento de programacion', value:'Programacion' },
  {  title: 'Departamento de ciencias', value:'Ciencias' }
])

const especialidades = ref([
  {  title: 'Administración de Sistemas Informáticos en Red', value:'ASIR' },
  {  title: 'Desarrollo de Aplicaciones Multiplataforma', value:'DAM' },
  {  title: 'Desarrollo de Aplicaciones Web', value:'DAW' }
])


//Cargos:
//Obtener un listado de los cargos de la api, para mostrar los valores en el select de cargos
//Insert:
//Al enviar, enviar el request a la api y guardar el profesor, deberia devolver a la lista de profesores
//Update:
//Falta indicar que si se obtiene un id, haga una busqueda del cargo y muestra los datos en sus respectivos inputs
//Al enviar, enviar el request a la api y actualizar el profesor, deberia devolver a la lista de profesores
//V2
//Crear el apartado de preferencias
</script>
<template>
    <form @submit.prevent=""> 
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" maxlength="20">

            <label for="email">Email:</label>
            <input type="text" name="email" id="email" maxlength="50">
        </div>
        <div>
            <label for="especialidad">Especialidad:</label>
            <select name="especialidad">
                <option v-for="especialidad in especialidades" :value="especialidad.value">{{ especialidad.title }}</option>
            </select>

            <label for="departamento">Departamento:</label>
            <select name="departamento">
                <option v-for="departamento in departamentos" :value="departamento.value">{{ departamento.title }}</option>
            </select>
        </div>
            <label for="cargo">Cargo:</label>
            <select name="cargo">
                <option value="value1">Cargo 1</option>
                <option value="value2" selected>Cargo 2</option>
                <option value="value3">Cargo 3</option>
            </select>
            <input type="submit" value="Send"/>
    </form>
</template>

