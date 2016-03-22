<?php

/**

 * The template for displaying the footer

 *

 * Contains the closing of the #content div and all content after

 *

 * @package WordPress

 * @subpackage Twenty_Sixteen

 * @since Twenty Sixteen 1.0

 */

?>

                </div>

            </main>

            <footer>

                <div class="container container-light container-footer">

                    <div class="row">

                        <div class="large-4 columns">

                            <div class="box-contact">

                                <h6 class="title">READY TO GROW YOUR BUSINESS?</h6>

                                <ul class="no-bullet">

                                    <li><b>Ange Dove</b> </li>
<li>45A Kampong Bahru Road<br> Singapore 169360<br></li>

                                    <li><strong>Telephone:</strong> +65 6333 4138</li>

                                    <!--li><strong>Website:</strong> <a href="www.proofperfect.com.sg">www.proofperfect.com.sg</a></li-->

                                </ul>

                            </div>

                        </div>

                        <div class="large-8 columns">

                            <ul class="no-bullet menu menu-footer horizontal">

                                <?php wp_list_pages(

                                    array('title_li' => '', 'sort_column' => 'menu_order' , 'exclude' => '10,51,70' )

                                );

                                ?>

                            </ul>

                        </div>

                    </div>

                </div>

            </footer>

        </div>

    </div>

</div> 





<div class="form-contact form-enquiry reveal" id="form-modal" data-reveal>

    <h2 class="title sub-title text-upper">MAKE AN ENQUIRY</h2>

    <div class="line-division"></div>

    <button class="close-button" data-close aria-label="Close modal" type="button">&times;</button>

    <?php echo do_shortcode('[contact-form-7 id="49" title="Contact form 1"]'); ?>

</div>



<?php wp_footer(); ?>

</body>

</html>

