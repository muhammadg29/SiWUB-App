<!--------- footer Section Start--------------->
<section class="footer wow  animate__animated animate__fadeIn" data-wow-duration="1000" data-wow-delay="500" data-wow-duration="1000" data-wow-delay="600">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12 col-12 mb-5">
                <img loading="lazy" src="<?php echo base_url('uploads/system/'.get_frontend_settings('light_logo')); ?>">
                <p><?php echo get_settings('website_description'); ?></p>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-4 mb-5">
                <h1><?php echo site_phrase('top_categories'); ?></h1>
                <ul>
                <?php $top_10_categories = $this->crud_model->get_top_categories(6, 'sub_category_id'); ?>
                <?php foreach($top_10_categories as $top_10_category): ?>
                  <?php $category_details = $this->crud_model->get_category_details_by_id($top_10_category['sub_category_id'])->row_array(); ?>
                    <li><a href="<?php echo site_url('home/courses?category='.$category_details['slug']); ?>"> <?php echo $category_details['name']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-4">
                <h1><?php echo site_phrase('useful_links'); ?></h1>
                <ul>
                    <li> <a href="<?php echo site_url('blog'); ?>"><?php echo site_phrase('blog'); ?></a></li>
                    <li><a href="<?php echo site_url('home/courses'); ?>"><?php echo site_phrase('all_courses'); ?></a></li>
                    <li><a href="<?php echo site_url('sign_up'); ?>"><?php echo site_phrase('sign_up'); ?></a></li>
                    <?php $custom_page_menus = $this->crud_model->get_custom_pages('', 'footer'); ?>
                    <?php foreach($custom_page_menus->result_array() as $custom_page_menu): ?>
                      <li><a href="<?php echo site_url('page/'.$custom_page_menu['page_url']); ?>"><?php echo $custom_page_menu['button_title']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-4">
                <h1><?php echo site_phrase('help'); ?></h1>
                <ul>
                    <li><a href="<?php echo site_url('home/contact_us'); ?>"><?php echo site_phrase('contact_us'); ?></a></li>
                    <li><a href="<?php echo site_url('home/about_us'); ?>"><?php echo site_phrase('about_us'); ?></a></li>
                    <li><a href="<?php echo site_url('home/privacy_policy'); ?>"><?php echo site_phrase('privacy_policy'); ?></a></li>
                    <li><a href="<?php echo site_url('home/terms_and_condition'); ?>"><?php echo site_phrase('terms_and_condition'); ?></a></li>
                    <li><a href="<?php echo site_url('home/faq'); ?>"><?php echo site_phrase('FAQ'); ?></a></li>
 
                </ul>
            </div>
        </div>
        <div class="lattest-news">
            <div class="row">                
                <div class="col-lg-8 col-md-6  col-sm-12 col-12">
                    <div class="icon right-icon">
                        <ul class="nav justify-content-end">
                          <li class="nav-item">
                            <a target="_blank" href="<?php echo get_settings('footer_link'); ?>">
                              <?php echo site_phrase(get_settings('footer_text')); ?>
                            </a>
                          </li>
                        </ul>
                    </div>  
                              
                </div>
            </div>
        </div>
    </div>
</section>
<!--------- footer Section End--------------->

<!-- PAYMENT MODAL -->
<!-- Modal -->
<?php
$paypal_info = json_decode(get_settings('paypal'), true);
$stripe_info = json_decode(get_settings('stripe_keys'), true);
if ($paypal_info[0]['active'] == 0) {
  $paypal_status = 'disabled';
}else {
  $paypal_status = '';
}
if ($stripe_info[0]['active'] == 0) {
  $stripe_status = 'disabled';
}else {
  $stripe_status = '';
}
?>


<script>
  $('document').ready(function(){
    new WOW().init();
  });
</script>