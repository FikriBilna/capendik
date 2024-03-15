<div class="content-wrapper">

    <section class="content-header">
        <h1><i class="fa fa-mortar-board"></i>Add Nilai Ekstrakurikuler</h1>
    </section>

    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('ekstrakurikuler', 'can_add') || $this->rbac->hasPrivilege('ekstrakurikuler', 'can_edit')) {
            ?>

                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><u>Add Nilai Ekstrakurikuler</u></h3>
                        </div>
                        <form action="<?php echo site_url('admin/ekstrakurikuler/addNilaiEkskul/'. $id) ?>" id="roomform" name="roomform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php
                                if ($this->session->flashdata('msg')) {
                                    echo $this->session->flashdata('msg');
                                }

                                echo $this->customlib->getCSRF();
                                ?>
                                <input type="hidden" value="<?= $student['id'] ?>" name="student_id">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Student</label><small class="req">*</small>
                                    <input type="text" class="form-control" value="<?php echo $student['firstname']." ".$student['lastname']; ?>" disabled>
                                    <span class="text-danger"><?php echo form_error('subject_id'); ?></span>
                                </div>
                                <input type="hidden" id="student_class_id" name="class_id" value="<?= $student['class_id'] ?>"></input>
                                <input type="hidden" id="student_sec_id" name="section_id" value="<?= $student['section_id'] ?>"></input>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ekstrakurikuler</label><small class="req">*</small>
                                    <select name="ekskul_id" id="ekskul_id" class="form-control">
                                        <option value="" selected disabled><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                            foreach($ekskul as $el){
                                        ?>
                                        <option value="<?= $el['id'] ?>"><?= $el['name'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Keterangan</label><small class="req">*</small>
                                    <textarea name="ekskul_ket" id="ekskul_ket" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                                <div class="box-footer">
                                    <a href="<?= base_url('admin/nilaistudent') ?>" class="btn btn-primary"><?php echo $this->lang->line('back'); ?></a>
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
                        <h3 class="box-title titlefix">View Nilai Ekstrakurikuler</h3>
                    </div>
                    <div class="slide-row">
                        <?php
                        if (empty($student["image"])) {
                            if ($student['gender'] == 'Female') {
                                $image = "uploads/student_images/default_female.jpg";
                            } else {
                                $image = "uploads/student_images/default_male.jpg";
                            }
                        } else {
                            $image = $student['image'];
                        }
                        ?>
                        <div id="carousel-2" class="carousel slide slide-carousel" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <a href="<?php echo base_url(); ?>student/view/<?php $student['id'] ?>">
                                        <img class="img-responsive img-thumbnail width150" alt="<?php echo $student["firstname"] . " " . $student["lastname"] ?>" src="<?php echo base_url() . $image; ?>" alt="Image"></a>
                                </div>
                            </div>
                        </div>
                        <div class="slide-content">
                            <h4><a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>"></a></h4>
                            <div class="row">
                                <div class="col-xs-6 col-md-6">
                                    <address>
                                        <strong><b><?php echo $this->lang->line('name'); ?>: </b><?php echo $student['firstname'] . ' ' . $student['lastname'] ?></strong><br>
                                        <b><?php echo $this->lang->line('class'); ?>: </b><?php echo $student['class'] ?><br />
                                        <b><?php echo $this->lang->line('group'); ?>: </b><?php echo $student['section'] ?><br />
                                        <b><?php echo $this->lang->line('admission_no'); ?>: </b><?php echo $student['admission_no'] ?><br />
                                    </address>
                                </div>                            
			    </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Session</th>
                                        <th>Ekstrakurikuler</th>
                                        <th>Code</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($nilaiEkskul as $list) {
                                        ?>
                                            <tr>
                                                <td><?= $list['session'] ?></td>
                                                <td><?= $list['ekskul_name'] ?></td>
                                                <td><?= $list['ekskul_code'] ?></td>
                                                <td><?= $list['ket'] ?></td>
                                                <td>
                                                    <?php if ($this->rbac->hasPrivilege('ekstrakurikuler', 'can_delete')) { ?>
                                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/ekstrakurikuler/delnilaiekskul/<?php echo $list['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('This action will affect Rapor.')"><i class="fa fa-remove"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
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