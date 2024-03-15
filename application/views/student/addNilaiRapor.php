<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary"  <?php if ($student["is_active"] == "no") { echo "style='background-color:#f0dddd;'";} ?>>
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
                            <?php
                                if ($sch_setting->roll_no) {
                            ?>
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('roll_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['roll_no']; ?></a>
                            </li>
                            <?php } ?>
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right text-aqua"><?php echo $student['class'] . " (" . $session . ")"; ?></a>
                            </li>
                            <li class="list-group-item listnoback">
                                <b>Form</b> <a class="pull-right text-aqua"><?php echo $student['section']; ?></a>
                            </li>
                            <li class="list-group-item listnoback">
                                <b>Home Room Teacher</b> 
                                <a class="pull-right text-aqua">
                                    <?php 
                                        if(!empty($class_teacher)){
                                        foreach($class_teacher as $ct){
                                                echo $ct['name']." ".$ct['surname'];
                                            }      
                                        }else{
                                            echo "-";
                                        }
                                    ?>
                                </a>
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
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix">Nilai Rapor</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-serponsive mailbox-message">
                                <table class="table table-striped table-bordered table-hover example">
                                    <thead>
                                        <th>Subject</th>
                                        <th>Rapor Name</th>
                                        <th>Nilai Rapor</th>
                                        <th style="text-align: left;">Deskripsi Capaian Kompetensi</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach($nilai_rapor as $list){
                                        ?>
                                        <tr>
                                            <td> <?= $list['subjectName'] ?></td>
                                            <td> <?= $list['rapor_name'] ?></td>
                                            <td> <?= $list['nilai_rapor'] ?></td>
                                            <td style="max-width: 100px; text-align:left;"> <?= $list['deskripsi'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer pull-right">
                        <a href="<?= base_url('admin/nilairapor/prosesnilairapor/'.$id.'') ?>" class="btn btn-primary">Tambah Nilai Rapor</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>