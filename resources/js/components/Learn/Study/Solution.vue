<template>
    <div class="md:w-2/3 mx-auto lg:py-8 py-6 _overflow-y-scroll no-scrollbar" v-if="solution">
        <div class="flex flex-col gap-4">

            <div>

                <h2 class="text-center text-blue-400 text-2xl mb-3 font-bold"
                     v-if="solution.skipped"><!--{{ $t('learn.skipped') }}--></h2>
                <h2 class="text-center text-green-400 text-2xl mb-3 font-bold"
                    v-else-if="solution.correct">{{ $t('learn.correct') }}!</h2>
                <h2 class="text-center text-red-400 text-2xl mb-3 font-bold"
                    v-else>{{ $t('learn.incorrect') }}!</h2>

                <div class="flex" v-cloak>
                    <template v-if="ceb.currentQuestion.type == 'MultipleChoiceQuestion'">
                        <CorrectMultipleChoiceSolution :answerTable="solution.answerTable" v-if="solution.skipped"/>
                        <CorrectMultipleChoiceSolution :answerTable="solution.answerTable"
                                                       v-else-if="solution.correct"/>
                        <IncorrectMultipleChoiceSolution :answerTable="solution.answerTable" v-else/>
                    </template>
                    <template v-else>
                        <CorrectNumberSolution :answerTable="solution.answerTable" :skipped="true"
                                               v-if="solution.skipped"/>
                        <CorrectNumberSolution :answerTable="solution.answerTable" v-else-if="solution.correct"/>
                        <IncorrectNumberSolution :answerTable="solution.answerTable" v-else/>
                    </template>
                </div>

                <div class="py-4">
                    <button
                        v-if="percentCompleted == 100"
                        class="w-full px-4 py-2 bg-amber-500 text-white hover:brightness-95 transition-color rounded-md"
                        @click="finishFn">{{ $t('Finish') }}
                    </button>
                    <button
                        v-else
                        class="w-full px-4 py-2 bg-green-500 text-white hover:brightness-95 transition-color rounded-md"
                        @click="() => continueFn()">{{ $t('Continue') }}
                    </button>
                </div>
            </div>

            <div class="rounded-lg bg-gray-100 flex flex-col gap-4 p-6 pt-2">
                <div class="flex gap-2 justify-around p-4 font-medium">
                    <div @click="() => tab = 'question'"
                         class="px-4 border-transparent border-b-2 cursor-pointer"
                         :class="{'border-gray-600': tab == 'question'}">{{ $t('Question') }}
                    </div>
                    <div @click="() => tab = 'solution'"
                         class="px-4 border-transparent border-b-2 cursor-pointer"
                         :class="{'border-gray-600': tab == 'solution'}">{{ $t('Solution') }}
                    </div>
                    <div v-if="solution.video"
                         @click="() => tab = 'video'"
                         class="px-4 border-transparent border-b-2 cursor-pointer"
                         :class="{'border-gray-600': tab == 'video'}">{{ $t('Video') }}
                    </div>
                </div>

                <div v-show="tab == 'question'"
                     v-html="solution.question"></div>
                <div v-show="tab == 'solution'"
                     v-html="solution.solution"></div>
                <div v-show="tab == 'video'">
                    <video class="max-w-2xl m-auto" :src="solution.video"
                           controls></video>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed, onMounted, onUnmounted, ref, unref, watch} from 'vue';
import useLearnStore from '@/stores/learn';
import useHeaderStore from '@/stores/header';

import {hasMathJax, renderMath} from "@/helpers/mathjax";
import CorrectMultipleChoiceSolution
    from '@/components/Learn/Study/SolutionTypes/MultipleChoiceQuestionSolutions/CorrectMultipleChoiceSolution'
import IncorrectMultipleChoiceSolution
    from '@/components/Learn/Study/SolutionTypes/MultipleChoiceQuestionSolutions/IncorrectMultipleChoiceSolution'
import IncorrectNumberSolution from "./SolutionTypes/NumberQuestionSolution/IncorrectNumberSolution";
import CorrectNumberSolution from "./SolutionTypes/NumberQuestionSolution/CorrectNumberSolution";

hasMathJax();

const tab = ref('solution');
const {currentExerciseBlock} = useLearnStore();
const {unfocus} = useHeaderStore();
const ceb = unref(currentExerciseBlock)
const question = computed(() => ceb.currentQuestion)
const solution = computed(() => question.value.solution);

const finishFn = unfocus;
const continueFn = () => ceb.startNextQuestion();

watch(question, () => {
    if(question.value)
    {
        unref(question).resetAnswers();
        unref(question).solution = null;
    }
    renderMath()
});

const progressCount = computed(() => {
    const ceb = unref(currentExerciseBlock)
    if (ceb.isRepeating && ceb.repeatQuestions.length > 0) return ceb.repeatQuestions.indexOf(ceb.currentQuestion) + 1
    return ceb.solvedQuestionsNo;
});

const percentCompleted = computed(() => {
    const ceb = unref(currentExerciseBlock)
    const total = ceb.isRepeating && ceb.repeatQuestions.length > 0 ? ceb.repeatQuestions.length : ceb.requiredQuestionsNo;
    return (progressCount.value / total) * 100
});


const listenForKeyup = async (event) => {
    if(event.code == 'Enter'){
        if(percentCompleted.value == 100) finishFn()
        else continueFn();
    }
}

onMounted(() => {
    window.addEventListener('keyup', listenForKeyup)
})

onUnmounted(() => {
    window.removeEventListener('keyup', listenForKeyup);

})
</script>
