<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const dataMonthly = {
        labels: @json($data['labels']),
        datasets: [
            {
                label: 'Company Total Funds',
                data: @json($data['fundsData']),
                borderColor: '#FFA500',
                backgroundColor: 'rgba(255, 165, 0, 0.2)',
                borderWidth: 2,
                tension: 0.4
            },
            {
                label: 'Investor Total Amount',
                data: @json($data['amountsData']),
                borderColor: '#1E90FF',
                backgroundColor: 'rgba(30, 144, 255, 0.2)',
                borderWidth: 2,
                tension: 0.4
            }
        ]
    };

    const ctx = document.getElementById('lineChart').getContext('2d');
    let currentChart = new Chart(ctx, {
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
                        text: 'Time Period',
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Investment (in SAR)',
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


{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<script>
    $(document).ready(function () {
        $('#category').change(function () {
            let categoryId = $(this).val();
            $('#company').html('<option value="">Loading...</option>'); // Show loading

            if (categoryId) {
                $.ajax({
                    url: "{{ route('admin.investor.funds.getCompaniesByCategory') }}",
                    type: 'GET',
                    data: { category_id: categoryId },
                    success: function (data) {
                        let options = '<option value="">Select Company</option>';
                        data.forEach(company => {
                            options += `<option value="${company.company.id}">${company.company.name}</option>`;
                        });
                        $('#company').html(options);
                    },
                    error: function () {
                        alert('Something went wrong while fetching companies!');
                    }
                });
            } else {
                $('#company').html('<option value="">Select Company</option>');
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#categorySelect').change(function () {
            let categoryId = $(this).val(); // Get selected category ID
            $('#companySelect').html('<option value="">Loading...</option>'); // Show loading text

            if (categoryId) {
                $.ajax({
                    url: "{{ route('admin.investor.funds.getCompaniesByCategory') }}",
                    type: 'GET',
                    data: { category_id: categoryId },
                    success: function (data) {
                        let options = '<option value="">Select Company</option>';
                        data.forEach(company => {
                            options += `<option value="${company.company.id}">${company.company.name}</option>`;
                        });
                        $('#companySelect').html(options); // Populate companies dropdown
                    },
                    error: function (xhr, status, error) {
                        alert('Unable to fetch companies.');
                        console.error(xhr.responseText); // Log error for debugging
                    }
                });
            } else {
                $('#companySelect').html('<option value="">Select Company</option>');
            }
        });
    });
</script>


<script>
    function handleFilePreview(inputId, previewId) {
        const input = document.getElementById(inputId);
        const previewContainer = document.getElementById(previewId);

        input.addEventListener("change", () => {
            previewContainer.innerHTML = "";
            const files = input.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                // Create file list item
                const listItem = document.createElement("li");
                listItem.className = "file-item";

                const fileName = document.createElement("span");
                fileName.className = "file-name";
                fileName.textContent = file.name;

                const deleteBtn = document.createElement("span");
                deleteBtn.className = "delete-btn";
                deleteBtn.textContent = "Delete";
                deleteBtn.addEventListener("click", () => {
                    listItem.remove();
                    removeFile(input, i);
                });

                listItem.appendChild(fileName);
                listItem.appendChild(deleteBtn);

                previewContainer.appendChild(listItem);
            }
        });
    }

    function removeFile(input, index) {
        const dataTransfer = new DataTransfer();
        const files = input.files;

        for (let i = 0; i < files.length; i++) {
            if (i !== index) {
                dataTransfer.items.add(files[i]);
            }
        }

        input.files = dataTransfer.files;
    }
    handleFilePreview("register_certificate", "register_preview");
    handleFilePreview("commercial_certificate", "commercial_preview");
    handleFilePreview("licenses", "licenses_preview");

</script>
