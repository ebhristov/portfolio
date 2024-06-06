<script setup>
import {onMounted} from 'vue';
import {Head} from '@inertiajs/vue3';

function updateLinks(observed) {
    observed.forEach(entry => {
        if (entry.isIntersecting) {
            const id = entry.target.id;
            links.forEach(link => {
                link.classList.toggle('text-red-600', link.getAttribute('href') === `#${id}`);
            });
        }
    });
}

function jumpTo(element) {
    document.getElementById(element).scrollIntoView({behavior: 'smooth', block: 'center'});
}

let observable;
let links;
let observer;

onMounted(() => {
    observable = document.querySelectorAll('section');
    links = document.querySelectorAll('aside a');
    observer = new IntersectionObserver(updateLinks, {root: document.getElementById('observed'), threshold: 0.25});
    observable.forEach(section => {
        observer.observe(section);
    });
});
</script>

<template>
    <Head title="Welcome"/>
    <div class="flex h-full">
        <aside class="w-64 p-5 flex flex-col place-items-center">
            <div class="bg-[url('/images/me.jpg')] h-32 w-32 bg-cover bg-center rounded-full"></div>
            <a href="#about" @click.prevent="jumpTo('about')">about</a>
            <a href="#disclaimer" @click.prevent="jumpTo('disclaimer')">disclaimer</a>
            <a href="#thanks" @click.prevent="jumpTo('thanks')">thanks</a>
        </aside>

        <div id="observed" class="content w-full">
            <section id="about" class="flex items-center justify-center h-screen">
                <h1>About</h1>
            </section>
            <section id="disclaimer" class="h-screen">
                <div>disclaimer</div>
            </section>
            <section id="thanks" class="h-screen">
                <div>thanks</div>
            </section>
        </div>
    </div>
</template>
