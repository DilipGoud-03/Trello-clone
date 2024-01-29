$(document).ready(function () {
    $("#ticket_sortable").sortable({
        placeholder: "ui-state-highlight",
        update: function () {

            var ticket_order_ids = new Array();
            $('#ticket_sortable li').each(function () {
                ticket_order_ids.push($(this).data("id"));
            });

            console.log(ticket_order_ids);
            $.ajax({
                type: "POST",
                url: "{{ route('ticket_order_change') }}",
                dataType: "json",
                data: {
                    order: ticket_order_ids,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    toastr.success(response.message);
                    $('#ticket_sortable li').each(function (index) {
                        $(this).find('.ticket_num').text(index + 1);
                    });

                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    });
});