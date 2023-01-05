import moment from "moment/moment";
import axios from "axios";
import {watch} from "vue";
import QuestionTypeMapToClass from "@/models/Question/Type";

export default class ExerciseBlock {
    constructor(args, parent) {
        const {
            id,
            name,
            description,
            a_goal_grade_minimum: aGoalGradeMinimum,
            b_goal_grade_minimum: bGoalGradeMinimum,
            c_goal_grade_minimum: cGoalGradeMinimum,
            d_goal_grade_minimum: dGoalGradeMinimum,
            e_goal_grade_minimum: eGoalGradeMinimum,
            a_points: aPoints,
            c_points: cPoints,
            e_points: ePoints,
            duration_in_seconds: durationInSeconds,
            goal_grade_string: goalGradeString,
            grade_points_string: gradePointsString,
            learning_sequence_id: learningSequenceId,
            order_column: orderColumn,
            required_no_questions: requiredQuestionsNo,
            similar_solution: similarSolution,
            seen_questions_no: seenQuestionsNo,
            answered_questions_no: answeredQuestionsNo,
            solved_questions_no: solvedQuestionsNo,
        } = args;

        this.id = id;
        this.name = name;
        this.description = description;
        this.aGoalGradeMinimum = aGoalGradeMinimum;
        this.bGoalGradeMinimum = bGoalGradeMinimum;
        this.cGoalGradeMinimum = cGoalGradeMinimum;
        this.dGoalGradeMinimum = dGoalGradeMinimum;
        this.eGoalGradeMinimum = eGoalGradeMinimum;
        this.goalGradeMinimum = {
            a: this.aGoalGradeMinimum,
            b: this.bGoalGradeMinimum,
            c: this.cGoalGradeMinimum,
            d: this.dGoalGradeMinimum,
            e: this.eGoalGradeMinimum,
        }
        this.aPoints = aPoints;
        this.cPoints = cPoints;
        this.ePoints = ePoints;
        this.points = {
            a: this.aPoints,
            c: this.cPoints,
            e: this.ePoints,
        }

        this.durationInSeconds = durationInSeconds;
        this.goalGradeString = goalGradeString;
        this.gradePointsString = gradePointsString;
        this.learningSequenceId = learningSequenceId;
        this.orderColumn = orderColumn;
        this.similarSolution = similarSolution;

        this.attemptedQuestionsNo = 0;
        this.requiredQuestionsNo = requiredQuestionsNo;
        this.seenQuestionsNo = seenQuestionsNo;
        this.answeredQuestionsNo = answeredQuestionsNo;
        this.solvedQuestionsNo = solvedQuestionsNo;

        this.currentQuestion = null;
        this.solvedQuestions = [];
        this.repeatQuestions = [];
        this.answeredQuestions = [];

        this.parent = parent;
        this.solving = false;

        this.fetchSolvedQuestions()
            .then(() => {});
    }

    async start(){
        if(this.isCompleted) await this.fetchRepeatQuestions();
        this.startNextQuestion();

        this.attemptedQuestionsNo = 0;
        this.solving = true;
    }

    stop(){
        this.solving = false;
        this.attemptedQuestionsNo = 0;
        this.currentQuestion = null;
    }


    async fetchSolvedQuestions(){
        try{
            const response = await axios.get(`exercise-block/${this.id}`)
            this.solvedQuestionsNo = response.data.number;
            this.solvedQuestions = response.data.questions;
        } catch(e) {
            throw(e);
        }
    }

    async fetchRepeatQuestions(){
        try{
            const response = await axios.get(`exercise-block/${this.id}/repeat`)
            this.repeatQuestions = response.data.map(q =>  new (QuestionTypeMapToClass(q))(q, this));
        } catch(e){
            throw(e);
        }
    }
    async startNextQuestion(){
        if(this.currentQuestion != null) this.attemptedQuestionsNo++;
        if(this.isCompleted) {
            const oldQuestion = this.currentQuestion;
            const index = this.repeatQuestions.map(q => q.id).indexOf(this.currentQuestion?.id);
            this.currentQuestion = this.repeatQuestions[index + 1]

            if(oldQuestion !== null) oldQuestion.solution = null;
        }
        else await this.fetchQuestion()
    }

    async fetchQuestion() {
        const {data: questionData } = await axios.post('question/fetch', {exercise: this.id});
        const question = new (QuestionTypeMapToClass(questionData))(questionData, this)
        this.currentQuestion = question;
        return question;
    }

    get questionsRemaining() {
        const questionsRemaining = this.requiredQuestionsNo - this.solvedQuestionsNo;

        if (questionsRemaining < 0) return 0;
        return questionsRemaining;
    }
    get timeLeft() {
        const timeLeft = (this.durationInSeconds ?? 0) * this.questionsRemaining;
        return moment.duration(timeLeft, 'seconds').locale(document.documentElement.lang).humanize();
    }

    get isStarted(){
        return this.solvedQuestionsNo > 0;
    }

    get isCompleted(){
        return this.questionsRemaining == 0 && this.requiredQuestionsNo > 0;
    }

    get isRepeating(){
        return this.isCompleted && this.repeatQuestions.length > 0 && this.currentQuestion !== null;
    }
}
