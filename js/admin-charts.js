// Admin Dashboard Charts - Static Data Implementation
// Uses Chart.js for visualization

document.addEventListener('DOMContentLoaded', function () {
    // Initialize all charts
    initUserGrowthChart();
    initCourseEnrollmentChart();
});

// User Growth Line Chart
function initUserGrowthChart() {
    const ctx = document.getElementById('userGrowthChart');
    if (!ctx) return;

    const data = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [
            {
                label: 'Students',
                data: [120, 150, 180, 220, 280, 350, 420, 480, 550, 620, 680, 750],
                borderColor: '#4f46e5',
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 2
            },
            {
                label: 'Employees',
                data: [10, 12, 15, 18, 22, 25, 28, 32, 35, 38, 42, 45],
                borderColor: '#00e5ff',
                backgroundColor: 'rgba(0, 229, 255, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 2
            }
        ]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: '#f8f9fa',
                        font: {
                            family: 'Roboto',
                            size: 12
                        },
                        usePointStyle: true,
                        padding: 15
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(10, 10, 35, 0.9)',
                    titleColor: '#f8f9fa',
                    bodyColor: '#f8f9fa',
                    borderColor: '#4f46e5',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6c757d',
                        font: {
                            family: 'Roboto'
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6c757d',
                        font: {
                            family: 'Roboto'
                        }
                    }
                }
            }
        }
    };

    new Chart(ctx, config);
}

// Course Enrollment Bar Chart
function initCourseEnrollmentChart() {
    const ctx = document.getElementById('courseEnrollmentChart');
    if (!ctx) return;

    const data = {
        labels: ['AI Fundamentals', 'Web Development', 'Data Science', 'Machine Learning', 'Cloud Computing', 'Cybersecurity'],
        datasets: [{
            label: 'Students Enrolled',
            data: [245, 189, 156, 203, 134, 167],
            backgroundColor: [
                'rgba(79, 70, 229, 0.8)',
                'rgba(99, 102, 241, 0.8)',
                'rgba(139, 92, 246, 0.8)',
                'rgba(168, 85, 247, 0.8)',
                'rgba(192, 132, 252, 0.8)',
                'rgba(0, 229, 255, 0.8)'
            ],
            borderColor: [
                '#4f46e5',
                '#6366f1',
                '#8b5cf6',
                '#a855f7',
                '#c084fc',
                '#00e5ff'
            ],
            borderWidth: 2,
            borderRadius: 8,
            barThickness: 40
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(10, 10, 35, 0.9)',
                    titleColor: '#f8f9fa',
                    bodyColor: '#f8f9fa',
                    borderColor: '#4f46e5',
                    borderWidth: 1,
                    padding: 12
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6c757d',
                        font: {
                            family: 'Roboto'
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6c757d',
                        font: {
                            family: 'Roboto',
                            size: 11
                        },
                        maxRotation: 45,
                        minRotation: 45
                    }
                }
            }
        }
    };

    new Chart(ctx, config);
}

// Utility function to format numbers
function formatNumber(num) {
    if (num >= 1000000) {
        return (num / 1000000).toFixed(1) + 'M';
    } else if (num >= 1000) {
        return (num / 1000).toFixed(1) + 'K';
    }
    return num.toString();
}

// Animate stat counters
function animateCounter(element, target, duration = 2000) {
    const start = 0;
    const increment = target / (duration / 16);
    let current = start;

    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = formatNumber(target);
            clearInterval(timer);
        } else {
            element.textContent = formatNumber(Math.floor(current));
        }
    }, 16);
}

// Initialize counter animations on page load
window.addEventListener('load', function () {
    const statValues = document.querySelectorAll('.stat-value[data-target]');
    statValues.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-target'));
        animateCounter(stat, target);
    });
});
