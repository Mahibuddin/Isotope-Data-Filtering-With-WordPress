<?php


//  Shortcode for Custom Post

add_shortcode('portfolio_q', 'carrer_shortcode_query');
function carrer_shortcode_query($atts, $content){ ?>

	 <div class="section-padding">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	                <ul class="project-title">
	                    <li class="active" data-filter="*">All</li>
						
						<?php 
					
							$port_terms = get_terms('cptcategory');
							
							if (!empty($port_terms)) : foreach ($port_terms as $p_term ) :
							?>
							<li data-filter=".<?php echo esc_attr($p_term->slug); ?>"><?php echo esc_attr($p_term->name); ?></li>
							<?php
							endforeach; endif;
						?>
	                </ul>
	                    <div class="row project-list">
						<?php
							$portfolio_post= new WP_Query(array(
								'post_type'=>'portfolio',
								'taxonomy'=>'cptcategory',
								'order'=>'DESC',
								'posts_per_page'=>6,
							));

							if($portfolio_post->have_posts()) : while($portfolio_post->have_posts()) : $portfolio_post->the_post(); 
							
						?>

	                    <div class="col-md-4 	                    
						<?php
							$portfolio_items = get_the_terms(get_the_ID(), 'cptcategory');
								foreach ($portfolio_items as $portfolio_item){
								echo $portfolio_item->slug.' ';
							}
						?>
	                    ">
							
		                    	<?php
				            		global $post;
				            		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
									$thumb[0];
				            	?>
		                        <div class="project-img" style="background: url('<?php echo $thumb['0'] ; ?>')">
		                        </div>
                                <div class="project-img-info">
                                	<div class="project-entry-info">
		                        		<a href="<?php echo get_post_meta( $post->ID, 'link', true ); ?>">
											<h2 class="test-title"><?php the_title(); ?></h2>
										</a>
		                     
						      			<?php echo get_the_term_list(get_the_ID(), 'cptcategory', '', ', ', ''); ?> 
                                	</div>
	                    		</div>
	                    	</div>

	                    <?php endwhile; endif;?>
                    </div>
	            </div>
	        </div>
	    </div>
	</div>
<?php
	    wp_reset_postdata(); 
}