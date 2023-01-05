<template>
    <div class="ml-4 mt-1 bg-white rounded-md p-1">
        <div
            class="flex align-items-center mx-0 justify-content-between select-none cursor-pointer expandable"
            @click="toggleExpand">
            <div class="flex gap-5 items-center">
                <HeroCaretRightIcon :class="{'rotate-90': expanded}" class="h-6 w-6 transition-all"/>

                <span v-html="topic.name"></span>

                <div class="flex gap-2 items-center">
                    <div class="flex gap-1">
                        <div v-for="learningSequence in topic.learning_sequences">
                            <HeroSquareIcon class="fill-green-400 stroke-green-400"
                                            v-if="learningSequence.isCompleted"/>
                            <HeroSquareIcon class="fill-amber-400 stroke-amber-400"
                                            v-else-if="learningSequence.isStarted"/>
                            <HeroSquareIcon class="fill-transparent stroke-blue-400" v-else/>
                        </div>
                    </div>
                    <!--
                    <span>
                        {{ learningSequenceNo }} learning {{ learningSequenceNo == 1 ? 'sequence' : 'sequences' }}
                    </span>
                    -->
                </div>
            </div>
        </div>

        <template v-for="sequence in topic.learning_sequences">
            <div :class="{'hidden': !expanded}" class="pl-12 mt-1">
                <LearningSequence :learning-sequence="sequence"/>
            </div>
        </template>
    </div>
</template>

<script setup>
import HeroSquareIcon from '@/icons/HeroSquareIcon';
import HeroCaretRightIcon from '@/icons/HeroCaretRightIcon';
import LearningSequence from "./LearningSequence";
import {computed, defineProps, ref} from 'vue';

const {topic} = defineProps({
    topic: {
        required: true
    }
})

const learningSequenceNo = computed(() => topic.getChildren().length)
const expanded = ref(false)
const toggleExpand = () => expanded.value = !expanded.value;
</script>
