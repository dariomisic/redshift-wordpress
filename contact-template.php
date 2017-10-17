<?php
/**
 * Template name: Contact Page
 * 
 * @package redshift
 */


  //response generation function

  $response = "";


  //function to generate response
  function my_contact_form_generate_response($type, $message){

    global $response;

    if($type == "success") $response = '<div class="success" style="border: 1px solid #404040; padding:10px; margin-bottom:15px;">'.$message.'</div>';
    else $response = '<div class="error" style="border: 1px solid #404040; padding:10px; margin-bottom:15px;">'.$message.'</div>';

  }
if(isset($_POST['message_name']))
{ //response messages
  $not_human       = "Human verification incorrect.";
  $missing_content = "Please supply all information.";
  $email_invalid   = "Email Address Invalid.";
  $message_unsent  = ot_get_option('mail_unsent');
  $message_sent    = ot_get_option('mail_sent');;

  //user posted variables
  $name = $_POST['message_name'];
  $email = $_POST['message_email'];
  $message = $_POST['message_text'];
  $human = $_POST['message_human'];

  //php mailer variables
  $to = ot_get_option('recepient_mail');
  $subject = ot_get_option('subject_mail');
  $headers = 'From: '. $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n";

  if(!$human == 0){
    if($human != 2) my_contact_form_generate_response("error", $not_human); //not human!
    else {

      //validate email
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        my_contact_form_generate_response("error", $email_invalid);
      else //email is valid
      {
        //validate presence of name and message
        if(empty($name) || empty($message)){
          my_contact_form_generate_response("error", $missing_content);
        }
        else //ready to go!
        {
          $sent = wp_mail($to, $subject, strip_tags($message), $headers);
          if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
          else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
        }
      }
    }
  }
  else if ($_POST['submitted']) my_contact_form_generate_response("error", $missing_content);

}
else
{

  $_POST['message_name']='';
  $_POST['message_email']='';
  $_POST['message_text']='';
  $_POST['message_human']='';
}

get_header('page'); ?>

<div class="page-red" style="height:100px; width:100%; z-index: 1000; background-color:#f4543c; position:relative; top:0; text-align:center; margin-top: 20px; border-bottom:"><h5 class="page-title"><?php the_title(); ?></h5>

<div style="position: absolute;   top: -99px;    left: 0;    right:0;    z-index: 1000;    pointer-events:none;">
<svg class="chevron-red" style="fill:#f4543c; position:relative; left:0;" fill-opacity="1" height="100px" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" width="30%" xmlns="http://www.w3.org/2000/svg">
  <path d="m0,100l50,-50l50,50l-100,0" stroke-width="0"></path>
</svg>
</div> <!-- svg red image -->


<div style="position: absolute;   bottom:-6px;    left: 0;    right:0;    z-index: 1000;    pointer-events:none;">
<svg style="fill:#fff; position:relative; left:0;" fill-opacity="1" height="100px" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" width="30%" xmlns="http://www.w3.org/2000/svg">
  <path d="m0,100l50,-50l50,50l-100,0" stroke-width="0"></path>
</svg>
</div> <!-- svg white image -->

</div> <!-- .page-title -->

<div id="map-canvas" style="width:100%; height:350px; margin-top:35px;"></div> <!-- google map --> 

	<?php while ( have_posts() ) : the_post(); ?>


		<?php get_template_part( 'content', 'page' ); ?>
	

	<?php endwhile; // end of the loop. ?>

<div class="container" style="margin-bottom:100px;">

<div class="row" style="margin-bottom:40px;">
<div class="col-md-12 col-sm-12 col-lg-12">
<div class="center wow fadeInDown">
                <h1><?php echo ot_get_option('contacttitle'); ?></h1>
<div class="divider"></div>
                    <h3><?php echo ot_get_option('contactdescription'); ?></h3>
</div>
</div> <!-- .col-md-12 .col-sm-12 .col-lg-12 -->
</div> <!-- .row -->

<div class="row">
<div class="col-md-12 col-xs-12 col-sm-12 wow fadeIn">




<div class="col-md-8 col-xs-12 col-sm-8">
  <?php echo $response; ?>
  <form action="<?php the_permalink(); ?>" method="post">
    <div class="form-group"><label for="name">Name:</label><input class="form-control" type="text" name="message_name" style="width:100%;"value="<?php echo esc_attr($_POST['message_name']); ?>"></div>
    <div class="form-group"><label for="message_email">Email:</label><input class="form-control" type="text" name="message_email" value="<?php echo esc_attr($_POST['message_email']); ?>"></div>
    <div class="form-group"><label for="message_text">Message:</label><textarea class="form-control" rows="10" type="text" name="message_text"><?php echo esc_textarea($_POST['message_text']); ?></textarea></div>
    <div class="form-group"><label for="message_human">Human Verification:</label><input class="form-control" style="margin:15px; width:50px;" type="text" style="width: 60px;" name="message_human"> + 3 = 5</label></div>
    <input type="hidden" name="submitted" value="1">
    <button class="form-control btn btn-default wpcf7-submit" style="width:100px;" type="submit">Send</button>
  </form>




</div> <!-- .col-md-8 .col-xs-12 .col-sm-6 -->
 <div class="col-md-4 col-xs-12 col-sm-4 contact-details scrollpoint sp-effect2" style="margin-top:40px;">
                                
                                <div class="media wow fadeIn">
                                 <i class="team-map pull-left" style="margin-left:10px;"></i>
                                    <div class="media-body">
                                        <h4 class="media-heading"><?php echo ot_get_option('address'); ?></h4>
                                    </div>
                                </div> <!-- content for contact informations -->

                                 <div class="media">
                                    <i class="team-mail2 pull-left" style="margin-left:10px;"></i>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="mailto:<?php echo ot_get_option('email'); ?>"><?php echo ot_get_option('email'); ?></a></h4>
                                        
                                    </div> <!-- content for contact informations -->
                                </div>
                                <div class="media">
                                    <i class="team-phone pull-left" style="margin-left:10px;"></i>
                                    <div class="media-body">
                                        <h4 class="media-heading"><?php echo ot_get_option('phone'); ?></h4>
                                    </div>
                                </div> <!-- content for contact informations -->
                          

</div> <!-- col-md-4 col-sm-12 col-lg-3 -->
</div> <!-- .row -->
</div> <!-- .container -->


    <script type="text/javascript">
      function initialize() {

       var geocoder = new google.maps.Geocoder();


        var mapOptions = {
          center: { lat: -34.397, lng: 150.644},
          zoom: <?php echo ot_get_option('zoom'); ?> ,
          styles: [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);


    var address = '<?php echo ot_get_option('googlemap'); ?>';
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
      } else {
        alert("Can't find the address, please check theme options: " + status);
      }
    });

      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script> <!-- goole map -->


<?php get_footer(); ?>