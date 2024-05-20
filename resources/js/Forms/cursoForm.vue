
<script setup>
import { ref } from 'vue'

//Asignaturas:
//Obtener un listado de todas las asignaturas disponibles de la api y guardarlo en una variable tipo lista
//Al pulsar el boton de añadir, mostrar un dialog/lista donde se escoja la asignatura a añadir de la variable
//Al añadir una asignatura, se añadira un elemento al div similar a un boton con el nombre de la Asignatura y se eliminara de la lista
//Este elemento, contara en un lateral con un icono de una X o papelera o y al pulsarlo se pedira la confirmacion de la designación (Tambien se puede hacer que se elimina al pulsar sobre el mismo elemento sin necesidad de un icono de borrado)
//Al designar, desaparecera el elemento y la asignatura estara disponible de nuevo en la lista de asignaturas 
//Mostrar los elementos ordenados dejando siempre el ultimo como el boton para añadir

//Insert:
//Al enviar, enviar el request a la api y guardar el curso, deberia devolver a la lista de cursos
//Update:
//Falta indicar que si se obtiene un id, haga una busqueda del curso y muestra los datos en sus respectivos inputs
//Al enviar, enviar el request a la api y actualizar el curso, deberia devolver a la lista de cursos
</script>
<template>
    <form @submit.prevent=""> 
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" maxlength="50">    
        </div>
        <div>
            <input type="button" value="Añadir asignatura" @click="">
        </div>
        <input type="submit" value="Send"/>
            
    </form>
</template>

