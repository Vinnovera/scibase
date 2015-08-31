<?php
global $wp_query;

if(is_page('news')) {
	$cat = 'news';
}

else if(is_page('events')) {
	$cat = 'events';
}

else{
	$cat = '';	
}

$news = new WP_query (
	array( 	
		'post_type' => 'post', 
		'post_status' => 'publish',
		'category_name' => $cat,
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
	if(in_category('events')) {
		echo '<h1>';
			echo $title;
		echo '</h1>';
		the_content();
	} else {
		echo '<h1>';
			echo '<a href="'.$permalink.'">';
				echo $title;
			echo '</a>';
		echo '</h1>';
		echo '<span class="date">';
			echo $date;
		echo '</span>';	
		the_excerpt();
		?>
		<a href="<?php echo $permalink ?>" class="readmore"><?php _e('Read more', 'scibase'); ?></a>
	<?php	
	}
	?>
</article>
<?php 
endwhile;
endif;
?>
<?php wp_reset_query(); ?>
