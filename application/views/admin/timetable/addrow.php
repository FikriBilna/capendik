<style type="text/css">
    .relative label.text-danger{position: absolute; left:5px; bottom:0;}
</style>
<div class="row clearfix">
    <div class="col-md-12 column">
        <a id="add_row" class="addrow addbtnright btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add') . " " . $this->lang->line('new'); ?></a>
        <form method="POST" action="<?php echo site_url('admin/timetable/savetimetable'); ?>" id="form_<?php echo $day; ?>" class="commentForm autoscroll">
            <?php
//print_r($subject);
            ?>
            <input type="hidden" name="day" name="" value="<?php echo $day; ?>">
            <input type="hidden" name="class_id" name="" value="<?php echo $class_id; ?>">
            <input type="hidden" name="section_id" name="" value="<?php echo $section_id; ?>">
            <input type="hidden" name="subject_group_id" name="" value="<?php echo $subject_group_id; ?>">
            <div class="">   
                <table class="table table-bordered table-hover order-list tablewidthRS" id="tab_logic">
                    <thead>
                        <tr>

                            <th>
                                <?php echo $this->lang->line('subject') ?>
                            </th>
                            <th>
                                <?php echo $this->lang->line('teacher'); ?>
                            </th>
                            <!-- <th>
                                 <?php //echo $this->lang->line('time') . " " . $this->lang->line('from') ?><small class="astrike"> *</small>
                            </th> -->
                            <!-- <th>
                                <?php //echo $this->lang->line('time') . " " . $this->lang->line('to') ?><small class="astrike"> *</small>
                            </th> -->
                            <th>
                                Period
                            </th>
                            <th>
                                <?php echo $this->lang->line('room')?>
                            </th>
                            <th class="text-right">
                                <?php echo $this->lang->line('action') ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($prev_record)) {
                            $counter = 1;
                            foreach ($prev_record as $prev_rec_key => $prev_rec_value) {
                                ?>
                            <input type="hidden" name="prev_array[]" value="<?php echo $prev_rec_value->id; ?>">

                            <tr id='addr0'>

                                <td>
                                    <input type="hidden" name="total_row[]" value="<?php echo $counter; ?>">
                                    <input type="hidden" name="prev_id_<?php echo $counter; ?>" value="<?php echo $prev_rec_value->id; ?>">
                                    <select class="form-control subject" id="subject_id_<?php echo $counter; ?>" name="subject_<?php echo $counter; ?>">

                                        <option value=""><?php echo$this->lang->line('select') ?></option>
                                        <?php
                                        foreach ($subject as $subject_key => $subject_value) {
                                            ?>

                                            <option value="<?php echo $subject_value->id; ?>" <?php echo set_select('subject_' . $counter, $subject_value->id, ($prev_rec_value->subject_group_subject_id == $subject_value->id ) ? TRUE : FALSE ); ?> >
                                                <?php
                                                $sub_code = ($subject_value->code != "") ? " (" . $subject_value->code . ")" : "";
                                                echo $subject_value->name . $sub_code;
                                                ?>
                                                <?php ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control staff" id="staff_id_<?php echo $counter; ?>" name="staff_<?php echo $counter; ?>">
                                        <option value=""><?php echo $this->lang->line('select') ?></option>
                                        <?php
                                        foreach ($staff as $staff_key => $staff_value) {
                                            ?>

                                            <option value="<?php echo $staff_value['id']; ?>" <?php echo set_select('staff_' . $counter, $staff_value['id'], ($prev_rec_value->staff_id == $staff_value['id'] ) ? TRUE : FALSE ); ?> ><?php echo $staff_value['name'] . " " . $staff_value['surname'] . " (" . $staff_value['employee_id'] . ")"; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <!-- <td>
                                    <div class="input-group">
                                        <input type="text" name="time_from_<?php //echo $counter; ?>" class="form-control time_from time" id="time_from_<?php //echo $counter; ?>" value="<?php //echo ($prev_rec_value->start_time != "") ? $prev_rec_value->time_from :  $this->customlib->timeFormat($prev_rec_value->start_time);?>">
                                        <div class="input-group-addon">
                                            <span class="fa fa-clock-o"></span>
                                        </div>
                                    </div>
                                </td> -->
                                <!-- <td>
                                    <div class="input-group">
                                        <input type="text" name="time_to_<?php //echo $counter; ?>" class="form-control time_to time" id="time_to_<?php //echo $counter; ?>" value="<?php //echo ($prev_rec_value->end_time != "") ? $prev_rec_value->time_to :  $this->customlib->timeFormat($prev_rec_value->end_time);?>">
                                        <div class="input-group-addon">
                                            <span class="fa fa-clock-o"></span>
                                        </div>
                                    </div>
                                </td> -->
                                <td>
                                    <!-- <select class="form-control period" id="period_<?php //echo $counter; ?>" name="period_<?php //echo $counter; ?>">
                                        <option value="<?php //echo ($prev_rec_value->period != "") ? $prev_rec_value->period : ""; ?>" selected="selected"><?php //echo ($prev_rec_value->period != "") ? 'P'.$prev_rec_value->period : "Select"; ?></option>
                                        <option value="">---</option>
                                        <option value="1">P1</option>
                                        <option value="2">P2</option>
                                        <option value="3">P3</option>
                                        <option value="4">P4</option>
                                        <option value="5">P5</option>
                                        <option value="6">P6</option>
                                        <option value="7">P7</option>
                                        <option value="8">P8</option>
                                        <option value="9">P9</option>
                                        <option value="10">P10</option>
                                    </select> -->

                                    <input type="text" name="period_t_<?php echo $counter; ?>" placeholder="period" class="form-control period" id="period_t_<?php echo $counter; ?>" value="<?php echo ($prev_rec_value->period != "") ? 'P'.$prev_rec_value->period : $counter; ?>" disabled/>
                                    <input type="hidden" name="period_<?php echo $counter;?>" id="period_<?php echo $counter; ?>" value="<?php echo ($prev_rec_value->period != "") ? $prev_rec_value->period : $counter; ?>" >
                                </td>
                                <!-- <td>
                                        <input type="text" name="period_<?php //echo $counter; ?>" placeholder="period" class="form-control period" id="period_<?php //echo $counter; ?>" value="<?php //echo ($prev_rec_value->period != "") ? 'P'.$prev_rec_value->period : ""; ?>">
                                </td> -->
                                <td>
                                    <!-- <input type="text" name='room_no_<?php //echo $counter; ?>' value="<?php //echo $prev_rec_value->room_no; ?>" placeholder='Room no' class="form-control room_no" id="room_no_<?php //echo $counter; ?>"/> -->
                                   <select class="form-control room_no" id="room_no_<?php echo $counter; ?>" name="room_no_<?php echo $counter; ?>">
                                        <option value=""><?php echo $this->lang->line('select') ?></option>
                                        <?php 
                                        foreach ($room as $room_key => $room_value){
                                        ?>
                                            <option value="<?php echo $room_value['id'] ?>" <?php echo set_select('room_'. $counter, $room_value['id'], ($prev_rec_value->room_no == $room_value['id'])? TRUE : FALSE ); ?>><?php echo $room_value['room_name']." (".$room_value['room_code'].")"; ?></option>
                                        <?php  
                                            }
                                        ?>
                                    </select>
                                </td>
                                <td class="text-right"><button class="ibtnDel btn btn-danger btn-sm btn-danger"> <i class="fa fa-trash"></i></button></td>

                            </tr>

                            <?php
                            $counter ++;
                        }
                    } else {
                        $counter = 1;
                        ?>

                        <tr id='addr0'>

                            <td class="relative">
                                <input type="hidden" name="total_row[]" value="<?php echo $total_count; ?>">
                                <input type="hidden" name="prev_id_<?php echo $total_count; ?>" value="0">
                                <select class="form-control subject" id="subject_id_<?php echo $total_count; ?>" name="subject_<?php echo $total_count; ?>">

                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                    <?php
                                    foreach ($subject as $subject_key => $subject_value) {
                                        ?>

                                        <option value="<?php echo $subject_value->id; ?>"><?php echo $subject_value->name . " (" . $subject_value->code . ")"; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td class="relative">
                                <select class="form-control staff" id="staff_id_<?php echo $total_count; ?>" name="staff_<?php echo $total_count; ?>">
                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                    <?php
                                    foreach ($staff as $staff_key => $staff_value) {
                                        ?>

                                        <option value="<?php echo $staff_value['id']; ?>"><?php echo $staff_value['name'] . " " . $staff_value['surname'] . " (" . $staff_value['employee_id'] . ")"; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <!-- <td>
                                <div class="input-group">
                                    <input type="text" name="time_from_<?php //echo $total_count; ?>" class="form-control time_from time" id="time_from_<?php //echo $total_count; ?>" aria-invalid="false">
                                    <div class="input-group-addon">
                                        <span class="fa fa-clock-o"></span>
                                    </div>
                                </div>
                            </td> -->
                            <!-- <td>
                                <div class="input-group">
                                    <input type="text" name="time_to_<?php //echo $total_count; ?>" class="form-control time_to time" id="time_to_<?php // echo $total_count; ?>" aria-invalid="false">
                                    <div class="input-group-addon">
                                        <span class="fa fa-clock-o"></span>
                                    </div>
                                </div>
                            </td> -->
                            <td>
                                    <!-- <select class="form-control period" id="period_<?php //echo $total_count; ?>" name="period_<?php //echo $total_count; ?>">
                                        <option value="">Select</option>
                                        <option value="1">P1</option>
                                        <option value="2">P2</option>
                                        <option value="3">P3</option>
                                        <option value="4">P4</option>
                                        <option value="5">P5</option>
                                        <option value="6">P6</option>
                                        <option value="7">P7</option>
                                        <option value="8">P8</option>
                                        <option value="9">P9</option>
                                        <option value="10">P10</option>
                                    </select> -->
                                    <input type="text" name="period_t_<?php echo $counter; ?>" placeholder="period" class="form-control period" id="period_t_<?php echo $counter; ?>" value="<?php echo 'P'.$counter; ?>" disabled/>
                                    <input type="hidden" name="period_<?php echo $counter;?>" id="period_<?php echo $counter; ?>" value="<?php echo $counter; ?>" >
                                </td>
                            <td>
                                <!-- <input type="text" name='room_no_<?php //echo $total_count; ?>' id='room_no_<?php //echo $total_count; ?>' placeholder='Room no' class="form-control room_no"/> -->
                                <select class="form-control room_no" id="room_no_<?php echo $counter; ?>" name="room_no_<?php echo $counter; ?>">
                                        <option value=""><?php echo $this->lang->line('select') ?></option>
                                        <?php 
                                        foreach ($room as $room_key => $room_value){
                                        ?>
                                            <option value="<?php echo $room_value['id'] ?>"><?php echo $room_value['room_name']." (".$room_value['room_code'].")"; ?></option>
                                        <?php  
                                            }
                                        ?>
                                    </select>
                            </td>
                            <td class="text-right"><button class="ibtnDel btn btn-danger btn-sm btn-danger"> <i class="fa fa-trash"></i></button></td>

                        </tr>
                        <?php
                    }
                    ?>


                    </tbody>
                </table>
            </div>
            <?php if ($this->rbac->hasPrivilege('class_timetable', 'can_edit')) {
                ?>
                <button class="btn btn-primary btn-sm pull-right" type="submit"><i class="fa fa-save"></i> <?php echo $this->lang->line('save'); ?></button>
            <?php }
            ?>


        </form>
    </div>
</div>
</div>

<script type="text/javascript">
    var form_id = "<?php echo $day ?>";
    $(function () {


        $('form#form_' + form_id).on('submit', function (event) {

            // adding rules for inputs with class 'comment'
            $('select[id^="subject_id_"]').each(function () {
                $(this).rules('add', {
                    required: true,
                    messages: {
                        required: "Required"
                    }
                });

            });           // adding rules for inputs with class 'comment'
            $('select[id^="staff_id_"]').each(function () {
                $(this).rules('add', {
                    required: true,
                    messages: {
                        required: "Required"
                    }
                });

            });


            $('input[id^="time_from_"]').each(function () {
                $(this).rules('add', {
                    required: true,
                    messages: {
                        required: "Required"
                    }
                });
            });


            $('input[id^="time_to_"]').each(function () {
                $(this).rules('add', {
                    required: true,
                    messages: {
                        required: "Required"
                    }
                });
            });

            $('input[id^="room_no_"]').each(function () {
                $(this).rules('add', {
                    required: true,
                    messages: {
                        required: "Required"
                    }
                });
            });




            // prevent default submit action         
            event.preventDefault();

            // test if form is valid 
            if ($('form#form_' + form_id).validate().form()) {
                var target = $('.nav-tabs .active a').attr("href");
                var target_id = $('.nav-tabs .active a').attr("id");
                var ajax_data = $('.nav-tabs .active a').data();

                $.ajax({
                    type: 'POST',
                    url: base_url + "admin/timetable/savegroup",
                    data: $('#form_' + form_id).serialize(),
                    dataType: 'json',
                    beforeSend: function () {

                    },
                    success: function (data) {


                        $(target).html(data.html);
                        if (data.status == 1) {

                            successMsg(data.message);
                            $(target).html("");
                            getGroupdata(target, target_id, ajax_data);

                        } else {
                            var list = $('<ul/>');
                            $.each(data.error, function (key, value) {

                                if (value != "") {
                                    list.append(value);
                                }
                            });
                            errorMsg(list);
                        }
                    },
                    error: function (xhr) { // if error occured

                    },
                    complete: function () {

                    }
                });

            } else {
                console.log("does not validate");
            }
        });


        // initialize the validator
        $('form#form_' + form_id).validate({
            errorClass: 'text-danger'
        });




    });

</script>

