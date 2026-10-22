<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
    <?php include('./include/head-meta.php') ?>
</head>

<body>
    <?php include('./include/header.php') ?>

    <div class="cta_component">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page_header-heading">Sell With Us</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="ctalist">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="services-wrapper">
                        <div class="services-box">
                            <h2 class="services-box_count">01</h2>
                            <h2 class="services-box_heading">Data Driven Analytics &amp; Analysis</h2>
                        </div>
                        <div class="services-box">
                            <h2 class="services-box_count">02</h2>
                            <h2 class="services-box_heading">Strategic Route to Market</h2>
                        </div>
                        <div class="services-box">
                            <h2 class="services-box_count">03</h2>
                            <h2 class="services-box_heading">World Class Photography &amp; Videography</h2>
                        </div>
                        <div class="services-box">
                            <h2 class="services-box_count">04</h2>
                            <h2 class="services-box_heading">Exposure to the leading Property Portals</h2>
                        </div>
                        <div class="services-box">
                            <h2 class="services-box_count">05</h2>
                            <h2 class="services-box_heading">Off-Market access to our High Net Worth Client database
                            </h2>
                        </div>
                        <div class="services-box">
                            <h2 class="services-box_count">06</h2>
                            <h2 class="services-box_heading">International Exposure via targeted Digital &amp; Social
                                Media Ad Campaigns</h2>
                        </div>
                        <div class="services-box">
                            <h2 class="services-box_count">07</h2>
                            <h2 class="services-box_heading">Regular Viewing Feedback and Offer Negotiation</h2>
                        </div>
                        <div class="services-box">
                            <h2 class="services-box_count">08</h2>
                            <h2 class="services-box_heading">Full Legal &amp; Conveyancing Support</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="property_inquiry_component">
        <div class="container">
            <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
            <h1 class="property_inquiry-heading">Contact us to arrange a complimentary valuation of your property</h1>
                <div class="property_inquiry-form_block w-form">
                    <form id="email-form" name="email-form" data-name="Email Form" method="get"
                        class="property_inquiry-form" data-wf-page-id="66d6e3e5a61d1e45a12499b1"
                        data-wf-element-id="788ae101-9250-3321-d9d6-15bd561e99ad" aria-label="Email Form"
                        data-hs-cf-bound="true">
                        <div class="property_inquiry-field_group"><input class="property_inquiry-field w-input"
                                maxlength="256" name="name" data-name="Name" placeholder="Full name" type="text"
                                id="name" required=""></div>
                                <div class="property_inquiry-field_group"><input class="property_inquiry-field w-input"
                                maxlength="256" name="name" data-name="Name" placeholder="Telephone" id="mobile_code" type="text"
                                 required=""></div>
                     
                        <div class="property_inquiry-field_group"><input class="property_inquiry-field w-input"
                                maxlength="256" name="Email" data-name="Email" placeholder="Your e-mail " type="email"
                                id="Email" required=""></div>
                        <div class="property_inquiry-field_group"><label for="UnitNumber"
                                class="property_inquiry-field_label">ID Property Address</label><input
                                class="property_inquiry-field w-input" maxlength="256" name="UnitNumber"
                                data-name="Unit Number" placeholder="Unit Number, Building Name, Street Name, Community"
                                type="text" id="UnitNumber" required=""></div>
                        <div class="property_inquiry-field_group"><label for="PropertyType"
                                class="property_inquiry-field_label">Property Type</label><select id="PropertyType"
                                name="PropertyType" data-name="Property Type" required=""
                                class="property_inquiry-select w-select">
                                <option value="Apartment">Apartment</option>
                                <option value="Villa">Villa</option>
                                <option value="Townhouse">Townhouse</option>
                                <option value="Penthouse">Penthouse</option>
                                <option value="Hotel Apartment">Hotel Apartment</option>
                            </select></div>
                        <div class="property_inquiry-field_group"><label for="PropertyType-3"
                                class="property_inquiry-field_label">Completion Status</label><select
                                id="PropertyType-3" name="PropertyType-3" data-name="Property Type 3" required=""
                                class="property_inquiry-select w-select">
                                <option value="Off Plan">Off Plan</option>
                                <option value="Ready">Ready</option>
                            </select></div>
                        <div class="property_inquiry-field_group"><textarea id="message" name="message" maxlength="5000"
                                data-name="Message" placeholder="Send Message"
                                class="property_inquiry-field property_inquiry-textarea w-input"></textarea></div>
                       <input type="submit" data-wait="Please wait..."
                            class="property_inquiry-submit w-button" value="Submit">
                    </form>
                 
                </div>
            </div>
            </div>
        </div>
    </div>

    <?php include('./include/footer.php') ?>
    <?php include('./include/js-meta.php') ?>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'></script>
    <script>
$("#mobile_code").intlTelInput({
    initialCountry: "in",
    separateDialCode: true,
    // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
});
</script>
</body>

</html>