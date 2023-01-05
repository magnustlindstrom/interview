<template>
    <div class="flex justify-start">
        <table>
            <tr v-for="(answer, answerIndex) of answers" :key="answerIndex">
                <td :class="{'pr-2': displayPrefixSuffix}">
                    <div class="whitespace-pre text-right"
                         v-if="displayPrefixSuffix" v-html="answerData[answerIndex]?.prefix"></div>
                </td>

                <td class="rounded w-[150px]">
                    <input :id="`answer-${answerIndex}`" type="text"
                           class="rounded w-[150px]"
                           :class="!answer.isValid && answer.displayValidation ? 'border !ring-1 !border-red-500 !ring-red-500' : ''"
                           v-model="answer.value"
                           @keypress="(event) => { answer.hideValidation(); filterUnwantedCharacters(event, answerIndex)}"
                           @keyup="tidyInput"
                           @input=""
                           v-click-away="() => answer.showValidation()" :tabindex="answerIndex + 1"
                           autocomplete="off"/>
                </td>

                <td :class="{'pl-2': displayPrefixSuffix}">
                    <div class="whitespace-pre text-left"
                         v-if="displayPrefixSuffix" v-html="answerData[answerIndex]?.suffix"></div>
                </td>

                <td class="flex gap-x-2">
                    <button class="px-4 py-2 bg-red-500 text-white hover:brightness-95 transition-colors rounded-md"
                            @click="question.removeAnswer(answer)"
                            v-if="question.hasVariableNumberOfAnswers && answers.length > 1">
                        <HeroTrashIcon class="h-6 w-6"/>
                    </button>

                    <div class="w-[150px]"
                         v-if="question.hasVariableNumberOfAnswers && answerIndex == answers.length - 1">
                        <button
                            class="px-3 gap-x-1 flex py-2 bg-green-300 text-green-700 text-white hover:brightness-95 transition-colors rounded-md w-full justify-center items-center"
                            @click="question.addAnswer(new NumberAnswer)">
                            <HeroPlusIcon class="h-6 w-6"/>
                            <span class="text-md">Add Answer</span>
                        </button>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</template>

<script setup>
import HeroPlusIcon from '@/icons/HeroPlusIcon';
import HeroTrashIcon from '@/icons/HeroTrashIcon';

import {computed, defineProps, onMounted, onUnmounted, ref, toRefs, unref, watchEffect, nextTick} from 'vue';
import {hasMathJax} from "@/helpers/mathjax";
import NumberAnswer from "@/models/NumberAnswer";
import useMainStore from '@/stores/main'

hasMathJax();

const {validators} = useMainStore();

const props = defineProps(['question']);
const {question} = toRefs(props);

const answers = computed(() => unref(question).getProvidedAnswers())
const answerData = computed(() => unref(question).answers);
const displayPrefixSuffix = !unref(question).hasVariableNumberOfAnswers;

const allowed = new RegExp(/^[0-9\,-\/]$/)

const filterUnwantedCharacters = (event, answerIndex) => {
    // TODO: figure out why the DOT is passing through the regex
    if (allowed.test(event.key) && event.code != 'Period') return

    event.target.classList.add('border', '!ring-1', '!border-red-500', '!ring-red-500')
    event.preventDefault();
}

const tidyInput = (event) => {
    event.target.classList.remove('border', '!ring-1', '!border-red-500', '!ring-red-500')
}

watchEffect(() => {
    const ar = answers.value
    if (ar && ar.length > 0 && unref(question).hasVariableNumberOfAnswers) {
        const last = ar.length - 1;
        nextTick(() => {
            document.getElementById(`answer-${last}`).focus({focusVisible: true})
        })
    }
})


const listenForKeyup = async (event) => {
    const q = unref(question)
    if (event.key == '+' && q.hasVariableNumberOfAnswers) q.addAnswer(new NumberAnswer)
}

onMounted(() => {
    let answersOnPage = 1;

    window.addEventListener('keyup', listenForKeyup)

    if (!unref(question).hasVariableNumberOfAnswers) answersOnPage = unref(question).answers.length;
    while (unref(answers).length < answersOnPage) {
        unref(question).addAnswer(new NumberAnswer);
    }

    nextTick(() => {
        document.getElementById(`answer-0`).focus({focusVisible: true})
    })
})

onUnmounted(() => {
    window.removeEventListener('keyup', listenForKeyup);
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
