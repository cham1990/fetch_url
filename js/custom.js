$(document).ready(function(){

	$(document).on('click', '#add_more', function(){

            var div_count = parseInt($('.inner_div').length)+1;
            var append_html = '<div class="form-group inner_div ui-state-default"><label class="control-label col-sm-2" ><span class="glyphicon glyphicon-menu-hamburger sort_handler"></span></label> <div class="col-sm-8">  <input type="text" class="form-control" placeholder="Enter URL '+div_count+'" name="url[]"></div><div class="col-sm-2">  <input type="button" class="btn btn-default update-btn div_remove" value="Remove"> </div></div>';

            $('#append_div').append(append_html);

	});

        $(document).on('click','.div_remove',function(){

              var div_count = parseInt($('.inner_div').length);

              if(div_count > 1){
		      $(this).closest('.inner_div').remove();
		      sort_placeholders();
              } else {
                      alert("You must add at least one URL");
              }
        });

        $('.sortable').sortable({ handle: '.sort_handler',stop  : function(event,ui){ sort_placeholders() } });
          
        $("#fetch_url").submit(function(e) {

            e.preventDefault();
            var div_count = parseInt($('.inner_div').length);
	    var formData = new FormData( document.getElementById("fetch_url") );

	    var xhr = new XMLHttpRequest();
	    xhr.open('POST', $(this).attr('action'), true);
	    xhr.send(formData);
	    var timer;
	    timer = window.setInterval(function() {
		if (xhr.readyState == XMLHttpRequest.DONE) {
		    window.clearTimeout(timer);
		}
               var output_array = xhr.responseText.split('___PAYLOAD___');
               var display = '';
               var l = output_array.length;

              if(output_array != undefined && output_array != null && output_array != '' && l > 0){

                  for(i=0;i<l;i++){
                      display += '<div class="col-sm-12">'+output_array[i]+'</div>';
                  }              

              } 
	       $('#output_div').html(display);

               $('#progress_div').html(Math.round((((parseInt(l)-1)*100)/div_count))+'% Completed');
		
	    }, 1000);
             
        });

      function sort_placeholders(){

         $('#fetch_url').find("input[type=text]").each(function(ev){
	      
	        $(this).attr("placeholder", "Enter URL "+(parseInt(ev)+1));
	     
        });
     }

});
