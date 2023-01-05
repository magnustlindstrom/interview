<template>
    <div class="relative flex items-center justify-center px-12 min-w-[50%]">
        <div class="w-full bg-gray-300 rounded-lg relative overflow-hidden">
            <div class="text-center bg-amber-300 left-0 top-0 h-2" :style="{ width: percentCompleted + '%' }" >&nbsp;</div>
        </div>
        <div class="absolute right-0 whitespace-pre">{{ currentExerciseBlock?.solvedQuestionsNo }} / {{ currentExerciseBlock?.requiredQuestionsNo }}</div>
    </div>
</template>

<script setup>
import {computed, unref} from 'vue'
import useLearnStore from '@/stores/learn'
const {currentExerciseBlock} = useLearnStore()

const percentCompleted = computed( () => {
    const ceb = unref(currentExerciseBlock)
    return (ceb?.solvedQuestionsNo/ceb?.requiredQuestionsNo) * 100
});

</script>
