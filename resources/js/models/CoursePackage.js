import Section from "./Section";

export default class CoursePackage {
    constructor({course_id, id, name, sections}, parent) {
        this.course_id = course_id;
        this.id = id;
        this.name = name;
        this.sections = sections.map(s => new Section(s, this));

        this.parent = parent;
    }

    hasChildren() {
        return this.sections.reduce((value, child) => value || child.hasChildren(), false);
    }

    getChildren() {
        return this.sections.filter(t => t.hasChildren());
    }
}
