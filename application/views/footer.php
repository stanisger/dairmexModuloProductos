       <script    src="<?php echo base_url();?>js/vendor/jquery.js"></script>
      <script    src="<?php echo base_url();?>js/vendor/what-input.js"></script>
      <script    src="<?php echo base_url();?>js/vendor/foundation.js"></script>
      <script    src="<?php echo base_url();?>js/app.js"></script>


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>		 
      <script type="text/javascript" src="<?php echo base_url();?>js/requesicion.js"></script>	
      <script>
         $(document).ready(function(){
         	
	  $('[data-app-dashboard-toggle-shrink]').on('click', function(e) {
	  e.preventDefault();
	  $(this).parents('.app-dashboard').toggleClass('shrink-medium').toggleClass('shrink-large');
	});
         })
	</script>



  </body>
</html>