<?php
global $wp_query;
$news = new WP_query ( 
	array( 	
		'post_type' => 'post', 
		'post_status' => 'publish',
		'category_name' => 'careers',
		'orderby' => 'date',
		'posts_per_page' => '-1',
		'order' => 'DESC'
	)
);
query_posts($news);
?>
<?php if (have_posts()) : ?>
<?php while ( $news->have_posts() ) : $news->the_post();  ?>
<?php
$title = get_the_title();			
$permalink = get_permalink($post->ID);
$category = get_the_category($post->ID);
$id = get_the_ID();
$date = get_the_date('d F Y H:i');
?>
<article class="post">
	<?php
	echo '<h1>';
		echo '<a href="'.$permalink.'">';
			echo $title;
		echo '</a>';
	echo '</h1>';
	echo '<span class="date">';
		echo $date;
	echo '</span>';
	?>
	<?php the_content(); ?>
</article>
<?php 
endwhile;
endif;
?>
<?php wp_reset_query(); ?>
