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
                        <form action="<?php echo site_url('admin/nilaistudent/addnilai/' . $id) ?>" id="roomform" name="roomform" method="post" accept-charset="utf-8">
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
                                    <!-- <?php //print_r ($subjectGroup); ?> -->
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('subject') . " " . $this->lang->line('group') ?></label><small class="req">*</small>
                                    <select name="subject_group_id" id="subject_group_id" class="form-control">
                                        <option value="" selected disabled><?php echo $this->lang->line('select') ?></option>
                                    </select>
                                    <span class="section_id_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Subject</label><small class="req">*</small>
                                    <select name="subject_id" id="subject_id" class="form-control">
                                        <option selected disabled><?php echo $this->lang->line('select') ?></option>
                                        <?php
                                        // foreach ($subject as $subject) {
                                        ?>
                                            <!-- <option value="<?= $subject['id'] ?>"><?= $subject['name'] ?></option> -->
                                        <?php
                                        // }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('subject_id'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lesson</label><small class="req">*</small>
                                    <select name="lesson_id" class="form-control" id="lesson_id">
                                        <option disabled selected><?php echo $this->lang->line('select') ?></option>
                                        <?php //foreach ($lessons as $lesson) : ?>
                                            <!-- <option value="<?= $lesson['id'] ?>"><?= $lesson['name'] ?></option> -->
                                        <?php //endforeach; ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('lesson_id'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Topic</label><small class="req">*</small>
                                    <select name="topic_id" id="topic_id" class="form-control">
                                        <option disabled selected>Select</option>
                                        <?php //foreach ($topic as $topic) : ?>
                                            <!-- <option value="<?= $topic['id'] ?>"><?= $topic['name'] ?></option> -->
                                        <?php //endforeach; ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('topic_id'); ?></span>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $type_nilai = ['Sumatif Lingkup Materi', 'Sumatif Akhir Semester - Tes', 'Sumatif Akhir Semester - Non Tes'];
                                    ?>
                                    <label for="exampleInputEmail1">Jenis Nilai</label><small class="req">*</small>
                                    <?php
                                    foreach ($type_nilai as $type_nilai) {
                                    ?>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio1" name="jenis_nilai" value="<?= $type_nilai ?>"><?= $type_nilai ?>
                                            <label class="form-check-label" for="radio1"></label>
                                        </div>
                                    <?php
                                    }
                                    ?>
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
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Student : <?= $student['firstname'] ?></h4>
                            </div>
                            <div class="col-md-3">
                                <h4>Class : <?= $student['class'] ?></h4>
                            </div>
                            <div class="col-md-3">
                                <h4>Form : <?= $student['section'] ?></h4>
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
                                            <td><?= $list['type_nilai'] ?></td>
                                            <td><?= $list['sumatif'] ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="5"><b>Final Score : </b><?= $finalScore ?></td>
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

        $('#lesson_id').change(function() {
            var lesson_id = $(this).val();
            var div_data = '<option value="" disabled selected><?php echo $this->lang->line('select'); ?></option>';
            console.log(lesson_id);
            $.ajax({
                type: "POST",
                // url: "<?= base_url('admin/NilaiStudent/getTopic') ?>",
                url : base_url + "admin/nilaistudent/getTopic/" + lesson_id,
                data: {
                    "lesson_id": lesson_id,
                },
                dataType: "json",
                beforeSend: function () {
                $('#lessonid').addClass('dropdownloading');
                },
                success: function(data) {
                    console.log(data);
                    // Clear existing options
                    $('#topic_id').empty();

                    $.each(data, function(index, topic) {
                        div_data += "<option value=" +topic.id+ ">" +topic.name+ "</option>";
                        // $('#topic_id').append('<option value="' + topic['id'] + '">' + topic['name'] + '</option>');
                    });
                     $('#topic_id').append(div_data);
                },
                complete: function () {
                $('#lessonid').removeClass('dropdownloading');
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        var class_id = $('#student_class_id').val();
        var section_id = $('#student_sec_id').val();
        getSubjectGroup(class_id, section_id, 0, 'subject_group_id');

        function getSubjectGroup(class_id, section_id, subjectgroup_id, subject_group_target){
            if (class_id != "" && section_id != ""){
                var div_data = '<option value="" disabled selected><?php echo $this->lang->line('select'); ?></option>';

                $.ajax({
                    type : 'POST',
                    url : base_url + 'admin/subjectgroup/getGroupByClassandSection',
                    data : {'class_id' : class_id, 'section_id' : section_id},
                    dataType : 'JSON',
                    beforeSend : function(){
                        $('#' + subject_group_target).html("").addClass('dropdownloading');
                    },
                    success: function (data){
                        // console.log(data);
                        $.each(data, function (i, obj){
                            var sel = "";
                            if(subjectgroup_id == obj.subject_group_id){
                                sel = "selected";
                            }
                            div_data += "<option value=" + obj.subject_group_id + " " + sel + ">" + obj.name + "</option>";
                        });
                        $('#' + subject_group_target).append(div_data);
                    },
                    error: function (xhr) { // if error occured
                    alert("Error occured.please try again");
                    },
                    complete: function () {
                        $('#' + subject_group_target).removeClass('dropdownloading');
                    }
                });
            }
        }
        
        $('#subject_group_id').change(function() {
            var subject_group_id = $(this).val();

            getsubjectBySubjectGroup(class_id, section_id, subject_group_id, 0, 'subject_id');
        });

        function getsubjectBySubjectGroup(class_id, section_id, subject_group_id, subject_group_subject_id, subject_target){
            if(class_id != "" && section_id != "" && subject_group_id != ""){
                var div_data = '<option value="" disabled selected><?= $this->lang->line('select') ?></option>';

                $.ajax({
                    type : 'POST',
                    url : base_url+'admin/subjectgroup/getGroupsubjects',
                    data : {'subject_group_id' : subject_group_id},
                    dataType : 'JSON',
                    beforeSend : function(){
                        $('#'+ subject_target).html("").addClass('dropdownloading');
                    },
                    success : function(data){
                        console.log(data);
                        $.each(data, function(i, obj){
                            var sel ="";
                            if(subject_group_subject_id == obj.id){
                                sel = "selected";
                            }
                            div_data += "<option value=" + obj.id + " " + sel + ">" + obj.name + "</option>";
                        });
                        $('#' + subject_target).append(div_data);
                    },
                    error : function (xhr){
                        alert("Error occured. Please try again");
                    },
                    complete : function(){
                        $('#' + subject_target).removeClass('dropdownloading');
                    }
                });
            }
        }

        $('#subject_id').change(function(){
            $('#lesson_id').html('');
            var div_data = '<option value="" disabled selected><?php echo $this->lang->line('select'); ?></option>';
            var subject_id = $('#subject_id').val();
            var class_id = $('#student_class_id').val();
            var section_id = $('#student_sec_id').val();
            var subject_group_id = $('#subject_group_id').val();
            $.ajax({
                type : "POST",
                url : base_url + "admin/lessonplan/getlessonBysubjectid/" + subject_id,
                data : {'subjectid' : subject_id, 'class_id' : class_id, 'section_id' : section_id, 'subject_group_id' : subject_group_id },
                dataType : "JSON",
                beforeSend : function(){
                    // console.log(data);
                    $('#lesson_id').addClass('dropdownloading');
                },
                success : function(data){
                    console.log(data);
                    $.each(data, function(i, obj){
                        div_data += "<option value=" + obj.id + ">" + obj.name + "</option>";
                    });
                    $('#lesson_id').append(div_data);
                },
                complete : function (){
                    $('#lesson_id').removeClass('dropdownloading');
                }
            });
        });
        
    });
</script>