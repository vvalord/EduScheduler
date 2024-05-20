
<script setup>
import { ref } from 'vue'

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
            <input type="text" name="nombre" id="nombre" maxlength="30">

            <label for="horas">Horas:</label>
            <input type="number" name="horas" id="horas" max="18" min="0" value=0>
            
            <label for="horas">Horario</label>
            <select name="horario">
                <option value="dia" selected> Diurno</option>
                <option value="noche"> Nocturno</option>
            </select>
        </div>
        <input type="submit" value="Send"/>
            
    </form>
</template>

