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
                        <form action="<?php echo site_url('admin/rapor/') ?>" id="raporform" name="raporform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php
                                if ($this->session->flashdata('msg')) {
                                    echo $this->session->flashdata('msg');
                                }

                                echo $this->customlib->getCSRF();
                                ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Rapor Name</label><small class="req">*</small>
                                    <input autofocus="" id="roomCode" name="rapor_name" type="text" class="form-control" value="<?php echo set_value('room_code'); ?>" />
                                    <span class="text-danger"><?php echo form_error('rapor_name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Session</label><small class="req">*</small>
                                    <select name="session_id" class="form-control">
                                        <option selected disabled>Select Session</option>
                                        <?php
                                        foreach ($sessionList as $session) {
                                        ?>
                                            <option value="<?= $session['id'] ?>"><?= $session['session'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Session</label><small class="req">*</small>
                                    <select name="class_id" class="form-control">
                                        <option selected disabled>Class Session</option>
                                        <?php
                                        foreach ($classList as $class) {
                                        ?>
                                            <option value="<?= $class['id'] ?>"><?= $class['class'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
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
                        <h3 class="box-title titlefix"> Rapor List</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download-label">Rapor List</div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Rapor Name</th>
                                        <th>Session</th>
                                        <th>Class</th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($raporList as $rapor) {
                                    ?>
                                        <tr>
                                            <td class="mailbox-name"><?php echo $rapor['rapor_name'] ?></td>
                                            <td class="mailbox-name">
                                                <?php
                                                foreach ($sessionList as $session) {
                                                ?>
                                                    <?= $session['id'] == $rapor['session_id'] ? $session['session'] : '' ?>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td class="mailbox-name">
                                                <?php
                                                foreach ($classList as $class) {
                                                ?>
                                                    <?= $class['id'] == $rapor['class_id'] ? $class['class'] : '' ?>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td class="mailbox-date pull-right">
                                                <?php if ($this->rbac->hasPrivilege('rapor', 'can_edit')) { ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/rapor/add_subject/<?php echo $rapor['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('add_subject'); ?>"><i class="fa fa-plus"></i></a>
                                                <?php } ?>
                                                <?php if ($this->rbac->hasPrivilege('rapor', 'can_delete')) { ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/rapor/delete_rapor/<?php echo $rapor['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('This action will affect Subject Rapor too.')"><i class="fa fa-remove"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    $count++;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>