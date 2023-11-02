<div class="content-wrapper">

    <section class="content-header">
        <h1><i class="fa fa-mortar-board"></i>Rapor List</h1>
    </section>

    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('room', 'can_add') || $this->rbac->hasPrivilege('room', 'can_edit')) {
            ?>

                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><u>Add Weightage</u></h3>
                        </div>
                        <div class="box-header">
                            <table class="table">
                                <tr>
                                    <th>Rapor</th>
                                    <th class="pull-right">Subject</th>
                                </tr>
                                <tr>
                                    <td>Rapor <?= $raporName['rapor_name'] ?></td>
                                    <td><?= $subjectName['name'] ?></td>
                                </tr>
                            </table>
                        </div>
                        <form action="<?php echo site_url('admin/rapor/add_weightage/' . $id) ?>" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php
                                if ($this->session->flashdata('msg')) {
                                    echo $this->session->flashdata('msg');
                                }

                                echo $this->customlib->getCSRF();
                                ?>
                                <input type="hidden" name="rapor_subject_id" value="<?= $id ?>">
                                <input type="hidden" name="subject_id" value="<?= $_GET['aksi'] ?>">
                                <div class="table-responsive">

                                    <table class="table">
                                        <tr>
                                            <th>Weightage Name</th>
                                            <th>Weightage</th>
                                            <th></th>
                                        </tr>
                                        <?php
                                        foreach ($subjectWeightage as $item) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <input type="text" disabled class="form-control" value="<?= $item['weightage_name'] ?>" />
                                                </td>
                                                <td>
                                                    <input type="text" disabled class="form-control" value="<?= $item['weightage'] ?>" />
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>

                                    <table class="table" id="table">
                                        <tr>
                                            <th>Weightage Name</th>
                                            <th>Weightage</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="inputs[0][weightage_name]" placeholder="Enter Weightage Name" class="form-control name_list" required="" />
                                            </td>
                                            <td>
                                                <input type="text" name="inputs[0][weightage]" placeholder="Enter Weightage" class="form-control name_list" required="" />
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="pull-right">
                                        <button type="button" name="add" id="add" class="btn btn-success btn-sm">Add More</button>
                                        <button type="submit" name="submit" id="submit" class="btn btn-info">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            <?php } ?>
        </div>
    </section>
</div>
<script type="text/javascript">
    var i = 0;
    $('#add').click(function() {
        ++i;
        $('#table').append(
            `<tr>
                <td>
                    <input type="text" name="inputs[` + i + `][weightage_name]" placeholder="Enter your Name" class="form-control name_list" required="" />
                </td>
                <td>
                    <input type="text" name="inputs[` + i + `][weightage]" placeholder="Enter your Name" class="form-control name_list" required="" />
                </td>
                <td>
                    <button type="button" class="remove-table-row" border="0">-</button>
                </td>
            </tr>`
        );
    });

    $(document).on('click', '.remove-table-row', function() {
        $(this).parents('tr').remove();
    });
</script>