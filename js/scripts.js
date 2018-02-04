( function( $ ){
    $(document).ready(function(){

        // change old author image.
        $('.author__selector').change(function(){
            var image_id = $(this).data('image');
            var $image = $('#' + image_id);

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