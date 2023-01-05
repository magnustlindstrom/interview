import CoursePackage from "./CoursePackage";

export default class Course {
    constructor({course_package, created_at, deleted_at, id, name, updated_at}) {
        this.coursePackage = new CoursePackage(course_package);
        this.created_at = created_at;
        this.deleted_at = deleted_at;
        this.id = id;
        this.name = name;
        this.updated_at = updated_at;
    }
}
