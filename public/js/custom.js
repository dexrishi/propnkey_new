// Custom JavaScript for Propnkey Application

document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Form validation enhancement
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // Add fade-in animation to cards
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('fade-in');
    });

    // Sidebar toggle for mobile
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
    }

    // Logout confirmation
    const logoutButtons = document.querySelectorAll('[data-action="logout"]');
    logoutButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to logout?')) {
                this.closest('form').submit();
            }
        });
    });

    // Password strength indicator
    const passwordInput = document.querySelector('input[name="password"]');
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strength = calculatePasswordStrength(password);
            updatePasswordStrengthIndicator(strength);
        });
    }

    // Real-time form validation
    const emailInput = document.querySelector('input[name="email"]');
    if (emailInput) {
        emailInput.addEventListener('blur', function() {
            validateEmail(this);
        });
    }
});

// Password strength calculation
function calculatePasswordStrength(password) {
    let strength = 0;
    
    if (password.length >= 8) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;
    
    return strength;
}

// Update password strength indicator
function updatePasswordStrengthIndicator(strength) {
    const indicator = document.querySelector('.password-strength');
    if (!indicator) return;
    
    indicator.className = 'password-strength';
    
    if (strength < 2) {
        indicator.classList.add('weak');
        indicator.textContent = 'Weak';
    } else if (strength < 4) {
        indicator.classList.add('medium');
        indicator.textContent = 'Medium';
    } else {
        indicator.classList.add('strong');
        indicator.textContent = 'Strong';
    }
}

// Email validation
function validateEmail(input) {
    const email = input.value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (email && !emailRegex.test(email)) {
        input.classList.add('is-invalid');
        showFieldError(input, 'Please enter a valid email address.');
    } else {
        input.classList.remove('is-invalid');
        hideFieldError(input);
    }
}

// Show field error
function showFieldError(input, message) {
    hideFieldError(input);
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback d-block';
    errorDiv.textContent = message;
    
    input.parentNode.appendChild(errorDiv);
}

// Hide field error
function hideFieldError(input) {
    const existingError = input.parentNode.querySelector('.invalid-feedback');
    if (existingError) {
        existingError.remove();
    }
}

// Utility function to show loading state
function showLoading(element) {
    element.classList.add('loading');
    element.disabled = true;
}

// Utility function to hide loading state
function hideLoading(element) {
    element.classList.remove('loading');
    element.disabled = false;
}

// AJAX form submission
function submitFormAjax(form, callback) {
    const formData = new FormData(form);
    const submitButton = form.querySelector('button[type="submit"]');
    
    showLoading(submitButton);
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        hideLoading(submitButton);
        if (callback) callback(data);
    })
    .catch(error => {
        hideLoading(submitButton);
        console.error('Error:', error);
    });
}
