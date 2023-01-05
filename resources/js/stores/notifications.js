import { reactive, computed } from 'vue'
import {withState} from "@/helpers/store";

const state = reactive({
    items: [],

})
const add = (type, message) => {
    if (!['success', 'error'].includes(type)) return;
    const notification = {type, message};
    state.items.push(notification);
    setTimeout(() => {
        remove(notification);
    }, 5000);
}

const remove = (notification) => {
    state.items.splice(state.items.indexOf(notification), 1);
}

export default () => withState({
    add,
    remove
}, state)
