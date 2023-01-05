import {reactive} from 'vue'
import {withState} from "@/helpers/store";
import useNotificationsStore from '@/stores/notifications'

const {add: addNotification} = useNotificationsStore();

const getSavedTheme = () => {
    localStorage.setItem('theme', window.VUE_DATA.theme)
    return window.VUE_DATA.theme
}
const state = reactive({
    active: localStorage.getItem('theme') ?? getSavedTheme(),
    options: ['classic', 'fall', 'vitamin', 'rusty', 'mustard', 'focus', 'nice', 'energy', 'ocean', 'smooth',],
})

const change = (theme) => {
    state.active = theme;
    localStorage.setItem('theme', theme);

    axios.post('settings/theme', {theme: state.active})
        .then((res) => {
            addNotification('success', res.data.message)
        })
        .catch((error) => {
            addNotification('error', 'Could not change theme.');
        })
}
export default () => withState({
    change
}, state)
