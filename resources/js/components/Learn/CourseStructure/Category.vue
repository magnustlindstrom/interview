<template>
    <div class="pl-4 mt-1 w-full">
        <h5 class="text-lg" v-html="category.name"></h5>
        <Topic v-for="(topic, key) in topics" :key="key" :topic="topic"/>
    </div>
</template>

<script setup>
import Topic from './Topic';
import {computed, defineProps} from 'vue';

const {category} = defineProps({
    category: {
        required: true
    }
})

const topics = computed( () => category.getChildren() )
</script>
