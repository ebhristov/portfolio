<script setup lang="ts">
 import Header from "./Header.vue";
</script>

<template>
    <main class="h-screen bg-gradient-to-b from-black from-60% to-red-900 text-white flex flex-col">
        <Header/>
        <div class="container bg-gray-500/25 h-full rounded-2xl shadow-2xl my-5">
            <slot/>
        </div>
    </main>
</template>
