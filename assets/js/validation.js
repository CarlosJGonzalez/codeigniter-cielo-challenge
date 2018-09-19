jQuery( document ).ready(function () {
    jQuery( "#submit" ).click( function (){
        jQuery( "#frmcreate" ).submit( function( event ){
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
                jQuery( "#frmcreate" ).submit();
            }
        });
    }); 

});

//--------------------------------------------------------------------------
//This function validates the date for MM/DD/YYYY format. 
//--------------------------------------------------------------------------
function isValidDate(dateStr) {
 
 // Checks for the following valid date formats:
 // MM/DD/YYYY
 // Also separates date into month, day, and year variables
 //var datePat = /^(\d{2,2})(\/)(\d{2,2})\2(\d{4}|\d{4})$/;
   var datePat = /^(\d{2,2})(\/)(\d{2,2})\2(\d{4}|\d{4})$/;
 
 var matchArray = dateStr.match(datePat); // is the format ok?
 if (matchArray == null) {
  //alert("Date must be in MM/DD/YYYY format")
  return false;
 }
 
 month = matchArray[1]; // parse date into variables
 day = matchArray[3];
 year = matchArray[4];
 if (month < 1 || month > 12) { // check month range
  alert("Month must be between 1 and 12");
  return false;
 }
 if (day < 1 || day > 31) {
  alert("Day must be between 1 and 31");
  return false;
 }
 if ((month==4 || month==6 || month==9 || month==11) && day==31) {
  alert("Month "+month+" doesn't have 31 days!")
  return false;
 }
 if (month == 2) { // check for february 29th
  var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
  if (day>29 || (day==29 && !isleap)) {
   alert("February " + year + " doesn't have " + day + " days!");
   return false;
    }
 }
 return true;  // date is valid
}