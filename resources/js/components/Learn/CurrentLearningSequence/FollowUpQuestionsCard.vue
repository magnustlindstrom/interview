<template>
    <Card :description="sequence.description" :title="$t('Follow-up questions')">
        <template #icon>
            <FollowUpQuestionsIcon class="h-12 w-12"/>
        </template>
        <template #buttons>
            <button class="bg-button text-tertiary px-4 py-2 rounded-md">{{ $t('Start') }}</button>
        </template>
    </Card>
</template>

<script setup>
import FollowUpQuestionsIcon from '@/icons/FollowUpQuestionsIcon'
import Card from './Card'
import {defineProps} from 'vue'

const {sequence} = defineProps({sequence: {required: true}});
</script>
