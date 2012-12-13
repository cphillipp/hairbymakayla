<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.','spatreats'); ?></p>
<?php  return;
	endif;?>
<h2 class="title"> <span><?php comments_number(__('No Comments','spatreats'), __('1 Comment','spatreats'), __('% Comments','spatreats') );?> </span> </h2>

<?php if ( have_comments() ) : ?>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
                <div class="navigation">
                    <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'spatreats' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'spatreats' ) ); ?></div>
                </div> <!-- .navigation -->
    <?php endif; // check for comment navigation ?>
    
    <div class="column two-third">
        <ul class="commentlist">
            <?php wp_list_comments( array( 'callback' => 'my_customComments' ) ); ?>
        </ul>
    </div><!-- .two-third -->    

<?php else: ?>
	<?php if ( ! comments_open() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.','spatreats' ); ?></p>
    <?php endif;?>    
<?php endif; ?>

<!-- Comment Form -->
	<?php if ('open' == $post->comment_status) : ?>
	 <div class="column one-third last">
      <?php  $comments_args = array(
				'title_reply' => __('Reply','spatreats')
				,'fields'=>array(
							'author'=>'<p><input id="author" name="author" type="text"  value="'.__('Name','spatreats').'" class="placeholder" title="'.__('Name','spatreats').'" /></p>'
							,'email'=>'<p><input id="email" name="email" type="text" value="'.__('Email','spatreats').'" class="placeholder" title="'.__('Email','spatreats').'" /></p>')
				,'comment_notes_before'=>''
				,'comment_notes_after'=>''
				,'comment_field'=>'<p><textarea id="comment" name="comment" class="placeholder" title="'.__('Comment','spatreats').'" rows="7" cols="20">'.__('Comment','spatreats').'</textarea></p>'
				,'label_submit'=>__('comment','spatreats'));
	  	comment_form($comments_args);?>
      </div>      
	<?php endif; ?>