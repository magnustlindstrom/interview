import Question from "./Question";

export default class MultipleChoiceQuestion extends Question {
    constructor(args, parent) {
        super(args, parent);

        this.initSelectedAnswers()
    }

    initSelectedAnswers()
    {
        this.selectedAnswers = this.answers.map(a => ({id: a.id, content: a.answer_content, selected: false}));
    }
    resetAnswers(){
        this.initSelectedAnswers()
    }

    toggleSelectAnswer(answer) {
        const isSelected = this.selectedAnswers.find(a => a.id == answer.id).selected
        this.selectedAnswers.find(a => a.id == answer.id).selected = !isSelected
    }

    isSelected(answer) {
        return this.selectedAnswers.filter(a => a.selected).map(a => a.id).includes(answer.id);
    }

    get hasSelected() {
        return this.selectedAnswers.filter(a => a.selected).length > 0
    }

    get passesValidation() {
        return this.hasSelected
    }

    get canSubmit() {
        return this.passesValidation;
    }

    async submitAnswers() {
        if (!this.canSubmit) return
        // TODO: implement try/catch
        const response = await axios.post('question/answer', {
            question: this.id,
            answers: this.selectedAnswers,
        });
        this.setSolution(response.data)
    }

}
