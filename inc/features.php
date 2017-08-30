<?php

add_action( 'bhari_entry_header_before', function() {
	?>
	<style type="text/css">
		.social-shares h3 {
			font-size: 1rem;
		    margin-bottom: 0.5em;
		}
		.social-shares ul {
			display: inline-block;
	    	padding: 0;
	    }
		.social-shares {
		    list-style-type: none;
		    padding: 0;
		    position: absolute;
		    left: -3.5em;
		    top: 0;
		    text-align: center;
		}
		.social-shares li {
			display: inline-block;
		    float: left;
		    clear: both;
		    padding: 1em 0;
		}
		.social-shares a {
		    padding: 1em;
		    background: #fff;
		    color: #888;
		    transition: all ease 0.7s;
		}
		.social-shares i {
		    text-align: center;
		    height: 1em;
		    width: 1em;
		    padding: 0;
		    line-height: 1em;
		}
		.social-shares a:hover {
		    color: #fff;
		}
		.social-shares .facebook:hover{background:#5677b3;}
		.social-shares .twitter:hover{background:#37a2d4;}
		.social-shares .google-plus:hover{background:#e84747;}
	</style>
	<div class="social-shares">
		<h3>Share</h3>
		<ul>
		    <li><a target="_blank" href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink(); ?>" class="facebook"><i class="fa fa-facebook"></i></a></li>
		    <li><a target="_blank" href="<?php echo 'https://twitter.com/intent/tweet?url='.get_the_permalink().'&text='.get_the_title().'&via='.site_url(); ?>" class="twitter"><i class="fa fa-twitter"></i></a></li>
		    <li><a target="_blank" href="<?php echo 'https://plus.google.com/share?url='.get_the_permalink(); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
		</ul>
	</div>
	<?php
} );