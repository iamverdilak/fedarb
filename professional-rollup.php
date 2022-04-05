<?php /* Template Name: Professionals Roll Up */ ?>

<?php get_header(); ?>

<?php 

// $enteredExpertise = $_GET[expertise];

?>

	<div style="margin-top: -170px;" id="main" class="m-all t-all d-all cf" role="main">
		<?php
		echo do_shortcode('[smartslider3 slider="7"]');
		?>
	</div>

	<div>

	<div id="content" class="fedarb-rollup content__content-span">

		<?php if (have_posts()) : while (have_posts()) : the_post();
		$thumb_id = get_post_thumbnail_id();
		$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
		$feat_img = $thumb_url_array[0];
		echo '<div class="article-header" style="background: unset;">'; ?>
			<!-- <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1> -->
			<div class="video-texture active_texture" style="opacity: 1;"></div>
		</div>
		<?php 
			endwhile;
			endif; 
			wp_reset_query();
		?>

		<div id="inner-content" class="content__content wrap cf">

			<div id="main" class="m-all t-all d-all cf" role="main">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<section class="entry-content cf" itemprop="articleBody">

						<?php include 'practiceareas.php'; ?>

						<?php if(get_field('sub-headline'))
						{
							echo '<h2 class="page-subtitle m-all t-all d-all" itemprop="subheadline">' . get_field('sub-headline') . '</h2>';
						} ?>
						<?php the_content(); ?>

						
						
						<?php
						$catname = $post->post_name;

					    $pros = new WP_Query(array(
					    	'post_type'		=>	'professionals',
					    	'posts_per_page'=>	-1,
					    	'meta_key'		=>	'last_name',
					    	'category_name'	=>	$catname,
					    	'order'			=>	'ASC',
					    	'orderby'		=>	'meta_value',
					    ));
						 
						
						if(is_page(42)) {
							$categories = get_categories( array(
								'parent'		=> 	7,
								'orderby'		=> 'description',
								'order'			=> 'ASC',
								'hierarchical'	=>	0,
								'hide_empty'	=>	1,
							) );
						} ?>
							
							<div id="filters">
							  <?php if(is_page(42)) {
								echo '<select id="expertise" name="expertise" class="filter" data-filter-group=".filter-category">';
									echo '<option data-filter="*">' . esc_attr(__('Expertise')) . '</option>';

									foreach ($categories as $category) {
									
									    $option = '<option data-filter=".'.$category->category_nicename.'"';
										$option .= '>';
										$option .= "&nbsp;&nbsp;";
										$option .= $category->cat_name;
										$option .= '</option>';
										echo $option;
										$subCategories =  get_categories( array(
									    'parent' => $category->cat_ID,
 										'orderby' => 'name',
										'order' => 'ASC',
										'hierarchical' => 0,
										'hide_empty' => 1,
										) );	
										foreach ($subCategories as $subCategory) {	
										$option = '<option data-filter=".'.$subCategory->category_nicename.'"';
										$option .= '>';
										$option .= "&nbsp;&nbsp;&nbsp;-";
										$option .= $subCategory->cat_name;
										$option .= '</option>';
										echo $option;
										}
									}
								echo '</select>';
							
							  }	
							
							  if (!is_page(214)) {
								$field_key = "field_5889561be20a4";
								$field = get_field_object($field_key);
								
								if( $field ) {
								    echo '<select class="filter" data-filter-group=".filter-location">';
								    	echo '<option data-filter="*">' . esc_attr(__('All Locations')) . '</option>';
								        foreach( $field['choices'] as $k => $v )
								        {
								            echo '<option data-filter=".' . $k . '">' . $v . '</option>';
								        }
								    echo '</select>';
								}
							  } 
								
								if (is_page(42)) {
								$field_key = "field_5c9e5d473765d";
								$field = get_field_object($field_key);
								
								if( $field ) {
								    echo '<select class="filter" data-filter-group=".filter-judges">';
								    	echo '<option data-filter="*">' . esc_attr(__('Select: Judge / Neutral')) . '</option>';
								        foreach( $field['choices'] as $n => $p )
								        {
								            echo '<option data-filter=".' . $n . '">' . $p . '</option>';
								        }
								    echo '</select>';
								}
							  } 
								
								?>
							</div>

						<?php
						if ( $pros->have_posts() ) {
							echo '<div class="panels-flex-div">';
							while ( $pros->have_posts() ) {
								$pros->the_post();
								
								$thumb_id = get_post_thumbnail_id();
								$feat_img = wp_get_attachment_image_src($thumb_id, 'profile-pic-square', true);
								$judgeneutrals = get_field('judge-neutral');
								$locations = get_field('location');
								?>
								<div class="individual-panel-div <?php foreach( $judgeneutrals as $judgeneutral ): 
											echo $judgeneutral['value'] . ' ';
										endforeach;
								
								foreach( $locations as $location ): 
											echo $location['value'] . ' ';
										endforeach;
									$postcats = get_the_category(); 
									$length = count($postcats); 
									$i = 1; 
									foreach((get_the_category()) as $postcategory) { 
										if($length == $i){ 
											$catString = $postcategory->category_nicename . ''; 
										} else { 
											$catString = $postcategory->category_nicename . ' '; 
										} echo $catString; 
										$i++; 
									}
									?>">
								<?php
								echo 	'<a target="_blank" href="' . get_permalink() . '">';
								echo 		'<img src="' . $feat_img[0] . '" alt="' . get_the_title() . '" class="profile-image" width="' . $feat_img[1] . '" height="' . $feat_img[2] . '">';
								echo		'<h3>' . get_the_title() . '</h3><!-- test -->';
								echo 	'</a>';
								echo '</div>';
							}
							echo '</div>';
							wp_reset_postdata();
						} 
						// $enteredExpertise = $_GET[expertise];
						// if (  ) {
							
						// }
						?>

						
						
					</section>

				<?php 
					endwhile;
					endif;
					wp_reset_query(); 
				?>

			</div>

		</div>

	</div>
	
	<?php // get_template_part( 'parts/brochure' ); ?>
	
	

	<!-- Emeritus Component  -->

