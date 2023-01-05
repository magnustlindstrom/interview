import MultipleChoiceQuestion from "./MultipleChoiceQuestion";
import NumberQuestion from "./NumberQuestion";

export default function QuestionTypeMapToClass(data) {
    return data.answer_type == 2 ? MultipleChoiceQuestion : NumberQuestion;
}
