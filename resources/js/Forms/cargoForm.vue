
<script setup>
import { ref } from 'vue'

let name;

if(!data){
    name="";
}else{
    name=data.nombre;
}

let submit=()=>{
    if(!data)
        Inertia.post('/cargos',form);
    else
        Inertia.put('/cargo/{$id}',form);
}

//Insert:
//Al enviar, enviar el request a la api y guardar el cargo, deberia devolver a la lista de cargos
//Update:
//Falta indicar que si se obtiene un id, haga una busqueda del cargo y muestra los datos en sus respectivos inputs
//Al enviar, enviar el request a la api y actualizar el cargo, deberia devolver a la lista de cargos
</script>
<template>
    <form @submit.prevent="submit" method="POST"> 
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" v-model="name" name="nombre" id="nombre" maxlength="30">
            
        </div>
        <input type="submit" value="Send"/>
    </form>
</template>

