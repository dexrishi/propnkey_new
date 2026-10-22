<div class="prolist">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="gbox">
                    @foreach($topCategories as $categoryData)
                        <div class="glist">
                            <h4>{{ $categoryData['name'] }}</h4>
                            <ul>
                                @foreach($categoryData['links'] as $link)
                                    <li>
                                        @if($link->url)
                                            <a href="{{ $link->url }}">{{ $link->title }}</a>
                                        @else
                                            <span>{{ $link->title }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@php
    $landline = \App\Helpers\SiteConfigHelper::get('contact_landline', '');
    $hasLandline = !empty($landline);
@endphp
<div class="middlefooter {{ !$hasLandline ? 'no-landline' : '' }}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="leftbbox">
                    <div class="cola">
                        <ul>
                        <li><div class="ico">
                        <i class="fal fa-mobile"></i>
                        </div>
                        <div class="inf">
                             <h6>Mobile</h6>
                             <a href="tel:{{ \App\Helpers\SiteConfigHelper::officePhone() }}">{{ \App\Helpers\SiteConfigHelper::officePhone() }}</a>

                            </div>
                     </li>
                     @if($hasLandline)
                     <li><div class="ico">
                        <i class="fal fa-phone"></i>
                        </div>
                        <div class="inf">
                             <h6>Landline</h6>
                             <a href="tel:{{ $landline }}">{{ $landline }}</a>

                            </div>
                        </li>
                     @endif
                        <li><div class="ico">
                        <i class="fal fa-envelope"></i>
                        </div>
                        <div class="inf">
                             <h6>Email Us</h6>
                             <a href="mailto:{{ \App\Helpers\SiteConfigHelper::contactEmail() }}">{{ \App\Helpers\SiteConfigHelper::contactEmail() }}</a>

                            </div>
                        </li>
                         </ul>
                    </div>
                    <div class="calb">
                            <ul>
                                <li><a href="#" class="bbutt" onclick="openEnquiryPopup(); return false;">Enquire Now</a></li>
                                <li><a href="https://wa.me/{{ \App\Helpers\SiteConfigHelper::whatsappNumber() }}" target="_blank" class="bbuttb">Whatsapp</a></li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="lastfooter">
    <div class="container">
        <div class="row">
            @foreach($bottomCategories as $categoryData)
                <div class="col-md-2">
                    <h4>{{ $categoryData['name'] }}</h4>
                    <ul class="links">
                        @foreach($categoryData['links'] as $link)
                            <li>
                                @if($link->url)
                                    <a href="{{ $link->url }}">{{ $link->title }}</a>
                                @else
                                    <span>{{ $link->title }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
            <div class="col-md-4">
                <div class="logobox">
                <img src="{{ asset(\App\Helpers\SiteConfigHelper::siteLogo()) }}" alt="{{ \App\Helpers\SiteConfigHelper::siteName() }}">
                <div class="social">
                        <ul>
                            @php $socialUrls = \App\Helpers\SiteConfigHelper::socialUrls(); @endphp
                            <li><a href="{{ $socialUrls['facebook'] }}"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="{{ $socialUrls['instagram'] }}"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="{{ $socialUrls['linkedin'] }}"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="{{ $socialUrls['youtube'] }}"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="{{ $socialUrls['tiktok'] }}"><i class="fab fa-tiktok"></i></a></li>
                         
                        </ul>
                    </div>
                    </div>
            </div>
            <div class="col-md-4">
                    <h4>{{ \App\Helpers\SiteConfigHelper::companyName() }}</h4>
                    <ul class="adlist">
                        <li><i class="fas fa-map-marker-alt"></i> {!! \App\Helpers\SiteConfigHelper::officeAddress() !!}</li>
                        <li><i class="fas fa-building"></i> {!! \App\Helpers\SiteConfigHelper::get('rera_number', 'HRERA Registration Number') !!}</li>
                    </ul>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <p class="mb-0 text-white">{{ \App\Helpers\SiteConfigHelper::copyrightText() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Enquiry Popup -->
<div class="popup-overlay-enquiry" id="enquiryPopup">
    <div class="popup-enquiry">
        <span class="close-btn-enquiry" onclick="closeEnquiryPopup()">×</span>

        <h2>Let's Stay in Touch</h2>
        <p>Fill in your details and our luxury advisor will connect with you</p>

        <form id="enquiryPopupForm" action="{{ route('property.inquiry.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="project_name" id="popupProjectName" value="">
            <input type="hidden" name="form_name" value="PopUp - Profile">
            <input type="hidden" name="url" value="{{ url()->current() }}">
            
            <div class="input-group-enquiry">
                <i>👤</i>
                <input type="text" name="name" id="popupName" placeholder="Full Name" required>
            </div>

            <div class="input-group-enquiry">
                <i>✉️</i>
                <input type="email" name="email" id="popupEmail" placeholder="Email Address" required>
            </div>

            <div class="input-group-enquiry">
                <i>📞</i>
                <input type="tel" name="phone" id="popupPhone" placeholder="Mobile Number" required>
            </div>
            
            <!-- Google reCAPTCHA -->
            @php
                $recaptchaSiteKey = \App\Helpers\SiteConfigHelper::recaptchaSiteKey();
            @endphp
            <div class="mb-3" style="margin-bottom: 20px;">
                <div id="popupRecaptcha"></div>
                <div id="popupRecaptchaError" style="display: none; color: #dc3545; font-size: 12px; margin-top: 5px;"></div>
            </div>
            
            <button type="submit" class="submit-btn-enquiry">
                <span id="popupSubmitText">Submit Enquiry</span>
                <span id="popupSubmitLoader" style="display: none;">Submitting...</span>
            </button>
        </form>
        
        <div id="popupSuccessMessage" style="display: none; margin-top: 20px; padding: 15px; background: #d4edda; color: #155724; border-radius: 6px; text-align: center; font-size: 14px;">
            <p style="margin: 0;">Thank you! We'll get back to you shortly.</p>
        </div>
        
        <div id="popupErrorMessage" style="display: none; margin-top: 20px; padding: 15px; background: #f8d7da; color: #721c24; border-radius: 6px; text-align: center; font-size: 14px;">
            <p style="margin: 0;" id="popupErrorText">Something went wrong. Please try again.</p>
        </div>
    </div>
</div>

<style>
/* Enquiry Popup Styles */
.popup-overlay-enquiry {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.75);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 10000;
    backdrop-filter: blur(4px);
}
.popup-overlay-enquiry.active {
    display: flex;
}

.popup-enquiry {
    background: #151515;
    width: 420px;
    padding: 32px 36px;
    border-radius: 12px;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6);
    position: relative;
    animation: popupFade 0.5s ease;
    max-height: 90vh;
    overflow-y: auto;
}

@keyframes popupFade {
    from {
        opacity: 0;
        transform: scale(0.85);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.close-btn-enquiry {
    position: absolute;
    top: 14px;
    right: 18px;
    font-size: 22px;
    cursor: pointer;
    color: #aaa;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}
.close-btn-enquiry:hover {
    color: #fff;
    background: rgba(255, 255, 255, 0.1);
}

.popup-enquiry h2 {
    font-family: 'Playfair Display', serif;
    font-size: 26px;
    margin-bottom: 6px;
    color: #fff;
    font-weight: 500;
}

.popup-enquiry p {
    font-size: 14px;
    color: #aaa;
    margin-bottom: 26px;
    font-family: 'Poppins', sans-serif;
}

.input-group-enquiry {
    position: relative;
    margin-bottom: 18px;
}

.input-group-enquiry input {
    width: 100%;
    padding: 14px 15px 14px 42px;
    border-radius: 6px;
    border: 1px solid #333;
    background: #0f0f0f;
    color: #fff;
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}

.input-group-enquiry input:focus {
    border-color: #d4af37;
    outline: none;
    box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
}

.input-group-enquiry input::placeholder {
    color: #666;
}

.input-group-enquiry i {
    position: absolute;
    top: 50%;
    left: 14px;
    transform: translateY(-50%);
    color: #bfa45a;
    font-style: normal;
    font-size: 16px;
}

.submit-btn-enquiry {
    width: 100%;
    padding: 14px;
    border-radius: 6px;
    border: none;
    background: linear-gradient(135deg, #d4af37, #f1d27a);
    color: #000;
    font-weight: 500;
    margin-top: 10px;
    cursor: pointer;
    font-size: 15px;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}

.submit-btn-enquiry:hover {
    background: linear-gradient(135deg, #f1d27a, #d4af37);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
}

.submit-btn-enquiry:active {
    transform: translateY(0);
}

.submit-btn-enquiry:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

@media (max-width: 480px) {
    .popup-enquiry {
        width: 90%;
        padding: 24px 20px;
    }
    
    .popup-enquiry h2 {
        font-size: 22px;
    }
}
</style>

<script>
let enquiryPopupOpened = false;

// Store widget ID globally
let popupRecaptchaWidgetId = null;

// Make function available globally immediately
function openEnquiryPopup(propertyData) {
    const popup = document.getElementById('enquiryPopup');
    const pageContent = document.body;
    
    if (!popup) return;
    
    popup.classList.add('active');
    pageContent.style.overflow = 'hidden';
    
    // If property data is provided, set it in the form
    if (propertyData) {
        const projectNameField = document.getElementById('popupProjectName');
        if (projectNameField) {
            projectNameField.value = propertyData.name || '';
        }
    }
    
    enquiryPopupOpened = true;
}

// Also assign to window for global access
window.openEnquiryPopup = openEnquiryPopup;

function closeEnquiryPopup() {
    const popup = document.getElementById('enquiryPopup');
    const pageContent = document.body;
    
    popup.classList.remove('active');
    pageContent.style.overflow = '';
    
    // Reset form after a delay
    setTimeout(function() {
        document.getElementById('enquiryPopupForm').reset();
        document.getElementById('popupSuccessMessage').style.display = 'none';
        document.getElementById('popupErrorMessage').style.display = 'none';
        if (typeof grecaptcha !== 'undefined' && popupRecaptchaWidgetId !== null) {
            grecaptcha.reset(popupRecaptchaWidgetId);
        }
        document.getElementById('popupRecaptchaError').style.display = 'none';
    }, 300);
}

// Handle form submission
document.addEventListener('DOMContentLoaded', function() {
    // Render reCAPTCHA programmatically - wait for grecaptcha to be ready
    function renderPopupRecaptcha() {
        const popupRecaptchaElement = document.getElementById('popupRecaptcha');
        if (popupRecaptchaElement && typeof grecaptcha !== 'undefined' && grecaptcha.render) {
            @php
                $recaptchaSiteKey = \App\Helpers\SiteConfigHelper::recaptchaSiteKey();
            @endphp
            popupRecaptchaWidgetId = grecaptcha.render('popupRecaptcha', {
                'sitekey': '{!! $recaptchaSiteKey !!}'
            });
        } else if (popupRecaptchaElement) {
            // Retry after a short delay if grecaptcha is not ready yet
            setTimeout(renderPopupRecaptcha, 100);
        }
    }
    renderPopupRecaptcha();
    
    const form = document.getElementById('enquiryPopupForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = form.querySelector('.submit-btn-enquiry');
            const submitText = document.getElementById('popupSubmitText');
            const submitLoader = document.getElementById('popupSubmitLoader');
            const successMsg = document.getElementById('popupSuccessMessage');
            const errorMsg = document.getElementById('popupErrorMessage');
            const errorText = document.getElementById('popupErrorText');
            
            // Show loading state
            submitBtn.disabled = true;
            submitText.style.display = 'none';
            submitLoader.style.display = 'inline';
            successMsg.style.display = 'none';
            errorMsg.style.display = 'none';
            
            // Get reCAPTCHA response
            const recaptchaResponse = popupRecaptchaWidgetId !== null ? grecaptcha.getResponse(popupRecaptchaWidgetId) : '';
            if (!recaptchaResponse) {
                document.getElementById('popupRecaptchaError').textContent = 'Please complete the reCAPTCHA verification.';
                document.getElementById('popupRecaptchaError').style.display = 'block';
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
                    if (popupRecaptchaWidgetId !== null) {
                        grecaptcha.reset(popupRecaptchaWidgetId);
                    }
                    document.getElementById('popupRecaptchaError').style.display = 'none';
                    
                    // Close popup after 2 seconds
                    setTimeout(function() {
                        closeEnquiryPopup();
                    }, 2000);
                } else {
                    // Show error message
                    errorText.textContent = data.message || 'Something went wrong. Please try again.';
                    errorMsg.style.display = 'block';
                    
                    // Handle reCAPTCHA errors
                    if (data.errors && data.errors['g-recaptcha-response']) {
                        document.getElementById('popupRecaptchaError').textContent = data.errors['g-recaptcha-response'][0];
                        document.getElementById('popupRecaptchaError').style.display = 'block';
                        if (popupRecaptchaWidgetId !== null) {
                            grecaptcha.reset(popupRecaptchaWidgetId);
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorText.textContent = 'Something went wrong. Please try again.';
                errorMsg.style.display = 'block';
                if (popupRecaptchaWidgetId !== null) {
                    grecaptcha.reset(popupRecaptchaWidgetId);
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
    
    // Close popup when clicking overlay
    document.getElementById('enquiryPopup').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEnquiryPopup();
        }
    });
    
    // Close popup on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('enquiryPopup').classList.contains('active')) {
            closeEnquiryPopup();
        }
    });
    
    // Auto open after 10 seconds (only once per session)
    if (!sessionStorage.getItem('enquiryPopupShown')) {
        setTimeout(function() {
            if (!enquiryPopupOpened) {
                openEnquiryPopup();
                sessionStorage.setItem('enquiryPopupShown', 'true');
            }
        }, 10000);
    }
});

// Function already assigned to window above
</script>

<!-- Google reCAPTCHA Script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>