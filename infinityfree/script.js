
  window.addEventListener('DOMContentLoaded', () => {
    const tbody = document.querySelector('table tbody');
    const rows = tbody.querySelectorAll('tr');
    const noDataMessage = document.getElementById('noDataMessage');

    if (rows.length === 0) {
      noDataMessage.classList.remove('d-none');
    }
  });

