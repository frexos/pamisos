<?php
$this_user = wp_get_current_user();
if(!$this_user->ID){
    wp_die(__("You don't have permission's on this page."));
}
/*Update User*/
if(isset($_POST["save-edit"])){
    if($_POST["password-edit"]){
        wp_update_user( array ( 'ID' => $this_user->ID , 'user_pass' => $_POST["password-edit"] ) ) ;
    }
    if($_POST["edit-about"]){
        wp_update_user( array ( 'ID' => $this_user->ID , 'description' => $_POST["edit-about"] ) ) ;
    }
    if(isset($_FILES["avatar-edit"])){

        $temp = explode(".", $_FILES["avatar-edit"]["name"]);
        $temp = end($temp);
        $filename = "avatarimg_user".$this_user->ID.".".$temp;

        $target_path = "wp-content/uploads/";
        $target_path =  $target_path.basename($filename);

        if(move_uploaded_file($_FILES['avatar-edit']['tmp_name'], $target_path)){
            $filename = $target_path;
            $wp_filetype = wp_check_filetype(basename($filename), null );
            $wp_upload_dir = wp_upload_dir();
            $attachment = array(
                'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ),
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                'post_content' => '',
                'post_status' => 'inherit'
            );
            $attach_id = wp_insert_attachment( $attachment, $filename);
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
            wp_update_attachment_metadata( $attach_id, $attach_data );

            update_user_meta($this_user->ID,"_author_image","field_51d2eb48a316e");
            update_user_meta($this_user->ID,"author_image",$attach_id);
        }
    }
    if($_POST["email-edit"]){
        //wp_update_user( array ( 'ID' => $this_user->ID , 'description' => $_POST["edit-about"] ) ) ;
        $some_user = get_user_by("email",$_POST["email-edit"]);
        if($some_user && ($some_user->ID != $this_user->ID) ){
            wp_die(__("This e-mail is already in use, please use another one.","um_lang")." <a href='".site_url()."/".$GLOBALS["um_profile"]."/".$GLOBALS["um_edit"]."'>".__("Back","um_lang")."</a>");
        }else{
            wp_update_user( array ( 'ID' => $this_user->ID , 'user_email' => $_POST["email-edit"] ) ) ;
        }
    }
    wp_redirect(site_url()."/".$GLOBALS["um_profile"]);
    die(__("Saving Data...","um_lang"));
}
/*Update User*/
?>
<?php get_header(); ?>
<div class="user-profile-top usr-prof">
	<div class="container">
        <div class="row">
            <div class="span4 user-pic">
                <?php if(get_field("author_image","user_".$this_user->ID)): $image = get_field("author_image","user_".$this_user->ID); ?>
                    <img src="<?php  echo $image["sizes"]["thumbnail"]; ?>" alt=""/>
                <?php endif; ?>
                <h4><?php echo $this_user->data->display_name; ?></h4>
                <p class="nr-of-posts"><?php echo count_user_posts($this_user->ID)." ".__("posts","um_lang"); ?></p>
            </div>
            <?php if($this_user->ID): ?>
                <div class="span8 edit-prof-page">
                    <a href="<?php echo site_url()."/".$GLOBALS["um_profile"]; ?>" class="my-posts"><?php _e("My Posts","um_lang"); ?></a>
                    <a href="<?php echo site_url()."/".$GLOBALS["um_profile"]."/".$GLOBALS["um_edit"]; ?>" class="edit-prof"><?php _e("Edit profile","um_lang"); ?></a>
                </div>
            <?php endif; ?>
        </div>
	</div>
</div>

<div class="user-edit-dialog">
	<div class="container">
		<div class="row">
			<div class="edit-dialog">
				<h5 class="dialog-title"><span><?php _e("Edit Profile","um_lang"); ?></span></h5>
				<form action="" class="edit-profile" method="post" enctype="multipart/form-data">
					<p>
						<label for="name-edit"><?php _e("Username","um_lang"); ?></label>
						<input type="text" id="name-edit" name="name-edit" readonly="readonly" value="<?php the_author_meta("user_login",$this_user->ID); ?>">
					</p>
					<p>
						<label for="password-edit"><?php _e("Password","um_lang"); ?></label>
						<input type="password" id="password-edit" name="password-edit">
					</p>
					<p>
						<label for="email-edit"><?php _e("Email","um_lang"); ?></label>
						<input type="email" id="email-edit" name="email-edit" placeholder="<?php the_author_meta("user_email",$this_user->ID); ?>">
					</p>
					<p>
						<label for="avatar-edit"><?php _e("Avatar","um_lang"); ?></label>
						<input type="file" id="avatar-edit" name="avatar-edit">
					</p>
					<p>
						<label for="edit-about"><?php _e("About","um_lang"); ?></label>
						<textarea name="edit-about" id="edit-about"><?php the_author_meta("description",$this_user->ID); ?></textarea>
					</p>
					<p>
						<input type="submit" id="save-edit" name="save-edit" value="Save">
					</p>
				</form>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>