<template>
    <Link href="/" class="menu__list__item__link" :class="{'menu__list__item--active':active}">
        <slot/>
    </Link>
</template>

<script setup>
defineProps({
    active: Boolean
})
</script>
