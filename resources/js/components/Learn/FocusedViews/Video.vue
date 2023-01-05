<template>
    <div class="m-auto shadow-md bg-white rounded-lg p-6 my-6 text-center w-[850px] h-fit">
        <video class="w-full" controls="">
            <source :src="theoryVideo" type="video/mp4">
        </video>
    </div>
</template>

<script setup>
import {computed} from 'vue'
import useLearnStore from '@/stores/learn'
const {currentLearningSequence} = useLearnStore();
const theoryVideo = computed(() => currentLearningSequence.value.theory_video)
</script>
