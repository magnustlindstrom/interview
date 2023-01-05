<template>
    <div class="flex items-center mx-0 gap-3">
        <svg class="h-2 w-2" fill="currentColor"
             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16z"
                  fill-rule="evenodd"/>
        </svg>

        <a class="text-indigo-500 visited:text-indigo-800 cursor-pointer"
           @click="selectLearningSequence( learningSequence )"
           v-html="learningSequence.title"></a>

        <div class="flex gap-1">
            <div v-for="exerciseBlock in learningSequence.exercises">
                <HeroSquareIcon class="fill-green-400 stroke-green-400" v-if="exerciseBlock.isCompleted"/>
                <HeroSquareIcon class="fill-amber-400 stroke-amber-400" v-else-if="exerciseBlock.isStarted"/>
                <HeroSquareIcon class="fill-transparent stroke-blue-400" v-else/>
            </div>
        </div>
    </div>
</template>

<script setup>
import {defineProps} from 'vue';
import HeroSquareIcon from '@/icons/HeroSquareIcon';
import useLearnStore from '@/stores/learn';

const {learningSequence} = defineProps({
    learningSequence: {
        required: true
    }
})

const {selectLearningSequence} = useLearnStore();
</script>
