export const commonSingleLineChart = {
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
                    formatter: (/** @type {string | any[]} */ title) =>
                        title.slice(0, 3),
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
};

export const commonColorsFirst = {
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
};

export const commonColorsSecond = {
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
};
