// Instructor Dashboard Charts - Bar Chart Implementation

document.addEventListener('DOMContentLoaded', function () {
    // Check if chart canvas exists
    const chartCanvas = document.getElementById('revenueChart');

    if (!chartCanvas) {
        console.log('Revenue chart canvas not found');
        return;
    }

    // Destroy any existing chart instance
    const existingChart = Chart.getChart(chartCanvas);
    if (existingChart) {
        existingChart.destroy();
    }

    // Create new bar chart
    const ctx = chartCanvas.getContext('2d');

    const revenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Monthly Revenue',
                data: [1200, 1900, 3000, 5000, 4500, 6000, 5500, 7000, 8500, 9000, 10500, 12450],
                backgroundColor: [
                    'rgba(79, 70, 229, 0.8)',
                    'rgba(79, 70, 229, 0.8)',
                    'rgba(79, 70, 229, 0.8)',
                    'rgba(79, 70, 229, 0.8)',
                    'rgba(79, 70, 229, 0.8)',
                    'rgba(79, 70, 229, 0.8)',
                    'rgba(79, 70, 229, 0.8)',
                    'rgba(79, 70, 229, 0.8)',
                    'rgba(79, 70, 229, 0.8)',
                    'rgba(79, 70, 229, 0.8)',
                    'rgba(79, 70, 229, 0.8)',
                    'rgba(79, 70, 229, 1.0)'
                ],
                borderColor: '#4f46e5',
                borderWidth: 1,
                borderRadius: 6,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: '#1e293b',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function (context) {
                            return 'Revenue: $' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                x: {
                    display: true,
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#64748b',
                        font: {
                            size: 11,
                            family: "'Inter', sans-serif"
                        }
                    }
                },
                y: {
                    display: true,
                    beginAtZero: true,
                    grid: {
                        color: '#f1f5f9',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#64748b',
                        font: {
                            size: 11,
                            family: "'Inter', sans-serif"
                        },
                        callback: function (value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
});
