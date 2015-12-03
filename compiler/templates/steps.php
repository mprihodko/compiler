<div class="compiler-wrapper">
    <div id="compiler"></div>
    <div class="compiler-content">
        <div class="full-width">
            <div class="w-tabs" id="tabsTemp">
                <div class="w-tabs-list">
                    <div class="w-tabs-item active"><span class="w-tabs-item-icon"></span><span class="w-tabs-item-title">Type &amp; Access</span></div>
                    <div class="w-tabs-item"><span class="w-tabs-item-icon"></span><span class="w-tabs-item-title">Site Information</span></div>
                    <div class="w-tabs-item"><span class="w-tabs-item-icon"></span><span class="w-tabs-item-title">Social Media</span></div>
                    <div class="w-tabs-item"><span class="w-tabs-item-icon"></span><span class="w-tabs-item-title">Contact Information</span></div>
                    <div class="w-tabs-item"><span class="w-tabs-item-icon"></span><span class="w-tabs-item-title">Finish</span></div>
                </div>
                <div class="w-tabs-section active">
                    <div class="w-tabs-section-header">
                        <div class="w-tabs-section-icon"></div>
                        <h4 class="w-tabs-section-title">Type &amp; Access</h4>
                        <div class="w-tabs-section-control"><i class="fa fa-angle-down"></i></div>
                    </div>
                    <div class="w-tabs-section-content" style="">
                        <div class="w-tabs-section-content-h">
                            <div class="wpb_text_column ">
                                <div class="wpb_wrapper">
                                    <h1 style="text-align: center;">Choose type of website</h1>
                                </div>
                            </div>
                            <div class="g-cols wpb_row offset_default  vc_custom_1447860094607" id="type">
