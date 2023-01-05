<template>
    <nav class="bg-tertiary flex w-full justify-between font-black text-md text-secondary px-1 md:px-8 pt-1 border-b-4 border-accent sticky top-0 z-10">
        <Left/>

        <Center/>

        <Right/>
    </nav>
</template>

<script setup>
import Left from './Left'
import Center from './Center'
import Right from './Right'
</script>
