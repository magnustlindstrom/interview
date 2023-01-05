export default class Question {
    constructor({id, question_content, answer_type, answers, variable_number_answers}, parent) {
        this.id = id;
        this.content = question_content;
        this.answer_type = answer_type;
        this.answers = answers;
        this.variable_number_answers = variable_number_answers;

        this.solution = null;
        this.parent = parent;
    }

    get type() {
        return this.answer_type == 2 ? 'MultipleChoiceQuestion' : 'NumberQuestion'
    }

    async submitSkip() {
        const response = await axios.post('question/answer', {
            question: this.id,
            answers: null
        });
        this.setSolution(response.data)
    }

    setSolution(solution) {
        this.parent.fetchSolvedQuestions();
        this.solution = solution;
    }

    get hasSolution(){
        return this.solution !== null;
    }
}
