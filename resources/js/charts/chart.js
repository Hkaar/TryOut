import { buildChart, buildTooltip } from "preline/dist/helper-apexcharts.js";

/**
 * Create a single line chart
 * 
 * @param {string} id 
 * @param {Chart.SingleLineChartConfig} config
 */
export default function SingleLineChart(id, config) {
    buildChart(
        id,
        (/** @type {any} */ mode) => ({
            chart: {
                height: 300,
                type: "area",
                toolbar: {
                    show: false,
                },
                zoom: {
                    enabled: false,
                },
            },
            series: [
                {
                    name: config.chartTitle,
                    data: config.data,
                },
            ],
            legend: {
                show: false,
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "straight",
                width: 2,
            },
            grid: {
                strokeDashArray: 2,
            },
            fill: {
                type: "gradient",
                gradient: {
                    type: "vertical",
                    shadeIntensity: 1,
                    opacityFrom: 0.1,
                    opacityTo: 0.8,
                },
            },
            xaxis: {
                type: "category",
                tickPlacement: "on",
                categories: config.labels,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
                crosshairs: {
                    stroke: {
                        dashArray: 0,
                    },
                    dropShadow: {
                        show: false,
                    },
                },
                tooltip: {
                    enabled: false,
                },
                labels: {
                    style: {
                        colors: "#9ca3af",
                        fontSize: "13px",
                        fontFamily: "Inter, ui-sans-serif",
                        fontWeight: 400,
                    },
                    formatter: (/** @type {string} */ title) => {
                        let t = title;

                        if (!title) return "";

                        const newT = t.split("-");
                        t = `${newT[0]} ${newT[1].slice(0, 3)}`;
                    },
                },
            },
            yaxis: {
                labels: {
                    align: "left",
                    minWidth: 0,
                    maxWidth: 140,
                    style: {
                        colors: "#9ca3af",
                        fontSize: "13px",
                        fontFamily: "Inter, ui-sans-serif",
                        fontWeight: 400,
                    },
                    formatter: (/** @type {number} */ value) =>
                        value >= 1000 ? `${value / 1000}k` : value,
                },
            },
            tooltip: {
                x: {
                    format: config.toolTipFormatX,
                },
                y: {
                    formatter: (/** @type {number} */ value) =>
                        `${value >= 1000 ? `${value / 1000}k` : value}`,
                },
                custom: function (/** @type {import("preline/dist/helper-apexcharts.js").IChartProps} */ props) {
                    // @ts-ignore
                    const { categories } = props.ctx.opts.xaxis;
                    const { dataPointIndex } = props;
                    const title = categories[dataPointIndex].split(" ");
                    const newTitle = `${title[0]} ${title[1]}`;

                    return buildTooltip(props, {
                        title: newTitle,
                        mode,
                        valuePrefix: "",
                        hasTextLabel: true,
                        markerExtClasses: "!rounded-sm",
                        wrapperExtClasses: "min-w-28",
                        isValueDivided: false,
                        valuePostfix: "",
                        invertGroup: false,
                        labelDivider: "",
                        wrapperClasses: "",
                        seriesClasses: "",
                        seriesExtClasses: "",
                        titleClasses: "",
                        titleExtClasses: "",
                        markerClasses: "",
                        valueClasses: "",
                        valueExtClasses: "",
                        labelClasses: "",
                        labelExtClasses: ""
                    });
                },
            },
            responsive: [
                {
                    breakpoint: 568,
                    options: {
                        chart: {
                            height: 300,
                        },
                        labels: {
                            style: {
                                colors: "#9ca3af",
                                fontSize: "11px",
                                fontFamily: "Inter, ui-sans-serif",
                                fontWeight: 400,
                            },
                            offsetX: -2,
                            formatter: (/** @type {string | any[]} */ title) => title.slice(0, 3),
                        },
                        yaxis: {
                            labels: {
                                align: "left",
                                minWidth: 0,
                                maxWidth: 140,
                                style: {
                                    colors: "#9ca3af",
                                    fontSize: "11px",
                                    fontFamily: "Inter, ui-sans-serif",
                                    fontWeight: 400,
                                },
                                formatter: (/** @type {number} */ value) =>
                                    value >= 1000 ? `${value / 1000}k` : value,
                            },
                        },
                    },
                },
            ],
        }),
        // @ts-ignore
        {
            colors: ["#2563eb", "#9333ea"],
            fill: {
                gradient: {
                    stops: [0, 90, 100],
                },
            },
            xaxis: {
                labels: {
                    style: {
                        colors: "#9ca3af",
                    },
                },
            },
            yaxis: {
                labels: {
                    style: {
                        colors: "#9ca3af",
                    },
                },
            },
            grid: {
                borderColor: "#e5e7eb",
            },
        },
        {
            colors: ["#3b82f6", "#a855f7"],
            fill: {
                gradient: {
                    stops: [100, 90, 0],
                },
            },
            xaxis: {
                labels: {
                    style: {
                        colors: "#a3a3a3",
                    },
                },
            },
            yaxis: {
                labels: {
                    style: {
                        colors: "#a3a3a3",
                    },
                },
            },
            grid: {
                borderColor: "#404040",
            },
        }
    );
}
