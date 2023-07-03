export function lineChart(chartId, chartData, chartName){

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
                label: chartName,
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
            scales: {
                y: {
                    ticks: {
                        callback: function (value) {
                            return value;
                        }
                    },
                    beginAtZero: true
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

export function barChart(chartId, chartData, chartName){
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
                label: chartName,
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
            scales: {
                y: {
                    ticks: {
                        callback: function (value) {
                            return value;
                        }
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