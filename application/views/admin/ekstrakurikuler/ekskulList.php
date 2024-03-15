<div class="content-wrapper">
    
    <section class="content-header">
        <h1><i class="fa fa-mortar-board"></i>Ekstrakurikuler List</h1>
    </section>

    <section class="content">
        <div class="row">
            <?php
                if($this->rbac->hasPrivilege('ekskul', 'can_add') || $this->rbac->hasPrivilege('ekskul', 'can_edit')) {
            ?>
            
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Ekstrakurikuler</h3>
                    </div>
                    <form action="<?php echo site_url('admin/ekstrakurikuler/') ?>" id="ekskulform" name="ekskulform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php 
                                if ($this->session->flashdata('msg')) {
                                   echo $this->session->flashdata('msg'); 
                                }

                                echo $this->customlib->getCSRF();
                            ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ekstrakurikuler Name</label><small class="req">*</small>
                                <input autofocus="" id="ekskulname" name="ekskulname" type="text" class="form-control" value="<?php echo set_value('name'); ?>" />
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ekstrakurikuler Code</label><small class="req">*</small>
                                <input autofocus="" id="ekskulcode" name="ekskulcode" type="text" class="form-control" value="<?php echo set_value('code'); ?>" />
                                <span class="text-danger"><?php echo form_error('code'); ?></span>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php } ?>
            <div class="col-md-<?php if ($this->rbac->hasPrivilege('ekskul', 'can_add') || $this->rbac->hasPrivilege('ekskul', 'can_edit')) { echo "8"; }else{ echo "12"; } ?>">
                    <div class="box box-primary">
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix">Ekstrakurikuler List</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-striped table-bordered table-hover example">
                                    <thead>
                                        <tr>
                                            <th>Ekstrakurikuler Name</th>
                                            <th>Ekstrakurikuler Code</th>
                                            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($ekskulList as $ekskul){
                                        ?>
                                            <tr>
                                                <td class="mailbox-name"><?= $ekskul['name'] ?></td>
                                                <td class="mailbox-name"><?= $ekskul['code'] ?></td>
                                                <td class="mailbox-date pull-right">
                                                    <?php
                                                        if ($this->rbac->hasPrivilege('ekskul', 'can_edit')){
                                                    ?>
                                                            <a data-placement="left" href="<?php base_url(); ?>ekstrakurikuler/edit/<?php echo $ekskul['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>" ><i class="fa fa-pencil"></i></a>
                                                    <?php
                                                        }
                                                        if ($this->rbac->hasPrivilege('ekskul', 'can_delete')){
                                                    ?>
                                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/ekstrakurikuler/delete/<?php echo $ekskul['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('This action will affect Class Timetable too.')"><i class="fa fa-remove"></i></a>
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