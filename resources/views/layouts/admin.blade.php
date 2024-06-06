<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hotel Dashboard Template</title>
    <link rel="shortcut icon" type="{{ asset('new_admin/image/x-icon" href="new_admin/assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/css/feathericon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/https://cdn.oesmith.co.uk/morris-0.5.1.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('new_admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

</head>

<body>
    <!-- heading -->
    @include('admin.header')
    <!-- end heading -->

    <!-- leftbar -->
    @include('admin.leftbar')
    <!-- end leftbar -->


    @yield('content')


    <script src="{{ asset('new_admin/assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('new_admin/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('new_admin/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('new_admin/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('new_admin/assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('new_admin/assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('new_admin/assets/js/chart.morris.js') }}"></script>
    <script src="{{ asset('new_admin/assets/js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script type="text/javascript">
        function revokeUser(route, id, element) {
            $(element).find(`#revoke_ban${id}`).html(`
                        <a class="btn btn-success ban btn-sm ban_user" data-status="banned"
                                                            data-id="${id}" data-action="userBan"
                                                            data-toggle="modal"
                                                            data-target="#banModal${id}">Ban</a>

                        <div class="modal fade" id="banModal${id}"
                            tabindex="-1" role="dialog" aria-labelledby="banModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form id="form_id${id}" action="">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="banModalLabel">Ban
                                                User
                                            </h5>
                                            <button type="button" class="close"
                                                data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="reason">Reason</label>
                                                        <textarea class="form-control" id="reason${id}" rows="5"
                                                            placeholder="Enter the reason for the ban"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            {{-- <a class="btn btn-success ban btn-sm ban_user" data-status="banned" data-id="${id}" data-action="userBanWithreason">Ban</a> --}}
                                            <button type="button" class="btn btn-danger"
                                                onclick="onClickBanUser('userBanWithreason', ${id}, '#parent_tr${id}')">Confirm
                                                Ban</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
        			`);



            $.ajax({
                url: `/${route}`,
                method: 'POST',
                data: {
                    id: id,
                },
                success: function(response) {


                    $(element).closest(`#parent_tr${id}`).find(`#yes_no${id}`).html(
                        `<label class="label label-danger">No</label>`);
                    $(element).closest(`#parent_tr${id}`).find(`#user_info${id}`).html(
                        `<div class="actions"> <a href="#" class="badge btn btn-sm bg-success-light mr-2">Active</a> </div>`
                    );


                },
            });
        }

        function onClickBanUser(route, id, element) {
            $(element).find(`#banModal${id}`).modal('hide');

            $(element).find(`#banModal${id}`).find(`#form_id${id}`)[0].reset();

            let comment = $(element).find(`#banModal${id}`).find('textarea').val();


            $.ajax({
                url: `/${route}`,
                method: 'POST',
                data: {
                    id: id,
                    comment: comment,
                },
                success: function(response) {

                    $(element).closest(`#parent_tr${id}`).find(`#yes_no${id}`).html(
                        `<label class="label label-danger">Yes</label>`);
                    $(element).closest(`#parent_tr${id}`).find(`#user_info${id}`).html(
                        `<div class="actions"> <a href="#" class="badge btn btn-sm bg-danger-light mr-2">InActive</a> </div>`
                    );
                    $(element).find(`#revoke_ban${id}`).html(`
                        <a href="#" class="btn btn-success btn-sm revoke_user" onclick="revokeUser('user/revokeuser',${id}, '#parent_tr${id}')"
                                                            data-status="revoked" data-id="${id}"
                                                            data-action="user/revokeuser">Revoke</a>
                    `);

                },
            });

        }

        $(document).ready(function() {
            // $('body').on('click', '.ban_user', function() {
            //     let id = $(this).data('id');
            //     let action = $(this).data('action');
            //     let element = $(this);
            //     let status = $(this).data('status');
            //     banRevoke(action, id, element, status);
            // });
            // $('body').on('click', '.revoke_user', function() {
            //     let id = $(this).data('id');
            //     let action = $(this).data('action');
            //     let element = $(this);
            //     let status = $(this).data('status');
            //     banRevoke(action, id, element, status);
            // });
        });

        // $("body").on("click", ".ban", function() {
        //     var current_object = $(this);
        //     bootbox.dialog({
        //         message: "<form class='form-inline add-to-ban' method='POST'><div class='form-group'><textarea class='form-control reason' rows='4' placeholder='Add Reason for Ban this user.'></textarea></div></form>",
        //         title: "Add To Black List",
        //         buttons: {
        //             success: {
        //                 label: "Submit",
        //                 className: "btn-success",
        //                 callback: function() {
        //                     var baninfo = $('.reason').val();
        //                     var token = $("input[name='_token']").val();
        //                     var action = current_object.attr('data-action');
        //                     var id = current_object.attr('data-id');
        //                     if (baninfo == '') {
        //                         $('.reason').css('border-color', 'red');
        //                         return false;
        //                     } else {
        //                         $('.add-to-ban').attr('action', action);
        //                         $('.add-to-ban').append('<input name="_token" type="hidden" value="' +
        //                             token + '">')
        //                         $('.add-to-ban').append('<input name="id" type="hidden" value="' + id +
        //                             '">')
        //                         $('.add-to-ban').append('<input name="baninfo" type="hidden" value="' +
        //                             baninfo + '">')
        //                         $('.add-to-ban').submit();
        //                     }
        //                 }
        //             },
        //             danger: {
        //                 label: "Cancel",
        //                 className: "btn-danger",
        //                 callback: function() {
        //                     // remove
        //                 }
        //             },
        //         }
        //     });
        // });
    </script>

    @stack('scripts')
</body>

</html>
