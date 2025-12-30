<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Widget</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Обратная связь</h3>
    <form id="widgetForm" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control" id="name" name="name">
            <div class="invalid-feedback" id="error-name"></div>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="text" class="form-control" id="phone" name="phone">
            <div class="invalid-feedback" id="error-phone"></div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email (не обязательно)</label>
            <input type="email" class="form-control" id="email" name="email">
            <div class="invalid-feedback" id="error-email"></div>
        </div>

        <div class="mb-3">
            <label for="subject" class="form-label">Тема</label>
            <input type="text" class="form-control" id="subject" name="subject">
            <div class="invalid-feedback" id="error-subject"></div>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Сообщение</label>
            <textarea class="form-control" id="message" name="message" rows="4"></textarea>
            <div class="invalid-feedback" id="error-message"></div>
        </div>

        <div class="mb-3">
            <label for="files" class="form-label">Файлы</label>
            <input type="file" class="form-control" id="files" name="files[]" multiple>
            <div class="invalid-feedback" id="error-files"></div>
        </div>

        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>

    <div class="alert mt-3 d-none" id="successMessage"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const form = document.getElementById('widgetForm');
    const successMessage = document.getElementById('successMessage');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        clearFormErrors();
        const formData = new FormData(form);

        axios.post("{{ route('widget.store') }}", formData)
            .then(response => {
                successMessage.classList.remove('d-none');
                successMessage.classList.add('alert-success');
                successMessage.innerText = response.data.message;
                form.reset();
            })
            .catch(error => {
                if (error.response.status === 422) {
                    const errors = error.response.data.errors;
                    // показать ошибки
                    Object.keys(errors).forEach(key => {
                        const input = document.getElementById(key);
                        if(input) input.classList.add('is-invalid');
                        const errorDiv = document.getElementById('error-' + key);
                        if(errorDiv) errorDiv.innerText = errors[key][0];
                    });
                }
            });
    });

    function clearFormErrors() {
        document.querySelectorAll('.invalid-feedback').forEach(el => {
            el.innerText = '';
        });

        document.querySelectorAll('.form-control').forEach(el => {
            el.classList.remove('is-invalid');
        });

        const successMessage = document.getElementById('successMessage');
        successMessage.classList.add('d-none');
        successMessage.innerText = '';
    }
</script>
</body>
</html>

