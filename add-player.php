<?php

$page_title = "Add a Player";
include('header.php');


?>

<div class="row">
    <div class="col-md-3 box"></div>
    <div class="col-md-6 box">

        <h1>Add Players</h1>


        <form id="add_players" method="post" action="add-player-action.php">

            <div class="form-group">
                <input type="text" id="playername" name="playername" placeholder="Player name" class="form-control maxwidth" />
            </div>
            <div class="form-group">
                <button id="addPlayerButton" type="submit" class="btn btn-success">Add Player</button>

            </div>

            <div id="result"></div>

        </form>



        <script type="text/javascript">

            //$("#addplayerButton").click(function(event) {
            $( "#add_players" ).submit(function( event ) {

                event.preventDefault();
                //alert("clicked");

                //$.post("add_player_action.php", {$("#playername").val()} );

                var $form = $( this ),
                    term = $form.find( "input[name='playername']" ).val(),
                    url = $form.attr( "action" );
                //alert (url);
                //alert(term);
                var posting = $.post( url, { playername: term } );

                // Put the results in a div
                posting.done(function( data ) {
                    $( "#result" ).empty().append( "Player Added" );
                    $( "#playername").val("");
                    $( "#result").hide().fadeIn( 1000 ).delay( 3000 ).fadeOut( 1000 );
                });

                posting.fail(function( data ) {
                    $( "#result" ).empty().append( "Not good..." );
                    $( "#result").hide().fadeIn( 1000 );
                });

            });

        </script>

    </div>

    <div class="col-md-3 box"></div>
</div>


<?php

include('footer.php');

?>