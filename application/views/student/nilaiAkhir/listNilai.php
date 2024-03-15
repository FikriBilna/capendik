<div class="content-wrapper">

    <section class="content-header">
        <h1><i class="fa fa-mortar-board"></i>Add Nilai</h1>
    </section>

    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('student', 'can_add') || $this->rbac->hasPrivilege('student', 'can_edit')) {
            ?>
                <div class="col-md-3">
                    <div class="box box-primary" <?php if ($student["is_active"] == "no") {
                                                        echo "style='background-color:#f0dddd;'";
                                                    } ?>>
                        <div class="box-body box-profile">
                            <?php if ($sch_setting->student_photo) { ?>
                                <img class="profile-user-img img-responsive" src="<?php
                                                                                    if (!empty($student["image"])) {
                                                                                        echo base_url() . $student["image"];
                                                                                    } else {
                                                                                        if ($student['gender'] == 'Female') {
                                                                                            echo base_url() . "uploads/student_images/default_female.jpg";
                                                                                        } else {
                                                                                            echo base_url() . "uploads/student_images/default_male.jpg";
                                                                                        }
                                                                                    }
                                                                                    ?>" alt="User profile picture">
                            <?php } ?>
                            <h3 class="profile-username text-center"><?php echo $this->customlib->getFullName($student['firstname'], $student['middlename'], $student['lastname'], $sch_setting->middlename, $sch_setting->lastname); ?></h3>

                            <ul class="list-group list-group-unbordered">
                                <?php
                                if ($student['is_active'] == 'no') {
                                ?>
                                    <li class="list-group-item listnoback">
                                        <b><?php echo $this->lang->line('disable') . " " . $this->lang->line('reason') ?></b> <span class="pull-right text-aqua"><?php echo $reason_data['reason'] ?></span>
                                    </li>
                                    <li class="list-group-item listnoback">
                                        <b><?php echo $this->lang->line('disable') . " " . $this->lang->line('note') ?></b> <span class="pull-right text-aqua"><?php echo $student['dis_note'] ?></span>
                                    </li>
                                    <li class="list-group-item listnoback">
                                        <b><?php echo $this->lang->line('disable') . " " . $this->lang->line('date') ?></b> <span class="pull-right text-aqua"><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['disable_at'])); ?></span>
                                    </li>
                                <?php } ?>
                                <!-- NISN -->
                                <li class="list-group-item listnoback">
                                    <b>NIK</b> <a class="pull-right text-aqua"><?php echo $student['nik']; ?></a>
                                </li>
                                <li class="list-group-item listnoback">
                                    <b>NISN</b> <a class="pull-right text-aqua"><?php echo $student['nisn']; ?></a>
                                </li>
                                <li class="list-group-item listnoback">
                                    <b>Preferred Name</b> <a class="pull-right text-aqua"><?php echo $student['preferedname']; ?></a>
                                </li>
                                <li class="list-group-item listnoback">
                                    <b><?php echo $this->lang->line('admission_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['admission_no']; ?></a>
                                </li>
                                <li class="list-group-item listnoback">
                                    <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right text-aqua"><?php echo $student['class'] ?></a>
                                </li>
                                <li class="list-group-item listnoback">
                                    <b>Form</b> <a class="pull-right text-aqua"><?php echo $student['section']; ?></a>
                                </li>
                                <?php if ($sch_setting->rte) { ?>
                                    <li class="list-group-item listnoback">
                                        <b><?php echo $this->lang->line('rte'); ?></b> <a class="pull-right text-aqua"><?php echo $student['rte']; ?></a>
                                    </li>
                                <?php } ?>
                                <li class="list-group-item listnoback">
                                    <b><?php echo $this->lang->line('gender'); ?></b> <a class="pull-right text-aqua"><?php echo $this->lang->line(strtolower($student['gender'])); ?></a>
                                </li>
                            </ul>
                        </div>
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
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Jenis Nilai</th>
                                        <th>Nilai Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($listNilai as $list) {
                                    ?>
                                        <tr>
                                            <td><?= $list['subjectName'] ?></td>
                                            <td>
                                                <?php
                                                if ($list['jenis_nilai_akhir'] == 0) {
                                                    echo "Sumatif Lingkup Materi";
                                                } elseif ($list['type_nilai'] == 1) {
                                                    echo "Sumatif Akhir Semester - Tes";
                                                } elseif ($list['type_nilai'] == 2) {
                                                    echo "Sumatif Akhir Semester - Non Tes";
                                                }
                                                ?>
                                            </td>
                                            <td><?= $list['nilai_akhir'] ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer pull-right">
                            <a href="<?= base_url('admin/nilaiakhir/addNilai/' . $id) ?>" class="btn btn-primary">Tambah Nilai Akhir</a>
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