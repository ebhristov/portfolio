<script setup>
import {onMounted} from 'vue';
import {Head} from '@inertiajs/vue3';

function updateLinks(observed) {
    observed.forEach(entry => {
        if (entry.isIntersecting) {
            const id = entry.target.id;
            links.forEach(link => {
                link.classList.toggle('text-cyan-300', link.getAttribute('href') === `#${id}`);
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
    <div class="flex h-full flex-col md:flex-row">
        <aside
            class="w-full p-5 flex md:flex-col md:w-96 place-items-center justify-between">
            <figure>
                <img src="/images/me.jpg" alt="me" class="h-32 w-32 object-cover rounded-full">
                <figcaption class="font-bold text-xl">Evlogi Hristov</figcaption>
            </figure>
            <div class="flex flex-col h-full justify-between md:gap-5 md:h-fit">
                <a href="#about" @click.prevent="jumpTo('about')">About</a>
                <a href="#disclaimer" @click.prevent="jumpTo('disclaimer')">Disclaimer</a>
                <a href="#thanks" @click.prevent="jumpTo('thanks')">Thanks</a>
            </div>
            <div class="flex flex-col h-full justify-between md:flex-row md:h-fit md:gap-5">
                <a href="mailto:ebhristov@gmail.com">
                    <i class="fas fa-envelope md:text-4xl"></i>
                    <span class="md:hidden"> Gmail</span>
                </a>
                <a href="https://github.com/ebhristov" target="_blank">
                    <i class="fab fa-github md:text-4xl"></i>
                    <span class="md:hidden"> GitHub</span>
                </a>
                <a href="https://www.linkedin.com/in/evlogi-hristov-24888423/" target="_blank">
                    <i class="fab fa-linkedin md:text-4xl"></i>
                    <span class="md:hidden"> LinkedIn</span>
                </a>
            </div>
        </aside>

        <div id="observed" class="content w-full">
            <section id="about">
                <h1 class="text-xl mb-3 md:text-4xl">About</h1>
                <p class="mb-3 md:text-xl">
                    Passionate Full Stack Developer with extensive experience in developing dynamic web
                    applications using PHP, Laravel, Livewire, JavaScript, and Vue.js.
                </p>
                <p class="mb-3 md:text-xl"> I excel in creating seamless user
                    experiences and optimizing performance to ensure fast and responsive applications.
                </p>
                <p class="mb-3 md:text-xl">
                    With a keen eye for detail and a commitment to staying updated with the latest industry trends, I
                    thrive in challenging environments where innovation and efficiency are paramount. My expertise
                    includes building robust back-end systems, integrating front-end technologies, and improving code
                    performance for optimal user satisfaction.
                </p>
                <p class="mb-3 md:text-xl">
                    I am dedicated to delivering high-quality, scalable solutions that meet client needs and exceed
                    expectations.
                </p>
            </section>
            <section id="disclaimer" class="h-screen">
                <h1 class="text-xl mb-3 md:text-4xl">Disclaimer</h1>
                <p class="mb-3 md:text-xl">
                    While I prioritize functionality and performance, my expertise in design may be
                    limited.
                </p>
                <p class="mb-3 md:text-xl">
                    My primary focus lies in optimizing performance and functionality rather than aesthetic
                    appeal.
                </p>
                <p class="mb-3 md:text-xl">
                    Please keep this in mind when evaluating my work.
                </p>
            </section>
            <section id="thanks" class="h-screen">
                <h1 class="text-xl mb-3 md:text-4xl">Special Thanks to Reviewers</h1>
                <p class="mb-3 md:text-xl">
                    I extend my sincere appreciation to those who have taken the time to review and give feedback for my
                    work. Your thoughtful
                    feedback, constructive criticism, and insightful suggestions have been instrumental in refining my
                    skills and improving the quality of my projects.
                </p>
                <p class="mb-3 md:text-xl">
                    Thank you for your commitment to excellence and for helping me strive for continuous growth and
                    improvement. Your contributions are deeply valued and have made a significant impact on my journey.
                </p>
                <p class="mb-3 md:text-xl">
                    Warm regards, <br>

                    Evlogi Hristov</p>
            </section>
        </div>
    </div>
</template>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
</style>
