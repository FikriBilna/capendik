<div class="content-wrapper">

    <section class="content-header">
        <h1><i class="fa fa-mortar-board"></i>Add Nilai</h1>
    </section>

    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('room', 'can_add') || $this->rbac->hasPrivilege('room', 'can_edit')) {
            ?>

                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><u>Add Nilai</u></h3>
                        </div>
                        <form action="<?php echo site_url('admin/rapor/add_subject/') ?>" id="roomform" name="roomform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php
                                if ($this->session->flashdata('msg')) {
                                    echo $this->session->flashdata('msg');
                                }

                                echo $this->customlib->getCSRF();
                                ?>
                                <input type="hidden" name="student_id" value="">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Student</label><small class="req">*</small>
                                    <input type="text" class="form-control" value="<?= $student['firstname'] ?>">
                                    <span class="text-danger"><?php echo form_error('subject_id'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Subject</label><small class="req">*</small>
                                    <select name="subject_id" id="" class="form-control">
                                        <option value="">select subject</option>
                                        <?php
                                        foreach ($subject as $subject) {
                                        ?>
                                            <option value="<?= $subject['id'] ?>"><?= $subject['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('subject_id'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lession</label><small class="req">*</small>
                                    <input type="text" class="form-control">
                                    <span class="text-danger"><?php echo form_error('subject_id'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Topic</label><small class="req">*</small>
                                    <input type="text" class="form-control">
                                    <span class="text-danger"><?php echo form_error('subject_id'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jenis Nilai</label><small class="req">*</small>
                                    <input type="text" class="form-control">
                                    <span class="text-danger"><?php echo form_error('subject_id'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sumatif</label><small class="req">*</small>
                                    <input type="text" class="form-control">
                                    <span class="text-danger"><?php echo form_error('subject_id'); ?></span>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('add'); ?></button>
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
                        <h3 class="box-title titlefix">View Nilai</h3>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Student : <?= $student['firstname'] ?></h4>
                            </div>
                            <div class="col-md-6">
                                <h4>Class : <?= $student['class'] ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Lesson</th>
                                        <th>Topic</th>
                                        <th>Jenis Nilai</th>
                                        <th>Sumati</th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>