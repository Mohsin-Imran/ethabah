<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    // Initialize Select2
    $('#select3').select2({
        placeholder: "Select Company",
        allowClear: true,
        closeOnSelect: false, // Keeps the dropdown open
        templateResult: formatOption // Custom formatting for checkboxes
    });

    // Add checkboxes to dropdown options
    function formatOption(option) {
        if (!option.id) {
            return option.text;
        }
        var $option = $(
            '<span><input type="checkbox" style="margin-right: 8px;">' + option.text + '</span>'
        );
        return $option;
    }

    // Manage selection when checkboxes are clicked
    $(document).on('click', '.select2-results__option', function (e) {
        var $checkbox = $(this).find('input[type="checkbox"]');
        var selected = !$checkbox.prop('checked');
        $checkbox.prop('checked', selected);

        // Update Select2's internal selection state
        var optionId = $(this).attr('id'); // Get option ID
        var select = $('#select3');
        var val = select.val() || []; // Get current selected values

        if (selected) {
            val.push(optionId); // Add the ID if selected
        } else {
            val = val.filter(function (v) {
                return v !== optionId; // Remove the ID if deselected
            });
        }

        select.val(val).trigger('change'); // Update Select2
        e.stopPropagation();

        let totalFunds = 0;
        let amount = 0;

        // Calculate total funds and update inputs
        val.forEach(function (id) {
            const option = select.find(`option[value="${id}"]`);
            totalFunds += parseFloat(option.data('total-funds')) || 0;
            amount += parseFloat(option.data('total-funds')) || 0;
        });

        $('#total_funds').val(totalFunds); // Update total funds input
        $('#amount').val(amount); // Update amount input

        // Populate the hidden input with selected data-ids values
        var selectedIds = val.map(function(id) {
            return select.find(`option[value="${id}"]`).data('ids'); // Get the data-ids from selected options
        });
        $('#selected_company_ids').val(selectedIds.join(',')); // Update hidden input with data-ids values
    });

    // Listen for deselection via Select2's close button
    $('#select3').on('select2:unselect', function (e) {
        var data = e.params.data;
        var select = $('#select3');
        var val = select.val() || []; // Get current selected values

        // Remove the deselected ID
        val = val.filter(function (v) {
            return v !== data.id; // Ensure the deselected ID is removed
        });

        select.val(val).trigger('change'); // Update Select2

        // Update the hidden input
        var selectedIds = val.map(function(id) {
            return select.find(`option[value="${id}"]`).data('ids'); // Get the data-ids from selected options
        });
        $('#selected_company_ids').val(selectedIds.join(',')); // Update hidden input with data-ids values
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const companySelect = document.getElementById('select3');
    const totalFundsInput = document.getElementById('total_funds');
    function calculateTotalFunds() {
        let totalFunds = 0;
        const selectedOptions = Array.from(companySelect.selectedOptions);
        selectedOptions.forEach(option => {
            totalFunds += parseFloat(option.getAttribute('data-total-funds')) || 0;
        });
        totalFundsInput.value = totalFunds;
    }
    companySelect.addEventListener('change', calculateTotalFunds);
    calculateTotalFunds();
});

</script>
