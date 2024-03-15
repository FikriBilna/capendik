<div class="content-wrapper">

    <section class="content-header">
        <h1><i class="fa fa-mortar-board"></i>Edit Nilai</h1>
    </section>

    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('room', 'can_add') || $this->rbac->hasPrivilege('room', 'can_edit')) {
            ?>

                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><u>Edit Nilai</u></h3>
                        </div>
                        <form action="<?php echo site_url('admin/nilaistudent/editNilai/' . $id) ?>" id="roomform" name="roomform" method="post" accept-charset="utf-8">
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
                                    <input type="text" class="form-control" value="<?= $student['firstname'] ?>" disabled>
                                    <span class="text-danger"><?php echo form_error('subject_id'); ?></span>
                                </div>
                                <input type="hidden" id="student_class_id" name="class_id" value="<?= $student['class_id'] ?>"></input>
                                <input type="hidden" id="student_sec_id" name="section_id" value="<?= $student['section_id'] ?>"></input>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('subject') . " " . $this->lang->line('group') ?></label><small class="req">*</small>
                                    <select name="subject_group_id" id="subject_group_id" class="form-control">
                                        <option value="<?php echo set_value('subject_id', $room['subject_id']); ?>" selected disabled></option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('subject_group_id'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Subject</label><small class="req">*</small>
                                    <select name="subject_id" class="form-control" id="subject_id">
                                        <option disabled selected>-pilih subject--</option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('lesson_id'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lesson</label><small class="req">*</small>
                                    <select name="lesson_id" class="form-control" id="lesson_id">
                                        <option disabled selected>--pilih lesson--</option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('lesson_id'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Topic</label><small class="req">*</small>
                                    <select name="topic_id" id="topic_id" class="form-control">
                                        <option disabled selected>--pilih topic--</option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('topic_id'); ?></span>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $type_nilai = [
                                        0 => 'Sumatif Lingkup Materi',
                                        1 => 'Sumatif Akhir Semester -Tes',
                                        2 => 'Sumatif Akhir Semester - Non Tes'
                                    ];
                                    ?>
                                    <label for="exampleInputEmail1">Jenis Nilai</label><small class="req">*</small>
                                    <?php foreach ($type_nilai as $key => $value) : ?>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input jenis_nilai" id="jenis_nilai<?= $key ?>" name="jenis_nilai" value="<?= $key ?>">
                                            <label class="form-check-label" for="jenis_nilai<?= $key ?>"><?= $value ?></label>
                                        </div>
                                    <?php endforeach ?>
                                    <span class="text-danger"><?php echo form_error('jenis_nilai'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sumatif</label><small class="req">*</small>
                                    <input type="text" class="form-control" name="sumatif">
                                    <span class="text-danger"><?php echo form_error('sumatif'); ?></span>
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
                        <h3 class="box-title titlefix">View Nilai</h3>
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
                                        <th>Subject</th>
                                        <th>Lesson</th>
                                        <th>Topic</th>
                                        <th>Jenis Nilai</th>
                                        <th>Sumati</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($listNilai as $list) {
                                    ?>
                                        <tr>
                                            <td><?= $list['subjectName'] ?></td>
                                            <td><?= $list['lessonName'] ?></td>
                                            <td><?= $list['topicName'] ?></td>
                                            <td>
                                                <?php
                                                if ($list['type_nilai'] == 0) {
                                                    echo "Sumatif Lingkup Materi";
                                                } elseif ($list['type_nilai'] == 1) {
                                                    echo "Sumatif Akhir Semester - Tes";
                                                } elseif ($list['type_nilai'] == 2) {
                                                    echo "Sumatif Akhir Semester - Non Tes";
                                                }
                                                ?>
                                            </td>
                                            <td><?= $list['sumatif'] ?></td>
                                            <td>
                                                <?php if ($this->rbac->hasPrivilege('rapor', 'can_edit')) { ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/nilaistudent/editnilai/<?php echo $list['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('edit_nilai'); ?>"><i class="fa fa-pencil"></i></a>
                                                <?php } ?>
                                                <?php if ($this->rbac->hasPrivilege('rapor', 'can_delete')) { ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/nilaistudent/delete/<?php echo $list['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('This action will affect delete nilai.')"><i class="fa fa-remove"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="6"><b>Final Score : </b><?= $finalScore ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function() {
        var class_id = $('#student_class_id').val();
        var section_id = $('#student_sec_id').val();
        getSubjectGroup(class_id, section_id, 0, 'subject_group_id');

        function getSubjectGroup(class_id, section_id, subjectgroup_id, subject_group_target) {
            if (class_id != "" && section_id != "") {

                $.ajax({
                    type: 'POST',
                    url: base_url + 'admin/nilaistudent/getGroupByClassandSection',
                    data: {
                        'class_id': class_id,
                        'section_id': section_id
                    },
                    beforeSend: function() {
                        $('#subject_group_id').html("").addClass('dropdownloading')
                    },
                    success: function(response) {
                        $('#subject_group_id').html(response).removeClass('dropdownloading');
                    }
                });
            }
        }


        $('#subject_group_id').change(function(e) {
            var subject_group_id = e.target.value;
            var student_class_id = $('#student_class_id').val();
            var student_sec_id = $('#student_sec_id').val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/nilaistudent/getSubject') ?>",
                data: {
                    subject_group_id: subject_group_id,
                },
                beforeSend: function() {
                    $('#subject_id').html("").addClass('dropdownloading')
                },
                success: function(response) {
                    $('#subject_id').html(response).removeClass('dropdownloading');
                }
            });
        })

        $('#subject_id').change(function(e) {
            var subject_id = e.target.value;
            var class_id = $('#student_class_id').val();
            var section_id = $('#student_sec_id').val();
            var subject_group_id = $('#subject_group_id').val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/nilaistudent/getLessonBySubject/') ?>" + subject_id,
                data: {
                    subjectid: subject_id,
                    class_id: class_id,
                    section_id: section_id,
                    subject_group_id: subject_group_id
                },
                beforeSend: function() {
                    $('#lesson_id').html("").addClass('dropdownloading')
                },
                success: function(response) {
                    $('#lesson_id').html(response).removeClass('dropdownloading');
                }
            });
        })

        $('#lesson_id').change(function(e) {
            var lesson_id = e.target.value;
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/nilaistudent/gettopic') ?>",
                data: {
                    id_lesson: lesson_id
                },
                beforeSend: function() {
                    $('#topic_id').html("").addClass('dropdownloading')
                },
                success: function(response) {
                    $('#topic_id').html(response).removeClass('dropdownloading');
                }
            });
        })

        $('.jenis_nilai').change(function(e) {
            var value = e.target.value;
            console.log(value);
            if (value == 1 || value == 2) {
                $('#lesson_id').html('').prop('disabled', true);
                $('#topic_id').html('').prop('disabled', true);
            } else {
                $('#lesson_id').prop('disabled', false);
                $('#topic_id').prop('disabled', false);
            }
        })
    });
</script>