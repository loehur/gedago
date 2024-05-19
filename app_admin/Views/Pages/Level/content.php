<div class="container">
    <div style="max-width: 500px;" class="m-auto px-1">
        <h5>Operation</h5>
        <?php
        foreach ($_SESSION['config']['level'] as $key => $d) {
        ?>
            <div class="row px-2 my-1">
                <div class="col bg-white border rounded py-2">
                    <div class="row">
                        <div class="col-auto">
                            Level
                        </div>
                        <div class="col text-end">
                            <?= $d['level'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            Name
                        </div>
                        <div class="col text-end">
                            <span class="cell_edit fw-bold text-primary" data-type="text" data-col="name" data-id="<?= $key ?>"><?= $d['name'] ?></span><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            Topup
                        </div>
                        <div class="col text-end">
                            <span class="cell_edit" data-col="topup" data-type="number" data-id="<?= $key ?>"><?= $d['topup'] ?></span><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            Days
                        </div>
                        <div class="col text-end">
                            <span class="cell_edit" data-col="days" data-type="number" data-id="<?= $key ?>"><?= $d['days'] ?></span><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            Daily Checking Fee
                        </div>
                        <div class="col text-end">
                            <span class="cell_edit" data-col="dc" data-type="number" data-id="<?= $key ?>"><?= $d['benefit'][0]['fee'] ?></span><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            Daily Watch Fee
                        </div>
                        <div class="col text-end">
                            <span class="cell_edit" data-col="dwf" data-type="number" data-id="<?= $key ?>"><?= $d['benefit'][1]['fee'] ?></span><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            Daily Watch Qty
                        </div>
                        <div class="col text-end">
                            <span class="cell_edit" data-col="dwq" data-type="number" data-id="<?= $key ?>"><?= $d['benefit'][1]['qty'] ?></span><br>
                        </div>
                    </div>
                </div>
            </div>
        <?php
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
        var tipe = $(this).attr('data-tipe');
        var value = $(this).html();
        var col = $(this).attr('data-col');
        var value_before = value;
        var el = $(this);
        var width = el.parent().width();

        align = "right";

        el.parent().css("width", width);
        el.html("<input type='" + tipe + "' style='outline:none;border:none;width:" + width + "px;text-align:" + align + "' id='value_' value='" + value + "'>");

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
</script>