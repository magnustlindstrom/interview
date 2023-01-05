import {computed} from 'vue'
export const withState =  (target, state)=>{
    Object.keys(state).forEach(prop =>{
        target[prop] = computed(()=> state[prop])
    })
    return target
}
