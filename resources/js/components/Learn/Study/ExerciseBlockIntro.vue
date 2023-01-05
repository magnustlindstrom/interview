<template>
    <div class="md:w-1/3 mx-auto lg:py-8 py-6">
        <div class="px-16 py-6 bg-white shadow-md rounded-md max-h-full _overflow-y-scroll">
            <div class="flex flex-col gap-8">
                <h2 class="font-bold text-center w-full text-2xl"
                    v-html="currentExerciseBlock?.name"></h2>
                <div class="font-bold text-lg">
                    <div class="flex gap-1">
                        <span>{{ $t('Your goal grade is') }}:</span>
                        <span class="capitalize">{{ goalGrade }}</span>
                    </div>
                    <div class="flex gap-1">
                        <span>{{ $t('Exercises completed') }}:</span>
                        <span>{{ solvedQuestionsNo }}/{{ requiredQuestionsNo }}</span>
                    </div>
                    <div class="flex gap-1 justify-start py-3" v-if="solvedQuestionsNo && requiredQuestionsNo">
                        <HeroSquareIcon class="w-6 h-6 stroke-green-400 fill-green-400"
                                        v-for="i in solvedQuestionsNo" :key="i"/>
                        <HeroSquareIcon class="w-6 h-6 stroke-blue-400 fill-transparent"
                                        v-for="i in Math.max(0, requiredQuestionsNo - solvedQuestionsNo)" :key="i"/>
                    </div>
                    <div class="flex gap-1">
                        <span>{{ $t('Estimated time') }}:</span>
                        <span>{{ currentExerciseBlock?.timeLeft }}</span></div>
                </div>

                <div class="w-full flex justify-center">
                    <button
                        class="bg-button text-tertiary rounded-md px-8 py-3 hover:brightness-75 transition-colors"
                        @click="startExerciseBlock">
                            <span v-if="hasCompleted">
                                {{ $t('Redo') }} ({{ requiredQuestionsNo }} {{ $t('old exercises') }})
                            </span>
                        <span v-else>
                                {{ $t('Start') }}
                            </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed, unref, onMounted, onUnmounted} from 'vue';
import useLearnStore from '@/stores/learn';
import HeroSquareIcon from '@/icons/HeroSquareIcon';

const {currentExerciseBlock, goalGrade} = useLearnStore();
const solvedQuestionsNo = computed(() => unref(currentExerciseBlock)?.solvedQuestionsNo);
const requiredQuestionsNo = computed(() => unref(currentExerciseBlock)?.requiredQuestionsNo);

const hasCompleted = computed(() => solvedQuestionsNo.value == requiredQuestionsNo.value)
const startExerciseBlock = async () => await unref(currentExerciseBlock)?.start()

const listenForEnterKey = async (event) => {
    if(event.code == 'Enter') await startExerciseBlock()
};

onMounted(() => {
    window.addEventListener('keyup', listenForEnterKey)
})

onUnmounted(() => {
    window.removeEventListener('keyup', listenForEnterKey);
})
</script>
