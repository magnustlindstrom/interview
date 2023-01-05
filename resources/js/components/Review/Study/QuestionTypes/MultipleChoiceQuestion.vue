<template>
    <div class="grid grid-cols-1 gap-x-10 gap-y-2">
        <template v-for="(answer, key) in question.answers">
            <div class="flex gap-2">
                <div class="p-2">
                    <div v-if="key/26 < 1">{{ String.fromCharCode(65 + key) }}.</div>
                    <div class="flex" v-else>
                        <span>{{ String.fromCharCode(65 + Math.floor(key / 26) - 1) }}</span>
                        <span>{{ String.fromCharCode(65 + key % 26) }}.</span>
                    </div>
                </div>
                <div
                    class="border rounded-md hover:border-blue-300 outline-offset-4 p-3 flex-grow cursor-pointer"
                    v-html="answer.answer_content"
                    :class="{'bg-gray-300': question.isSelected(answer)}"
                    @click="() => question.toggleSelectAnswer(answer)"></div>
            </div>
        </template>
    </div>
</template>

<script setup>
import {defineProps, onMounted, onUnmounted, unref} from 'vue';

const {question} = defineProps(['question']);


const listenForKeyup = async (event) => {
    const q = unref(question)
    const pressedKey = event.key.toLocaleUpperCase()

    const hasMoreAnswersThanAlphabetHasLetters = q.answers.length > 26
    const charCode = pressedKey.charCodeAt(0);

    if(pressedKey.length !== 1) return;
    if(hasMoreAnswersThanAlphabetHasLetters) return;

    if(charCode >= 65 && charCode <= 90) {
        console.log(q.answers, charCode)
        q.toggleSelectAnswer(q.answers[charCode - 65])
    }
}

onMounted(() => {
    window.addEventListener('keyup', listenForKeyup)
})

onUnmounted(() => {
    window.removeEventListener('keyup', listenForKeyup);
})
</script>
