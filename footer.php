<?php $options = get_option('settings_options');?>
  	  		</div>
  	  	</article>
  	  	<footer id="footer">
  	  		<div class="container  clearfix">
  	  			<span class="logo ir"><?php echo $options['site_title']; ?></span>
  	  			<p class="contact"><?php echo $options['contacts']; ?></p>
  	  			
  	  			<ul class="links">
  	  				<li class="blog"><a href="<?php echo $options['blog']; ?>">Blog <?php echo $options['site_title']; ?></a></li>
  	  				<li class="twitter"><a href="<?php echo $options['twitter']; ?>" class="ir">Twitter</a></li>
  	  				<li class="facebook"><a href="<?php echo $options['facebook']; ?>" class="ir">Facebook</a></li>
  	  			</ul>
  	  		</div>
  	  	</footer>
  	</div>
  	
  	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script>
  	<script>window.jQuery || document.write('<script src="<?php bloginfo('stylesheet_directory');?>/js/libs/jquery-1.6.3.min.js"><\/script>')</script>


  	<!-- scripts concatenated and minified via build script -->
  	<script defer src="<?php bloginfo('stylesheet_directory');?>/js/mylibs/jquery.color.js"></script>
  	<script defer src="<?php bloginfo('stylesheet_directory');?>/js/mylibs/jquery.transform.light.js"></script>
  	<script defer src="<?php bloginfo('stylesheet_directory');?>/js/mylibs/RequestAnimationFrame.js"></script>
  	<script defer src="<?php bloginfo('stylesheet_directory');?>/js/plugins.js"></script>
  	<script defer src="<?php bloginfo('stylesheet_directory');?>/js/script.js"></script>
  	<!-- end scripts -->
	
  	<script>
  	  	var _gaq=[['_setAccount','<?php echo $options['analytics']; ?>'],['_trackPageview'],['_trackPageLoadTime']];
  	  	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  	  	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
  	  	s.parentNode.insertBefore(g,s)}(document,'script'));
  	</script>

  	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
  	  	  	 chromium.org/developers/how-tos/chrome-frame-getting-started -->
  	<!--[if lt IE 7 ]>
  	  	<script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  	  	<script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  	<![endif]-->
</body>
</html>