<template>
    <table class="w-full table-fixed">
        <thead>
        <tr>
            <th class="w-10"></th>
            <th class="text-lg" :colspan="displayPrefixSuffix ? 3 : 1">{{ $t('Your answers') }}</th>
            <th class="text-lg" :colspan="displayPrefixSuffix ? 3 : 1">{{ $t('Correct answers') }}</th>
            <th class="w-10"></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="answer in answerTable">
            <td class="w-10 flex items-center justify-center">
                <CorrectIcon class="w-7 h-7 text-green-500" v-if="answer.is_correct === true"/>
                <IncorrectIcon class="w-7 h-7 text-red-500" v-else-if="answer.is_correct === false"/>
            </td>
            <td
                :class="[answer.is_correct ? 'bg-green-200' : 'bg-red-200' ]"
                class="pr-2 text-right"
                v-if="displayPrefixSuffix"
                v-html="answer.prefix"></td>

            <td
                :class="[answer.is_correct ? 'bg-green-200' : 'bg-red-200' ]"
                class="p-1 ">
                <div class="flex gap-2">
                    <span :class="{'font-bold': displayPrefixSuffix}"
                          v-html="answer.given" v-if="!skipped"></span>
                </div>
            </td>

            <td
                :class="[answer.is_correct ? 'bg-green-200' : 'bg-red-200' ]"
                class="pr-2 text-left"
                v-if="displayPrefixSuffix"
                v-html="answer.suffix"></td>

            <td
                :class="[answer.correct ? 'bg-green-200' : 'bg-red-200' ]"
                class="pr-2 text-right"
                v-if="displayPrefixSuffix"
                v-html="answer.prefix"></td>

            <td
                :class="[answer.correct ? 'bg-green-200' : 'bg-red-200' ]"
                class="p-1">
                <div class="flex gap-2">
                    <span :class="{'font-bold': displayPrefixSuffix}"
                          v-html="answer.correct" v-if="!skipped"></span>
                    <template v-if="answer.given !== answer.correct && answer.is_correct">
                        <span class="italic font-bold" v-if="!skipped">{{ $t('or') }}</span>
                        <span :class="{'font-bold': displayPrefixSuffix}"
                              v-html="answer.given"></span>
                    </template>
                </div>
            </td>

            <td
                :class="[answer.correct ? 'bg-green-200' : 'bg-red-200' ]"
                class="pr-2 text-left"
                v-if="displayPrefixSuffix"
                v-html="answer.suffix"></td>

            <td class="w-10"></td>
        </tr>
        </tbody>
    </table>
</template>

<script setup>
import {unref, defineProps, computed} from 'vue';
import IncorrectIcon from '@/icons/IncorrectIcon';
import CorrectIcon from '@/icons/CorrectIcon';
import useLearnStore from '@/stores/learn';

const {currentExerciseBlock} = useLearnStore();
const ceb = unref(currentExerciseBlock)

const displayPrefixSuffix = computed(() => !ceb.currentQuestion.hasVariableNumberOfAnswers );
const {answerTable} = defineProps({answerTable: {'required': true}});
</script>
