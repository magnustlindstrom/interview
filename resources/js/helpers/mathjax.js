import {nextTick, onMounted, onActivated} from 'vue';

export function hasMathJax() {
    onMounted(async () => await renderMath())
}

export async function renderMath(){
    if (typeof MathJax !== 'undefined') {
        await nextTick();
        MathJax.typeset();
    }
}
