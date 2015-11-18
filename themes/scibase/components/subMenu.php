<?php

//Thanks to ESMI at http://wordpress.org/support/topic/how-to-show-grandchildren-when-on-a-grandchild-page-1

function my_page_tree($this_page) {
	$pagelist = '';
	if( !$this_page->post_parent ) {
		$children = wp_list_pages('title_li=&child_of='.$this_page->ID.'&echo=0');
		if( $children ) {
			$pagelist .= '<li class="current_page_item"><a href="'.  get_page_link($this_page->ID) .'">' . $this_page->post_title . '</a>';
			$pagelist .= '<ul>' . $children . '</ul>';
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
<?php echo my_page_tree($post);?>
</ul>
<?php endif;?>
