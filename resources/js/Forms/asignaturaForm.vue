
<script setup>
import { ref } from 'vue'

let name;
let horas;
let cod;
if(!data){
    name="";
    cod="";
    horas=0;
}else{
    name=data.nombre;
    cod=data.cod;
    horas=data.horas;
}
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
            <input type="text" v-model="name" name="nombre" id="nombre" maxlength="20">

            <label for="cod">Codigo:</label>
            <input type="text" v-model="cod" name="cod" id="cod" maxlength="5">

            <label for="horas">Horas:</label>
            <input type="number" v-model="horas" name="horas" id="horas" max="18" min="0">
        </div>  
            <input type="submit" value="Send"/>
    </form>
</template>

