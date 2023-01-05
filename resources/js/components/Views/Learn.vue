<template>
    <div class="flex min-h-full _h-[calc(100vh-57px)] _max-h-full _overflow-hidden">
        <KeepAlive>
            <component :is="displayComponent"></component>
        </KeepAlive>
    </div>
</template>

<script setup>
import {computed} from 'vue';
import Index from '@/components/Learn/Index'
import Study from '@/components/Learn/Study'

import useLearnStore from '@/stores/learn'
const {hasExerciseBlock} = useLearnStore();
const displayComponent = computed( () => hasExerciseBlock.value ? Study : Index);

</script>
