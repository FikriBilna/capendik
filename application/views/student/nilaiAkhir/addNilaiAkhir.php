<div class="content-wrapper">

    <section class="content-header">
        <h1><i class="fa fa-mortar-board"></i>Student : </h1>
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
                        <form action="#" id="nilaiakhirform" name="roomform" accept-charset="utf-8">
                            <div class="box-body">
                                <?php
                                if ($this->session->flashdata('msg')) {
                                    echo $this->session->flashdata('msg');
                                }

                                echo $this->customlib->getCSRF();
                                ?>
                                <input type="hidden" value="<?= $student['id'] ?>" name="student_id" id="id_student">
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
                                        <option value="" selected disabled><?php echo $this->lang->line('select') ?></option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('subject_group_id'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Subject</label><small class="req">*</small>
                                    <select name="subject_id" class="form-control" id="subject_id">
                                        <option value="" selected disabled><?php echo $this->lang->line('select') ?></option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('subject_id'); ?></span>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $type_nilai = [
                                        0 => 'Sumatif Lingkup Materi',
                                        1 => 'Sumatif Akhir Semester',
                                    ];
                                    ?>
                                    <label for="exampleInputEmail1">Jenis Nilai</label><small class="req">*</small>
                                    <?php foreach ($type_nilai as $key => $value) : ?>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input jenis_nilai" id="jenis_nilai" name="jenis_nilai" value="<?= $key ?>">
                                            <label class="form-check-label" for="jenis_nilai"><?= $value ?></label>
                                        </div>
                                    <?php endforeach ?>
                                    <span class="text-danger"><?php echo form_error('jenis_nilai'); ?></span>
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
                    <div class="container-fluid">
                        <h3>List Nilai</h3>
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
                                <tbody id="listNilai">

                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer pull-right">
                            <button id="proses" class="btn btn-primary">Proses Nilai Akhir</button>
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
        var student_id = $('#id_student').val();
        getSubjectGroup(class_id, section_id, 0, 'subject_group_id');

        function getSubjectGroup(class_id, section_id, subjectgroup_id, subject_group_target) {
            if (class_id != "" && section_id != "") {

                $.ajax({
                    type: 'POST',
                    url: base_url + 'admin/nilaiakhir/getGroupByClassandSection',
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

        $('#proses').click(function(e) {
            e.preventDefault();
            var id_nilai = []
            $('input:checkbox[name=id_nilai]:checked').each(function() {
                id_nilai.push($(this).val())
            })
            if (id_nilai.length > 0) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('admin/nilaiakhir/prosesNilai') ?>",
                    data: {
                        id_nilai: id_nilai
                    },
                    beforeSend: function() {
                        $('#proses').html("").addClass('dropdownloading')
                    },
                    success: function(response) {
                        window.location.href = "<?= base_url('admin/nilaiakhir/listnilaistudent/') ?>" + student_id
                    }
                });
            } else {
                alert('Pilih salah satu untuk melanjutkan proses');
                return;
            }
        });


        $('#subject_group_id').change(function(e) {
            var subject_group_id = e.target.value;
            var student_class_id = $('#student_class_id').val();
            var student_sec_id = $('#student_sec_id').val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/nilaiakhir/getSubject') ?>",
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

        $('#nilaiakhirform').submit(function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                type: "GET",
                url: "<?php echo site_url('admin/nilaiakhir/getNilai/'); ?>",
                data: formData,
                success: function(response) {
                    $('#listNilai').html(response);
                },
                error: function(xhr, status, error) {
                    // console.log('AJAX Request Error:', status, error);
                    // console.log('Response Text:', xhr.responseText);
                }
            });
        });

    });
</script>