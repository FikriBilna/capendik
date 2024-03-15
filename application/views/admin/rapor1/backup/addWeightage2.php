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
                            <h3 class="box-title">Add Room</h3>
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
                                                <input type="text" name="inputs[0][weightage_name]" placeholder="Enter Weightage Name" class="form-control name_list" required="" />
                                            </td>
                                            <td>
                                                <input type="text" name="inputs[0][weightage]" placeholder="Enter Weightage" class="form-control name_list" required="" />
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                    </table>
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
                        <h3 class="box-title titlefix"> Weightage List</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download-label">Weightage List</div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Weightage Name</th>
                                        <th>Weightage</th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($subjectWeightage as $item) {
                                    ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <?= $item['weightage_name'] ?>
                                            </td>
                                            <td class="mailbox-name">
                                                <?= $item['weightage'] ?>
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
    var i = 0;
    $('#add').click(function() {
        ++i;
        $('#table').append(
            `<tr>
                <td>
                    <input type="text" name="inputs[` + i + `][weightage_name]" placeholder="Enter your Name" class="form-control name_list" required="" />
                </td>
                <td>
                    <input type="text" name="inputs[` + i + `][weightage]" placeholder="Enter your Name" class="form-control name_list" required="" />
                </td>
                <td>
                    <button type="button" class="remove-table-row" border="0">-</button>
                </td>
            </tr>`
        );
    });

    $(document).on('click', '.remove-table-row', function() {
        $(this).parents('tr').remove();
    });
</script>