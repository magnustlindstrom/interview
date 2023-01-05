import Class from './Class';

export default class StudentClass {
    constructor(args) {
        const {archived_at, class_id, created_at, deleted_at, grade, id, updated_at, user, user_id} = args

        this.archived_at = archived_at;
        this.class_id = class_id;
        this.created_at = created_at;
        this.deleted_at = deleted_at;
        this.grade = grade;
        this.id = id;
        this.updated_at = updated_at;
        this.user = user;
        this.user_id = user_id;

        this['class'] = new Class(args['class'], this);
    }
}
