<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const dataMonthly = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [
            {
                label: 'Investors',
                data: [400000, 300000, 500000, 700000, 600000, 500000, 600000, 748000, 500000, 600000, 450000, 470000],
                borderColor: '#FFA500',
                backgroundColor: 'rgba(255, 165, 0, 0.2)',
                borderWidth: 2,
                tension: 0.4
            },
            {
                label: 'Companies',
                data: [200000, 400000, 300000, 500000, 800000, 700000, 600000, 748000, 700000, 800000, 850000, 880000],
                borderColor: '#1E90FF',
                backgroundColor: 'rgba(30, 144, 255, 0.2)',
                borderWidth: 2,
                tension: 0.4
            }
        ]
    };

    const dataYearly = {
        labels: ['2020', '2021', '2022', '2023', '2024'],
        datasets: [
            {
                label: 'Bikes',
                data: [5000000, 5200000, 5300000, 5600000, 5900000],
                borderColor: '#FFA500',
                backgroundColor: 'rgba(255, 165, 0, 0.2)',
                borderWidth: 2,
                tension: 0.4
            },
            {
                label: 'Cars',
                data: [4800000, 4900000, 5100000, 5300000, 5500000],
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
                        text: 'Investment (in $)',
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

    // Handle Dropdown Change
    document.getElementById('dataFilter').addEventListener('change', function (e) {
        const selectedValue = e.target.value;
        currentChart.data = selectedValue === 'monthly' ? dataMonthly : dataYearly;
        currentChart.update();
    });

    // User Role-Based Table
    const users = [
        { id: 1, name: 'John Doe', role: 0, details: 'Investor Details' },
        { id: 2, name: 'Jane Smith', role: 2, details: 'Company Details' },
    ];

    const userTable = document.getElementById('userTable');
    users.forEach(user => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${user.id}</td>
            <td>${user.name}</td>
            <td>${user.role === 0 ? 'Investor' : 'Company'}</td>
            <td>${user.details}</td>
        `;
        userTable.appendChild(row);
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
