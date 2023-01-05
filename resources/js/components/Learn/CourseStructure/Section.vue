<template>
    <div>
        <h4 class="text-xl text-center" v-html="section.name"></h4>
        <div class="flex justify-between rounded-md shadow-md bg-white p-4 gap-2 w-full"
             :style="{backgroundColor: section.color}">
            <Category v-for="category in categories" :category="category"/>
        </div>
    </div>
</template>

<script setup>
import Category from './Category';
import {computed, defineProps} from 'vue';

const {section} = defineProps({
    section: {
        required: true
    }
})

const categories = computed(() => section.getChildren())
</script>
