<template>
    <header class="menu">
        <Menu/>
    </header>
    <section>
        <div class="main">
            <slot />
        </div>
    </section>
</template>

<script setup>
import Menu from './Menu.vue';

</script>

<style scoped>
.main {
    width: 100%;
    display: grid;
    grid-template-columns: 1fr;
    align-items: center;
}
</style>
