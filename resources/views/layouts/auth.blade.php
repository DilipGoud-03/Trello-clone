<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Trello </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="{{asset('css/modal.css')}}">
    <link rel="stylesheet" href="{{asset('css/stages-drag-drop.css')}}">
    <link rel="stylesheet" href="{{asset('css/drag-drop.css')}}">
    <link rel="stylesheet" href="{{asset('css/tickets-drag-drop.css')}}">


</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
        <div class="container ">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ">
                    @if(auth()->user())
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('dashboard')) ? 'active' : '' }}" href="{{route('dashboard')}}">Dashbaord</a>
                    </li>
                </ul>
                <ul class="navbar-nav " style="margin-left: auto">
                    <li>
                        <a class=" nav-link {{ (request()->is('logout')) ? 'active' : '' }}">{{auth()->user()->name}}</a>
                    </li>
                </ul>
                <ul class="navbar-nav " style="margin-left: auto">
                    <li>
                        <a class=" nav-link {{ (request()->is('logout')) ? 'active' : '' }}" href="{{ route('logout') }}">Logout</a>
                    </li>
                </ul>
                <ul class="navbar-nav ">
                    @else
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="{{url('/')}}">Home</a>
                    </li>
                </ul>
                <ul class="navbar-nav " style="margin-left: auto">
                    <li class="nav-item-flex-right">
                        <a class="nav-link {{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('register')) ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <main class="mt-3">
        @yield('content')
        <script src="{{asset('js/modal.js')}}"></script>

        <!-- Change stage order with ajax -->

        <script>
            $(document).ready(function() {
                $("#stage_sortable").sortable({
                    placeholder: "ui-state-highlight",
                    update: function(event, ui) {

                        var stage_order_ids = new Array();
                        $('#stage_sortable li').each(function() {
                            stage_order_ids.push($(this).data("id"));
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{route('stage_order_change')}}",
                            dataType: "json",
                            data: {
                                order: stage_order_ids,
                                _token: "{{ csrf_token() }}"
                            },
                        });
                    }
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#ticket_sortable").sortable({
                    placeholder: "ui-state-highlight",
                    update: function(event, ui) {

                        var stage_order_ids = new Array();
                        $('#ticket_sortable li').each(function() {
                            stage_order_ids.push($(this).data("id"));
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{route('stage_order_change')}}",
                            dataType: "json",
                            data: {
                                order: stage_order_ids,
                                _token: "{{ csrf_token() }}"
                            },
                        });
                    }
                });
            });
        </script>

        <!-- create tickets with ajax -->
        <script>
            $(document).ready(function() {
                $(document).on("click", ".createTicketsModel", function() {
                    var stage_id = $(this).data('id');
                    $('#tickets_form').on('submit', function() {
                        $('#ticketsName_error').text('');
                        $('#ticket_assignee_error').text('');

                        var myStageId = stage_id;
                        var ticketsName = $('#ticketsName').val();
                        var ticket_description = $('#ticket_description').val();
                        var ticket_assignee = $('#ticket_assignee').val();

                        $.ajax({
                            url: "{{route('ticketsStore')}}",
                            type: "POST",
                            dataType: 'json',
                            data: {
                                stage_id: myStageId,
                                ticketsName: ticketsName,
                                assignee: ticket_assignee,
                                description: ticket_description,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response) {
                                    $('#success_message').text(response.success);
                                    $("#tickets_form").reset();
                                }
                            },
                            error: function(response) {
                                $('#ticketsName_error').text(response.responseJSON.errors.ticketsName);
                                $('#ticket_assignee_error').text(response.responseJSON.errors.assignee);
                            }
                        });
                    });
                });
            });
        </script>
        <script type="text/javascript">
            $(document).on("click", ".ticketsDetailsModal", function() {
                var myTicketId = $(this).data('id');
                var tickets_id = $(".modal-body .my_tickets_id").text(myTicketId);
            });
        </script>

        <!-- commments create with ajax -->
        <script type="text/javascript">
            $(document).ready(function() {
                $(document).on("click", "#ticketsDetailsModal", function() {
                    var myTicketId = $(this).data('id');
                    $('#commentsForm').on('submit', function() {
                        var created_by = $('#created_by ').val();
                        var tickets_id = $(".modal-body #ticket_id").val(myTicketId);
                        var comment = $('#comment').val();
                        $.ajax({
                            url: "{{route('commentsStore')}}",
                            type: "POST",
                            dataType: 'json',
                            data: {
                                created_by: created_by,
                                tickets_id: tickets_id,
                                comment: comment,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response) {
                                    $("#commentsForm")[0].reset();
                                }
                            },
                        });
                    });
                });
            });
        </script>

        <!-- create board with Ajax -->

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function() {
                $('#multi_step_form').on('submit', function() {
                    $('#board_name_error').text('');
                    $('#user_email_error').text('');

                    var created_by = $('#created_by ').val();
                    var board_name = $('#board_name ').val();
                    var board_description = $('#board_description').val();
                    var user_email = $('#user_email').val();
                    var role = $('#role').val();
                    var stage_name = $('#stage_name').val();
                    var stage_description = $('#stage_description').val();
                    $.ajax({
                        url: "{{route('modalData')}}",
                        type: "POST",
                        dataType: 'json',
                        data: {
                            created_by: created_by,
                            board_name: board_name,
                            board_description: board_description,
                            user_email: user_email,
                            role: role,
                            stage_name: stage_name,
                            stage_description: stage_description,
                        },
                        success: function(response) {
                            if (response) {
                                $('#success-message').text(response.success);
                                $("#multi_step_form")[0].reset();
                            }
                        },
                        error: function(response) {
                            $('#board_name_error').text(response.responseJSON.errors.board_name);
                            $('#user_email_error').text(response.responseJSON.errors.user_email);
                        }
                    });
                });
            });
        </script>
    </main>
</body>

</html>