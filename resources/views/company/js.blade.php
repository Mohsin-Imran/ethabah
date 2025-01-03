<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   const labels = @json($labels ?? []);
    const fundsData = @json($fundsData ?? []);
    const dataMonthly = {
        labels: labels,
        datasets: [
            {
                label: 'Total Request Funds',
                data: fundsData,
                borderColor: '#214d45',
                backgroundColor: '#FFFFFF',
                borderWidth: 2,
                tension: 0.4
            }
        ]
    };
    const ctx = document.getElementById('lineChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: dataMonthly,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `$${context.raw.toLocaleString()}`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Months',
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Total Funds (in $)',
                    },
                    ticks: {
                        callback: function(value) {
                            return `$${value / 1000}k`;
                        }
                    }
                }
            }
        }
    });
</script>
<script>
    function filterCards() {
        const selectedStatus = document.querySelector('input[name="status"]:checked').value;
        const cards = document.querySelectorAll('.card-item');

        cards.forEach(card => {
            const cardStatus = card.getAttribute('data-status');
            if (cardStatus === selectedStatus) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Initial filter on page load
    document.addEventListener('DOMContentLoaded', filterCards);

</script>



