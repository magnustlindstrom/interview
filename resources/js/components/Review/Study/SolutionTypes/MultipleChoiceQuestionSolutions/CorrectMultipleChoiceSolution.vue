<template>
    <table class="w-auto m-auto table-fixed">
        <tbody>
        <tr v-for="answer in answerTable">
            <td class="w-10 flex items-center justify-center">
                <CorrectIcon class="w-7 h-7 text-green-500" v-if="answer.is_correct === true"/>
            </td>
            <td class="py-1 px-2" :class="{
                                       'font-bold': answer.correct,
                                       'bg-green-200': answer.correct,
                                }" v-html="answer.content"></td>
            <td class="w-10"></td>
        </tr>
        </tbody>
    </table>
</template>

<script setup>
import {defineProps} from 'vue';
import CorrectIcon from '@/icons/CorrectIcon';

const {answerTable} = defineProps({answerTable: {'required': true}});
</script>
