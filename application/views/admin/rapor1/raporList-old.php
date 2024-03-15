<div class="content-wrapper">
    
    <section class="content-header">
        <h1><i class="fa fa-mortar-board"></i>Rapor List</h1>
    </section>

    <section class="content">
        <div class="row">
            <?php
                if($this->rbac->hasPrivilege('rapor', 'can_add') || $this->rbac->hasPrivilege('rapor', 'can_edit')) {
            ?>
            
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Rapor</h3>
                    </div>
                    <form action="<?php echo site_url('admin/rapor/') ?>" id="raporForm" name="raporform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php 
                                if ($this->session->flashdata('msg')) {
                                   echo $this->session->flashdata('msg'); 
                                }

                                echo $this->customlib->getCSRF();
                            ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Rapor Name</label><small class="req">*</small>
                                <input autofocus="" id="raporName" name="raporname" type="text" class="form-control" value="<?php echo set_value('rapor_name
                                '); ?>" />
                                <span class="text-danger"><?php echo form_error('rapor_name'); ?></span>
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>

                                        <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($classlist as $class) {
                                                ?>
                                                <option value="<?php echo $class['id'] ?>" <?php
                                                if ($class_id == $class['id']) {
                                                    echo "selected =selected";
                                                }
                                                ?>><?php echo $class['class'] ?></option>
                                                        <?php
                                                        $count++;
                                                    }
                                                    ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php } ?>
            <div class="col-md-<?php if ($this->rbac->hasPrivilege('room', 'can_add') || $this->rbac->hasPrivilege('room', 'can_edit')) { echo "8"; }else{ echo "12"; } ?>">
                    <div class="box box-primary">
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix"> Room List</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive mailbox-messages">
                                <div class="download-label">Room List</div>
                                <table class="table table-striped table-bordered table-hover example">
                                    <thead>
                                        <tr>
                                            <th>Room Code</th>
                                            <th>Room Name</th>
                                            <th>Room Type</th>
                                            <th>Building</th>
                                            <th>Floor</th>
                                            <th>Length</th>
                                            <th>Width</th>
                                            <th>Space Area</th>
                                            <th>Capacity</th>
                                            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($roomList as $room){
                                        ?>
                                            <tr>
                                                <td class="mailbox-name"><?php echo $room['room_code'] ?></td>
                                                <td class="mailbox-name"><?php echo $room['room_name'] ?></td>
                                                <td class="mailbox-name">
                                                    <?php 
                                                    if ($room['room_type'] == '1'){
                                                        echo "Kelas / Teori";
                                                    } elseif ($room['room_type'] == '2')  {
                                                        echo "Laboratorium";
                                                    } elseif ($room['room_type'] == '3')  {
                                                        echo "Perpustakaan";
                                                    } elseif ($room['room_type'] == '4')  {
                                                        echo "Praktek";
                                                    } elseif ($room['room_type'] == '5')  {
                                                        echo "Penunjang";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="mailbox-name"><?php echo $room['building'] ?></td>
                                                <td class="mailbox-name"><?php echo $room['floor'] ?></td>
                                                <td class="mailbox-name"><?php echo $room['length']."m" ?></td>
                                                <td class="mailbox-name"><?php echo $room['width']."m" ?></td>
                                                <td class="mailbox-name"><?php echo $room['space_area'] ?></td>
                                                <td class="mailbox-name"><?php echo $room['capacity']." People" ?></td>
                                                <td class="mailbox-date pull-right">
                                                    <?php
                                                        if ($this->rbac->hasPrivilege('room', 'can_edit')){
                                                    ?>
                                                            <a data-placement="left" href="<?php base_url(); ?>room/edit/<?php echo $room['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>" ><i class="fa fa-pencil"></i></a>
                                                    <?php
                                                        }
                                                        if ($this->rbac->hasPrivilege('room', 'can_delete')){
                                                    ?>
                                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/room/delete/<?php echo $room['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('This action will affect Class Timetable too.')"><i class="fa fa-remove"></i></a>
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