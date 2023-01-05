import Category from "./Category";

export default class Section {
    constructor({id, categories, color, course_package_id, is_published, name}, parent) {
        this.categories = categories.map(c => new Category(c, this))
        this.color = color
        this.course_package_id = course_package_id
        this.id = id
        this.is_published = is_published
        this.name = name

        this.parent = parent
    }

    hasChildren() {
        return this.categories.reduce((value, child) => value || child.hasChildren(), false);
    }

    getChildren(){
        return this.categories.filter(t => t.hasChildren());
    }
}
