<template>
    <div class="flex justify-between rounded-md shadow-md bg-white p-4 gap-2 w-full">
        <div class="flex gap-5 flex-grow">
            <div class="flex items-center flex-shrink max-w-sm">
                <slot name="icon"></slot>
            </div>
            <div class="flex flex-col gap-1 flex-grow">
                <slot>
                    <h3 class="text-lg font-bold" v-html="title"></h3>
                    <div class="unreset" v-html="description"></div>
                </slot>
                <slot name="footer">
                </slot>
            </div>
        </div>

        <div class="flex flex-col gap-2">
            <slot name="buttons"></slot>
        </div>
    </div>
</template>

<script setup>
import {defineProps} from 'vue'

const {title, description} = defineProps({title: {required: true}, description: {required: true}});
</script>

<style scoped>
/deep/ .unreset p{
    margin: 0;
}
</style>
