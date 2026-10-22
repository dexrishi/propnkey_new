<!-- Sticky Enquiry Button -->
<div class="sticky-enquiry-btn" onclick="openSidebarEnquiry()">
    <span>Enquire Now</span>
</div>

<!-- Overlay -->
<div class="popup-overlay" id="sidebarOverlay" onclick="closeSidebarEnquiry()"></div>

<!-- Sidebar Form -->
<div class="sidebar-enquiry" id="sidebarEnquiry">
    <span class="close-btn" onclick="closeSidebarEnquiry()">×</span>

    <h2>Enquire Now</h2>

    <form id="sidebarEnquiryForm" action="{{ route('property.inquiry.submit') }}" method="POST">
        @csrf
        <input type="hidden" name="project_name" id="sidebarProjectName" value="">
        <input type="hidden" name="form_name" value="Sidebar Enquiry">
        <input type="hidden" name="url" value="{{ url()->current() }}">
        
        <div class="input-group">
            <input type="text" name="name" id="sidebarName" placeholder="Name*" required>
        </div>
        <div class="input-group">
            <input type="email" name="email" id="sidebarEmail" placeholder="Email*" required>
        </div>
        <div class="input-group">
            <input type="tel" name="phone" id="sidebarPhone" placeholder="Phone*" required>
        </div>
        <div class="input-group">
            <textarea name="message" id="sidebarMessage" placeholder="Message (Optional)" rows="3" style="width: 100%; border: none; border-bottom: 1px solid #000; padding: 10px 0; font-size: 14px; background: transparent; outline: none; resize: vertical; font-family: inherit;"></textarea>
        </div>
        
        <!-- Google reCAPTCHA -->
        @php
            $recaptchaSiteKey = \App\Helpers\SiteConfigHelper::recaptchaSiteKey();
        @endphp
        <div class="mb-3" style="margin-bottom: 20px;">
            <div id="sidebarRecaptcha"></div>
            <div id="sidebarRecaptchaError" style="display: none; color: #dc3545; font-size: 12px; margin-top: 5px;"></div>
        </div>
        
        <button class="submit-btn" type="submit">
            <span id="sidebarSubmitText">Submit</span>
            <span id="sidebarSubmitLoader" style="display: none;">Submitting...</span>
        </button>
    </form>
    
    <div id="sidebarSuccessMessage" style="display: none; margin-top: 20px; padding: 15px; background: #d4edda; color: #155724; border-radius: 4px; text-align: center;">
        <p style="margin: 0;">Thank you! We'll get back to you shortly.</p>
    </div>
    
    <div id="sidebarErrorMessage" style="display: none; margin-top: 20px; padding: 15px; background: #f8d7da; color: #721c24; border-radius: 4px; text-align: center;">
        <p style="margin: 0;" id="sidebarErrorText">Something went wrong. Please try again.</p>
    </div>
</div>

