$(document).ready(function () {
    $("#stage_sortable").sortable({
        placeholder: "ui-state-highlight",
        update: function (event, ui) {

            var stage_order_ids = new Array();
            $('#stage_sortable th').each(function () {
                stage_order_ids.push($(this).data("id"));
            });

            console.log(stage_order_ids);
            $.ajax({
                type: "POST",
                url: "{{ route('stage_order_change') }}",
                dataType: "json",
                data: {
                    order: stage_order_ids,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    toastr.success(response.message);
                    $('#stage_sortable th').each(function (index) {
                        $(this).find('.stage_num').text(index + 1);
                    });

                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    });
});