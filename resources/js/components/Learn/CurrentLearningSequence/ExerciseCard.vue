<template>
    <Card :description="exerciseBlock.description" :title="exerciseBlock.name">
        <template #icon>
            <ExerciseIcon class="h-12 w-12"/>
        </template>
        <template #buttons>
            <div class="flex flex-col justify-between h-full">
                <button class="bg-button text-tertiary px-4 py-2 rounded-md"
                        @click="selectThisExerciseBlock">
                    <span v-if="exerciseBlock.isCompleted">
                        {{ $t('Redo') }}
                    </span>
                    <span v-else>
                        {{ $t('Start') }}
                    </span>
                </button>
                <div class="text-right">
                    {{ exerciseBlock.ePoints }} / {{ exerciseBlock.cPoints }} / {{ exerciseBlock.aPoints }}
                </div>
            </div>


        </template>
        <template #footer>
            <div class="flex gap-1 items-center">
                <span class="font-bold">
                    {{ solvedQuestionsNo }}/{{ requiredQuestionsNo }} {{ pluralizedExerciseString }}
                </span>
                <ExerciseBlockCompletedIcon class="h-8 w-8 text-green-500" v-if="exerciseBlock.isCompleted"/>
                <ExerciseBlockStartedIcon class="h-8 w-8 text-amber-500" v-else-if="exerciseBlock.isStarted"/>
            </div>
        </template>
    </Card>
</template>

<script setup>
import Card from './Card'
import ExerciseIcon from '@/icons/ExerciseIcon'
import ExerciseBlockStartedIcon from '@/icons/ExerciseBlockStartedIcon'
import ExerciseBlockCompletedIcon from '@/icons/ExerciseBlockCompletedIcon'
import {defineProps, computed, unref} from 'vue'

import {wTransChoice} from 'laravel-vue-i18n';

import useLearnStore from '@/stores/learn';

const {selectExerciseBlock} = useLearnStore();

const {exerciseBlock} = defineProps({exerciseBlock: {required: true}});

const selectThisExerciseBlock = () => selectExerciseBlock(exerciseBlock)
const solvedQuestionsNo = computed(() => exerciseBlock.solvedQuestionsNo)
const requiredQuestionsNo = computed(() => exerciseBlock.requiredQuestionsNo)
const pluralizedExerciseString = computed(() => {
    const no = Math.max(unref(solvedQuestionsNo), unref(requiredQuestionsNo))
    return wTransChoice('exercise|exercises', no).value.replace(/^"/, '').replace(/"$/, '')
})
</script>
