@extends('front.frontlayouts.frontapp')

@section('page-css')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
<style>
    .page_header_component .row:first-child {
        margin-top: 120px;
    }
    
    @media (max-width: 768px) {
        .page_header_component .row:first-child {
            margin-top: 80px;
        }
    }
</style>
@endsection

@section('content')
<div class="page_header_component">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page_header-heading heading-style3-h1">Contact us</h1>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Contact Details -->
            <div class="col-lg-5 col-md-6">
                <div class="contact_info-contact_details">
                    <h2 class="contact_details-heading">{{ \App\Helpers\SiteConfigHelper::companyName() }}</h2>
                    <div class="contact_details-meta">
                        <div class="contact_details-meta_heading">office</div>
                        <div class="contact_details-meta_text">
                            @php
                                $phone = \App\Helpers\SiteConfigHelper::officePhone();
                                $phoneLink = preg_replace('/[^0-9+]/', '', $phone);
                            @endphp
                            <a href="tel:{{ $phoneLink }}" class="contact_details-meta_link">{{ $phone }}</a>
                        </div>
                    </div>
                    <div class="contact_details-meta">
                        <div class="contact_details-meta_heading">e-mail</div>
                        <div class="contact_details-meta_text">
                            @php
                                $email = \App\Helpers\SiteConfigHelper::contactEmail();
                            @endphp
                            <a href="mailto:{{ $email }}" class="contact_details-meta_link">{{ $email }}</a>
                        </div>
                    </div>
                    <div class="contact_details-meta">
                        <div class="contact_details-meta_heading">address</div>
                        <div class="contact_details-meta_text">
                            {!! \App\Helpers\SiteConfigHelper::officeAddress() !!}
                        </div>
                    </div>
                    <div class="contact_details-meta contact_details-footer">
                        <div class="contact_details-meta_heading">follow us</div>
                        <div class="w-layout-grid social-icons2_list">
                            <div class="social">
                                <ul>
                                    @php
                                        $socialUrls = \App\Helpers\SiteConfigHelper::socialUrls();
                                    @endphp
                                    @if(!empty($socialUrls['facebook']) && $socialUrls['facebook'] !== '#')
                                        <li><a href="{{ $socialUrls['facebook'] }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook"></i></a></li>
                                    @endif
                                    @if(!empty($socialUrls['instagram']) && $socialUrls['instagram'] !== '#')
                                        <li><a href="{{ $socialUrls['instagram'] }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a></li>
                                    @endif
                                    @if(!empty($socialUrls['linkedin']) && $socialUrls['linkedin'] !== '#')
                                        <li><a href="{{ $socialUrls['linkedin'] }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin"></i></a></li>
                                    @endif
                                    @if(!empty($socialUrls['youtube']) && $socialUrls['youtube'] !== '#')
                                        <li><a href="{{ $socialUrls['youtube'] }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a></li>
                                    @endif
                                    @if(!empty($socialUrls['twitter']) && $socialUrls['twitter'] !== '#')
                                        <li><a href="{{ $socialUrls['twitter'] }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a></li>
                                    @endif
                                    @if(!empty($socialUrls['tiktok']) && $socialUrls['tiktok'] !== '#')
                                        <li><a href="{{ $socialUrls['tiktok'] }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-tiktok"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7 col-md-6">
                <div class="contact_info-contact_form">
                    <h2 class="contact_info-contact_form_heading">A touch <br>of perfection</h2>
                    <p class="contact_info-contact_form_paragraph">Please submit your details to arrange a consultation.<br></p>

                    <div class="property_inquiry-form_block w-form">
                        <form id="email-form" action="{{ route('property.inquiry.submit') }}" method="POST" class="property_inquiry-form">
                            @csrf
                            <input type="hidden" name="form_name" value="Contact Page">
                            <input type="hidden" name="url" value="{{ url()->current() }}">

                            <div class="property_inquiry-field_group field-group-style2">
                                <input class="property_inquiry-field field-style2 w-input" 
                                       name="name" placeholder="Full name" type="text" required>
                            </div>

                            <div class="property_inquiry-field_group field-group-style2">
                                <input class="property_inquiry-field field-style2 w-input" 
                                       name="phone" placeholder="+91 9876543210" type="tel" required>
                            </div>

                            <div class="property_inquiry-field_group field-group-style2 margin-top">
                                <input class="property_inquiry-field field-style2 w-input" 
                                       name="email" placeholder="Your e-mail" type="email" required>
                            </div>

                            <div class="property_inquiry-field_group field-group-style2 margin-top">
                                <textarea class="property_inquiry-field field-style2 w-input" 
                                          name="message" rows="5" placeholder="Write your message here..." required></textarea>
                            </div>

                            <!-- Google reCAPTCHA -->
                            @php
                                $recaptchaSiteKey = \App\Helpers\SiteConfigHelper::recaptchaSiteKey();
                            @endphp
                            <div class="mb-3">
                                <div id="contactRecaptcha"></div>
                                <div id="contactRecaptchaError" style="display: none; color: #dc3545; font-size: 12px; margin-top: 5px;"></div>
                            </div>

                            <!-- Success/Error Messages -->
                            <div id="contactSuccessMessage" style="display: none; padding: 15px; margin-bottom: 20px; background-color: #d4edda; border: 1px solid #c3e6cb; border-radius: 4px; color: #155724;">
                                <strong>Success!</strong> Your message has been sent successfully. We will contact you soon.
                            </div>
                            <div id="contactErrorMessage" style="display: none; padding: 15px; margin-bottom: 20px; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 4px; color: #721c24;">
                                <strong>Error!</strong> <span id="contactErrorText">Something went wrong. Please try again.</span>
                            </div>

                            <div class="property_inquiry-form_footer">
                                <button type="submit" class="property_inquiry-submit w-button" id="contactSubmitBtn">
                                    <span id="contactSubmitText">Send</span>
                                    <span id="contactSubmitLoader" style="display: none;">
                                        <i class="fas fa-spinner fa-spin"></i> Sending...
                                    </span>
                                </button>
                                <a href="/privacy-policy-luxury-residence" target="_blank" class="property_inquiry-privacy_link">Privacy Policy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="map">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @php
                    $contactMap = \App\Helpers\SiteConfigHelper::get('contact_map', '');
                @endphp
                @if($contactMap)
                    {!! $contactMap !!}
                @else
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1751.2810323158258!2d77.22738308760458!3d28.612911970597693!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce2daa9eb4d0b%3A0x717971125923e5d!2sIndia%20Gate!5e0!3m2!1sen!2sin!4v1739893456671!5m2!1sen!2sin" 
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- <script src="https://www.google.com/recaptcha/enterprise.js" async defer></script> -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'></script>

