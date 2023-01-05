import {computed, reactive, unref, watch} from 'vue'
import {withState} from '@/helpers/store';
import useHeaderStore from '@/stores/header';
import useMainStore from '@/stores/main';

const {focus, setTitle} = useHeaderStore();
const {selectedClass} = useMainStore()

const state = reactive({
    currentLearningSequence: null,
    currentExerciseBlock: null,
    questionCounter: 0,
    solving: false,
});

const setQuestionCounter = (count) => {
    state.questionCounter = count;
}

const goalGrade = computed(() => {
    return unref(selectedClass).grade;
});

const currentTopic = computed(() => {
    return state.currentLearningSequence.parent;
});

const unfocusFn = () => unselectExerciseBlock()

const selectExerciseBlock = async (eb) => {
    if(eb.isCompleted) await eb.start()

    state.currentExerciseBlock = eb;
    const headerTitle = state.currentLearningSequence.title + eb.name
    setTitle(headerTitle)
    focus(unfocusFn);
}
const unselectExerciseBlock = () => {
    state.currentExerciseBlock.stop();
    state.currentExerciseBlock = null;

}

export default () => withState({
    hasSelectedLearningSequence: computed(() => state.currentLearningSequence !== null),
    selectLearningSequence: (ls) => state.currentLearningSequence = ls,

    hasExerciseBlock: computed(() => state.currentExerciseBlock !== null),
    selectExerciseBlock,
    unselectExerciseBlock,

    currentTopic,
    goalGrade,
}, state)
