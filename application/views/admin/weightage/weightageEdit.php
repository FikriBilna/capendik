<div class="content-wrapper">
    
    <section class="content-header">
        <h1><i class="fa fa-mortar-board"></i>Weightage Name List</h1>
    </section>

    <section class="content">
        <div class="row">
            <?php
                if($this->rbac->hasPrivilege('weightage', 'can_add') || $this->rbac->hasPrivilege('weightage', 'can_edit')) {
            ?>
            
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Weightage</h3>
                    </div>
                    <form action="<?php echo site_url('admin/weightage/edit/'.$id) ?>" id="weightageform" name="weightageform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php 
                                if ($this->session->flashdata('msg')) {
                                   echo $this->session->flashdata('msg'); 
                                }

                                echo $this->customlib->getCSRF();
                            ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Weightage Name</label><small class="req">*</small>
                                <input autofocus="" id="weightageName" name="weightagename" type="text" class="form-control" value="<?php echo set_value('weightage_name', $weightageGet[0]['weightage_name']); ?>" />
                                <span class="text-danger"><?php echo form_error('weightage_name'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Subject</label><small class="req">*</small>
                                <select name="subject_id" id="subject" class="form-control">
                                    <option value="<?= set_value('subject_id',$weightageGet[0]['subject_id']) ?>"><?= $weightageGet[0]['subject_id'] ?></option>
                                    <option value="">----------</option>
                                    <?php
                                        foreach($subjectList as $subject){
                                    ?>
                                    <option value="<?= $subject['id'] ?>"><?= $subject['name'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php } ?>
            <div class="col-md-<?php if ($this->rbac->hasPrivilege('weightage', 'can_add') || $this->rbac->hasPrivilege('weightage', 'can_edit')) { echo "8"; }else{ echo "12"; } ?>">
                    <div class="box box-primary">
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix"> Weightage List</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive mailbox-messages">
                                <div class="download-label">Weightage List</div>
                                <table class="table table-striped table-bordered table-hover example">
                                    <thead>
                                        <tr>
                                            <th>Weightage Name</th>
                                            <th>Subject</th>
                                            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($weightageList as $wtg){
                                        ?>
                                            <tr>
                                                <td class="mailbox-name"><?php echo $wtg['weightage_name'] ?></td>
                                                <td class="mailbox-name">
                                                    <?php
                                                        foreach($subjectList as $subject){
                                                    ?>
                                                    <?= $subject['id'] == $wtg['subject_id'] ? $subject['name'] : '' ?>
                                                    <?php } ?>
                                                </td>
                                                <td class="mailbox-date pull-right">
                                                    <?php
                                                        if ($this->rbac->hasPrivilege('weightage', 'can_edit')){
                                                    ?>
                                                            <a data-placement="left" href="<?php base_url(); ?><?php echo $wtg['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>" ><i class="fa fa-pencil"></i></a>
                                                    <?php
                                                        }
                                                        if ($this->rbac->hasPrivilege('weightage', 'can_delete')){
                                                    ?>
                                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/weightage/delete/<?php echo $wtg['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure?')"><i class="fa fa-remove"></i></a>
                                                    <?php
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php 
                                            } 
                                            $count++;
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