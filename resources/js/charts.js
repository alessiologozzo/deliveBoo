export function lineChart(chartId, chartData, chartTitle, chartLabel, chartYLabel, chartXLabel, chartYParam, chartTooltipExtra, chartColor){

    const ctx = document.getElementById(chartId).getContext("2d");

    let labels = [];
    let values = [];

    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    if(!chartColor || chartColor == "blue") {
        gradient.addColorStop(0, "rgba(58, 123, 213, 1)");
        gradient.addColorStop(1, "rgba(0, 210, 255, 0.3)");
    }
    else if(chartColor == "violet") {
        gradient.addColorStop(0, "rgb(208, 70, 166)");
        gradient.addColorStop(1, "rgba(254, 201, 117, 0.7)");
    }
    else if(chartColor == "orange") {
        gradient.addColorStop(0, "rgba(255, 133, 88, 1)");
        gradient.addColorStop(1, "rgba(255, 219, 61, 0.6)");
    }
    else if(chartColor == "green") {
        gradient.addColorStop(0, "rgba(60, 191, 174, 1)");
        gradient.addColorStop(1, "rgba(65, 227, 150, 0.6)");
    }

    let delayed;

    chartData.forEach(data => {
        labels.push(data.label);
        values.push(data.value)
    });

    const data = {
        labels,
        datasets: [
            {
                data: values,
                label: chartLabel,
                fill: true,
                backgroundColor: gradient,
                tension: 0.3
                // borderColor: "#4d8edc",
                // pointBackgroundColor: "rgb(189, 195, 199)"
            }
        ]
    }

    const config = {
        type: "line",
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            radius: 6,
            hitRadius: 20,
            hoverRadius: 12,
            plugins: {
                title:{
                    display: true,
                    text: chartTitle,
                    position: "top",
                    align: "center",
                    font: {
                        size: 16
                    }
                },

                legend: {
                    display: true,
                    position: "top",
                    align: "end"
                },

                tooltip: {
                    callbacks: {
                        label: function(context) {
                            if(chartTooltipExtra != undefined) {
                                let label = context.dataset.label;

                                if(label)
                                    label += ": ";
                                
                                if(context.parsed.y !== null)
                                    label += context.parsed.y + chartTooltipExtra;

                                return label;
                            }
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title:{
                        display: true,
                        text: chartYLabel
                    },
                    ticks: {
                        callback: function (value) {
                            return value + chartYParam;
                        }
                    },
                    afterDataLimits(scale) {
                        scale.max += (scale.max * 5) / 100;
                    }
                },
                x: {
                    title:{
                        display: true,
                        text: chartXLabel
                    },
                }
            },
            animation: {
                onComplete: () => {
                    delayed = true;
                },
                delay: (context) => {
                    let delay = 0;
                    if(context.type === "data" && context.mode === "default" && !delayed) {
                        delay = context.dataIndex * 300 + context.datasetIndex * 100;
                    }
                    return delay;
                }
            }
        }
    }

    let myChart = new Chart(ctx, config);
}

export function barChart(chartId, chartData, chartTitle, chartLabel, chartYLabel, chartXLabel, chartYParam, chartTooltipExtra, chartColor){
    const ctx = document.getElementById(chartId).getContext("2d");

    let labels = [];
    let values = [];

    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    if(!chartColor || chartColor == "violet") {
        gradient.addColorStop(0, "rgb(208, 70, 166)");
        gradient.addColorStop(1, "rgba(254, 201, 117, 0.7)");
    }
    else if(chartColor == "blue") {
        gradient.addColorStop(0, "rgba(58, 123, 213, 1)");
        gradient.addColorStop(1, "rgba(0, 210, 255, 0.3)");
    }
    else if(chartColor == "orange") {
        gradient.addColorStop(0, "rgba(255, 133, 88, 1)");
        gradient.addColorStop(1, "rgba(255, 219, 61, 0.6)");
    }
    else if(chartColor == "green") {
        gradient.addColorStop(0, "rgba(60, 191, 174, 1)");
        gradient.addColorStop(1, "rgba(65, 227, 150, 0.6)");
    }

    let delayed;

    chartData.forEach(data => {
        labels.push(data.label);
        values.push(data.value)
    });

    const data = {
        labels,
        datasets: [
            {
                data: values,
                label: chartLabel,
                backgroundColor: gradient,
            }
        ]
    }

    const config = {
        type: "bar",
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title:{
                    display: true,
                    text: chartTitle,
                    position: "top",
                    align: "center",
                    font: {
                        size: 16
                    }
                },

                legend: {
                    display: true,
                    position: "top",
                    align: "end"
                },

                tooltip: {
                    callbacks: {
                        label: function(context) {
                            if(chartTooltipExtra != undefined) {
                                let label = context.dataset.label;

                                if(label)
                                    label += ": ";
                                
                                if(context.parsed.y !== null)
                                    label += context.parsed.y + chartTooltipExtra;

                                return label;
                            }
                        }
                    }
                }
            },
            scales: {
                y: {
                    ticks: {
                        callback: function (value) {
                            return value + chartYParam;
                        }
                    },
                    afterDataLimits(scale) {
                        scale.max += (scale.max * 5) / 100;
                    },
                    title: {
                        display: true,
                        text: chartYLabel
                    }
                },

                x: {
                    title: {
                        display: true,
                        text: chartXLabel
                    }
                }
            },
            animation: {
                onComplete: () => {
                    delayed = true;
                },
                delay: (context) => {
                    let delay = 0;
                    if(context.type === "data" && context.mode === "default" && !delayed) {
                        delay = context.dataIndex * 300 + context.datasetIndex * 100;
                    }
                    return delay;
                }
            }
        }
    }

    let myChart = new Chart(ctx, config);
}

export function doughnutChart(chartId, chartData, chartTitle, chartTooltipExtra){
    const ctx = document.getElementById(chartId).getContext("2d");

    let labels = [];
    let values = [];

    let delayed;

    chartData.forEach(data => {
        labels.push(data.label);
        values.push(data.value)
    });

    const data = {
        labels,
        datasets: [
            {
                data: values
            }
        ]
    }

    const config = {
        type: "doughnut",
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title:{
                    display: true,
                    text: chartTitle,
                    position: "top",
                    align: "center",
                    font: {
                        size: 16
                    }
                },

                legend: {
                    display: false,
                    position: "top",
                    align: "end"
                },

                tooltip: {
                    callbacks: {
                        label: function(context) {
                            if(chartTooltipExtra != undefined) {
                                let label = context.dataset.label;

                                if(label)
                                    label += ": ";
                                
                                if(context.parsed.y !== null)
                                    label += context.parsed.y + chartTooltipExtra;

                                return label;
                            }
                        }
                    }
                }
            },

            animation: {
                onComplete: () => {
                    delayed = true;
                },
                delay: (context) => {
                    let delay = 0;
                    if(context.type === "data" && context.mode === "default" && !delayed) {
                        delay = context.dataIndex * 300 + context.datasetIndex * 100;
                    }
                    return delay;
                }
            }
        }
    }

    let myChart = new Chart(ctx, config);
}