<script setup>
import NavLink from '@/Components/NavLink.vue';
import IconHome from '@/Images/IconHome.vue';
import IconBook from '@/Images/IconBook.vue';
</script>

<template>
    <header>
        <div class="container pt-5">
            <div class="flex justify-between">
                <NavLink :href="route('welcome')" :active="$page.component === 'Welcome'">
                    <IconHome/>
                </NavLink>

                <nav class="flex gap-5">
                    <NavLink :href="route('library.index')" :active="$page.component === 'Library'">
                        <IconBook/>
                    </NavLink>
                </nav>
            </div>
        </div>
    </header>
</template>
