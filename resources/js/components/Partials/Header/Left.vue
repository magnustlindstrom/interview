<template>
    <a href="/home" class="flex items-center w-1/5">
        <PluggamatteLogo class="h-12 fill-primary" :hide-text="focused"/>
    </a>
</template>

<script setup>
import PluggamatteLogo from '@/icons/PluggamatteLogo'
import useHeaderStore from '@/stores/header'

const {focused} = useHeaderStore();
</script>
