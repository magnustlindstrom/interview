import useMainStore from '@/stores/main'
const {validators} = useMainStore();

export default class NumberAnswer{
    constructor(value = '') {
        this.displayValidation = false;
        this.value = value;
    }

    showValidation(){
        this.displayValidation = true;
    }

    hideValidation(){
        this.displayValidation = false;
    }

    get isValid(){
        if(this.value.length == 0) return true;

        return Object.values(validators.value)
            .reduce((accumulator, v) => accumulator || (new RegExp(v).test(this.value)), false)
    }
}
