import {reactive, computed} from 'vue'
import {withState} from '@/helpers/store'
import StudentClass from "../models/StudentClass";

const state = reactive({
    locale: window.VUE_DATA.locale,
    user: window.VUE_DATA.user,
    selectedClass: new StudentClass(window.VUE_DATA.selectedClass),
    classes: window.VUE_DATA.classes,
    validators: window.VUE_DATA.validators,
})


const currentUrlSegment = (index) => {
    const currentUrl = (new URL(window.location.href))
    return currentUrl.pathname.split('/')[1];
}

export default () => withState({
    unselectedClasses: computed(() => state.classes.filter(c => c.id != state.selectedClass.class_id)),
    currentUrlSegmentIs(path, index = 1) {
        return currentUrlSegment(index) === path;
    },
    currentUrlSegment,
    route(name) {
        const path = name.split('.')[1];
        return new URL(window.location.href).origin + '/' + path
    }
}, state)
