require("./bootstrap");

import Alpine from 'alpinejs'

import {createApp} from 'vue'
import {i18nVue} from 'laravel-vue-i18n'

import App from './components/App.vue'

const app = createApp(App)
app.use(i18nVue, {
    resolve: (lang) => import(`../../resources/lang/${lang}.json`)
})

app.mount('#app');

function comment() {
    window.Alpine = Alpine;

        Alpine.store('learn', {
            currentLearningSequence: null,
            currentExerciseBlock: null,
            questionCounter: 0,
            currentExerciseQuestions: [],
        });

}
