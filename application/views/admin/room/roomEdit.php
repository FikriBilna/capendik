<div class="content-wrapper">
    
    <section class="content-header">
        <h1><i class="fa fa-mortar-board"></i>Room List</h1>
    </section>

    <section class="content">
        <div class="row">
            <?php
                if($this->rbac->hasPrivilege('room', 'can_add') || $this->rbac->hasPrivilege('room', 'can_edit')) {
            ?>
            
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Room</h3>
                    </div>
                    <form action="<?php echo site_url('admin/room/edit/'.$id) ?>" id="roomform" name="roomform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php 
                                if ($this->session->flashdata('msg')) {
                                   echo $this->session->flashdata('msg'); 
                                }

                                echo $this->customlib->getCSRF();
                            ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Room Code</label><small class="req">*</small>
                                <input autofocus="" id="roomCode" name="roomcode" type="text" class="form-control" value="<?php echo set_value('room_code', $room['room_code']); ?>" />
                                <span class="text-danger"><?php echo form_error('room_code'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Room Name</label><small class="req">*</small>
                                <input autofocus="" id="roomName" name="roomname" type="text" class="form-control" value="<?php echo set_value('room_name', $room['room_name']); ?>" />
                                <span class="text-danger"><?php echo form_error('room_name'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Room Type</label><small class="req">*</small>
                                <select name="roomtype" id="roomType" class="form-control">
                                    <option value="<?php echo set_value('room_type', $room['room_type']); ?>"><?php echo $room['room_type'] ?></option>
                                    <option value="">-----</option>
                                    <option value="1">Kelas / Teori</option>
                                    <option value="2">Laboratorium</option>
                                    <option value="3">Perpustakaan</option>
                                    <option value="4">Praktek</option>
                                    <option value="5">Penunjang</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Building</label><small class="req">*</small>
                                <select name="building" id="building" class="form-control">
                                    <option value="<?php echo set_value('building', $room['building']); ?>"><?php echo $room['building'] ?></option>
                                    <option value="">-----</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Floor</label><small class="req">*</small>
                                <select name="floor" id="floor" class="form-control">
                                    <option value="<?php echo set_value('floor', $room['floor']); ?>"><?php echo $room['floor'] ?></option>
                                    <option value="">-----</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Length</label><small class="req">*</small>
                                <input autofocus="" id="length" name="length" type="text" class="form-control" value="<?php echo set_value('length', $room['length']); ?>" />
                                <span class="text-danger"><?php echo form_error('length'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Width</label><small class="req">*</small>
                                <input autofocus="" id="width" name="width" type="text" class="form-control" value="<?php echo set_value('width', $room['width']); ?>" />
                                <span class="text-danger"><?php echo form_error('width'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Space Area</label><small class="req">*</small>
                                <input autofocus="" id="spaceArea" name="spacearea" type="text" class="form-control" value="<?php echo set_value('space_area', $room['space_area']); ?>" />
                                <span class="text-danger"><?php echo form_error('space_area'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Capacity</label><small class="req">*</small>
                                <input autofocus="" id="capacity" name="capacity" type="text" class="form-control" value="<?php echo set_value('capacity', $room['capacity']); ?>" />
                                <span class="text-danger"><?php echo form_error('capacity'); ?></span>
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
                                        foreach ($roomlist as $room){
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
                                                            <a data-placement="left" href="<?php base_url(); ?><?php echo $room['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>" ><i class="fa fa-pencil"></i></a>
                                                    <?php
                                                        }
                                                        if ($this->rbac->hasPrivilege('room', 'can_delete')){
                                                    ?>
                                                            <a data-placement="left" href="<?php echo base_url(); ?>room/delete/<?php echo $room['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('This action will affect Class Timetable too.')"><i class="fa fa-remove"></i></a>
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