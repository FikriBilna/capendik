<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-flask"></i> <?php echo $this->lang->line('homework'); ?>
        </h1>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header ptbnull">
                        <h2 class="box-title titlefix">Nilai Student : <?= $student['firstname'] . ' ' . $student['lastname'] ?></h2>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <div>
                            <div class="download_label"><?php echo $this->lang->line('nilai_student'); ?></div>
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Topic</th>
                                        <th>Lesson</th>
                                        <th>Sumatif</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($nilai as $list) {
                                    ?>
                                        <tr>
                                            <td><?= $list['subjectName'] ?></td>
                                            <td><?= $list['topicName'] ?></td>
                                            <td><?= $list['lessonName'] ?></td>
                                            <td><?= $list['sumatif'] ?></td>
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