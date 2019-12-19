window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let csrf_token = document.head.querySelector('meta[name="csrf-token"]');

if (csrf_token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = csrf_token.content;
} else {
    console.error(
        "CSRF token not found"
    );
}
