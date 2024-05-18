<template>
    <header class="menu">
        <Menu/>
    </header>
    <section>
        <div>
            <slot />
        </div>
    </section>
</template>

<script setup>
import Menu from './Menu.vue';

</script>
