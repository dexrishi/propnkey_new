<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css'>
    <?php include('./include/head-meta.php') ?>
</head>

<body>
    <div class="navbar-gradient">
        <?php include('./include/header.php') ?>
    </div>

    <div class="topserch">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="properties_intro-wrapper">
                        <h1 class="properties_intro-heading">Residences</h1>
                        <h2 class="properties_intro-sub_heading">just for you</h2>
                        <div class="properties_intro-paragraph">Luxury Residences provides you unparalleled access to
                            the finest new developments <br>and private homes. Please savour our curated selection of
                            exquisite properties.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="searchbox innerserch">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search_form-container">
                        <div class="search_form-field">
                            <input class="search_form-textfield w-input" maxlength="256" name="query" placeholder="3 BHK Apartments, Gurgaon" type="text" id="query">
                            <img loading="lazy" src="https://cdn.prod.website-files.com/66a8e4e8bd6f32dc4680818f/66cc2cef03ccf308a49ba730_search.svg" alt="" class="search_form-icon search_icon">
                            <div id="search_form-settings_icon_white" data-w-id="112bdf36-7448-9e6f-361c-e610af4accc0" class="search_form-icon_white"></div>
                        </div>
                        <input type="submit" data-wait="Please wait..." class="search_form-submit w-button" value="Search">

                        <div class="serchfilter" style="display:none" id="myDivser">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home">Private Residences</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu1">Rent</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu2">New Developments</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane  active" id="home">
                                    <div class="accordion" id="faq">
                                        <div class="card">
                                            <div class="card-header" id="faqhead1">
                                                <a href="#" class="btn btn-header-link" data-toggle="collapse" data-target="#faq1" aria-expanded="true" aria-controls="faq1">Location</a>
                                            </div>

                                            <div id="faq1" class="collapse show" aria-labelledby="faqhead1" data-parent="#faq">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="faqhead2">
                                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq2" aria-expanded="true" aria-controls="faq2">Price</a>
                                            </div>

                                            <div id="faq2" class="collapse" aria-labelledby="faqhead2" data-parent="#faq">
                                                <div class="card-body">
                                                    <div class="pricebox">
                                                        <div class="rangebox">
                                                            <input type="text" placeholder="12332" class="form-control">
                                                            <div class="min">min:</div>
                                                        </div>
                                                        <div class="dash"></div>
                                                        <div class="rangebox">
                                                            <input type="text" placeholder="12332" class="form-control">
                                                            <div class="min">max:</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="faqhead3">
                                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq3" aria-expanded="true" aria-controls="faq3">Type</a>
                                            </div>

                                            <div id="faq3" class="collapse" aria-labelledby="faqhead3" data-parent="#faq">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="faqhead4">
                                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq4" aria-expanded="true" aria-controls="faq4">Bedrooms</a>
                                            </div>

                                            <div id="faq4" class="collapse" aria-labelledby="faqhead4" data-parent="#faq">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="faqhead5">
                                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq5" aria-expanded="true" aria-controls="faq5">Features</a>
                                            </div>

                                            <div id="faq5" class="collapse" aria-labelledby="faqhead5" data-parent="#faq">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane  fade" id="menu1">
                                    <div class="accordion" id="faq">
                                        <div class="card">
                                            <div class="card-header" id="faqhead1">
                                                <a href="#" class="btn btn-header-link" data-toggle="collapse" data-target="#faq1" aria-expanded="true" aria-controls="faq1">Location</a>
                                            </div>

                                            <div id="faq1" class="collapse show" aria-labelledby="faqhead1" data-parent="#faq">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="faqhead2">
                                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq2" aria-expanded="true" aria-controls="faq2">Price</a>
                                            </div>

                                            <div id="faq2" class="collapse" aria-labelledby="faqhead2" data-parent="#faq">
                                                <div class="card-body">
                                                    <div class="pricebox">
                                                        <div class="rangebox">
                                                            <input type="text" placeholder="12332" class="form-control">
                                                            <div class="min">min:</div>
                                                        </div>
                                                        <div class="dash"></div>
                                                        <div class="rangebox">
                                                            <input type="text" placeholder="12332" class="form-control">
                                                            <div class="min">max:</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="faqhead3">
                                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq3" aria-expanded="true" aria-controls="faq3">Type</a>
                                            </div>

                                            <div id="faq3" class="collapse" aria-labelledby="faqhead3" data-parent="#faq">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="faqhead4">
                                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq4" aria-expanded="true" aria-controls="faq4">Bedrooms</a>
                                            </div>

                                            <div id="faq4" class="collapse" aria-labelledby="faqhead4" data-parent="#faq">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="faqhead5">
                                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq5" aria-expanded="true" aria-controls="faq5">Features</a>
                                            </div>

                                            <div id="faq5" class="collapse" aria-labelledby="faqhead5" data-parent="#faq">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" value="">Option 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane  fade" id="menu2">...</div>
                            </div>
                            <div class="search_form-filter_footer"><input type="submit" data-wait="Please wait..." data-w-id="112bdf36-7448-9e6f-361c-e610af4ace39" class="search_form-filter_submit_button w-button" value="Confirm"><a fs-cmsfilter-element="clear" href="#" class="search_form-filter_clear_button w-button">Clear</a></div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="productlistsec">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="proboxcat soldrel">
                        <span class="sold">Sold Out</span>
                        <div class="proboxcatimg">
                            <a href="detail.php">
                                <img src="images/8d6806d9eb070ea43be26c54f90b369a.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="proboxcattext">
                            <h1 class="details_meta-property_title"><a href="detail.php">Chic European Style Penthouse with Amazing Views</a></h1>
                            <p>Penthouse | 3 | 4,077 sq.ft | 379 sq.m</p>
                            <p>Location:
                                Al Mesk Tower, Dubai, Dubai Marina</p>
                            <div class="search_properties-details_price">
                                <div fs-cmsfilter-field="price" class="details_price-aed">RS 13,900,000</div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="proboxcat">
                        <div class="proboxcatimg">
                            <a href="detail.php">
                                <img src="images/godrej-connaught-one-interiors-165765038751.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="proboxcattext">
                        <h1 class="details_meta-property_title"><a href="detail.php">Chic European Style Penthouse with Amazing Views</a></h1>
                            <p>Penthouse | 3 | 4,077 sq.ft | 379 sq.m</p>
                            <p>Location:
                                Al Mesk Tower, Dubai, Dubai Marina</p>
                            <div class="search_properties-details_price">
                               <div fs-cmsfilter-field="price" class="details_price-aed">RS 13,900,000</div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="proboxcat">
                        <div class="proboxcatimg">
                            <a href="">
                                <img src="images/cf7998fdfa5e5f44588d9fe2ead47803.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="proboxcattext">
                        <h1 class="details_meta-property_title"><a href="detail.php">Chic European Style Penthouse with Amazing Views</a></h1>
                            <p>Penthouse | 3 | 4,077 sq.ft | 379 sq.m</p>
                            <p>Location:
                                Al Mesk Tower, Dubai, Dubai Marina</p>
                            <div class="search_properties-details_price">
                               <div fs-cmsfilter-field="price" class="details_price-aed">RS 13,900,000</div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="proboxcat">
                        <div class="proboxcatimg">
                            <a href="">
                                <img src="images/DSC08587-MLS.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="proboxcattext">
                            <h1 class="details_meta-property_title">Chic European Style Penthouse with Amazing Views</h1>
                            <p>Penthouse | 3 | 4,077 sq.ft | 379 sq.m</p>
                            <p>Location:
                                Al Mesk Tower, Dubai, Dubai Marina</p>
                            <div class="search_properties-details_price">
                               <div fs-cmsfilter-field="price" class="details_price-aed">RS 13,900,000</div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ptb">
                <div class="pagination">
        <button class="arrow" id="prevPage" disabled>← <span class="nav-text">PREV</span></button>
        <div class="pages">
            <div class="page-number active">1</div>
            <div class="page-number">2</div>
            <div class="page-number">3</div>
            <div class="page-number">4</div>
            <div class="page-number">5</div>
        </div>
        <button class="arrow" id="nextPage"><span class="nav-text">NEXT</span> →</button>
    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('./include/footer.php') ?>
    <?php include('./include/js-meta.php') ?>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js'></script>
</body>

</html>