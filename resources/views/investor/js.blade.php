<script>
    function toggleInput() {
    const select = document.getElementById('investor_funds_id');
    const pendingInput = document.getElementById('pending_amount');
    const investmentInput = document.getElementById('investment_amount');
    const errorMessage = document.getElementById('error_message');
    const submitButton = document.querySelector('button[type="submit"]');
    const selectedOption = select.options[select.selectedIndex];
    const pendingAmount = selectedOption.getAttribute('data-pending');

    // Reset fields
    pendingInput.value = '';
    investmentInput.value = '';
    errorMessage.style.display = 'none';
    submitButton.disabled = true;

    // Show pending amount if a valid fund is selected
    if (pendingAmount !== null && pendingAmount !== '') {
        document.getElementById('amount-container').style.display = 'block';
        pendingInput.value = pendingAmount;
    } else {
        document.getElementById('amount-container').style.display = 'none';
    }
}

document.getElementById('investment_amount').addEventListener('input', function () {
    const investmentInput = this;
    const select = document.getElementById('investor_funds_id');
    const selectedOption = select.options[select.selectedIndex];
    const pendingAmount = parseFloat(selectedOption.getAttribute('data-pending'));
    const errorMessage = document.getElementById('error_message');
    const submitButton = document.querySelector('button[type="submit"]');

    // Validate investment amount
    if (investmentInput.value > pendingAmount) {
        errorMessage.style.display = 'block';
        submitButton.disabled = true;
    } else {
        errorMessage.style.display = 'none';
        submitButton.disabled = false;
    }
});
</script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        // Fetching the labels, data, and colors from the server-side
        var labels = {!! json_encode($labels ?? []) !!};
        var data = {!! json_encode($data ?? []) !!};
        var colors = {!! json_encode($colors ?? []) !!};

        // Chart configuration
        const chartData = {
            labels: labels,
            datasets: [{
                label: 'Investor Investment Amount',
                backgroundColor: colors,
                borderColor: colors,
                data: data,
            }]
        };

        const chartConfig = {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return 'SAR: ' + tooltipItem.raw;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Create the chart
        const investorChart = new Chart(
            document.getElementById('investorChart'),
            chartConfig
        );
    </script>

