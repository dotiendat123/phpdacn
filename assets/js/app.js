document.querySelectorAll('.task-checkbox').forEach(cb => {
    cb.addEventListener('change', function () {
        fetch('/task/status', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id=${this.dataset.id}&status=${this.checked ? 'hoàn thành' : 'chưa hoàn thành'}`
        });
    });
});
