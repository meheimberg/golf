<?php
/**
 * Created by PhpStorm.
 * User: markheimberg
 * Date: 4/27/15
 * Time: 12:07 PM
 */
?>
        </div>
    </body>

<?php

	if(!empty($_SESSION['username']) && $_SESSION['access'] == 10 ):
	
?>

    <script language="JavaScript" type="text/javascript">
	    
	    var originalStrokes;
	    var ignoreFocusOut = false;

		$('.strokes').focusout(function(){
			if(!ignoreFocusOut) {
				$(this).add($('#change-item')).animate( { color : '#777', backgroundColor : '#fff' }, 1000);
	            this.innerHTML = originalStrokes;
	            console.log("focusout executed");
            }
		});
		
	

		$('.strokes').click(function(e){

			
            if (this.innerHTML.indexOf("<input") < 0) {

                var retainId = this;
                
                
                
                var date = this.getAttribute('data-date');
                var hole_num = this.getAttribute('data-hole');
                var player = this.getAttribute('data-player')
                var row = this.getAttribute('data-row');

				if (!hole_num) // makes sure there is a hole number - cannot edit the total column
					return;
					
                var strokes = this.innerHTML;
                originalStrokes = this.innerHTML;
				
                this.innerHTML = '<input type="text" class="hole-input-edit" pattern="\d*" value="' + $.trim(originalStrokes) + '" id="change-item" >';
                
                var changeItem = $();
                
                
                $('#change-item').select();
                $('#change-item').add(retainId).animate( { backgroundColor : '#e9d3d8', color : '#df0032' }, 1000);               

                $('#change-item').change(function() {
					
					ignoreFocusOut = true;
					
					console.log("called...");
					

                    var  newstrokes = $('#change-item').val();
                    console.log("newstrokes = " + newstrokes);

					console.log(date + " : " + hole_num + " : " + newstrokes + " : " + <?=$course;?> + " : " + player);

					var courseid = '<?=$course;?>';
                    $.ajax({
                        type: 'POST',
                        url: 'update-scores-action.php',
                        data: { date:date, hole:hole_num, strokes:newstrokes, course:courseid, player:player },
                        
                        success: function (data) {
							
							
							
                        	console.log("success " + data);

                            var newTotal = (parseInt($( '#total-row-' + row).html()) - parseInt(strokes) + parseInt(newstrokes));

                            $( '#total-row-' + row).text(newTotal);
                            
                            console.log("retainId = "  + retainId.id);
                            
                            $(retainId).html($.trim(newstrokes));
                            
                            $(retainId).add('#total-row-' + row).animate( { backgroundColor : '#90b7d0', color: "#777" }, 1000).delay(2000).animate( { backgroundColor : '#fff' }, 1000);                            
                            

                            var position = $(retainId).position();
                            var leftPos  = $(retainId).width() + position.left;
                            
                            $('#update-success').animate( { top: position.top - 6 }, 0).animate( { left: leftPos + 18}, 0);
                            $('#update-success').fadeIn( 1000 ).delay( 2000 ).fadeOut( 1000 );
                            
                            
                            var totalBoxLeftPos = $('#total-row-' + row).position();
                            
                            $('#round-update').animate( { top: position.top - 6 }, 0).animate( { left: totalBoxLeftPos.left + 65}, 0);
                            $('#round-update').fadeIn( 1000 ).delay( 2000 ).fadeOut( 1000 );


                            ignoreFocusOut = false;

                        },
                        dataType: "json",
                        error: function (data) {
                            console.log("failure " + JSON.stringify(data));
                        }
                    });

                });



            }

        });

    </script>
    
<?php
	endif;
?>


</html>
