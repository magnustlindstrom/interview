import Course from './Course';

export default class Class {
    constructor(args, parent) {
        const {
            id,
            name,
            archived_at,
            book_id,
            course,
            course_id,
            created_at,
            end_date,
            full_label,
            school_id,
            student_count,
            teacher_id,
            updated_at,
            will_be_deleted_in
        } = args;

        this.id = id;
        this.name = name;
        this.archived_at = archived_at;
        this.book_id = book_id;
        this.course_id = course_id;
        this.created_at = created_at;
        this.end_date = end_date;
        this.full_label = full_label;
        this.school_id = school_id;
        this.student_count = student_count;
        this.teacher_id = teacher_id;
        this.updated_at = updated_at;
        this.will_be_deleted_in = will_be_deleted_in;

        this.course = new Course(course, this);

        this.parent = parent;
    }

}
