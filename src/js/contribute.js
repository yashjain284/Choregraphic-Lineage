/*
  SHOULD ONLY BE INCLUDED IN contribute.html
*/
/*global $*/
$(document).foundation();

$(document).ready(onDocumentReady);

function onDocumentReady() {
    var phoneForm = $('#phoneForm');
    
    // to prevent form from submitting upon successful validation
    phoneForm.on('submit', function(ev) {
        ev.preventDefault();
        return false;
    });

    // post via AJAX
    phoneForm.on("formvalid.zf.abide", handlePhoneFormSubmit);

    function handlePhoneFormSubmit(ev, form) {
        var t = form.serialize();

        $.ajax({
            type: 'POST',
            url: '../php/viaPhone.php',
            data: t,
            success: function(responseData, textStatus, jqXHR) {
                if (responseData === 'success') {
                    form.foundation('resetForm');
                } else {
                    // error
                }
                console.log(responseData);
            },
            error: function(responseData, textStatus, errorThrown) {
                // console.log(responseData);
            }
        });
        
    } // handlePhoneFormSubmit()

} // onDocumentReady()


