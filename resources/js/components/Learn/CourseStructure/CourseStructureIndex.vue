<template>
    <div class="flex h-[calc(100vh-57px)] w-full">
        <div class="w-1/2 p-4 bg-white overflow-y-scroll">
            <CourseStructure :course="coursePackage"/>
        </div>
        <div class="flex w-1/2 flex-grow overflow-hidden">
            <LearningSequenceDetailed v-if="hasSelectedLearningSequence"
                                      @show-theory="$emit('changeView', 'theory')"
                                      @show-video="$emit('changeView', 'video')"/>
            <div v-else class="p-4">{{ $t('Select a learning sequence to view here') }}</div>
        </div>
    </div>
</template>

<script setup>
import CourseStructure from '@/components/Learn/CourseStructure/CourseStructure';
import LearningSequenceDetailed from '@/components/Learn/CurrentLearningSequence/LearningSequenceDetailed';

import {defineEmits, unref} from 'vue'
import useMainStore from '@/stores/main'
import useLearnStore from '@/stores/learn'

const {selectedClass} = useMainStore();
const {hasSelectedLearningSequence, currentLearningSequence} = useLearnStore();
const {coursePackage} = unref(selectedClass).class.course


const emit = defineEmits(['changeView'])

</script>
