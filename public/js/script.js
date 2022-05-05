// /**
//  * AdminLTE Demo Menu
//  * ------------------
//  * You should not use this file in production.
//  * This file is for demo purposes only.
//  */
//
// /* eslint-disable camelcase */
//
(function ($) {
    'use strict'
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
    $(".datatable").DataTable({
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "responsive": true,
        "dom": 'Bfrtip',
        "pageLength": 10,
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
    });
    $('body').on('click', function (e) {
        // Dynamically changes the form action path
        // Reads href attribute from the button
        // Assigns the href value to form action
        let target;
        if ($(e.target).hasClass('delete-btn')) {
            target = $(e.target);
        } else if ($(e.target).parent().hasClass('delete-btn')) {
            target = $(e.target).parent();
        }
        if (target) {
            const path = target.attr('href');
            console.log(path);
            $("#delete-modal form").attr('action', path);
        }
    });
    $("#delete-modal form").on('submit',e  => {
        // Submits the form by ajax
        // prevents normal submission
        // in case of success, shows toast of success, and remove the row from html
        // in case of error, shows toast of error
        e.preventDefault();
        const path = $(e.target).attr('action');
        $.ajax({
            url: path,
            type: 'DELETE',
            data: {
                _token: $("input[name='_token']").val(),
            },
            success: () => {
                Toast.fire({
                    icon: 'success',
                    title: 'Successfully deleted.'
                })
                $(`a[href="${path}"]`).parentsUntil('tr').parent().remove();
                $("#delete-modal").modal('hide');
            },
            error: err => {
                Toast.fire({
                    icon: 'error',
                    title: 'An error has occurred.'
                });
                console.error(err);
            }
        });
    });
    $('.custom-file-input').on('change',function(){
        //get the file name
        const fileName = this.files[0].name;
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });

    Pusher.logToConsole = true;

    const pusher = new Pusher('44fa6c6e3c8fd13e074f', {
        cluster: 'eu'
    });

    const channel = pusher.subscribe('notifications-channel');
    channel.bind('my-event', function(data) {
        console.log('received data', data);
    });
})(jQuery);
