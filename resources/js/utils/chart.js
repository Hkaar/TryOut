import _ from 'lodash';
import ApexCharts from 'apexcharts';

import 'apexcharts/dist/apexcharts.css';

// @ts-ignore
window.ApexCharts = ApexCharts;
window._ = _;

import { buildChart } from "preline/dist/helper-apexcharts.js";

/**
 * Create a line chart and attach it to an element
 *
 * @param {string} element - The element query for the chart to be attached on
 * @param {Chart.ChartData[]} data - The data to be used in the chart
 * @param {Chart.ChartConfig} config - The desired configuration for the chart
 * @returns void
 */
export function CreateLineChart(element, data, config) {
    buildChart(
        element,
        // (/** @type {"dark"|"light"}  */ _mode) => ({
        () => ({
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
                ...data
            ],
            legend: {
                show: false,
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth", // Change curve to smooth for better aesthetics
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
                categories: [
                    ...config.labels
                ],
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
                        fontSize: "13px",
                        fontFamily: "Inter, ui-sans-serif",
                        fontWeight: 400,
                    },
                },
            },
            yaxis: {
                labels: {
                    align: "left",
                    minWidth: 0,
                    maxWidth: 140,
                    style: {
                        fontSize: "13px",
                        fontFamily: "Inter, ui-sans-serif",
                        fontWeight: 400,
                    },
                    formatter: (/** @type {number} */ value) => {
                        // Format the y-axis labels to be more readable
                        return value >= 1000 ? `${value / 1000}k` : value;
                    },
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
                            formatter: (/** @type {string} */ title) => title.slice(0, 3), // Shorten labels on small screens
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
        `{
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
        }`,
        `{
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
        }`
    );
}
