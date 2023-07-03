export function lineChart(chartId, chartData, chartTitle, chartLabel, chartYLabel, chartXLabel){

    const ctx = document.getElementById(chartId).getContext("2d");

    let labels = [];
    let values = [];

    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, "rgba(58, 123, 213, 1)");
    gradient.addColorStop(1, "rgba(0, 210, 255, 0.3)");

    let delayed;

    chartData.forEach(data => {
        labels.push(data.date);
        values.push(data.orders_number)
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
                    align: "start"
                },

                legend: {
                    display: true,
                    position: "top",
                    align: "end"
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
                            return value;
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

export function barChart(chartId, chartData, chartTitle, chartLabel, chartYLabel, chartXLabel){
    const ctx = document.getElementById(chartId).getContext("2d");

    let labels = [];
    let values = [];

    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, "rgb(208, 70, 166)");
    gradient.addColorStop(1, "rgba(254, 201, 117, 0.7)");

    let delayed;

    chartData.forEach(data => {
        labels.push(data.date);
        values.push(data.orders_number)
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
                    align: "start"
                },

                legend: {
                    display: true,
                    position: "top",
                    align: "end"
                }
            },
            scales: {
                y: {
                    ticks: {
                        callback: function (value) {
                            return value;
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