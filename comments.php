<?php
/**
 * The template for displaying Comments.
 */
?>

<div id="comments">

	<?php if ( post_password_required() ) : ?>
        <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', TXTDOMAIN ); ?></p>
        </div><!-- #comments -->
        <?php
        /* Stop the rest of comments.php from being processed, but don't kill the script entirely -- we still have to fully load the template. */
        return;
    endif; ?>
    
	<div class="replySection">
		<?php
        $fields =  array(
            'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Uw naam:' ) . ( $req ? ' *' : '' ) . '</label> ' . 
                        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
            'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Uw e-mailadres:' ) . ( $req ? ' *' : '' ) . '</label> ' .
                        '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
        ); 
        $comment_field = '<p class="comment-form-comment"><label for="comment">' . _x( 'Uw reactie: *', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
        $args = array(
            'comment_notes_after' => '',
            'fields' => $fields,
            'title_reply' => __( 'Reageren' ),
            'comment_field' => $comment_field,
            'label_submit' => __( 'Plaats reactie' ), 
            'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( '<label>Ingelogd als:</label> %1$s.' ), $user_identity ) . '</p>',
        ); ?>
        <?php comment_form($args); ?>
    </div>
	<?php if ( have_comments() ) : ?>
    	
    
        <div class="commentsSection">
        	<h2>
        	<?php
                printf( _n( 'Eén reactie op %2$s', '%1$s Reacties op %2$s', get_comments_number(), TXTDOMAIN ),
                number_format_i18n( get_comments_number() ), '"' . get_the_title() . '"' );
            ?>
            </h2>
            <?php
                /* Loop through and list the comments. */
                wp_list_comments( array( 'callback' => 'koffietijd_comment' ) );
            ?>
        </div>
    
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <div class="navigation">
            		<?php //the comments are reverse due to a plugin, so let's alter this a bit :) ?>
                    <?php next_comments_link( __( '<span class="meta-nav">&lt;</span> Oudere reacties', TXTDOMAIN ) ); ?>
                    <?php previous_comments_link( __( 'Nieuwere reacties <span class="meta-nav">&gt;</span> ', TXTDOMAIN ) ); ?>   
            </div><!-- .navigation -->
        <?php endif; // check for comment navigation ?>
        <?php else : // or, if we don't have comments: If there are no comments and comments are closed, let's leave a little note, shall we? */
            if ( ! comments_open() ) :
                ?>    
                <p class="nocomments"><?php _e( 'Het is niet meer mogelijk om te reageren.', TXTDOMAIN ); ?></p>
        <?php endif; // end ! comments_open() ?>
    <?php endif; // end have_comments() ?>
</div><!-- #comments --> 

