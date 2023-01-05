<template>
    <KeepAlive>
        <component v-bind:is="activeComponent" :title="title"/>
    </KeepAlive>
</template>

<script setup>
import {computed, unref} from 'vue'
import useLearnStore from '@/stores/learn'
import useHeaderStore from '@/stores/header'

import Menu from './Menu'
import ProgressBar from "./ProgressBar.vue";
import QuestionPagination from './QuestionPagination.vue'

const Title = {
    props: ['title'],
    template: `<div class="text-center" v-html="title"></div>`
}

const {focused, title} = useHeaderStore();
const {currentExerciseBlock} = useLearnStore();

const activeComponent = computed(() => {
    const ceb = unref(currentExerciseBlock);

    if (!unref(focused)) return Menu;
    if (ceb?.currentQuestion == null) return Title
    if (ceb?.isRepeating && ceb?.repeatQuestions.length > 0) return QuestionPagination;
    return ProgressBar;
});
</script>