<?php if(compileExists('standart')){ ?>
                                <div class="one-third">
                                    <div class="wpb_text_column site_type">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input class="type_app not-empty" name="type_website" type="radio" value="standart">
                                            </p>
                                            <h3 style="text-align: center;">Standart Site</h3>
                                            <p><small>(news, media, or blog)</small></p>
                                        </div>
                                    </div>
                                </div>
<?php } ?>
<?php if(compileExists('e-commerse')){ ?>
                                <div class="one-third">
                                    <div class="wpb_text_column site_type">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input class="type_app not-empty" name="type_website" type="radio" value="e-commerse">
                                            </p>
                                            <h3 style="text-align: center;">E-Commerce Site</h3>
                                            <p><small>(You want to sell a product)</small></p>
                                        </div>
                                    </div>
                                </div>
<?php } ?>
<?php if(compileExists('membership')){ ?>
                                <div class="one-third">
                                    <div class="wpb_text_column site_type">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input class="type_app not-empty" name="type_website" type="radio" value="membership">
                                            </p>
                                            <h3 style="text-align: center;">Membership Site</h3>
                                            <p><small>(You’re seling monthly access)</small></p>
                                        </div>
                                    </div>
                                </div>
<?php } ?>
                            </div>
                            <div class="wpb_text_column  vc_custom_1447950966197">
                                <div class="wpb_wrapper">
                                    <h2>Enter Site Access</h2>
                                    <p>Please make sure you check all the information entered. You will get the FTP information from your host or when you create the “Addon” site on your hosting account</p>
                                </div>
                            </div>
                            <div class="g-cols wpb_row offset_default ftp_row vc_custom_1447857413729">
                                <div class="one-quarter">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="site_url"  name="site_url" type="text" placeholder="Site URL *">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-quarter">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="ftp_hostname"  name="ftp_hostname" type="text" placeholder="FTP hostname *">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-quarter">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="ftp_username"  name="ftp_username" type="text" placeholder="FTP username *">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-quarter">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="ftp_password"  name="ftp_password" type="password" placeholder="FTP password *">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="g-cols wpb_row offset_default sql_row vc_custom_1447857423343">
                                <div class="one-quarter">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="mysql_host"  name="mysql_host" type="text" placeholder="MySQL Host *">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-quarter">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="mysql_database"  name="mysql_database" type="text" placeholder="MySQL Database Name *">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-quarter">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="mysql_username"  name="mysql_username" type="text" placeholder="MySQL username *">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-quarter">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="mysql_password"  name="mysql_password" type="password" placeholder="MySQL password *">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="g-cols wpb_row offset_default  vc_custom_1447857363710">
                                <div class="full-width controls_step">
                                    <div class="wpb_raw_code wpb_content_element wpb_raw_html">
                                        <div class="wpb_wrapper">
                                            <div id="connectionResult"></div>
                                        </div>
                                    </div> <span class="wpb_button align_left test_ftp"><a href="" class="g-btn color_yellow outlined"><i class="fa fa-fa fa-connectdevelop"></i><span>Test Setting</span></a>
                                    </span>
                                    <span class="wpb_button align_right next_step "><a href="" class="g-btn color_green outlined"><i class="fa fa-fa fa-arrow-circle-o-right"></i><span>Next</span></a>
                                    </span>
                                    <span class="wpb_button align_right i_confirm"><a href="" class="g-btn color_blue outlined"><i class="fa fa-fa fa-check"></i><span>I confirm this connection details</span></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-tabs-section">
                    <div class="w-tabs-section-header">
                        <div class="w-tabs-section-icon"></div>
                        <h4 class="w-tabs-section-title">Site Information</h4>
                        <div class="w-tabs-section-control"><i class="fa fa-angle-down"></i></div>
                    </div>
                    <div class="w-tabs-section-content">
                        <div class="w-tabs-section-content-h">
                            <div class="wpb_text_column ">
                                <div class="wpb_wrapper">
                                    <h1>Enter Site Information</h1>
                                    <p>Ok, lest start customizing your site information. These settings are very important so you want to make sure you pay attention to the site name and taglines as they have a huge impact on your internal SEO.
                                    </p>
                                </div>
                            </div>
                            <div class="g-cols wpb_row offset_default ftp_row vc_custom_1447857439762">
                                <div class="one-quarter">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="site_name"  name="site_name" type="text" placeholder="Site Name *">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-quarter">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="site_tagline"  name="site_tagline" type="text" placeholder="Site tagline *">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-quarter">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="site_email"  name="site_email" type="email" placeholder="Site email *">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="g-cols wpb_row offset_default ftp_row vc_custom_1447857450204">
                                <div class="full-width">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <textarea id="site_meta_desc" style="width: 99%;" name="site_meta_desc" rows="5" placeholder="Site Meta Description *"></textarea>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="g-cols wpb_row offset_default ftp_row vc_custom_1447857460674">
                                <div class="one-quarter">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="admin_name"  name="admin_name" type="text" placeholder="Admin Name *">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-quarter">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="admin_nickname"  name="admin_nickname" type="text" placeholder="Admin Nickname *">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-quarter">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="admin_password"  name="admin_password" type="password" placeholder="Admin Password *">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="one-quarter">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <span class="wpb_button align_left generate_password"><a href="" class="g-btn color_midnight generate outlined"><span>GENERATE PASSWORD</span></a></span>                                            
                                            </p>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="g-cols wpb_row offset_default  vc_custom_1447857385281">
                                <div class="full-width controls_step"><span class="wpb_button align_left prev_step"><a href="" class="g-btn color_contrast outlined"><i class="fa fa-fa fa-arrow-circle-o-left"></i><span>Preview</span></a>
                                    </span>
                                    <span class="wpb_button align_right next_step"><a href="" class="g-btn color_green outlined"><i class="fa fa-fa fa-arrow-circle-o-right"></i><span>Next</span></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-tabs-section">
                    <div class="w-tabs-section-header">
                        <div class="w-tabs-section-icon"></div>
                        <h4 class="w-tabs-section-title">Social Media</h4>
                        <div class="w-tabs-section-control"><i class="fa fa-angle-down"></i></div>
                    </div>
                    <div class="w-tabs-section-content">
                        <div class="w-tabs-section-content-h">
                            <div class="wpb_text_column ">
                                <div class="wpb_wrapper">
                                    <h1>Enter Social&nbsp;Media Accounts</h1>
                                    <p>You can customize your Social Media settings here. There are many more settings inside in the site but with this section you can configure the main ones right now…
                                    </p>
                                </div>
                            </div>
                            <div class="g-cols wpb_row offset_default ftp_row vc_custom_1447857484142">
                                <div class="one-third">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p class="fa fa-facebook-square" style="text-align: center;">
                                                <input id="facebook" name="facebook" type="text" placeholder="Facebook Account URL">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-third">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p class="fa fa-twitter-square" style="text-align: center;">
                                                <input id="twitter" name="twitter" type="text" placeholder="Twitter Account URL">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-third">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p class="fa fa-linkedin-square" style="text-align: center;">
                                                <input id="linkedin" name="linkedin" type="text" placeholder="LinkedIn Profile URL">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="g-cols wpb_row offset_default ftp_row vc_custom_1447857494316">
                                <div class="one-third">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p class="fa fa-google-plus-square" style="text-align: center;">
                                                <input id="google" name="google" type="text" placeholder="Google Plus Profile URL">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-third">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p class="fa fa-youtube-square" style="text-align: center;">
                                                <input id="youtube" name="youtube" type="text" placeholder="Youtube Profile URL">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-third">
                                </div>
                            </div>
                            <div class="g-cols wpb_row offset_default  vc_custom_1447857506428">
                                <div class="full-width controls_step"><span class="wpb_button align_left prev_step"><a href="" class="g-btn color_contrast outlined"><i class="fa fa-fa fa-arrow-circle-o-left"></i><span>Preview</span></a>
                                    </span>
                                    <span class="wpb_button align_right next_step"><a href="" class="g-btn color_green outlined"><i class="fa fa-fa fa-arrow-circle-o-right"></i><span>Next </span></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-tabs-section">
                    <div class="w-tabs-section-header">
                        <div class="w-tabs-section-icon"></div>
                        <h4 class="w-tabs-section-title">Contact Information</h4>
                        <div class="w-tabs-section-control"><i class="fa fa-angle-down"></i></div>
                    </div>
                    <div class="w-tabs-section-content">
                        <div class="w-tabs-section-content-h">
                            <div class="wpb_text_column ">
                                <div class="wpb_wrapper">
                                    <h1>Enter Site Contact Information &amp; Privacy Policy</h1>
                                    <p>This section allows you to configure and setup the base site contact information as well as the data that appears in the terms of use and privacy policy pages. This is &nbsp;very useful for compliance for many affiliate programs and allows you to build true authority.
                                    </p>
                                </div>
                            </div>
                            <div class="g-cols wpb_row offset_default ftp_row vc_custom_1447857523516">
                                <div class="one-third">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="company_name" name="company_name" type="text" placeholder="Company Name">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-third">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="street" name="street" type="text" placeholder="Street Address">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-third">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="city" name="city" type="text" placeholder="City">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="g-cols wpb_row offset_default ftp_row vc_custom_1447857536046">
                                <div class="one-third">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="state" name="state" type="text" placeholder="State">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-third">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="zip" name="zip" type="text" placeholder="Zip / Postcode">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-third">
                                    <div class="wpb_text_column ">
                                        <div class="wpb_wrapper">
                                            <p>
                                                <input id="phone" name="phone" type="text" placeholder="Phone Number">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="g-cols wpb_row offset_default  vc_custom_1447857548331">
                                <div class="full-width controls_step"><span class="wpb_button align_left prev_step"><a href="" class="g-btn color_contrast outlined"><i class="fa fa-fa fa-arrow-circle-o-left"></i><span>Preview</span></a>
                                    </span>
                                    <span class="wpb_button align_right next_step"><a href="" class="g-btn color_green outlined"><i class="fa fa-fa fa-arrow-circle-o-right"></i><span>Next</span></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-tabs-section">
                    <div class="w-tabs-section-header">
                        <div class="w-tabs-section-icon"></div>
                        <h4 class="w-tabs-section-title">Finish</h4>
                        <div class="w-tabs-section-control"><i class="fa fa-angle-down"></i></div>
                    </div>
                    <div class="w-tabs-section-content">
                        <div class="w-tabs-section-content-h">
                            <div class="wpb_text_column ">
                                <div class="wpb_wrapper">
                                    <h1 style="text-align: left;">Agree to Terms and Conditions</h1>
                                    <p>By clicking bellow you confirm that we accept no responsibility for any data loss for the user of this tool and that you have checked and verified all information before submission and installation. You also confirm that you have made backups of your account and all data prior to using this tool.
                                    </p>
                                </div>
                            </div>
                            <div class="wpb_text_column  vc_custom_1448356884044">
                                <div class="wpb_wrapper">
                                    <p style="text-align: left;">
                                        <input id="confirm" name="confirm" type="checkbox" value="confirm" class="not-empty">Yes, I accept these terms and verify that all data is accurate.</p>
                                    <p style="text-align: left;">
                                        <input id="ftp_folder" style="display: none;" name="ftp_folder" type="text" placeholder="Please Enter Path for FTP">
                                    </p>
                                </div>
                            </div>
                            <div class="g-cols wpb_row offset_default  vc_custom_1447857584057">
                                <div class="full-width controls_step"><span class="wpb_button align_left prev_step"><a href="" class="g-btn color_contrast outlined"><i class="fa fa-fa fa-arrow-circle-o-left"></i><span>Preview</span></a>
                                    </span>
                                    <span class="wpb_button align_right install_button "><a href="" class="g-btn color_green outlined"><i class="fa fa-fa fa-share"></i><span>Install </span></a>
                                    </span>
                                    <span class="wpb_button align_right loadToFTP"><a href="" class="g-btn color_green outlined"><i class="fa fa-fa fa-share"></i><span>Install </span></a>
                                    </span>
                                    <span class="wpb_button align_right download_button"><a href="" class="g-btn color_green outlined"><i class="fa fa-fa fa-download"></i><span>Download</span></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>