<template>
    <div class="flex flex-col w-full overflow-y-scroll p-4 items-center">
        <h3 class="text-xl font-bold w-full text-center" v-html="learningSequence.title"></h3>
        <span v-if="learningSequenceIsEmpty">This learning sequence has no exercises yet.</span>
        <div v-else class="flex flex-col gap-5 w-10/12 py-8">
            <TheoryCard :sequence="learningSequence"
                        @show-theory="emit('showTheory')"
                        @show-video="emit('showVideo')"/>

            <FollowUpQuestionsCard sequence="learningSequence"/>

            <ExerciseCard v-for="exerciseBlock in learningSequence.exercises" :key="exerciseBlock.id"
                          :exercise-block="exerciseBlock"/>
        </div>
    </div>
</template>

<script setup>
import {computed, unref} from 'vue'
import TheoryCard from './TheoryCard';
import FollowUpQuestionsCard from './FollowUpQuestionsCard';

import useLearnStore from '@/stores/learn'
import ExerciseCard from "./ExerciseCard";

const {currentLearningSequence: learningSequence} = useLearnStore();

const emit = defineEmits(['showTheory', 'showVideo']);
const learningSequenceIsEmpty = computed(() => unref(learningSequence).getChildren().length === 0);
</script>
