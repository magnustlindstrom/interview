import Topic from './Topic';

export default class Category {
    constructor({id, name, is_published, section_id, topics}, parent) {
        this.id = id;
        this.name = name;
        this.is_published = is_published;
        this.section_id = section_id;
        this.topics = topics.map(t => new Topic(t, this));

        this.parent = parent;
    }

    hasChildren() {
        return this.topics.reduce((value, child) => value || child.hasChildren(), false);
    }

    getChildren(){
        return this.topics.filter(t => t.hasChildren());
    }
}
