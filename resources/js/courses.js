//Create/Edit
$(function () {
    $('.add-to-course-user-list').on('click', '.add-user, .remove-user', function () {
        //Toggle if user is added to course
        $(this).closest('.course-user-row').find('.add-user, .remove-user').toggleClass('d-none');
    })

    $('.submit-course').on('click', function () {
        let idArr = [];
        //Find all users to add an submit form
        $('.add-to-course-user-list').find('.add-user.d-none').each(function () {
            idArr.push($(this).closest('.course-user-row').attr('data-user-id'));
        })

        $('input[name="user_list"]').val(idArr.join(","));
        $('#edit-course-form').submit();
    })

    $('.submit-delete-course').on('click', function () {
        let id = $(this).attr('data-course-id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'courses/delete/'+id,
            method: 'post',
            success: function (response) {

            }
        });
    })
})
