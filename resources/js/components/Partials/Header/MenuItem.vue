<template>
    <li>
        <a :class="{'border-transparent hover:border-primary': !props.active, 'border-primary': props.active }"
           :href="props.href"
           class="relative bg-tertiary border-b-2 flex flex-col hover:brightness-95 justify-center items-center transition-all px-4 py-0.5 select-none">
            <span>{{ props.label }}</span>
        </a>
    </li>
</template>

<script setup>
import {defineProps} from 'vue';

const props = defineProps(['href', 'label', 'active'])
</script>
