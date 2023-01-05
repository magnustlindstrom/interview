<template>
    <Suspense v-if="activeView">
        <KeepAlive>
            <component :is="activeView" @change-view="changeView"/>
        </KeepAlive>
    </Suspense>
</template>

<script setup>
import {computed, ref, unref} from 'vue'

import TheoryView from '@/components/Learn/FocusedViews/Theory';
import VideoView from '@/components/Learn/FocusedViews/Video';
import CourseStructureIndex from '@/components/Learn/CourseStructure/CourseStructureIndex';

import useHeaderStore from '@/stores/header'
import useLearnStore from '@/stores/learn'

const {currentLearningSequence} = useLearnStore();
const {focus, setTitle: setFocusModeTitle} = useHeaderStore();

let currentView = ref('normal');

const changeView = (type) => {
    currentView.value = type;

    const topicName = unref(currentLearningSequence).parent.name
    const learningSequenceName = unref(currentLearningSequence).title

    setFocusModeTitle(topicName + learningSequenceName)
    focus(() => currentView.value = 'normal')
}

const activeView = computed(() => {
    if (currentView.value == 'theory') return TheoryView;
    else if (currentView.value == 'video') return VideoView;
    return CourseStructureIndex;
})
</script>
