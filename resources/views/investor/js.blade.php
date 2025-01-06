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
