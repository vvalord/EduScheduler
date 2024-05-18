<template>
    <nav>
        <ul class="menu__list">
            <li class="menu__list__item">
                <MenuLink href="/" :active="$page.component === 'Home'">Home</MenuLink>
            </li>
            <li class="menu__list__item">
                <MenuLink href="/profesores" :active="$page.component === 'Profesores'">Profesores</MenuLink>
            </li>
            <li class="menu__list__item">
                <MenuLink href="/cursos" :active="$page.component === 'Cursos'">Cursos</MenuLink>
            </li>
            <li class="menu__list__item">
                <MenuLink href="/asignaturas" :active="$page.component === 'Asignaturas'">Asignaturas</MenuLink>
            </li>
            <li class="menu__list__item">
                <MenuLink href="/cargos" :active="$page.component === 'Cargos'">Cargos</MenuLink>
            </li>
        </ul>
    </nav>
</template>

<script setup>
import MenuLink from './MenuLink.vue';
</script>
