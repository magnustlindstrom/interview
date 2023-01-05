<template>
    <div class="md:w-2/3 mx-auto lg:py-8 py-6">
        <div class="px-16 py-6 bg-white shadow-md rounded-md max-h-full">

            <div class="flex flex-col gap-5">
                <div class="flex items-center p-3 border-2 border-primary rounded-md unreset"
                     v-html="question.content"></div>

                <!-- NOTE: Line breaks for paragraphs - deep scoping (ex. Question.vue) -->

                <div class="flex flex-col gap-5">
                    <div class="flex-grow">
                        <div v-if="showAnswers">
                            <component :is="questionComponent" :question="question"/>
                        </div>
                        <div v-else-if="checkSolution">
                            <p>
                                {{
                                    $t('You can look at the solution and watch the video on how to solve a problem like this and then you get a new chance to see if you can do it yourself.')
                                }}
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-between" v-if="!showAnswers && !checkSolution">
                        <button
                            class="px-4 py-2 bg-green-500 text-white hover:brightness-95 transition-colors rounded-md"
                            @click="toggleShowAnswers">{{ $t('Answer') }}
                        </button>
                        <button
                            class="px-4 py-2 bg-orange-500 text-white hover:brightness-95 transition-colors rounded-md"
                            @click="runCheckSolution">{{ $t('Show me how to do it') }}
                        </button>
                    </div>

                    <div class="flex justify-between"
                         v-if="showAnswers">
                        <div class="flex items-center gap-3">
                            <button
                                class="px-4 py-2 bg-green-500 text-white hover:brightness-95 transition-colors rounded-md"
                                :class="{'cursor-not-allowed bg-gray-200': !question.passesValidation}"
                                @click="performSubmit">{{ $t('Submit') }}
                            </button>
                            <button class="relative" @click="() => showErrorPopup = true"
                                    v-click-away="() => showErrorPopup = false">
                                <InformationCircleIcon class="text-red-400"
                                                       v-if="question instanceof NumberQuestion && !question.passesValidation"
                                                       @mouseover="() => showErrorPopup = true"
                                />
                                <div v-if="showErrorPopup"
                                     class="absolute bg-red-200 p-4 -right-2 rounded text-red-600 top-0 flex gap-8 translate-x-full w-64">

                                    <svg
                                        class="absolute z-10 w-10 h-6 text-red-200 transform -translate-x-8 -translate-y-3 fill-current stroke-current"
                                        width="8" height="8">
                                        <rect x="12" y="-10" width="8" height="8" transform="rotate(45)"/>
                                    </svg>

                                    <div v-html="$t('learn.accepted-input-formats')" class="text-left text-sm"></div>
                                    <span @click="() => showErrorPopup = false">
                                        <HeroCrossIcon class="w-5"/>
                                    </span>
                                </div>
                            </button>
                        </div>

                        <button
                            class="px-4 py-2 bg-orange-500 text-white hover:brightness-95 transition-colors rounded-md"
                            @click="toggleShowAnswers">{{ $t('Back') }}
                        </button>

                    </div>
                    <div class="flex justify-between gap-6" v-if="checkSolution">
                        <button
                            class="px-4 py-2 bg-green-500 text-white hover:brightness-95 transition-colors rounded-md"
                            @click="() => question.submitSkip()">{{ $t('Yes, show me how to do it') }}
                        </button>
                        <button
                            class="px-4 py-2 bg-orange-500 text-white hover:brightness-95 transition-colors rounded-md"
                            @click="() => checkSolution = false">{{ $t('No, I want to give it a try') }}
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/deep/ .unreset p {
    margin: 0;
}
</style>

<script setup>
import {hasMathJax, renderMath} from "@/helpers/mathjax";
import {computed, ref, unref, watch, onMounted, onUnmounted} from 'vue';
import MultipleChoiceQuestionComponent from './QuestionTypes/MultipleChoiceQuestion';
import NumberQuestionComponent from './QuestionTypes/NumberQuestion';
import MultipleChoiceQuestion from '@/models/Question/MultipleChoiceQuestion';
import NumberQuestion from '@/models/Question/NumberQuestion';
import InformationCircleIcon from "@/icons/InformationCircleIcon.vue";
import HeroCrossIcon from "@/icons/HeroCrossIcon.vue";

import {handleComponentError} from '@/helpers/errors';
import useLearnStore from '@/stores/learn';

hasMathJax();

handleComponentError();

const {currentExerciseBlock} = useLearnStore();

const question = computed(() => {
    const ceb = unref(currentExerciseBlock)
    const currentQuestion = ceb?.currentQuestion;
    if(currentQuestion === null) ceb?.start();
    return ceb?.currentQuestion
});

const showAnswers = ref(false);
const checkSolution = ref(false);

const showErrorPopup = ref(false)

const toggleShowAnswers = () => showAnswers.value = !showAnswers.value

const performSubmit = () => unref(question).submitAnswers()

const questionComponent = computed(() => {
    const componentMap = [
        {type: MultipleChoiceQuestion, component: MultipleChoiceQuestionComponent},
        {type: NumberQuestion, component: NumberQuestionComponent}
    ];

    const q = unref(question)
    const component = componentMap.find(i => q instanceof i.type)?.component
    if(component === null) throw new Error('Unexpected type of question');
    return component
})

const runCheckSolution = () => {
    if(currentExerciseBlock.value.isRepeating) question.value.submitSkip()
    else checkSolution.value = true
}

watch(question, () => {
    if(question.value)
    {
        unref(question).resetAnswers();
        unref(question).solution = null;
    }
    showAnswers.value = false;
    checkSolution.value = false;
    showErrorPopup.value = false;
    renderMath()
});

const listenForKeyup = async (event) => {
    if (event.code == 'Enter') {
        if (showAnswers.value == false) toggleShowAnswers()
        else performSubmit()
    }
}

onMounted(() => {
    window.addEventListener('keyup', listenForKeyup)
})

onUnmounted(() => {
    window.removeEventListener('keyup', listenForKeyup);
    showAnswers.value = false;
    checkSolution.value = false;
    showErrorPopup.value = false;
})

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

