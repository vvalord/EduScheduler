
<script setup>
import { ref } from 'vue'


let name;
let horas;
let horario;

if(!data){
    name="";
    horas=0;
    horario="dia";
}else{
    name=data.nombre;
    horas=data.horas;
    horario=data.turno;
}
//Insert:
//Al enviar, enviar el request a la api y guardar el cargo, deberia devolver a la lista de cargos
//Update:
//Falta indicar que si se obtiene un id, haga una busqueda del cargo y muestra los datos en sus respectivos inputs
//Al enviar, enviar el request a la api y actualizar el cargo, deberia devolver a la lista de cargos
</script>
<template>
    <form @submit.prevent=""> 
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" v-model="name" name="nombre" id="nombre" maxlength="30">

            <label for="cod">Codigo:</label>
            <input type="text" v-model="cod" name="cod" id="cod" maxlength="5">
            
            <label for="horas">Horas:</label>
            <input type="number" v-model="horas" name="horas" id="horas" max="18" min="0" value=0>
            
            <label for="horas">Horario</label>
            <select name="horario" v-model="horario">
                <option value="dia"> Diurno</option>
                <option value="noche"> Nocturno</option>
            </select>
        </div>
        <input type="submit" value="Send"/>
            
    </form>
</template>

