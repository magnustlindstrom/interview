<template>
    <ul class="hidden md:flex items-center gap-1">
        <MenuItem
            :active="currentUrlSegmentIs('home')"
            :href="route('student.home')"
            :label="$t('Home')"
        />
        <MenuItem
            :active="currentUrlSegmentIs('learn')"
            :href="route('student.learn')"
            :label="$t('Learn')"
        />
        <MenuItem
            :active="currentUrlSegmentIs('review')"
            :href="route('student.review')"
            :label="$t('Review')"
        />
        <MenuItem
            :active="currentUrlSegmentIs('lessons')"
            :href="route('student.lessons')"
            :label="$t('Lessons')"
        />
    </ul>
</template>

<script setup>
import MenuItem from './MenuItem';
import useMainStore from '@/stores/main'

const {currentUrlSegmentIs, route} = useMainStore();
</script>
