import {reactive, ref, unref} from "vue";
import Question from "./Question";

export default class NumberQuestion extends Question {
    constructor(args, parent) {
        super(args, parent);

        this.providedAnswers = reactive({items: []});
    }

    resetAnswers() {
        this.providedAnswers.items = [];
    }

    get passesValidation(){
        return this.getProvidedAnswers().filter(a => !a.isValid && a.displayValidation).length == 0;
    }

    get actuallyPassesValidation()
    {
        return this.getProvidedAnswers().filter(a => !a.isValid).length == 0;
    }

    get canSubmit() {
        return this.hasProvidedAnswers && this.actuallyPassesValidation;
    }

    addAnswer(answer) {
        this.providedAnswers.items.push(answer);
    }

    getProvidedAnswers() {
        return this.providedAnswers.items;
    }

    removeAnswer(answer) {
        const index = this.providedAnswers.items.indexOf(answer);
        this.providedAnswers.items.splice(index, 1);
    }

    get hasVariableNumberOfAnswers() {
        return this.variable_number_answers ? true : false;
    }

    get hasProvidedAnswers() {
        const providedAnswers = this.getProvidedAnswers();
        if (providedAnswers.length === 0) return false;
        else if (providedAnswers.filter(a => a).length == 0) return false;
        return true;
    }

    async submitAnswers() {
        if (!this.canSubmit) return
        // TODO: implement try/catch
        const response = await axios.post('question/answer', {
            question: this.id,
            answers: this.getProvidedAnswers().map(a => a.value),
        });
        this.setSolution(response.data)
    }
}
