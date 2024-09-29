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
} 

declare namespace Chart {
    type SingleLineChartConfig = {
        chartTitle: string,
        labels: Array<string>
        data: Array<string|number>
        toolTipFormatX: string
    }
}