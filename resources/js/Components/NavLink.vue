<script setup>
import {Link} from '@inertiajs/vue3';

defineProps({active: Boolean});

</script>

<template>
    <Link type="button">
        <svg class="h-8 w-8 hover:stroke-red-500 hover:transition-colors duration-300"
             :class="{'stroke-amber-500': active, 'stroke-white': !active}"
             viewBox="0 0 24 24"
             fill="none"
             xmlns="http://www.w3.org/2000/svg">
            <slot/>
        </svg>
    </Link>
</template>

<style scoped>

</style>
