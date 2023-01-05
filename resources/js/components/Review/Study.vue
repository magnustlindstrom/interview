<template>
    <Suspense>
        <component :is="activeView"/>
        <template #fallback>
            <div class="border border-blue-300 shadow rounded-md p-4 max-w-sm w-full mx-auto">
                <div class="animate-pulse flex space-x-4">
                    <div class="rounded-full bg-slate-700 h-10 w-10"></div>
                    <div class="flex-1 space-y-6 py-1">
                        <div class="h-2 bg-slate-700 rounded"></div>
                        <div class="space-y-3">
                            <div class="grid grid-cols-3 gap-4">
                                <div class="h-2 bg-slate-700 rounded col-span-2"></div>
                                <div class="h-2 bg-slate-700 rounded col-span-1"></div>
                            </div>
                            <div class="h-2 bg-slate-700 rounded"></div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </Suspense>
</template>

<script setup>
import {computed, unref} from 'vue';
import ExerciseBlockIntro from '@/components/Learn/Study/ExerciseBlockIntro'
import Question from '@/components/Learn/Study/Question';
import Solution from '@/components/Learn/Study/Solution';

import useLearnStore from '@/stores/learn'

const {currentExerciseBlock} = useLearnStore();

const activeView = computed(() => {
    const ceb = unref(currentExerciseBlock)
    if (ceb?.solving || ceb?.isCompleted)
    {
        if(ceb?.currentQuestion?.hasSolution) return Solution;
        if(ceb?.currentQuestion) return Question;
    }
    return ExerciseBlockIntro;
})
</script>
