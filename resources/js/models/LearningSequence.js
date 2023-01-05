import ExerciseBlock from "./ExerciseBlock";

export default class LearningSequence {
    constructor({id, description, exercises, follow_up_questions, theory_content, title, topic_id}, parent) {
        this.description = description;
        this.exercises = exercises.map(e => new ExerciseBlock(e, this));
        this.follow_up_questions = follow_up_questions;
        this.id = id;
        this.theory_content = theory_content;
        this.title = title;
        this.topic_id = topic_id;

        this.parent = parent
    }

    hasChildren() {
        return this.exercises.length > 0;
    }

    getChildren(){
        return this.exercises
    }

    get isStarted(){
        return this.exercises.reduce((res, e) => res || e.isStarted , false);
    }

    get isCompleted(){
        return this.exercises.reduce((res, e) => res && e.isCompleted , true);
    }
}
