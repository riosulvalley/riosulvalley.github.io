<?php // Check if password protected
    if ( post_password_required() ) return;
?>

<?php $comments_by_type = separate_comments( $comments ); ?>

<?php if ( !empty( $comments_by_type['comment'] ) ) : ?>

	<!--Comments Section-->
	<div class="entry-comments full-width" id="comments">
    
		<h3><?php comments_number( __( '0 Comments', 'mighty' ), __( '1 Comment', 'mighty' ), __( '% Comments', 'mighty' ) ); ?></h3>  

        <?php if ( ! comments_open() && '0' != get_comments_number() ) : ?>

			<p class="comments-closed"><?php _e( 'Comments are closed.', 'mighty' ) ?></p>

		<?php else : ?>

        	<ol class="comment-list">
            	<?php wp_list_comments( 'type=comment&callback=mighty_comment' ); ?>
        	</ol>

            <?php paginate_comments_links() ?>

    	<?php endif; ?>	    	
	</div>

<?php elseif ( ! comments_open() && ! is_page() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
    
    <p><?php _e( 'Comments are closed.', 'mighty' ) ?></p>
    
<?php endif; ?>


<?php if ( comments_open() ) : ?>
    
	<!--Leave Response-->
	<?php
        $fields = array(
            'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
            'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'mighty' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
            'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out</a>', 'mighty' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
            'title_reply'          => __( 'Leave a reply', 'mighty' ),
            'title_reply_to'       => __( 'Leave a reply to %s', 'mighty' ),
            'cancel_reply_link'    => __( 'Cancel reply', 'mighty' ),
            'label_submit'         => __( 'Submit Comment', 'mighty' )
        );
    ?>
    		    	
    <?php comment_form( $fields ); ?>
    
<?php endif; ?>
