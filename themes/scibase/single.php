<?php get_header(); ?>

<div class="main">
	<div class="body">
		<div class="gw">
			
			<article class="g three-quarters post-list">
			<div class="box">
				<?php if (have_posts()) : ?>
				<?php while (have_posts() ) : the_post();  ?>
				<?php
				$title = get_the_title();			
				$permalink = get_permalink($post->ID);
				$category = get_the_category($post->ID);
				$category = $category[0]->slug;
				$id = get_the_ID();
				$date = get_the_date('d F Y H:i');
				
				$media =  get_post_meta($post->ID,'enclosure', true);
				$media = preg_split('/\s+/', $media);
				$media_title = get_post_meta($post->ID,'media_title', true);
				if (!$media_title) {
					$media_title = basename($media[0]);
				}

				$media_link = '<a class="download" href="'.$media[0].'" target="_blank" title="'.$media_title.'">'.$media_title.'</a>';

				?>
				<article class="post">
					<?php
					echo '<h1>';
						echo $title;
					echo '</h1>';
					if ($category !== 'events') {
					echo '<span class="date">';
						echo $date;
					echo '</span>';
					}


					?>
					<?php the_content(); ?>
				</article>
				<?php 
				if ($media[0]) {
					echo '<h3>Downloads</h3>';
					echo '<ul class="link-list">';
					echo '<li class="file">'.$media_link.'</li>';
					echo '</ul>';
				}
				 ?>
				<?php 
				endwhile;
				endif;
				?>
			</div>
		</article>
			<nav class="g one-quarter side-menu">
				<div class="box">
				<?php
				//Thanks to ESMI at http://wordpress.org/support/topic/how-to-show-grandchildren-when-on-a-grandchild-page-1
				
				function my_page_tree($this_page) {
					$pagelist = '';
					$postid = get_the_ID(55);
					$news_title = get_the_title(55);
					$events_title = get_the_title(359);
					if( !$this_page->post_parent ) {
						$children = wp_list_pages('title_li=&child_of=55&echo=0');
						if( $children ) {
							if(in_category('news')) {
								$pagelist .= '<li class="current_page_item"><a href="'.  get_page_link(55) .'">' . $news_title . '</a>';
							}
							else if(in_category('events')) {
								$pagelist .= '<li><a href="'.  get_page_link(55) .'">' . $news_title . '</a>';	
							}
							else{
								
							}
							if(in_category('events')) {
								$pagelist .= '<ul class="events-sub">' . $children . '</ul>';
							}
							else {
								$pagelist .= '<ul>' . $children . '</ul>';	
							}
							$pagelist .= '</li>';
						}
					}
					elseif( $this_page->ancestors ) {
						// get the top ID of this page. Page ids DESC so top level ID is the last one
						$ancestor = end($this_page->ancestors);
						$pagelist .= wp_list_pages('title_li=&include='.$ancestor.'&echo=0');
						$pagelist = str_replace('</li>', '', $pagelist);
						$pagelist .= '<ul>' . wp_list_pages('title_li=&child_of='.$ancestor.'&echo=0') .'</ul></li>';
					}
					return $pagelist;
				}
				
				
				if( function_exists( 'my_page_tree') && my_page_tree($post) != '' ) :?>
				<ul>
				<?php echo my_page_tree($post);?></ul>
				<?php endif;?>
				</div>
			</nav>
			
			
		</div>
	</div>
</div>

<?php get_footer(); ?>
