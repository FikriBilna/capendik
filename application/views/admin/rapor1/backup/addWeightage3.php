<div class="content-wrapper">

    <section class="content-header">
        <h1><i class="fa fa-mortar-board"></i>Rapor List</h1>
    </section>

    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('room', 'can_add') || $this->rbac->hasPrivilege('room', 'can_edit')) {
            ?>

                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Weightage</h3>
                        </div>
                        <div class="alert alert-danger hide" id="alert" role="alert">
                            Total Percent Must be 100 %
                        </div>
                        <form action="<?php echo site_url('admin/rapor/add_weightage/' . $id) ?>" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php
                                if ($this->session->flashdata('msg')) {
                                    echo $this->session->flashdata('msg');
                                }

                                echo $this->customlib->getCSRF();
                                ?>
                                <input type="hidden" name="rapor_subject_id" value="<?= $id ?>">
                                <input type="hidden" name="subject_id" value="<?= $_GET['aksi'] ?>">
                                <div class="table-responsive">
                                    <table class="table" id="table">
                                        <tr>
                                            <th>Weightage Name</th>
                                            <th>Weightage</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="inputs[0][weightage_id]" id="" class="form-control name_list" required>
                                                    <option value="" selected disabled>-- Select Weightage --</option>
                                                    <?php foreach ($weightageList as $weightage) : ?>
                                                        <option value="<?= $weightage['id'] ?>"><?= $weightage['weightage_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <small class="text-danger"><?php echo form_error('inputs[0][weightage_id]'); ?></small>
                                            </td>
                                            <td>
                                                <input type="number" name="inputs[0][weightage_score]" placeholder="Enter Weightage" class="form-control name_list" required="" id="score" />
                                                <small class="text-danger"><?php echo form_error('inputs[0][weightage_score]'); ?></small>
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="container">
                                        Presentase : <span id="hasil"></span>%
                                    </div>
                                    <div class="pull-right">
                                        <button type="button" name="add" id="add" class="btn btn-success btn-sm">Add More</button>
                                        <button type="submit" name="submit" id="submit" class="btn btn-info">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            <?php } ?>
            <div class="col-md-<?php if ($this->rbac->hasPrivilege('room', 'can_add') || $this->rbac->hasPrivilege('room', 'can_edit')) {
                                    echo "8";
                                } else {
                                    echo "12";
                                } ?>">
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Weightage List <?= $subjectName['name'] ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download-label">Weightage List</div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Weightage Name</th>
                                        <th>Weightage Score</th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($subjectWeightage as $item) {
                                    ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <?php
                                                foreach ($weightageList as $weightage) {
                                                ?>
                                                    <?= $weightage['id'] == $item['weightage_id'] ? $weightage['weightage_name'] : '' ?>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td class="mailbox-name">
                                                <?= (int)$item['weightage_score'] ?>
                                            </td>
                                            <td class="mailbox-date pull-right">
                                                <?php if ($this->rbac->hasPrivilege('rapor', 'can_delete')) { ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/rapor/delete_weightage/<?php echo $item['id'] ?>?subject=<?php echo $id; ?>?aksi=<?= $_GET['aksi'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('This action will affect Subject Rapor too.')"><i class="fa fa-remove"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        updateHasil();
    });

    var i = 0;
    $('#add').click(function() {
        ++i;
        $('#table').append(
            `<tr>
                <td>
                <select name="inputs[` + i + `][weightage_id]"id="" class="form-control name_list" required>
                                                    <option selected disabled>-- Select Weightage --</option>
                                                    <?php
                                                    foreach ($weightageList as $weightage) {
                                                    ?>
                                                        <option value="<?= $weightage['id'] ?>"><?= $weightage['weightage_name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                </td>
                <td>
                    <input type="number" name="inputs[` + i + `][weightage_score]" placeholder="Enter your Name" class="form-control name_list" required="" id="score"/>
                </td>
                <td>
                    <button type="button" class="remove-table-row" border="0">-</button>
                </td>
            </tr>`
        );
    });

    // untuk handle jika score = 100 atau lebih
    $('#table').on('input', 'input[type="number"]', function() {
        updateHasil();
    });

    function updateHasil() {
        var totalScore = 0;
        $('input[name*="[weightage_score]"]').each(function() {
            var score = parseFloat($(this).val()) || 0;
            totalScore += score;
        });

        $('#hasil').text(totalScore);
        if (totalScore > 100) {
            $('#add').hide();
            $('#submit').hide();
            $('.alert').removeClass('hide');
        } else {
            $('#add').show();
            $('#submit').show();
            $('.alert').addClass('hide');
        }
    }

    $(document).on('click', '.remove-table-row', function() {
        $(this).parents('tr').remove();
        updateHasil();
    });
</script>