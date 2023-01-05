import {reactive} from 'vue'
import {withState} from '@/helpers/store'

const state = reactive({
    showIconText: true,
    title: null,
    percentage: null,
    focused: false,
    unfocusFunction: () => {},
})

const setTitle = (title) => state.title = title;
const focus = (unfocusFunction = () => {}) => {
    state.focused = true;
    state.showIconText = false;
    state.unfocusFunction = unfocusFunction
}

const unfocus = () => {
    state.focused = false;
    state.title = null;
    state.showIconText = true;
    if( typeof state.unfocusFunction == 'function') state.unfocusFunction()
    else console.error('not a function', state.unfocusFunction)
    state.unfocusFunction = () => {}
}

export default () => withState({
    setTitle,
    focus,
    unfocus,
}, state)
