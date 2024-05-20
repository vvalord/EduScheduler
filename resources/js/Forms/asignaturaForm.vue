
<script setup>
import { ref } from 'vue'

//Insert:
//Al enviar, enviar el request a la api y guardar la asignatura, deberia devolver a la lista de asignaturas
//Update:
//Falta indicar que si se obtiene un id, haga una busqueda de la asignatura y muestra los datos en sus respectivos inputs
//Al enviar, enviar el request a la api y actualizar la asignatura, deberia devolver a la lista de asignaturas
//V2
//Crear el apartado de preferencias
</script>
<template>
    <form @submit.prevent=""> 
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" maxlength="20">

            <label for="horas">Horas:</label>
            <input type="number" name="horas" id="horas" max="18" min="0" value=0>
        </div>  
            <input type="submit" value="Send"/>
    </form>
</template>

