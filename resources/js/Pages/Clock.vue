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
    <div class="flex h-full justify-center items-center select-none overflow-hidden">
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
</template>

<style scoped>
.clock {
    position: relative;
    width: 50%;
    aspect-ratio: 1;
    border: 0.5vw solid rgb(0, 255, 255);
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
    color: rgba(0, 255, 255, 0.8);
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
    color: rgba(255, 0, 0, 0.8);
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
    border: 0.5vw solid rgba(255, 0, 0, 0.8);
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
    background-color: rgba(0, 255, 255, 0.8);
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
}

.minute-hand {
    width: 1.2%;
    height: 40%;
    background-color: rgba(0, 255, 255, 0.8);
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
}

.second-hand {
    width: 0.8%;
    height: 45%;
    background-color: rgba(255, 0, 0, 0.8);
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
}
</style>
