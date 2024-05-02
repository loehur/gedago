<div class="container">
    <div style="max-width: 500px;" class="m-auto px-1">
        <h5>Notification</h5>
        <div class="row px-2 my-1">
            <div class="col bg-white border rounded py-2">
                <div class="row py-1">
                    <div class="col-auto">
                        <span>Whatsapp Sender Token</span><br>
                    </div>
                    <div class="col text-end">
                        <span class="cell_edit" data-id="1"><?= $_SESSION['config']['api_key']['fonnte'][1] ?></span><br>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col-auto">
                        <span>Whatsapp Group</span><br>
                    </div>
                    <div class="col text-end">
                        <span class="cell_edit" data-id="2"><?= $_SESSION['config']['notif']['finance'][1] ?></span><br>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        spinner(0);
    });

    var click = 0;
    $(".cell_edit").on('dblclick', function() {
        click = click + 1;
        if (click != 1) {
            return;
        }

        var id = $(this).attr('data-id');
        var value = $(this).html();
        var value_before = value;
        var el = $(this);
        var width = el.parent().width();
        align = "right";

        el.parent().css("width", width);
        el.html("<input required type='text' style='outline:none;border:none;width:" + width + ";text-align:" + align + "' id='value_' value='" + value + "'>");

        $("#value_").focus();
        $("#value_").focusout(function() {
            var value_after = $(this).val();
            if (value_after === value_before) {
                el.html(value);
                click = 0;
            } else {
                $.ajax({
                    url: '<?= PC::BASE_URL_ADMIN . $con ?>/updateJSON',
                    data: {
                        'id': id,
                        'value': value_after,
                    },
                    type: 'POST',
                    dataType: 'html',
                    success: function(res) {
                        el.html(value_after);
                        click = 0;
                    },
                });
            }
        });
    });
</script>