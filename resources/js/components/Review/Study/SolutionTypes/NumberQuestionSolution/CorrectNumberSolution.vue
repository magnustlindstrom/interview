<template>
    <table class="w-auto m-auto table-fixed">
        <tbody>
        <tr v-for="answer in answerTable">
            <td class="w-10">
                <CorrectIcon class="w-7 h-7 text-green-500" v-if="!skipped"/>
            </td>
            <td class="bg-green-200 pr-2 text-right" v-if="displayPrefixSuffix" v-html="answer.prefix"></td>
            <td class="p-1 bg-green-200 flex gap-2">
                <span :class="{'font-bold': displayPrefixSuffix}"
                      v-html="answer.given" v-if="!skipped"></span>
                <template v-if="answer.given !== answer.correct">
                    <span class="italic font-bold" v-if="!skipped">{{ $t('or') }}</span>
                    <span :class="{'font-bold': displayPrefixSuffix}"
                          v-html="answer.correct"></span>
                </template>
            </td>
            <td class="bg-green-200 pl-2 text-left" v-if="displayPrefixSuffix" v-html="answer.suffix"></td>
            <td class="w-10"></td>
        </tr>
        </tbody>
    </table>
</template>

<script setup>
import {defineProps, unref, computed} from 'vue';
import CorrectIcon from '@/icons/CorrectIcon';
import useLearnStore from '@/stores/learn';

const {currentExerciseBlock} = useLearnStore();
const ceb = unref(currentExerciseBlock)

const displayPrefixSuffix = computed(() => !ceb.currentQuestion.hasVariableNumberOfAnswers );
const {answerTable, skipped} = defineProps({answerTable: {'required': true}, skipped: {default: false}});
</script>
