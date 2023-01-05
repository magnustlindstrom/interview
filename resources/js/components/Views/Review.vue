<template>
    <div class="flex min-h-full _h-[calc(100vh-57px)] _max-h-full _overflow-hidden">
        <KeepAlive>
            <div class="flex-col gap-y-4 w-full">
                <div class="rounded-lg flex flex-col gap-4 p-6 pt-2">
                    <div class="w-1/2 max-w-lg">
                        <div class="flex gap-2 p-4 font-medium">
                            <div @click="() => tab = 'review'"
                                 class="px-4 border-transparent border-b-2 cursor-pointer"
                                 :class="{'border-gray-600': tab == 'review'}">{{ $t('Review') }} (16)
                            </div>
                            <div @click="() => tab = 'knowledge'"
                                 class="px-4 border-transparent border-b-2 cursor-pointer"
                                 :class="{'border-gray-600': tab == 'knowledge'}">{{ $t('My knowledge') }} (134)
                            </div>
                        </div>

                        <div class="bg-gray-300 rounded p-8">
                            <div v-show="tab == 'review'">
                                <h2 class="text-4xl">16</h2>
                                <p class="text-md mb-8">{{ $t('question ready to review') }}</p>
                                <div>
                                    <button class="bg-button text-tertiary px-4 py-2 rounded-md">Review 5 now</button>
                                </div>
                            </div>

                            <div v-show="tab == 'knowledge'">
                                to be continued
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </KeepAlive>
    </div>
</template>

<!--            <component :is="displayComponent"></component>-->

<script setup>
import {computed, ref} from 'vue';
import Index from '@/components/Learn/Index'
import Study from '@/components/Learn/Study'

import useLearnStore from '@/stores/learn'


const tab = ref('review');

const {hasExerciseBlock} = useLearnStore();
const displayComponent = computed(() => hasExerciseBlock.value ? Study : Index);

</script>
