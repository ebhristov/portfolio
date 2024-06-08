<script setup>
import {ref, onMounted} from 'vue';

const hourHand = ref(null);
const minuteHand = ref(null);
const secondHand = ref(null);

function clockTick() {
    const date = new Date();
    const seconds = date.getSeconds();
    const minutes = date.getMinutes();
    const hours = date.getHours();

    const totalSeconds = hours * 3600 + minutes * 60 + seconds;

    const secondsFraction = totalSeconds / 60;
    const minutesFraction = totalSeconds / 3600;
    const hoursFraction = totalSeconds / 43200;

    rotateClockHand(secondHand.value, secondsFraction);
    rotateClockHand(minuteHand.value, minutesFraction);
    rotateClockHand(hourHand.value, hoursFraction);
}

function rotateClockHand(element, rotation) {
    if (element) {
        element.style.transform = `translate(-50%) rotate(${rotation * 360}deg)`;
    }
}

function startClock() {
    clockTick();
    requestAnimationFrame(startClock);
}

onMounted(() => {
    startClock();
});
</script>

<template>
    <div class="flex flex-col h-full w-full select-none overflow-hidden md:flex-row">
        <aside class="w-full p-5 flex flex-col gap-5 place-items-center align-middle md:w-96">
            <h1 class="text-4xl">Vue.js Clock</h1>
            <p>This Vue.js clock utilizes smooth animation achieved through the <code>requestAnimationFrame()</code>
                function, ensuring consistent performance across various display refresh rates. The clock's design
                features distinct hour, minute, and second hands, set against a minimalist backdrop. Watch time come to
                life as each hand glides seamlessly around the clock face.</p>
        </aside>
        <div class="w-full flex place-content-center items-center p-5">
            <div class="clock">
                <div
                    v-for="n in 12"
                    :key="'hour-' + n"
                    class="number"
                    :style="{ transform: `rotate(${30 * n}deg)` }"
                >
                    <span :style="{ transform: `rotate(${-30 * n}deg)` }">{{ n }}</span>
                </div>
                <div
                    v-for="m in 60"
                    :key="'minute-' + m"
                    class="minute-number"
                    :style="{ transform: `rotate(${6 * m}deg)` }"
                >
                    <span>{{ m }}</span>
                </div>
                <div class="hour-hand" ref="hourHand"></div>
                <div class="minute-hand" ref="minuteHand"></div>
                <div class="second-hand" ref="secondHand"></div>
                <div class="center-dot"></div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.clock {
    position: relative;
    width: 100%;
    max-width: 80vh;
    aspect-ratio: 1;
    border: 0.5vw solid rgb(103, 232, 249);
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
}

.number {
    position: absolute;
    text-align: center;
    inset: 3%;
    color: rgb(103, 232, 249);
    transform-origin: center;
    font-family: Bahnschrift, sans-serif;
    font-weight: bold;
    font-size: 5vw;
}

.number > span {
    display: inline-block;
}

.minute-number {
    position: absolute;
    text-align: center;
    inset: 1.5%;
    color: rgb(255, 0, 0);
    transform-origin: center;
    font-family: Bahnschrift, sans-serif;
    font-size: 1vw;
}

.minute-number > span {
    display: inline-block;
}

.center-dot {
    position: absolute;
    width: 2vw;
    height: 2vw;
    background-color: black;
    background-clip: padding-box;
    border: 0.6vw solid rgb(255, 0, 0);
    border-radius: 50%;
}

.hour-hand, .minute-hand, .second-hand {
    position: absolute;
    left: 50%;
    bottom: 50%;
    transform-origin: bottom;
    border-radius: 5px;
    transition: transform 0.5s cubic-bezier(0.4, 2.3, 0.3, 1);
}

.hour-hand {
    width: 1.5%;
    height: 30%;
    background-color: rgba(103, 232, 249, 0.8);
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
}

.minute-hand {
    width: 1.2%;
    height: 40%;
    background-color: rgba(103, 232, 249, 0.8);
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
}

.second-hand {
    width: 0.8%;
    height: 45%;
    background-color: rgb(255, 0, 0);
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
}
</style>