<div id="emeritus-container" class="second-panel">
<div id="emeritus">
	<h2 id="emeritus-h2">Emeritus</h2>
	<div class="panels-flex-div">
		<div class="individual-panel-div">
			<a href="/professionals/judge-edward-cahn/">
			<img src="/wp-content/uploads/2015/04/Cahn-Fedarb.jpg" alt="judge-edward-cahn" class="profile-image emeritus" width="250px" height="auto" />
			<h3 class="emeritus">Judge Edward N. Cahn (Retired)<br><span style="color:#83603e;font-size:12px;">U.S. District Court, Eastern District of Pennsylvania</span></h3>
			</a>
		</div>
		<div class="individual-panel-div">
			<a href="/professionals/adr-neutral-barry-garfinkel/">
			<img src="/wp-content/uploads/2015/04/barry-garfinkel-photo-2.jpg" alt="Barry H. Garfinkel Esq" class="profile-image emeritus" width="250px" height="auto" />
			<h3 class="emeritus">Barry H. Garfinkel, Esq.<br><span style="color:#83603e;font-size:12px;">New York, New York</span></h3>
			</a>
		</div>
		<div class="individual-panel-div">
			<a href="/professionals/judge-bruce-kauffman/">
			<img src="/wp-content/uploads/2015/04/Kauffman-Fedarb.jpg" alt="judge-bruce-kauffman" class="profile-image emeritus" width="250px" height="auto" />
			<h3 class="emeritus">Judge Bruce W. Kauffman (Retired)<br><span style="color:#83603e;font-size:12px;">U.S. District Court, Eastern District of Pennsylvania</span></h3>
			</a>
		</div>
		<div class="individual-panel-div">
			<a href="/professionals/judge-stephen-limbaugh/">
			<img src="/wp-content/uploads/2015/04/Limbaugh-Fedarb.jpg" alt="judge-stephen-limbaugh" class="profile-image emeritus" width="250px" height="auto" />
			<h3 class="emeritus">Judge Stephen N. Limbaugh, Sr. (Former)<br><span style="color:#83603e;font-size:12px;">U.S. District Judge, Eastern and Western Districts of Missouri</span></h3>
			</a>
		</div>
		<div class="individual-panel-div">
			<a href="/professionals/judge-raymond-lyons/">
			<img src="/wp-content/uploads/2015/04/Lyons-Fedarb.jpg" alt="judge-raymond-lyons" class="profile-image emeritus" width="250px" height="auto" />
			<h3 class="emeritus">Judge Raymond T. Lyons (Retired)<br><span style="color:#83603e;font-size:12px;">U.S. Bankruptcy Court, New Jersey</span></h3>
			</a>
		</div>
		<div class="individual-panel-div">
			<a href="/professionals/frank-mcfadden/">
			<img src="/wp-content/uploads/2015/04/McFadden-Fedarb.jpg" alt="frank-mcfadden" class="profile-image emeritus" width="250px" height="auto" />
			<h3 class="emeritus">Judge Frank H. McFadden (Former)<br><span style="color:#83603e;font-size:12px;">U.S. District Judge, Northern District of Alabama</span></h3>
			</a>
		</div>
		<div class="individual-panel-div">
			<a href="/professionals/judge-alan-nevas/">
			<img src="/wp-content/uploads/2015/04/Nevas-Fedarb.jpg" alt="judge-alan-nevas" class="profile-image emeritus" width="250px" height="auto" />
			<h3 class="emeritus">Judge Alan H. Nevas (Retired)<br><span style="color:#83603e;font-size:12px;">U.S. District Court, Connecticut</span></h3>
			</a>
		</div>
		<div class="individual-panel-div">
			<a href="/professionals/judge-robert-oconor/">
			<img src="/wp-content/uploads/2015/04/oconor-fedarb.jpg" alt="judge-oconor" class="profile-image emeritus" width="250px" height="auto" />
			<h3 class="emeritus">Judge Robert J. O'Conor, Jr. (Former)<br><span style="color:#83603e;font-size:12px;">U.S. District Court, Southern District of Texas</span></h3>
			</a>
		</div>
		<div class="individual-panel-div">
			<a href="/professionals/judge-lee-sarokin/">
			<img src="/wp-content/uploads/2015/04/Sarokin-Fedarb.jpg" alt="judge-lee-sarokin" class="profile-image emeritus" width="250px" height="auto" />
			<h3 class="emeritus">Judge H. Lee Sarokin (Retired)<br><span style="color:#83603e;font-size:12px;">U.S. Court of Appeals, Third Circuit</span></h3>
			</a>
		</div>
		<div class="individual-panel-div">
			<a href="/professionals/chief-justice-e-norman-veasey-retired-de-supreme-court/">
			<img src="/wp-content/uploads/2015/04/Veasey-Fedarb.jpg" alt="chief-justice-e-norman-veasey-retired-de-supreme-court" class="profile-image emeritus" width="250px" height="auto" />
			<h3 class="emeritus">Chief Justice E. Norman Veasey (Retired)<br><span style="color:#83603e;font-size:12px;">Chief Justice Delaware Supreme Court</span></h3>
			</a>
		</div>
		<div class="individual-panel-div">
			<a href="/professionals/judge-william-webster/">
			<img src="/wp-content/uploads/2015/04/Webster-Fedarb.jpg" alt="judge-raymond-lyons" class="profile-image emeritus" width="250px" height="auto" />
			<h3 class="emeritus">Judge William H. Webster (Retired)<br><span style="color:#83603e;font-size:12px;">U.S. Court of Appeals, Eighth Circuit</span></h3>
			</a>
		</div>
	</div>
