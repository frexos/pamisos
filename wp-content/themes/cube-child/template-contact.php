<?php
if(isset($_POST["um_name"]) && isset($_POST["um_email"]) && isset($_POST["um_message"])){

    $to_email = get_field("receiving_email");
    $subject = __("Email from : ","um_lang").$_POST["um_name"];
    $email = $_POST["um_email"];
    $name = $_POST["um_name"];
    $message = $_POST["um_message"]."

    E-mail : {$email},
    Name : {$name}
    ";
    wp_mail($to_email,$subject,$message);
    die;
}
/*Template Name:Contact*/
get_header();
?>

<div class="user-profile-top">
	<div class="container">
		<div class="row">
			<div class="span12 contact-title">
				<p><i class="icon-file-text-alt"></i><?php wp_title(""); ?></p>
			</div>
		</div>
	</div>
</div>
<div class="user-prof-content">
	<div class="container">
		<div class="row">
			<div class="span8 user-posts">
				<div class="category-row row one">
					<div class="span8 category">
						<h4 class="category-title"><span><?php _e("Find us on map","um_lang"); ?></span></h4>
                        <?php
                            $map = get_field("google_map");
                            $coordinates = explode(",",$map["coordinates"]);
                            $zoom = get_field("google_map_zoom_level") ? get_field("google_map_zoom_level") : 4;
                            if($coordinates):
                        ?>
                        <div id="map" data-zoom="<?php echo $zoom; ?>" data-title="<?php echo $map["address"]; ?>" data-lat="<?php echo $coordinates[0]; ?>" data-lang="<?php echo $coordinates[1]; ?>" style="width:100%; height:500px;"></div>
                        <?php endif; ?>
                        <?php if(get_field("receiving_email")): ?>
                        <div class="contact-form">
                        	<form action="<?php the_permalink(); ?>" method="post">
                        		<p class="contact-author">
                        			<label for="cont-auth"><?php _e("Name","um_lang"); ?>*</label>
                        			<input type="text" id="cont-auth" name="cont-auth" aria-required="true">
                        		</p>
                        		<p class="contact-email">
                        			<label for="cont-email"><?php _e("Email","um_lang"); ?>*</label>
                        			<input type="text" id="cont-email" name="cont-email" aria-required="true">
                        		</p>
                        		<p class="contact-message">
                        			<label for="cont-message"><?php _e("Message","um_lang"); ?>*</label>
                        			<textarea name="cont-message" id="cont-message" aria-required="true"></textarea>
                        		</p>
                        		<p class="contact-submit">
                        			<input type="submit" name="cont-submit" id="cont-submit" value="<?php _e("Send","um_lang"); ?>">
                        		</p>
                        	</form>
                        	<div class="success-message">
                        		<h1><?php the_field("success_message"); ?></h1>
                        	</div>
                        	<div class="contact-text">
                        		<?php the_field("contact_form_additional_content"); ?>
                        	</div>
                        </div>
                        <?php endif; ?>
					</div>
				</div>
			</div>
			<div class="span4 user-sidebar">
				<div class="about-widget">
					<h5 class="widget-title"><span><?php _e("About","um_lang"); ?></span></h5>
					<div class="about-user-cont">
						<?php
                            setup_postdata($post);
                            the_content();
                        ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>