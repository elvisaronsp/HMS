$( document ).ready(function() {
    // Get id from parent of time input
    $('.time').click(function () {
        let doctorId = $(this).parent().parent().attr('id');
        $('.hidden-doctor-input').val(doctorId);
        console.log(doctorId)
    })
});