</div>
</div>
	
	<?php include 'globalfooter.php'; ?>

	<?php get_footer(); ?>

	<script type="text/javascript">
		(function($) {
			$(document).ready(function() {
				const urlParams = new URLSearchParams(window.location.search);
				const expertise = urlParams.get('expertise');
			
				//console.log('Expertise: ', expertise);
				//console.log('Exp Value 1: ', document.getElementById('expertise').value);

				var $grid = $('.panels-flex-div'),
				$select = $('#filters select');
				var selector = '*';
				filters = {};
			
				$grid.isotope({										
					itemSelector: '.panels-flex-div .individual-panel-div',
					percentPosition: true,
					layoutMode: 'fitRows',
					filter: function() {
					// var serRes = qsRegex ? $(this).text().match( qsRegex ) : true;
						var selRes = selector == '' || $(this).is(selector);
						//return serRes && selRes;
						return selRes;
					}
				});
		
		//run selection
		$select.ready(function() {
					var $this = $(this);
					// console.log('Exp Value 2: ', document.getElementById('expertise').value);
					if(expertise){
						$("#expertise").val(expertise);
		
					$("#emeritus-container").hide();

					var select = document.getElementById('expertise');
					
					// console.log(select.options);

					var option;

					for (var i=0; i<select.options.length; i++) {
						option = select.options[i];
						var $optionSet = $this;	
						var selectedOption = select.options[i];
						var expertiseStr = '.' + expertise;
						if (option.dataset.filter === expertiseStr) {
							// console.log('Option Data Filter: '+ i, option.dataset.filter);
							// console.log('Selected Option: ', selectedOption);
							option.setAttribute('selected', true);
							var $optionSet = option[i];
							
						} 
					}
				}  
	        var group = $optionSet.attr('data-filter-group');
			filters[group] = $this.find('option:selected').attr('data-filter');
			var isoFilters = [];
            for ( var prop in filters ) {
              if( filters[ prop ] != '*' ){
                isoFilters.push( filters[ prop ] )
              }
            }				        
	        selector = isoFilters.join('');
	
	        $grid.isotope({
	            filter: selector
	        });				        	
	        				
	        return false;
	    });
			
			})

		})(jQuery);
	</script>