<template>
    <div class="m-auto shadow-md bg-white rounded-lg p-6 my-6 text-center w-[850px] unreset"
         v-html="theoryContent"></div>
</template>

<script setup>
import {hasMathJax} from "@/helpers/mathjax";
hasMathJax();
import {computed} from 'vue'
import useLearnStore from '@/stores/learn'
const {currentLearningSequence} = useLearnStore();

const theoryContent = computed(() => currentLearningSequence.value.theory_content)
</script>

<style scoped>
/deep/ .unreset p {
    margin: 0;
}
</style>
