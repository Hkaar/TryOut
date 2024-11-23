declare namespace Questions {
    type answerBoxData = {
        status?: boolean
        answer?: string|null
        imageFile?: File|null
    }
    
    type choicesBoxData = {
        [x: number]: answerBoxData
    }

    type Question = {
        id: number
        packet_id: number
        question_type_id: number
        content: string
        img: string
    }

    type multiChoiceData = {
        id: number
        content: string
        is_image: number
    }

    type questionData = {
        id: number
        question_id: number
        correct: number
        not_sure: number
        exam_result_id: number
        answer: string
        type: string
        content: string
        choices: Array<multiChoiceData>
        img?: string
    }

    type questionGotoConfig = {
        element?: Element
        questionId?: number
        questionNumber?: number
    }
}