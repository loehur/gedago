<?php
$menu = $data['grup'];
$produk_id = $data['produk']['produk_id'];
$produk_name = $data['produk']['produk'];
$produk_grup = $data['produk']['grup'];
$produk_grup_name = "";
$vg1_id = $data['vg1_id'];

if (isset($data['gid'])) {
    $v2_head = $this->db(0)->get_where("v2_head", "vg2_id = " . $data['gid']);
} else {
    $v2_head = [];
}

$grup_list = $this->model("D_Group")->main();
foreach ($grup_list as $k => $m) {
    if ($k == $produk_grup) {
        $produk_grup_name = $m['name'];
    }
}
?>

<div class="container mb-3 pt-2" style="min-height: 300px;">
    <h6 class="pb-2">
        <b><a class="border rounded px-2 me-1 border-warning" href="<?= PC::BASE_URL ?>Produk/index/<?= $produk_grup ?>"><?= $produk_grup_name ?></a></b>
        <b><a class="border rounded px-2 me-1 border-warning" href="<?= PC::BASE_URL ?>Varian1/index/<?= $produk_id ?>"><?= $produk_name ?></a></b>
        <b class="text-secondary"><?= isset($data['v1']['varian']) ? $data['v1']['varian'] : "" ?></b>
    </h6>
    <nav>
        <label class="mb-1"><small><b>Head</b> | Varian 2</small></label>
        <table class="p-0 mb-2">
            <tr>
                <?php
                foreach ($menu as $m) {
                ?>
                    <td>
                        <span class="cell_edit me-2" data-tb="varian_grup_2" data-primary="vg2_id" data-id="<?= $m['vg2_id'] ?>" data-col="vg" data-tipe="text"><?= $m['vg'] ?></span>
                    </td>
                <?php
                } ?>
            </tr>
        </table>
        <ul class="nav nav-tabs">
            <?php
            foreach ($menu as $m) {
                $parse = [
                    "v1_id" => $data['v1']['varian_id'],
                    "vg1_id" => $data['vg1_id'],
                    "produk_id" => $produk_id
                ];
                $parse = serialize($parse);
                $parse = base64_encode($parse);
            ?>
                <li class="nav-item">
                    <a id="h<?= $m['vg2_id'] ?>" class="nav-link <?= ($m['vg2_id'] == $data['gid']) ? 'active' : '' ?>" href="<?= PC::BASE_URL . $con ?>/index/<?= $parse ?>/<?= $m['vg2_id'] ?>"><?= $m['vg'] ?></a>
                </li>
            <?php
            } ?>
            <li class="nav-item py-2">
                <span class="px-2 text-primary" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal202"><small>Head (+)</small></span>
            </li>
        </ul>
    </nav>
    <div class="border p-2 pt-2 border-top-0">
        <?php if (count($menu) > 0) { ?>
            <table class="mb-0 table table-sm" style="font-size: small;">
                <tr>
                    <th></th>
                    <th><span class="text-primary" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal"><small>Varian (+)</small></span></th>
                    <th class="text-end">Harga</th>
                    <th>Img</th>
                    <th class="text-end">Berat</th>
                    <th class="text-end">P</th>
                    <th class="text-end">L</th>
                    <th class="text-end">T</th>
                </tr>
                <?php
                foreach ($data['varian2'] as $dp) {
                    $varian = "";
                    $attr = 'class="cell_edit" data-tb="varian_2" data-primary="varian_id" data-id="' . $dp['varian_id'] . '"';
                    foreach ($v2_head as $vh) {
                        if ($vh['v2_head_id'] == $dp['v2_head_id']) {
                            $varian = $vh['v2_head'];
                        }
                    } ?>
                    <tr>
                        <td>
                            <span class="cell_delete" data-tb="varian_2" data-primary="varian_id" data-id="<?= $dp['varian_id'] ?>"><i class="fa-regular fa-trash-can"></i></span>
                        </td>
                        <td>
                            <span class="cell_edit" data-tb="v2_head" data-primary="v2_head_id" data-id="<?= $dp['v2_head_id'] ?>" data-col="v2_head" data-tipe="text"><?= $varian ?></span>
                        </td>
                        <td class="text-end">
                            <span <?= $attr ?> data-col="harga" data-tipe="number"><?= $dp['harga'] ?></span>
                        </td>
                        <td>
                            <span <?= $attr ?> data-col="img" data-tipe="text"><?= $dp['img'] == '' ? "_" : $dp['img'] ?></span>
                        </td>
                        <td class="text-end">
                            <span <?= $attr ?> data-col="berat" data-tipe="number"><?= $dp['berat'] ?></span>
                        </td>
                        <td class="text-end">
                            <span <?= $attr ?> data-col="p" data-tipe="number"><?= $dp['p'] ?></span>
                        </td>
                        <td class="text-end">
                            <span <?= $attr ?> data-col="l" data-tipe="number"><?= $dp['l'] ?></span>
                        </td>
                        <td class="text-end">
                            <span <?= $attr ?> data-col="t" data-tipe="number"><?= $dp['t'] ?></span>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    </div>
</div>

<div class="modal" id="exampleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Tambah Varian</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="ajax" action="<?= PC::BASE_URL ?>Varian2/tambah/<?= $data['gid'] ?>/<?= $data['v1']['varian_id'] ?>" method="POST">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col">
                            <label>Varian</label>
                            <input list="varian_list" required type="text" class="form-control form-control-sm shadow-none" name="varian">

                            <datalist id="varian_list">
                                <?php
                                if (isset($data['gid'])) {
                                    $cek = $this->db(0)->get_where("v2_head", "vg2_id = " . $data['gid']);
                                    foreach ($cek as $vr) { ?>
                                        <option value="<?= $vr['v2_head'] ?>">
                                    <?php }
                                } ?>
                            </datalist>
                        </div>
                        <div class="col">
                            <label>Harga</label>
                            <input required type="number" min="0" value="0" class="form-control form-control-sm shadow-none" name="harga">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label>Image</label>
                            <input type="text" class="form-control form-control-sm shadow-none" name="image">
                        </div>
                        <div class="col">
                            <label>Berat (gram)</label>
                            <input required type="number" min="0" value="0" class="form-control form-control-sm shadow-none" name="berat">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label>Panjang (cm)</label>
                            <input required type="number" min="0" value="0" class="form-control form-control-sm shadow-none" name="p">
                        </div>
                        <div class="col">
                            <label>Lebar (cm)</label>
                            <input required type="number" min="0" value="0" class="form-control form-control-sm shadow-none" name="l">
                        </div>
                        <div class="col">
                            <label>Tinggi (cm)</label>
                            <input required type="number" min="0" value="0" class="form-control form-control-sm shadow-none" name="t">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="exampleModal202" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Tambah Varian</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="ajax" action="<?= PC::BASE_URL ?>Varian2/tambah_head/<?= $vg1_id ?>" method="POST">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col">
                            <label>Head Varian 2</label>
                            <input required type="text" class="form-control form-control-sm shadow-none" name="name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        device();
        spinner(0);
    });

    $("form.ajax").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr("method"),
            success: function(res) {
                if (res == 0) {
                    $(".btn-close").click();
                    reload_content();
                } else {
                    alert(res);
                }
            },
        });
    });

    $(".cell_delete").dblclick(function() {
        var id = $(this).attr('data-id');
        var primary = $(this).attr('data-primary');
        var tb = $(this).attr('data-tb');

        $.ajax({
            url: '<?= PC::BASE_URL ?>Functions/deleteCell',
            data: {
                'id': id,
                'primary': primary,
                'tb': tb
            },
            type: 'POST',
            dataType: 'html',
            success: function(res) {
                reload_content();
            },
        });
    });

    var click = 0;
    $(".cell_edit").on('dblclick', function() {
        click = click + 1;
        if (click != 1) {
            return;
        }

        var id = $(this).attr('data-id');
        var primary = $(this).attr('data-primary');
        var col = $(this).attr('data-col');
        var tb = $(this).attr('data-tb');
        var tipe = $(this).attr('data-tipe');
        var value = $(this).html();
        var value_before = value;
        var el = $(this);
        var width = el.parent().width();
        var align = "left";
        if (tipe == "number") {
            align = "right";
        }

        el.parent().css("width", width);

        el.html("<input required type=" + tipe + " style='outline:none;border:none;width:" + width + ";text-align:" + align + "' id='value_' value='" + value + "'>");

        $("#value_").focus();
        $("#value_").focusout(function() {
            var value_after = $(this).val();
            if (value_after === value_before) {
                el.html(value);
                click = 0;
            } else {
                $.ajax({
                    url: '<?= PC::BASE_URL ?>Functions/updateCell',
                    data: {
                        'id': id,
                        'value': value_after,
                        'col': col,
                        'primary': primary,
                        'tb': tb
                    },
                    type: 'POST',
                    dataType: 'html',
                    success: function(res) {
                        click = 0;
                        reload_content();
                    },
                });
            }
        });
    });
</script>