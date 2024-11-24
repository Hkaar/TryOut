declare namespace Exam {
    type ExamTimeResponse = {
        valid: boolean
        remaining: number
    }

    type QuestionGotoConfig = {
        element?: Element
        questionId?: number
        questionNumber?: number
    }

    type ExamEndResponse = {
        redirect: string
    }
}