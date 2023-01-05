<template>
    <div v-click-away="hide" class="relative">
        <button class="flex items-center gap-2 font-bold" @click="toggle">
            <span>
                <slot name="label"></slot>
            </span>
            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <Transition enter-active-class="transition ease-out duration-200"
                    enter-from-class="opacity-0 translate-y-1"
                    enter-to-class="opacity-100 translate-y-0"
                    leave-active-class="transition ease-in duration-150"
                    leave-from-class="opacity-100 translate-y-0"
                    leave-to-class="opacity-0 translate-y-1">
            <div v-cloak
                 v-if="open" class="absolute -ml-4 mt-3 transform z-10 px-2 w-screen max-w-fit sm:px-0 lg:ml-0 lg:-translate-x-1/2">
                <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                    <div class="relative grid gap-6 bg-tertiary brightness-150 px-5 py-6 sm:gap-8 sm:p-8">
                        <slot name="items"></slot>
                    </div>
                </div>
            </div>
        </Transition>
    </div>
</template>

<script setup>
import {ref} from 'vue';

const open = ref(false);

const toggle = () => open.value = !open.value;
const hide = () => open.value = false

const vClickAway = {
    mounted: (el, binding, vnode) => {
        el.clickOutsideEvent = (event) => {
            if (!(el === event.target || el.contains(event.target))) {
                binding.value(event, el);
            }
        };
        document.addEventListener('click', el.clickOutsideEvent);
    },
    unmounted: (el) => {
        document.removeEventListener('click', el.clickOutsideEvent);
    }
}
</script>
