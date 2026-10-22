<div class="prolist">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="gbox">
                    <div class="glist">
                        <h4>Real Estate Developer</h4>
                        <ul>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="" class="read">Read More...</a></li>
                        </ul>
                    </div>
                    <div class="glist">
                        <h4>Residential Projects</h4>
                        <ul>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="" class="read">Read More...</a></li>
                        </ul>
                    </div>
                    <div class="glist">
                        <h4>Commercial Projects</h4>
                        <ul>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="" class="read">Read More...</a></li>
                        </ul>
                    </div>
                    <div class="glist">
                        <h4>Real Estate Developer</h4>
                        <ul>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="" class="read">Read More...</a></li>
                        </ul>
                    </div>
                    <div class="glist">
                        <h4>Real Estate Developer</h4>
                        <ul>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="">4S Developers</a></li>
                        <li><a href="" class="read">Read More...</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<div class="middlefooter">
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
                             <a href="tel:+91-9999964462">+91-9999964462</a>

                            </div>
                     </li>
                     <li><div class="ico">
                        <i class="fal fa-mobile"></i>
                        </div>
                        <div class="inf">
                             <h6>Landline</h6>
                             <a href="tel:+91-9999964462">+91-9999964462</a>

                            </div>
                        </li>
                        <li><div class="ico">
                        <i class="fal fa-mobile"></i>
                        </div>
                        <div class="inf">
                             <h6>Email Us</h6>
                             <a href="tel:+91-9999964462">+91-9999964462</a>

                            </div>
                        </li>
                         </ul>
                    </div>
                    <div class="calb">
                            <ul>
                                <li><a href="#" class="bbutt" onclick="openEnquiryPopup(); return false;">Enquire Now</a></li>
                                <?php
                                    // Get WhatsApp number from site configs
                                    // Assume there's a function or variable $siteConfig with ['whatsapp'] key
                                    // Fallback to a default number if not set
                                    $whatsapp = isset($siteConfig['whatsapp']) && $siteConfig['whatsapp'] ? $siteConfig['whatsapp'] : '919999964462';
                                    // Remove all non-numeric except +
                                    $wa_num = preg_replace('/\D+/', '', $whatsapp);
                                    $wa_link = "https://wa.me/" . $wa_num;
                                ?>
                                <li><a href="<?php echo htmlspecialchars($wa_link); ?>" target="_blank" class="bbuttb">WhatsApp</a></li>
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
            <div class="col-md-2">
                <h4>Properties</h4>
                <ul class="links">
                    <li><a href="">Residential</a></li>
                    <li><a href="">Commercial</a></li>
                    <li><a href="">SCO Plots</a></li>
                    <li><a href="">Resale</a></li>
                    <li><a href="">Rent</a></li>
                    <li><a href="">Plots</a></li>
                </ul>
            </div>
            <div class="col-md-2">
            <h4>Quick Links</h4>
                <ul class="links">
                    <li><a href="">About us</a></li>
                    <li><a href="">Blogs</a></li>
                    <li><a href="">Privacy Policy</a></li>
                    <li><a href="">Contact us</a></li>
   
                </ul>
            </div>
            <div class="col-md-4">
                <div class="logobox">
                <img src="images/logoa.svg" alt="">
                <div class="social">
                        <ul>
                            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                         
                        </ul>
                    </div>
                    </div>
            </div>
            <div class="col-md-4">
                    <h4>Reias India Real Estate Pvt. Ltd.</h4>
                    <ul class="adlist">
                        <li><i class="fas fa-map-marker-alt"></i> Office No- R2131, First Floor, M3M Cosmopolitan, Sec-66, Golf Course Extn Road, Gurugram-122018-Haryana</li>
                        <li><i class="fas fa-building"></i> HRERA No- GGM/2037/1632/2023/50</li>
                    </ul>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <p class="mb-0 text-white">© Reias India Real Estate Pvt. Ltd., All rights reseved. Made by passion </p>
            </div>
        </div>
    </div>
</div>