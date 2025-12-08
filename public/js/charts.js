/* ==================== CHART CONFIGURATIONS ==================== */

// Initialize Bar Chart
function initBarChart(elementId, labels, data, label = 'Jumlah') {
    return new Chart(document.getElementById(elementId), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: label,
                data: data,
                backgroundColor: ['#7c5cdb', '#b8a5d1'],
                borderRadius: 10,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#8a7a9e'
                    },
                    grid: {
                        color: 'rgba(122, 92, 219, 0.1)'
                    }
                },
                x: {
                    ticks: {
                        color: '#8a7a9e'
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
}

// Initialize Line Chart
function initLineChart(elementId, labels, datasets) {
    return new Chart(document.getElementById(elementId), {
        type: 'line',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: '#8a7a9e'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#8a7a9e'
                    },
                    grid: {
                        color: 'rgba(122, 92, 219, 0.1)'
                    }
                },
                x: {
                    ticks: {
                        color: '#8a7a9e'
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
}

// Initialize Doughnut Chart
function initDoughnutChart(elementId, labels, data) {
    return new Chart(document.getElementById(elementId), {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: ['#7c5cdb', '#b8a5d1', '#d4c4e3', '#e8e1f0'],
                borderColor: 'rgba(255, 255, 255, 0.85)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: '#8a7a9e'
                    }
                }
            }
        }
    });
}

// ==================== LINE CHART WITH FILL ==================== 
function initFilledLineChart(elementId, labels, datasets) {
    const formattedDatasets = datasets.map(ds => ({
        ...ds,
        borderWidth: 3,
        tension: 0.4,
        fill: true
    }));

    return new Chart(document.getElementById(elementId), {
        type: 'line',
        data: {
            labels: labels,
            datasets: formattedDatasets
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: '#8a7a9e'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#8a7a9e'
                    },
                    grid: {
                        color: 'rgba(122, 92, 219, 0.1)'
                    }
                },
                x: {
                    ticks: {
                        color: '#8a7a9e'
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
}
