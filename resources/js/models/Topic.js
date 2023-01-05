import LearningSequence from "./LearningSequence";

export default class Topic {
    constructor({id, name, category_id, is_published, learning_sequences}, parent) {
        this.id = id;
        this.name = name;
        this.category_id = category_id;
        this.is_published = is_published;
        this.learning_sequences = learning_sequences.map(ls => new LearningSequence(ls, this));

        this.parent = parent;
    }

    hasChildren() {
        return this.learning_sequences.reduce((value, child) => value || child.hasChildren(), false);
    }

    getChildren(){
        return this.learning_sequences.filter(t => t.hasChildren());
    }
}
