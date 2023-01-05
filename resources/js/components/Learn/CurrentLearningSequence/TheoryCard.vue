<template>
    <Card :description="sequence.description" :title="$t('Theory')">
        <template #icon>
            <TheoryIcon class="h-12 w-12"/>
        </template>
        <template #buttons>
            <button class="bg-button text-tertiary px-4 py-2 rounded-md"
                    @click="emit('showTheory')">{{ $t('Read') }}
            </button>
            <button class="bg-button text-tertiary px-4 py-2 rounded-md"
                    @click="emit('showVideo')">{{ $t('Watch') }}
            </button>
        </template>
    </Card>
</template>

<script setup>

import TheoryIcon from '@/icons/TheoryIcon'
import Card from './Card'
import {defineProps} from 'vue'

const emit = defineEmits(['showTheory', 'showVideo']);
const {sequence} = defineProps({sequence: {required: true}});
</script>
