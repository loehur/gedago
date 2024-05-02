<div class="container">
    <div style="max-width: 500px;" class="m-auto px-1">
        <h5>User Admin</h5>
        <?php
        foreach ($_SESSION['config']['user_admin'] as $key => $d) {
            if ($d['access'] <> "sa") {
        ?>
                <div class="row px-2 my-1">
                    <div class="col bg-white border rounded py-2">
                        <div class="row py-1">
                            <div class="col">
                                <span class="cell_edit" data-id="<?= $key ?>" data-col="nama"><?= $d['nama'] ?></span><br>
                                <span class="cell_edit" data-id="<?= $key ?>" data-col="no"><?= $d['no'] ?></span><br>
                            </div>
                            <div class="col-auto">
                                <select data-col="access" data-id="<?= $key ?>" class="form-select form-select-sm sel_edit" aria-label="Default select example">
                                    <?php foreach ($_SESSION['config']['access'] as $acc) {
                                        if ($acc['code'] <> "sa") { ?>
                                            <option value="<?= $acc['code'] ?>" <?= $d['access'] == $acc['code'] ? "selected" : "" ?>><?= $acc['name'] ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
        <?php }
        }
        ?>
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
        var col = $(this).attr('data-col');
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
                        'col': col,
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

    $(".sel_edit").on('change', function() {
        var id = $(this).attr('data-id');
        var col = $(this).attr('data-col');
        var value = $(this).val();

        $.ajax({
            url: '<?= PC::BASE_URL_ADMIN . $con ?>/updateJSON_SEL',
            data: {
                'id': id,
                'value': value,
            },
            type: 'POST',
            dataType: 'html',
            success: function(res) {
                content();
            },
        });
    });
</script>