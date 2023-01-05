<template>
    <div class="flex flex-col gap-3">
        <Section v-for="section in sections" :section="section"/>
    </div>
</template>

<script setup>
import {defineProps, computed} from 'vue';
import Section from './Section';

const {course} = defineProps(['course'])
const sections = computed( () => course.getChildren() )
</script>
