( function( $ ){
    $(document).ready(function(){

        // send request to change auhtor's posts.
        $('#switch-form').submit(function(event){
            event.preventDefault();
            // TODO : Validate fields here.

            var form_data   = $(this).serializeArray();
            var ajax_url    = $(this).data('ajax'); 
            console.log( form_data );
            console.log( ajax_url );

            $.ajax({
                url: ajax_url,
                type: 'post',
                //dataType: 'json',
                data: {
                    action: 'set_new_author',
                    data: form_data,
                },
                success: function( response ) {
                    console.log( 1 );
                    console.log( response );
                },
                error: function( response ) {
                    console.log( 2 );
                    console.log( response );
                }
            });
        });

        // change old author image.
        $('.author__selector').change(function(){
            var image_id    = $(this).data('image');
            var $image      = $('#' + image_id);

            $image.fadeTo("fast", 0.5 );

            $.ajax ({
                url : $(this).data('ajax'),
                type: 'post',
                dataType: 'json',
                data: {
                    action: 'get_user_gravatar',
                    user_id: $(this).val(),
                },
                success : function( response ) {
                    $image.attr('src', response.img_url );
                    $image.fadeTo("fast", 1 );
                },
                error: function( response ) {
                    $image.fadeTo("fast", 1 );
                }
            });
        });

    });
}(jQuery));