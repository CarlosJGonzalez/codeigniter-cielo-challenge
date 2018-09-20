<script src="<?=base_url();?>assets/js/jquery.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/style.css">
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
<script src='<?=base_url();?>assets/js/color-picker.js'></script>
<script src="<?=base_url();?>assets/js/validation.js" type="text/javascript" charset="utf-8"></script>
<!--div id="site_content"-->
<?php echo validation_errors(); ?>
	<div id="content">
		<div id="message"></div>
		<?php 
			$attributes = array('id'=>'frmcreate', 'method'=>'POST', 'name'=>'frmcreate');
			echo form_open('contacts/create', $attributes); 
		?>
		    <p>
		    	<label for="name">Name</label>
		    	<input class="input" type="input" id="name" name="name" placeholder="Full Name" />
			</p>
			<p>
			    <label for="dob">D.O.B.</label>
			    <input class="input" type="input" id="dob" name="dob" placeholder="MM/DD/YYYY" />
			</p>	
			<p>	    
				<label for="email">Email</label>
		    	<input class="input" type="input" id="email" name="email" placeholder="email@domain" />
		    </p>

			<p>
		    	<label id="pickcolor" for="pickcont">Fav. Color
		    	<div id="colpic">
		    		<script>
				    //color picker
				    jQuery('#colpic').colorPicker({
				        rows: 3, // No of rows to display
				        cols: 3, // No of columns to display
				        top: 10, // Top position to display color picker
				        left: 120, // Left position to display color picker
				        cellspacing: 4, // Space between the cells 
				        cellWidth: 20, // width of each cell showing color
				        cellHeight: 20, // height of each cell showing color
				        zindex: 200, // zindex for the color picker
				        showCode: 1, // showing code on the bottom if made as 1
				        onSelect: function(colorcode) { // function upon selecting the color
				        // Use Your ajax code to use this color code
				        jQuery( "#favcolor" ).val(colorcode);
				        jQuery( "#pickcolor" ).css('background-color',colorcode);
				        },
				        onmouseover: function(colorcode) { // function upon selecting the color
				        // Use Your ajax code to use this color code
				        },
				        colorData: ['red','blue','orange', 'black', 'yellow', 'green', 'brown', 'white', 'silver'] //Custom colors if mentioned loads the colors from the array. 
				        //Accepted hexadecimal colorcodes also
				    });


				    (function($) {
				        jQuery('#favcolor').colorPicker({
				            rows: 3,
				            cols: 3,
				            showCode: 0,
				            onSelect: function(colorCode) {
				                jQuery('#favcolor').css('background-color', colorCode);
				            },
				            showCode: 1,
				            colorData: ['red','blue','orange', 'black', 'yellow', 'green', 'brown', 'white', 'silver'],
				            onmouseover: function(colorCode) {
				            }
				        });
				                
				    })(jQuery);				    
					</script>
		    	</div></label>&nbsp;    	
				<input type="hidden"  name="favcolor" id="favcolor" />
			</p>
		    <!--input class="submit" type="submit" id="submit" name="submit" value="submit" /-->
		    <input class="submit" type="button" id="ajaxsubmit" name="ajaxsubmit" value="Submit" />
		</form>
	</div>
<script>
jQuery( document ).ready(function () {
    jQuery( "#ajaxsubmit" ).click(function (){
      var name = jQuery( "#name" ).val();
      var dob = jQuery( "#dob" ).val();
      var email = jQuery( "#email" ).val();
      var favcolor = jQuery( "#favcolor" ).val();

	  if(validating() === false) 
		return;
	  
      jQuery.ajax({
        url : "<?=base_url();?>contacts/new",
        type : "POST",
        data : {"name" : name, "dob" : dob, "email": email,  "favcolor": favcolor},
          success: function (data){
          	var res=JSON.parse(data);
            if( res.response == 'true'){
            	jQuery( "#frmcreate" )[0].reset();
                jQuery( "#message" ).html('<div class="added">'+res.message+'</div>');
                //document.location.href="<?php echo base_url();?>contacts";
            }else{
                jQuery( "#message" ).html('<div class="added">'+res.message+'</div>');
            }
            jQuery( "#message" ).show('slow').delay(2000).hide(1500, function(){
                jQuery( ".added" ).remove();
            });            
          },
          error: function(data){
            alert ('failed');
          }
      });
    }); 
});

function validating()
{
	var strmsg='';
	var fields = [];
	if( jQuery.trim(jQuery( "#name" ).val()) == '' )   
		fields.push('Name is required');
	
	if( jQuery( "#dob" ).val() == '' || jQuery( "#dob" ).val() === null)   
		fields.push('D.O.B. is required');

	if( jQuery( "#email" ).val() == '' || jQuery( "#email" ).val() === null )            
		fields.push("Email is required");

	 if(isValidDate(jQuery( "#dob" ).val()) == false){
		fields.push("Valid Date format: mm/dd/yyyy");
	 }

	if( fields.length>0 ){
		for(i=0; i<fields.length; i++)
		{
			strmsg +=fields[i]+'<br />';
		}
		jQuery( "#message" ).html('<div class="added">'+strmsg+'</div>');
		jQuery( "#message" ).show('slow').delay(2000).hide(1500, function(){
			jQuery( ".added" ).remove();
		});
		fields.length=0;
		event.preventDefault();
		return false;
	}else{
		return true;
	}
}
</script>	