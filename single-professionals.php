<?php /* ** PROFESSIONALS TEMPLATE ** */ ?>

<?php get_header(); ?>

	<div style="margin-top: -170px;" id="main" class="m-all t-all d-all cf" role="main">
		<?php
		echo do_shortcode('[smartslider3 slider="6"]');
		?>
	</div>

	<div id="content" class="content__content-span">
		<!-- <div class="article-header content__professionals">
			<?php //if ( in_category('federal-judges') ) {
				//echo '<h2 class="page-title h1" itemprop="headline">Federal Judges</h2>';
			//} elseif ( in_category('state-judges') ) {
			//	echo '<h2 class="page-title h1" itemprop="headline">State Judges</h2>';
			//} elseif ( in_category('commercial-neutrals') ) {
			//	echo '<h2 class="page-title h1" itemprop="headline">Commercial Neutrals</h2>';
			//} elseif ( in_category('specialized-panels') ) {
			//	echo '<h2 class="page-title h1" itemprop="headline">Specialized Panels</h2>';
			//} else {
			//	echo '<h2 class="page-title h1" itemprop="headline">Professional</h2>';
			//} ?>
			<div class="video-texture active_texture" style="opacity: 1;"></div>
		</div> -->

		<div id="inner-content" class="content__content wrap cf">

			<div id="main" class="m-all t-all d-all cf" role="main">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<section class="entry-content cf" itemprop="articleBody">

						<?php include 'practiceareas.php'; ?>
						<div style="margin-top: 75px;">
						<?php $thumb_id = get_post_thumbnail_id();
						$feat_img = wp_get_attachment_image_src($thumb_id, 'profile-pic', true);

						echo 	'<img src="' . $feat_img[0] . '" alt="' . get_the_title() . '" style="max-width: 300px;" class="profile-image m-all t-1of3 d-1of4 last" width="' . $feat_img[1] . '" height="' . $feat_img[2] . '">'; ?>
						
							<div class="content__pro-content m-all t-2of3 d-3of4 cf">
								<h1><?php the_title(); ?></h1>
								<?php if(get_field('professional_title'))
								{
								echo '<h2 class="professional-title" itemprop="subheadline">' . get_field('professional_title') . '</h2>';
								}
								if(get_field('contact_email'))
								{
								echo '<a class="professional-contact" href="mailto:' . get_field('contact_email') . '"><i class="fa fa-envelope-o" aria-hidden="true"></i> ' . get_field('contact_email') . '</a>';
								}
								if(get_field('quick_bio')) {
								echo '<div class="pro-content__quick-bio">';
									the_field('quick_bio');
								echo '</div>';
								}
								echo '<div class="pro-content__content">';
									the_content();
								echo '</div>'; ?>
							</div>
						</div>
						
						<?php 
						if(get_field('download_bio')) {
							echo '<a href="' . get_field( 'download_bio' ) . '" class="content__download-bio brown-btn-outline m-all t-1of3 d-1of4" target="_blank"><i class="fa fa-file-pdf-o"></i> Download Bio</a>';
						}
						
						$categories = get_the_category($post->ID);
						if(have_rows('courts') || $categories) {
						echo '<div class="content__pro-sidebar m-all t-1of3 d-1of4">';
							if(have_rows('courts')):
								echo '<h2>Judicial Service</h2>';
								echo '<ul class="pro-sidebar__links">';
								while(have_rows('courts')):the_row();
									echo '<li>' . get_sub_field('court_name') . '</li>';
								endwhile;
								echo '</ul>';
								$hasCourts = true;
							endif;
							
							//if($hasCourts && $categories) {
							if($hasCourts) {
							echo '<hr>';
							}
							
							if(have_rows('specific_locations')):
								echo '<h2>Location</h2>';
								echo '<ul class="pro-sidebar__locations">';
								while(have_rows('specific_locations')):the_row();
									echo '<li>' . get_sub_field('city_state_location') . '</li>';
								endwhile;
								echo '</ul>';
								$hasLocation = true;
							endif;
							
							//$locations = get_field('location');
							//if( $locations ):
							//	echo '<h2>Location</h2>';
							//	echo '<ul class="pro-sidebar__locations">';
							//		foreach( $locations as $location ):
							//			echo '<li>' . $location['label'] . '</li>';
							//		endforeach;
							//	echo '</ul>';
							//	$hasLocation = true;
							//endif;
							
							if($hasLocation) {
							echo '<hr>';
							}
							
							if($categories){
								echo '<h2>Expertise</h2>';
								echo '<ul class="pro-sidebar__links">';
								
								$postCats = get_the_category();
								if($postCats){
									foreach($postCats as $postcategory) {
										if (
											$postcategory->slug !=='federal-judges' && 
											$postcategory->slug !=='state-judges' && 
											$postcategory->slug !=='commercial-neutrals' &&
											$postcategory->slug !=='specialized-panels' 
										) {
											$catString .= '<li>'.$postcategory->name.'</li>';
											$subCategories =  get_categories( array(
											'parent' => $postcategory->cat_ID,
											'orderby' => 'name',
											'order' => 'ASC',
											'hierarchical' => 0,
											'hide_empty' => 1,
											) );	
											foreach ($subCategories as $subCategory) {	
											$catString .='<li style="margin-left:25px">'; //fixed it
											$catString .= $subCategory->cat_name;
											$catString .= '</li>';
											}
										}
									}
									echo $catString;
								}
							}
						echo '</div>';
						} ?>
					</section>

				<?php 
					endwhile;
					endif;
					wp_reset_query(); 
				?>

			</div>

		</div>

	</div>
	
	<?php //get_template_part( 'parts/brochure' ); ?>

			<?php include 'globalfooter.php'; ?>
	

	<?php get_footer(); ?>