<script>
// Store widget ID globally
let contactRecaptchaWidgetId = null;

// Handle contact form submission
document.addEventListener('DOMContentLoaded', function() {
    // Render reCAPTCHA programmatically - wait for grecaptcha to be ready
    function renderContactRecaptcha() {
        const contactRecaptchaElement = document.getElementById('contactRecaptcha');
        if (contactRecaptchaElement && typeof grecaptcha !== 'undefined' && grecaptcha.render) {
            @php
                $recaptchaSiteKey = \App\Helpers\SiteConfigHelper::recaptchaSiteKey();
            @endphp
            contactRecaptchaWidgetId = grecaptcha.render('contactRecaptcha', {
                'sitekey': '{!! $recaptchaSiteKey !!}'
            });
        } else if (contactRecaptchaElement) {
            // Retry after a short delay if grecaptcha is not ready yet
            setTimeout(renderContactRecaptcha, 100);
        }
    }
    renderContactRecaptcha();
    
    const form = document.getElementById('email-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('contactSubmitBtn');
            const submitText = document.getElementById('contactSubmitText');
            const submitLoader = document.getElementById('contactSubmitLoader');
            const successMsg = document.getElementById('contactSuccessMessage');
            const errorMsg = document.getElementById('contactErrorMessage');
            const errorText = document.getElementById('contactErrorText');
            
            // Show loading state
            submitBtn.disabled = true;
            submitText.style.display = 'none';
            submitLoader.style.display = 'inline';
            successMsg.style.display = 'none';
            errorMsg.style.display = 'none';
            document.getElementById('contactRecaptchaError').style.display = 'none';
            
            // Get reCAPTCHA response
            const recaptchaResponse = contactRecaptchaWidgetId !== null ? grecaptcha.getResponse(contactRecaptchaWidgetId) : '';
            if (!recaptchaResponse) {
                document.getElementById('contactRecaptchaError').textContent = 'Please complete the reCAPTCHA verification.';
                document.getElementById('contactRecaptchaError').style.display = 'block';
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
                    if (contactRecaptchaWidgetId !== null) {
                        grecaptcha.reset(contactRecaptchaWidgetId);
                    }
                    document.getElementById('contactRecaptchaError').style.display = 'none';
                    
                    // Scroll to success message
                    successMsg.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                } else {
                    // Show error message
                    errorText.textContent = data.message || 'Something went wrong. Please try again.';
                    errorMsg.style.display = 'block';
                    
                    // Handle reCAPTCHA errors
                    if (data.errors && data.errors['g-recaptcha-response']) {
                        document.getElementById('contactRecaptchaError').textContent = data.errors['g-recaptcha-response'][0];
                        document.getElementById('contactRecaptchaError').style.display = 'block';
                        if (contactRecaptchaWidgetId !== null) {
                            grecaptcha.reset(contactRecaptchaWidgetId);
                        }
                    }
                    
                    // Handle other validation errors
                    if (data.errors) {
                        let errorMessages = [];
                        for (let field in data.errors) {
                            if (field !== 'g-recaptcha-response') {
                                errorMessages.push(data.errors[field][0]);
                            }
                        }
                        if (errorMessages.length > 0) {
                            errorText.textContent = errorMessages.join(', ');
                        }
                    }
                    
                    // Scroll to error message
                    errorMsg.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorText.textContent = 'Something went wrong. Please try again.';
                errorMsg.style.display = 'block';
                if (contactRecaptchaWidgetId !== null) {
                    grecaptcha.reset(contactRecaptchaWidgetId);
                }
                
                // Scroll to error message
                errorMsg.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                submitText.style.display = 'inline';
                submitLoader.style.display = 'none';
            });
        });
    }
});
</script>
@endsection
