<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Tambah Nilai Rapor </h3>
                    </div>
                    <form action="<?php echo site_url('admin/nilairapor/prosesnilairapor/'.$id) ?>" id="form1" name="form1" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body box-profile">
                            <?php 
                                if($this->session->flashdata('msg')){
                                    echo $this->session->flashdata('msg');
                                }
                                echo $this->customlib->getCSRF();
                            ?>
                            <input type="hidden" value="<?= $student['id'] ?>" name="student_id">
                            <div class="form-group">
                                <label for="exampleInputEmail">Student</label><small class="req">*</small>
                                <input type="text" class="form-control" value="<?php echo $student['firstname']." ".$student['lastname']; ?>" disabled>
                            </div>
                            <input type="hidden" id="student_class_id" name="class_id" value="<?= $student['class_id'] ?>"></input>
                            <input type="hidden" id="student_sec_id" name="section_id" value="<?= $student['section_id'] ?>"></input>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('subject') . " " . $this->lang->line('group') ?></label><small class="req">*</small>
                                <select name="subject_group_id" id="subject_group_id" class="form-control">
                                    <option value="" selected disabled><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="text-danger"><?php echo form_error('subject_group_id'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Subject</label><small class="req">*</small>
                                <select name="subject_id" class="form-control" id="subject_id">
                                    <option disabled selected><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="text-danger"><?php echo form_error('lesson_id'); ?></span>
                            </div>
                            <div class="box-footer">
                                <a href="<?= base_url('admin/nilairapor') ?>" class="btn btn-primary"><?php echo $this->lang->line('back'); ?></a>
                                <button type="submit" class="btn btn-info pull-right" name="submit1" value="submit1"><?php echo $this->lang->line('submit'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box box-primary">
                    <form action="<?php echo site_url('admin/nilairapor/savenilairapor') ?>" id="form2" name="form2" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $student['id'] ?>" name="student_id">
                    <?php if(isset($subject_group_subjects_id)){ ?>
                    <input type="hidden" value="<?= $subject_group_subjects_id ?>" name="subject_group_subjects_id">
                    <?php } ?>
                    <div class="box-body box-profile">
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix">Proses Nilai Rapor</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive mailbox-message">
                                <table class="table table-striped table-bordered table-hover ">
                                    <thead>
                                        <th>Subject</th>
                                        <th>Jennis Nilai Akhir</th>
                                        <th>Nilai Akhir</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $inv = 'display:none;';
                                        if(isset($nilai_akhir)){
                                            $inv = 'display:block';
                                            foreach($nilai_akhir as $na){
                                    ?>
                                        <tr>
                                            <td><?= $na['subjectName'] ?></td>
                                            <td><?= ($na['jenis_nilai_akhir'] == '0') ? "Sumatif Lingkup Materi" : (($na['jenis_nilai_akhir'] == '1') ? "Sumatif Akhir Semester" : "-"); ?></td>
                                            <td><?= $na['nilai_akhir'] ?></td>
                                            <td style="text-align: center;"><input type="checkbox" name="cb[]" value="<?= $na['nilai_akhir'] ?>"></td>
                                        </tr>
                                    <?php
                                            }
                                        }else{
                                    ?>
                                    <td colspan="4" style="text-align: center;">Please Select Subject Group and Subject</td>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-boy col-md-4" style="<?= $inv ?>">
                                <div class="form-group">
                                    <label for="deskpen">Deskripsi Pencapaian Kompetensi</label><small class="req">*</small>
                                    <textarea name="deskpen" id="deskpen" cols="50" rows="6" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="raporname">Rapor Name</label><small class="req">*</small>
                                    <select name="raporname" id="raporname" class="form-control">
                                        <option value="" disabled><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                            foreach($raporname as $rn){
                                        ?>
                                        <option value="<?= $rn['id'] ?>"><?= $rn['rapor_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer pull-right">
                            <button type="submit" class="btn btn-info pull-right" name="submit2" value="submit2" style="<?= $inv ?>"><?php echo $this->lang->line('submit'); ?></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function(){
        var class_id = $('#student_class_id').val();
        var section_id = $('#student_sec_id').val();
        getSubjectGroup(class_id, section_id, 0, 'subject_group_id');

        function getSubjectGroup(class_id, section_id, subjectgroup_id, subject_group_target){
            if(class_id != "" && section_id != ""){

                $.ajax({
                    type: 'POST',
                    url: base_url + 'admin/nilairapor/getGroupByClassandSection',
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
                url: "<?= base_url('admin/nilairapor/getSubject') ?>",
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
        });
    });
</script>