<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7e2;
            padding: 20px;
        }

        .form-control {
            background-color: #b4d7c3;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            text-align: center;
            color: #000;
            font-family: Arial;
        }

        .submit-btn {
            background-color: #b3dd0d;
            color: #000;
            font-weight: bold;
            border: none;
            padding: 8px;
        }

        .submit-btn:hover {
            background-color: #9fca0b;
        }

        .upload-btn {
            background-color: #00a87e;
            color: #fff;
            border: none;
            border-radius: 4px;
        }

        .upload-btn:hover {
            background-color: #008b68;
        }

        a {
            color: #00a87e;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="container">
        <form class="form-horizontal auth-form" method="POST" action="{{ route('company.register') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-6 offset-lg-3" id="registration-section" dir="rtl">
                <div class="card p-4">
                    <div class="row g-4">
                        <h2 class="card-title">تسجيل الشركة</h2>
                        <div class="">
                            <label for="company-name" class="form-label">اسم الشركة الكامل</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus id="company-name" placeholder="اسم الشركة الكامل">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="">
                            <label for="email" class="form-label">عنوان البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="عنوان البريد الإلكتروني" value="{{ old('email') }}" required autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="">
                            <label for="reg-number" class="form-label">رقم تسجيل الشركة</label>
                            <input type="text" dir="rtl" name="register_num" placeholder="رقم تسجيل الشركة" class="form-control @error('register_num') is-invalid @enderror" value="{{ old('register_num') }}" required>
                            @error('register_num')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="">
                            <label for="address" class="form-label">عنوان الشركة</label>
                            <input type="text" name="address" placeholder="عنوان الشركة" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" required>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="">
                            <label for="phone" class="form-label">رقم الهاتف</label>
                                <input type="tel" id="phone" dir="rtl" placeholder="رقم الهاتف" name="phone" class="form-control" value="{{ old('phone') }}">
                                <span id="phone-error" class="invalid-feedback" role="alert" style="display: none;">
                                    <strong>رقم الهاتف غير صالح. يُسمح فقط بأرقام السعودية ودبي وباكستان.</strong>
                                </span>

                                <script>
                                    document.getElementById('phone').addEventListener('input', function () {
                                        const phoneInput = this.value.trim();
                                        const errorSpan = document.getElementById('phone-error');
                                        const saudiRegex = /^(\+966|0)?5\d{8}$/;
                                        const dubaiRegex = /^(\+971|0)?5\d{8}$/;
                                        const pakistanRegex = /^(\+92|0)?3\d{9}$/;

                                        if (saudiRegex.test(phoneInput) || dubaiRegex.test(phoneInput) || pakistanRegex.test(phoneInput)) {
                                            this.classList.remove('is-invalid');
                                            errorSpan.style.display = 'none';
                                        } else {
                                            this.classList.add('is-invalid');
                                            errorSpan.style.display = 'block';
                                        }
                                    });
                                </script>
                                {{-- <select class="form-select" dir="ltr" style="max-width: 120px;background-color: #b4d7c3;border-radius:6px;">
                                    <option value="+966">+966</option>
                                </select> --}}
                        </div>
                        <div class="">
                            <label for="password">كلمة المرور</label>
                            <input id="password" type="password" placeholder="كلمة المرور" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" oninput="validatePassword()">
                            <div id="password-error" class="text-danger mt-1" style="display: none;">يجب أن تكون كلمة المرور 8 أحرف على الأقل.</div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="">
                            <label for="password-confirm">تأكيد كلمة المرور</label>
                            <input id="password-confirm" type="password" placeholder="تأكيد كلمة المرور" class="form-control" name="password_confirmation" required autocomplete="new-password" oninput="validatePassword()">
                            <div id="confirm-password-error" class="text-danger mt-1" style="display: none;">كلمات المرور غير متطابقة.</div>
                        </div>
                        <button type="button" class="submit-btn text-white">التالي &raquo;</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 offset-lg-3" id="verification-section" dir="rtl" style="display: none;">
                <div class="card p-4 mt-5">
                    <h2 class="card-title">التحقق من الحساب</h2>
                    <div class="mt-3">
                        <label for="reg-cert" class="form-label">شهادة تسجيل الشركة</label>
                        <br>
                        <button type="button" class="btn upload-btn" onclick="document.getElementById('reg-cert').click()">رفع</button>
                        <input type="file" name="register_certificate[]" id="reg-cert" class="form-control d-none" multiple onchange="handleFileUpload(event, 'reg-cert-files')" required>
                        <ul id="reg-cert-files" class="list-group mt-2"></ul>
                    </div>

                    <div class="mb-1">
                        <label for="comm-reg-cert" class="form-label">شهادة التسجيل التجاري</label>
                        <br>
                        <button type="button" class="btn upload-btn" onclick="document.getElementById('comm-reg-cert').click()">رفع</button>
                        <input type="file" name="commercial_certificate[]" id="comm-reg-cert" class="form-control d-none" multiple onchange="handleFileUpload(event, 'comm-reg-files')" required>
                        <ul id="comm-reg-files" class="list-group mt-2"></ul>
                    </div>

                    <div class="mb-1">
                        <label for="other-licenses" class="form-label">تراخيص أخرى</label>
                        <br>
                        <button type="button" class="btn upload-btn" onclick="document.getElementById('other-licenses').click()">رفع</button>
                        <input type="file" name="licenses[]" id="other-licenses" class="form-control d-none" multiple onchange="handleFileUpload(event, 'other-licenses-files')" required>
                        <ul id="other-licenses-files" class="list-group mt-2"></ul>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="terms">
                        <label for="terms" class="form-check-label">
                            أوافق على <a href="#">الشروط والأحكام</a> و <a href="#">سياسة الخصوصية</a>
                        </label>
                    </div>
                    <button type="button" class="btn w-100 btn-success mt-2 previous-btn">السابق</button>
                    <button class="btn w-100 mt-2" style="background-color: #b3dd0d;color:white;" type="submit" onclick="validateFileUploads()">إرسال</button>
                    <div class="d-flex flex-row justify-content-between mt-2">
                        <a href="{{ route('password.request') }}" style="color: #393f81; text-decoration: none;">هل نسيت كلمة المرور؟</a>
                        <a href="{{ route('login') }}" style="color: #393f81; text-decoration: none;">تسجيل الدخول هنا</a>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function validateFileUploads() {
            const fileInputs = [
                document.getElementById('reg-cert')
                , document.getElementById('comm-reg-cert')
                , document.getElementById('other-licenses')
            ];
            let isValid = true;
            let missingFields = [];

            fileInputs.forEach(input => {
                if (input.files.length === 0) {
                    isValid = false;
                    missingFields.push(input.previousElementSibling.textContent.trim());
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: 'error'
                    , title: 'Missing Files',
                    // html: `<p>Please upload the following files:</p><ul>${missingFields.map(field => `<li>${field}</li>`).join('')}</ul>`,
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    icon: 'success'
                    , title: 'All files uploaded!'
                    , text: 'Submitting the form...'
                    , confirmButtonText: 'Submit'
                }).then(() => {
                    // Submit the form programmatically
                    document.querySelector('form').submit();
                });
            }
        }

    </script>
    <script>
        // Function to handle file upload and preview file names
        function handleFileUpload(event, listId) {
            const fileList = event.target.files;
            const list = document.getElementById(listId);

            // Clear the list before adding new files
            list.innerHTML = '';

            // Loop through uploaded files and add to the list
            Array.from(fileList).forEach((file, index) => {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                listItem.textContent = file.name;

                // Add delete button
                const deleteBtn = document.createElement('button');
                deleteBtn.className = 'btn btn-sm btn-danger';
                deleteBtn.textContent = 'Delete';
                deleteBtn.onclick = () => {
                    listItem.remove();
                    const input = event.target;
                    const dt = new DataTransfer();

                    // Retain only files that are not deleted
                    Array.from(input.files).forEach((f, i) => {
                        if (i !== index) dt.items.add(f);
                    });

                    input.files = dt.files; // Update the file input
                };

                listItem.appendChild(deleteBtn);
                list.appendChild(listItem);
            });
        }

    </script>

    <script>
        function validatePassword() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password-confirm').value;

            // Password length validation
            const passwordError = document.getElementById('password-error');
            if (password.length < 8) {
                passwordError.style.display = 'block';
            } else {
                passwordError.style.display = 'none';
            }

            // Confirm Password match validation
            const confirmPasswordError = document.getElementById('confirm-password-error');
            if (password !== confirmPassword && confirmPassword !== '') {
                confirmPasswordError.style.display = 'block';
            } else {
                confirmPasswordError.style.display = 'none';
            }
        }

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nextButton = document.querySelector('.submit-btn');
            const previousButton = document.querySelector('.previous-btn');
            const registrationSection = document.getElementById('registration-section');
            const verificationSection = document.getElementById('verification-section');

            // Show verification section and hide registration section
            nextButton.addEventListener('click', () => {
                registrationSection.style.display = 'none'; // Hide the first div
                verificationSection.style.display = 'block'; // Show the second div
            });

            // Show registration section and hide verification section
            previousButton.addEventListener('click', () => {
                verificationSection.style.display = 'none'; // Hide the second div
                registrationSection.style.display = 'block'; // Show the first div
            });
        });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
