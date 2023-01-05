<template>
    <table class="w-full table-fixed">
        <thead>
        <tr>
            <th class="w-10"></th>
            <th class="text-lg">{{ $t('Your answers') }}</th>
            <th class="text-lg">{{ $t('Correct answers') }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="answer in answerTable">
            <td class="w-10 flex items-center justify-center">
                <CorrectIcon class="w-7 h-7 text-green-500" v-if="answer.is_correct === true"/>
                <IncorrectIcon class="w-7 h-7 text-red-500" v-else-if="answer.is_correct === false"/>
            </td>
            <td class="p-1" :class="{
                                       'font-bold': answer.selected,
                                       'bg-green-200': answer.selected && answer.is_correct,
                                       'bg-red-200': answer.selected && !answer.is_correct
                                }" v-html="answer.content"></td>
            <td class="p-1" :class="{'font-bold bg-green-200': answer.correct}" v-html="answer.content"></td>
        </tr>
        </tbody>
    </table>
</template>

<script setup>
import {defineProps} from 'vue';
import IncorrectIcon from '@/icons/IncorrectIcon';
import CorrectIcon from '@/icons/CorrectIcon';

const {answerTable} = defineProps({answerTable: {'required': true}});
</script>
