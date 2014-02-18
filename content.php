<?php
/**
 * @package Prologue
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class() ?>>
	<header class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<ul class="inline-list">
				<?php Prologue_posted_on(); ?>
				<li><?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ', ', 'Prologue' ) );
					if ( $categories_list && Prologue_categorized_blog() ) :
					?></li>
				<li><span class="cat-links">
				<?php printf( __( '<i class="icon fa fa-folder-open"></i> %1$s', 'Prologue' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'Prologue' ) );
				if ( $tags_list ) :
			?>
				<li>
			<span class="tags-links">
				<?php printf( __( '<i class="icon fa fa-tag"></i> %1$s', 'Prologue' ), $tags_list ); ?>
			</span>
				</li>
			<?php endif; // End if $tags_list ?>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<li><span class="comments-link"><i class="icon fa fa-comment"></i> <?php comments_popup_link( __( 'Leave a comment', 'Prologue' ), __( '1 Comment', 'Prologue' ), __( '% Comments', 'Prologue' ) ); ?></span></li>
		<?php endif; ?>
		</ul>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php if ( has_post_thumbnail()) : ?>
   			<a href="<?php the_permalink(); ?>" class="th left" title="<?php the_title_attribute(); ?>" >
   				<?php the_post_thumbnail(); ?>
   			</a>
 		<?php endif; ?>
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'Prologue' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'Prologue' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">

		<?php edit_post_link( __( 'Edit', 'Prologue' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
