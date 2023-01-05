<template>
    <div class="px-6 py-8">
        <h1 class="font-bold text-2xl mb-12">{{ $t('Hello') }} {{ user.first_name }}!</h1>
    </div>
</template>

<script setup>
import useMainStore from '@/stores/main';

const {user} = useMainStore();
</script>
