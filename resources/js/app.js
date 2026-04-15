import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
// ===== Sidebar Toggle =====
function toggleSidebar() {
    const sidebar = document.querySelector('aside');
    sidebar.classList.toggle('hidden');
}

// ===== Auto-hide alerts =====
setTimeout(() => {
    document.querySelectorAll('.alert').forEach(el => {
        el.style.display = 'none';
    });
}, 3000);

// ===== Confirm Delete =====
function confirmDelete() {
    return confirm("Are you sure you want to delete?");
}

// ===== Dynamic Table Search =====
function searchTable(inputId, tableId) {
    let input = document.getElementById(inputId);
    let filter = input.value.toLowerCase();
    let rows = document.querySelectorAll(`#${tableId} tbody tr`);

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
}

// ===== Simple Chart (Chart.js Required) =====
function loadChart(labels, data) {
    const ctx = document.getElementById('chart');

    if (!ctx) return;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Submissions',
                data: data,
                borderWidth: 1
            }]
        }
    });
}