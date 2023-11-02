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
                            <h3 class="box-title"><u><?= $title ?></u></h3>
                        </div>
                        <div class="box-header">
                            <h3 class="box-title"><u>Rapor Name : <?= $raporName['rapor_name'] ?></u></h3>
                        </div>
                        <form action="<?php echo site_url('admin/rapor/add_subject/' . $rapor_id) ?>" id="roomform" name="roomform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php
                                if ($this->session->flashdata('msg')) {
                                    echo $this->session->flashdata('msg');
                                }

                                echo $this->customlib->getCSRF();
                                ?>
                                <input type="hidden" name="rapor_id" value="<?= $rapor_id ?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Subject</label><small class="req">*</small>
                                    <select name="subject_id" id="" class="form-control">
                                        <option selected disabled>Select subject</option>
                                        <?php
                                        foreach ($subjects as $subject) {
                                        ?>
                                            <option value="<?= $subject['id'] ?>"><?= $subject['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('subject_id'); ?></span>
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
                        <h3 class="box-title titlefix">List Subject (<?= $raporName['rapor_name'] ?>)</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($raporSubjects as $raporSubject) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php
                                                foreach ($subjects as $subject) {
                                                ?>
                                                    <?= $subject['id'] == $raporSubject['subject_id'] ? $subject['name'] : '' ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($this->rbac->hasPrivilege('rapor', 'can_edit')) { ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/rapor/add_weightage/<?php echo $raporSubject['id']; ?>?aksi=<?php echo $rapor_id; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('add_weightage'); ?>"><i class="fa fa-plus"></i></a>
                                                <?php } ?>
                                                <?php if ($this->rbac->hasPrivilege('rapor', 'can_delete')) { ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/rapor/delete_subject/<?php echo $raporSubject['id']; ?>?aksi=<?php echo $rapor_id; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('This action will affect Rapor Weightage too.')"><i class="fa fa-remove"></i></a>
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