<style>
/* ===== Sticky Enquiry Button ===== */
.sticky-enquiry-btn {
    position: fixed;
    right: -55px;
    top: 50%;
    transform: translateY(-50%) rotate(-90deg);
    background: linear-gradient(135deg, #d4af37, #f1d27a);
    color: #000;
    padding: 12px 28px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    z-index: 9997;
    border-radius: 6px 6px 0 0;
    letter-spacing: 0.5px;
    white-space: nowrap;
    transition: all 0.3s ease;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.sticky-enquiry-btn:hover {
    background: linear-gradient(135deg, #f1d27a, #d4af37);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

/* ===== Overlay ===== */
.popup-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    display: none;
    z-index: 9998;
    backdrop-filter: blur(2px);
}
.popup-overlay.active {
    display: block;
}

/* ===== Sidebar ===== */
.sidebar-enquiry {
    position: fixed;
    top: 0;
    right: -420px;
    width: 420px;
    height: 100vh;
    background: #fff;
    padding: 40px 36px;
    z-index: 9999;
    transition: right 0.4s ease;
    color: #000;
    overflow-y: auto;
    box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
}
.sidebar-enquiry.active {
    right: 0;
}

/* ===== Close ===== */
.close-btn {
    position: absolute;
    top: 18px;
    right: 22px;
    font-size: 26px;
    cursor: pointer;
    color: #333;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}
.close-btn:hover {
    background: #f0f0f0;
    color: #000;
}

/* ===== Header ===== */
.sidebar-enquiry h2 {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    margin-bottom: 30px;
    color: #333;
    font-weight: 500;
}

/* ===== Inputs ===== */
.input-group {
    margin-bottom: 22px;
}
.input-group input,
.input-group textarea {
    width: 100%;
    border: none;
    border-bottom: 1px solid #000;
    padding: 10px 0;
    font-size: 14px;
    background: transparent;
    outline: none;
    font-family: 'Poppins', sans-serif;
    transition: border-color 0.3s ease;
}
.input-group input:focus,
.input-group textarea:focus {
    border-bottom-color: #d4af37;
}
.input-group input::placeholder,
.input-group textarea::placeholder {
    color: #999;
}

/* ===== Button ===== */
.submit-btn {
    margin-top: 30px;
    padding: 14px 34px;
    border: none;
    background: linear-gradient(135deg, #d4af37, #f1d27a);
    font-weight: 500;
    cursor: pointer;
    width: 100%;
    font-size: 15px;
    color: #000;
    border-radius: 4px;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
}
.submit-btn:hover {
    background: linear-gradient(135deg, #f1d27a, #d4af37);
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(212, 175, 55, 0.3);
}
.submit-btn:active {
    transform: translateY(0);
}

/* ===== Responsive ===== */
@media (max-width: 480px) {
    .sidebar-enquiry {
        width: 100%;
    }
}
@media (max-width: 768px) {
    .sticky-enquiry-btn {
        right: -45px;
        top: 50%;
        bottom: auto;
        transform: translateY(-50%) rotate(-90deg);
        border-radius: 6px 6px 0 0;
        padding: 6px 12px;
    }
    .sticky-enquiry-btn span {
        transform: none;
    }
}

/* Loading state */
.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}
</style>

<script>
// Store widget ID globally
let sidebarRecaptchaWidgetId = null;

// Make function available globally immediately
function openSidebarEnquiry(propertyData) {
    document.getElementById('sidebarEnquiry').classList.add('active');
    document.getElementById('sidebarOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // If property data is provided, set it in the form
    if (propertyData) {
        const projectNameField = document.getElementById('sidebarProjectName');
        if (projectNameField) {
            projectNameField.value = propertyData.name || '';
        }
    }
}

// Also assign to window for global access
window.openSidebarEnquiry = openSidebarEnquiry;

function closeSidebarEnquiry() {
    document.getElementById('sidebarEnquiry').classList.remove('active');
    document.getElementById('sidebarOverlay').classList.remove('active');
    document.body.style.overflow = '';
    
    // Reset form after a delay
    setTimeout(function() {
        document.getElementById('sidebarEnquiryForm').reset();
        document.getElementById('sidebarSuccessMessage').style.display = 'none';
        document.getElementById('sidebarErrorMessage').style.display = 'none';
        if (typeof grecaptcha !== 'undefined' && sidebarRecaptchaWidgetId !== null) {
            grecaptcha.reset(sidebarRecaptchaWidgetId);
        }
        document.getElementById('sidebarRecaptchaError').style.display = 'none';
    }, 300);
}

// Handle form submission
document.addEventListener('DOMContentLoaded', function() {
    // Render reCAPTCHA programmatically - wait for grecaptcha to be ready
    function renderSidebarRecaptcha() {
        const sidebarRecaptchaElement = document.getElementById('sidebarRecaptcha');
        if (sidebarRecaptchaElement && typeof grecaptcha !== 'undefined' && grecaptcha.render) {
            @php
                $recaptchaSiteKey = \App\Helpers\SiteConfigHelper::recaptchaSiteKey();
            @endphp
            sidebarRecaptchaWidgetId = grecaptcha.render('sidebarRecaptcha', {
                'sitekey': '{!! $recaptchaSiteKey !!}'
            });
        } else if (sidebarRecaptchaElement) {
            // Retry after a short delay if grecaptcha is not ready yet
            setTimeout(renderSidebarRecaptcha, 100);
        }
    }
    renderSidebarRecaptcha();
    
    const form = document.getElementById('sidebarEnquiryForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = form.querySelector('.submit-btn');
            const submitText = document.getElementById('sidebarSubmitText');
            const submitLoader = document.getElementById('sidebarSubmitLoader');
            const successMsg = document.getElementById('sidebarSuccessMessage');
            const errorMsg = document.getElementById('sidebarErrorMessage');
            const errorText = document.getElementById('sidebarErrorText');
            
            // Show loading state
            submitBtn.disabled = true;
            submitText.style.display = 'none';
            submitLoader.style.display = 'inline';
            successMsg.style.display = 'none';
            errorMsg.style.display = 'none';
            
            // Get reCAPTCHA response
            const recaptchaResponse = sidebarRecaptchaWidgetId !== null ? grecaptcha.getResponse(sidebarRecaptchaWidgetId) : '';
            if (!recaptchaResponse) {
                document.getElementById('sidebarRecaptchaError').textContent = 'Please complete the reCAPTCHA verification.';
                document.getElementById('sidebarRecaptchaError').style.display = 'block';
                submitBtn.disabled = false;
                submitText.style.display = 'inline';
                submitLoader.style.display = 'none';
                return;
            }
            
            // Get form data
            const formData = new FormData(form);
            formData.append('g-recaptcha-response', recaptchaResponse);
            
            // Submit via AJAX
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || formData.get('_token')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    successMsg.style.display = 'block';
                    form.reset();
                    if (sidebarRecaptchaWidgetId !== null) {
                        grecaptcha.reset(sidebarRecaptchaWidgetId);
                    }
                    document.getElementById('sidebarRecaptchaError').style.display = 'none';
                    
                    // Close sidebar after 2 seconds
                    setTimeout(function() {
                        closeSidebarEnquiry();
                    }, 2000);
                } else {
                    // Show error message
                    errorText.textContent = data.message || 'Something went wrong. Please try again.';
                    errorMsg.style.display = 'block';
                    
                    // Handle reCAPTCHA errors
                    if (data.errors && data.errors['g-recaptcha-response']) {
                        document.getElementById('sidebarRecaptchaError').textContent = data.errors['g-recaptcha-response'][0];
                        document.getElementById('sidebarRecaptchaError').style.display = 'block';
                        if (sidebarRecaptchaWidgetId !== null) {
                            grecaptcha.reset(sidebarRecaptchaWidgetId);
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorText.textContent = 'Something went wrong. Please try again.';
                errorMsg.style.display = 'block';
                if (sidebarRecaptchaWidgetId !== null) {
                    grecaptcha.reset(sidebarRecaptchaWidgetId);
                }
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                submitText.style.display = 'inline';
                submitLoader.style.display = 'none';
            });
        });
    }
    
    // Close sidebar when clicking overlay
    document.getElementById('sidebarOverlay').addEventListener('click', closeSidebarEnquiry);
    
    // Close sidebar on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSidebarEnquiry();
        }
    });
});

// Function already assigned to window above
</script>

