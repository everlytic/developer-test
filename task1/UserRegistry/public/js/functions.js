/**
 * Functions for user listing page
 * Use jQuery with noConflict object
 */

(function($) {

    $document = $('document');

    $.fn.user_listing = function() {  

        $body = $('body'),
        $save_modal = $('#user-save-modal'), 
        $save_form = $save_modal.find('form#save-user-form'),
        $save_button = $('#user-save-button'), 
        $save_cancel_button = $('#savecancelbutton'),
        $delete_modal = $('#user-delete-modal'), 
        $delete_form = $delete_modal.find('form#delete-user-form'),
        $delete_buttons = $('a.user-delete'), 
        $delete_cancel_button = $('#deletecancelbutton'),
        $alert_dismiss = $('.alert a.dismiss');

        $save_button.on('click', function() {
            show_save_modal();
        });

        $save_cancel_button.on('click', function() {
            hide_save_modal();
        });

        $delete_buttons.on('click', function() {
            $this_button = $(this);
            $user_id = $this_button.data('id');

            show_delete_modal($user_id);
        });

        $alert_dismiss.on('click', function() {
            $(this).parent().fadeOut();
        });

        $delete_cancel_button.on('click', function() {
            hide_delete_modal();
        });

        /**
         * Listen for an ESC key press to close the modal
         * @param  {[type]} event) {                       if (event.keyCode [description]  
         */
        $(document).on('keypress', function (event) {
            if (event.keyCode == 27) {
                hide_save_modal(); 
                hide_delete_modal();
            }
        })

        /**
         * Show the save modal with the form
         */
        var show_save_modal = function() {
            $save_modal.show();
            $save_form.find('input[type="text"]:first').focus();
        }

        /**
         * Hide the save modal
         */
        var hide_save_modal = function() {
            $save_modal.hide();
        }

        /**
         * Show the delete modal
         */
        var show_delete_modal = function($user_id) {
            $delete_modal.show().find('button#delete').focus();
            $delete_form.attr('action', '/users/' + $user_id).find('input#user_id').val($user_id);
        }

        /**
         * Hide the delete modal
         */
        var hide_delete_modal = function() {
            $delete_modal.hide();
        }
    }

    $document.ready(function() {
        $(this).user_listing();
    })
})(jQuery);