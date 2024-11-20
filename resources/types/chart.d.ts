declare namespace Chart {
    type SingleLineChartConfig = {
        chartTitle: string,
        labels: Array<string>
        data: Array<string|number>
        toolTipFormatX: string
    }
}