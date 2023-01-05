<template>
    <div class="relative flex items-center justify-center px-12 min-w-[50%]">
        <div class="flex bg-white gap-3">
            <button v-for="(question, questionIndex) of currentExerciseBlock?.repeatQuestions"
                class="py-2 px-4 rounded-md" @click="() => currentExerciseBlock.currentQuestion = question"
                :class="{'bg-green-400': currentExerciseBlock?.currentQuestion?.id === question.id}">
                {{ questionIndex + 1 }}
            </button>
        </div>
    </div>
</template>

<script setup>

// TODO: add pagination of pagination
import {computed, unref} from 'vue'
import useLearnStore from '@/stores/learn'
const {currentExerciseBlock} = useLearnStore()

const progressCount = computed( () => {
    const ceb = unref(currentExerciseBlock)
    if(ceb.isRepeating) return ceb.attemptedQuestionsNo
    return ceb.solvedQuestionsNo;
});

const percentCompleted = computed( () => {
    const ceb = unref(currentExerciseBlock)
    return (progressCount.value/ceb.requiredQuestionsNo) * 100
});

</script>
