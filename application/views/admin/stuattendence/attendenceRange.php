<style type="text/css">
    .radio {
        padding-left: 20px;}
    .radio label {
        display: inline-block;
        vertical-align: middle;
        position: relative;
        padding-left: 5px; }
    .radio label::before {
        content: "";
        display: inline-block;
        position: absolute;
        width: 17px;
        height: 17px;
        left: 0;
        margin-left: -20px;
        border: 1px solid #cccccc;
        border-radius: 50%;
        background-color: #fff;
        -webkit-transition: border 0.15s ease-in-out;
        -o-transition: border 0.15s ease-in-out;
        transition: border 0.15s ease-in-out; }
    .radio label::after {
        display: inline-block;
        position: absolute;
        content: " ";
        width: 11px;
        height: 11px;
        left: 3px;
        top: 3px;
        margin-left: -20px;
        border-radius: 50%;
        background-color: #555555;
        -webkit-transform: scale(0, 0);
        -ms-transform: scale(0, 0);
        -o-transform: scale(0, 0);
        transform: scale(0, 0);
        -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33); }
    .radio input[type="radio"] {
        opacity: 0;
        z-index: 1; }
    .radio input[type="radio"]:focus + label::before {
        outline: thin dotted;
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px; }
    .radio input[type="radio"]:checked + label::after {
        -webkit-transform: scale(1, 1);
        -ms-transform: scale(1, 1);
        -o-transform: scale(1, 1);
        transform: scale(1, 1); }
    .radio input[type="radio"]:disabled + label {
        opacity: 0.65; }
    .radio input[type="radio"]:disabled + label::before {
        cursor: not-allowed; }
    .radio.radio-inline {
        margin-top: 0; }
    .radio-primary input[type="radio"] + label::after {
        background-color: #337ab7; }
    .radio-primary input[type="radio"]:checked + label::before {
        border-color: #337ab7; }
    .radio-primary input[type="radio"]:checked + label::after {
        background-color: #337ab7; }
    .radio-danger input[type="radio"] + label::after {
        background-color: #d9534f; }
    .radio-danger input[type="radio"]:checked + label::before {
        border-color: #d9534f; }
    .radio-danger input[type="radio"]:checked + label::after {
        background-color: #d9534f; }
    .radio-info input[type="radio"] + label::after {
        background-color: #5bc0de; }
    .radio-info input[type="radio"]:checked + label::before {
        border-color: #5bc0de; }
    .radio-info input[type="radio"]:checked + label::after {
        background-color: #5bc0de; }
    @media (max-width:767px){
        .radio.radio-inline {display: inherit;}
    }
    .top-label {
        display: block;
        margin-bottom: 1px;
    }
</style>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('attendance'); ?> <small><?php echo $this->lang->line('by_date1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <form id='form1' action="<?php echo site_url('admin/stuattendence/rangeAttendence') ?>"  method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php
                            if ($this->session->flashdata('msg')) {
                                echo $this->session->flashdata('msg');
                            }
                            ?>

                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
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
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Form</label><small class="req"> *</small>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">
                                                Date Start
                                            </label>
                                            <input id="date" name="dateStart" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('dateStart', date($this->customlib->getSchoolDateFormat())); ?>" readonly="readonly"/>
                                            <span class="text-danger"><?php echo form_error('date'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">
                                                Date End
                                            </label>
                                            <input id="date" name="dateEnd" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('dateEnd', date($this->customlib->getSchoolDateFormat())); ?>" readonly="readonly"/>
                                            <span class="text-danger"><?php echo form_error('date'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div>
                    </div>
                    <?php
                    if(isset($resultlist)){
                    ?>
                        <div class="">
                            <div class="box-header ptbnull"></div>
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('list'); ?></h3>
                                <div class="box-tools pull-right"></div>
                            </div>
                            <div class="box-body">
                                <?php
                                    // var_dump($resultlistcek);
                                    // return false;
                                    if(!empty($resultlistcek)){
                                        $can_edit =1;
                                        $checked = "";
                                        $hid = "";
                                        if(!isset($msg)){

                                            $attTypeId = 'attendence_type_id';
                                            $notEmpty = false;

                                            foreach($resultlistcek as $reslist){
                                                foreach($reslist as $subreslist){
                                                    if(isset($subreslist[$attTypeId]) && !empty($subreslist[$attTypeId])){
                                                        $notEmpty = true;
                                                        break;
                                                    }
                                                }
                                            }

                                            if($notEmpty){
                                                $hid = "display:none;";
                                                $tgl = [];
                                                foreach($resultlistcek as $subresid){
                                                    foreach($subresid as $item){
                                                        if(isset($item['attendence_type_id'])){
                                                            $tgl[] = $item['date']; 
                                                        }
                                                    }
                                                }

                                                $uniqueDates = [];
                                                foreach($tgl as $dts){
                                                    $uniqueDates[$dts] = $dts;
                                                }

                                                $restgl = array_values($uniqueDates);

                                                // var_dump($restgl);
                                                // return false;
                                            ?>
                                                <div class="alert alert-success">Date <?php $formattgl = array_map(function($data){ return date("m/d/Y", strtotime($data));}, $restgl); echo implode(", ", $formattgl); ?> already submited.</div>
                                            <?php
                                            }else{
                                                $hid = "display:block;";
                                            }
                                        }else{
                                        ?>
                                            <div class="alert alert-success"><?php echo $this->lang->line('attendance_saved_successfully'); ?></div>
                                        <?php
                                        }
                                        ?>
                                        <div style="<?php echo $hid; ?>">
                                        <form action="<?php echo site_url('admin/stuattendence/rangeAttendence') ?>" method="post" class="form_attendence">
                                            <?php echo $this->customlib->getCSRF(); ?>
                                            <div class="mailbox-controls">
                                                <span>
                                                    <?php if($this->rbac->hasPrivilege('student_attendence', 'can_add')){ ?>
                                                        <!-- <button type="button" class="btn btn-sm btn-primary" data-color="primary"><?php //echo $this->lang->line('mark_as_holiday'); ?></button> -->
                                                        <!-- <input type="checkbox" id="checkbox1" class="hidden" name="holiday" value="checked" <?php //echo $checked; ?>/> -->
                                                    
                                                </span>
                                                <div class="pull-right">
                                                    <?php
                                                }
                                                    if($can_edit ==1){
                                                        if($this->rbac->hasPrivilege('student_attendence', 'can_add')){
                                                    ?>
                                                    <button type="submit" name="search" value="saveattendence" class="btn btn-primary btn-small pull-right checkbox-toggle"><i class="fa fa-save"></i><?php echo $this->lang->line('save_attendence') ?></button>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                                            <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
                                            <?php
                                                foreach((array)$date as $dates){
                                            ?>
                                                <input type="hidden" name="date[]" value="<?php echo $dates; ?>">
                                            <?php
                                                }
                                            ?>
                                            <div class="table-responsive ptt10">
                                                <table class="table table-hover table-striped example">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th><?php echo $this->lang->line('admission_no'); ?></th>
                                                            <th><?php echo $this->lang->line('roll_no'); ?></th>
                                                            <th><?php echo $this->lang->line('name'); ?></th>
                                                            <th class=""><?php echo $this->lang->line('attendance'); ?></th>
                                                            <th class="noteinput"><?php echo $this->lang->line('note'); ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $row_count = 1;
                                                        foreach($resultlist as $key => $res){
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="hidden" name="student_session[]" value="<?php echo $res['student_session_id']; ?>">
                                                                    <input  type="hidden" value="<?php echo $res['attendence_id']; ?>"  name="attendendence_id<?php echo $res['student_session_id']; ?>[]">
                                                                    <?php echo $row_count; ?>
                                                                </td>
                                                                <td><?php echo $res['admission_no']; ?></td>
                                                                <td><?php if(empty($res['roll_no']) || $res['roll_no'] = ""){ echo "-";}else{ echo $res['roll_no'];} ?></td>
                                                                <td><?php echo $this->customlib->getFullName($res['firstname'],$res['middlename'],$res['lastname'],$sch_setting->middlename,$sch_setting->lastname);  ?></td>
                                                                <td>
                                                                    <?php
                                                                    if(!empty($date)){
                                                                        $c = 0;
                                                                        foreach($date as $key => $dates){
                                                                    ?> 
                                                                        <input type="hidden" name="attendencedate<?php echo $res['student_session_id'] ;?>[]" value="<?php echo $dates; ?>">
                                                                        <!-- <label for="attendencetype<?php echo $res['student_session_id']."-".$count; ?>"> -->
                                                                        <?php
                                                                        // $lb_date = date("d/m", strtotime($dates));
                                                                        // echo $lb_date;
                                                                        ?>
                                                                        </label>
                                                                        <label for="attendencetype<?php echo $res['student_session_id'] . "-" . $count; ?>" class="top-label"><?php echo $dates; ?></label>
                                                                        <select class="" name="attendencetype<?php echo $res['student_session_id']; ?>[]" id="attendencetype<?php echo $res['student_session_id'] . "-" . $count; ?>">
                                                                            <?php 
                                                                             foreach($attendencetypeslist as $key => $type){
                                                                                $att_type = str_replace(" ", "_", strtolower($type['type']));
                                                                            ?>
                                                                            <option value="<?php echo $type['id']; ?>">
                                                                            <?php echo $this->lang->line($att_type); ?>
                                                                            </option>
                                                                            <?php
                                                                             }
                                                                            ?>
                                                                        </select>
                                                                    <?php
                                                                    $c++;
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="text-right"><input type="text" class="noteinput" name="remark<?php echo $res["student_session_id"]; ?>" ></td>
                                                            </tr>
                                                        <?php
                                                        $row_count++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </section>
            </div>
            <script type="text/javascript">
                $(document).ready(function () {
                    // Get the current date
                var currentDate = new Date();

                // Calculate the minimum date (six days before)
                var minDate = new Date(currentDate);
                minDate.setDate(currentDate.getDate() - 6);

                // Initialize the datepicker
                $('#date').datepicker({
                minDate: minDate,
                maxDate: currentDate
                });
                }
            </script>
            <script type="text/javascript">
                $(document).ready(function () {

                    $.extend($.fn.dataTable.defaults, {
                        searching: false,
                        ordering: true,
                        paging: false,
                        retrieve: true,
                        destroy: true,
                        info: false
                    });
                    var table = $('.example').DataTable();
                    table.buttons('.export').remove();
                    var section_id_post = '<?php echo $section_id; ?>';
                    var class_id_post = '<?php echo $class_id; ?>';
                    populateSection(section_id_post, class_id_post);
                    function populateSection(section_id_post, class_id_post) {
                        $('#section_id').html("");
                        var base_url = '<?php echo base_url() ?>';
                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        $.ajax({
                            type: "GET",
                            url: base_url + "sections/getByClass",
                            data: {'class_id': class_id_post, 'day_wise': 'yes'},
                            dataType: "json",
                            success: function (data) {
                                $.each(data, function (i, obj)
                                {
                                    var select = "";
                                    if (section_id_post == obj.section_id) {
                                        var select = "selected=selected";
                                    }
                                    div_data += "<option value=" + obj.section_id + " " + select + ">" + obj.section + "</option>";
                                });
                                $('#section_id').append(div_data);
                            }
                        });
                    }

                    $(document).on('change', '#class_id', function (e) {
                        $('#section_id').html("");
                        var class_id = $(this).val();
                        var base_url = '<?php echo base_url() ?>';
                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        var url = "<?php
                $userdata = $this->customlib->getUserData();
                if (($userdata["role_id"] == 2)) {
                    echo "getClassTeacherSection";
                } else {
                    echo "getByClass";
                }
                ?>";
                        $.ajax({
                            type: "GET",
                            url: base_url + "sections/getByClass",
                            data: {'class_id': class_id, 'day_wise': 'yes'},
                            dataType: "json",
                            success: function (data) {
                                $.each(data, function (i, obj)
                                {
                                    div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                                });
                                $('#section_id').append(div_data);
                            }
                        });
                    });

                });
            </script>
            <script type="text/javascript">
                $(function () {
                    $('.button-checkbox').each(function () {
                        var $widget = $(this),
                                $button = $widget.find('button'),
                                $checkbox = $widget.find('input:checkbox'),
                                color = $button.data('color'),
                                settings = {
                                    on: {
                                        icon: 'glyphicon glyphicon-check'
                                    },
                                    off: {
                                        icon: 'glyphicon glyphicon-unchecked'
                                    }
                                };
                        $button.on('click', function () {
                            $checkbox.prop('checked', !$checkbox.is(':checked'));
                            $checkbox.triggerHandler('change');
                            updateDisplay();
                        });
                        $checkbox.on('change', function () {
                            updateDisplay();
                        });

                        function updateDisplay() {
                            var isChecked = $checkbox.is(':checked');
                            $button.data('state', (isChecked) ? "on" : "off");
                            $button.find('.state-icon')
                                    .removeClass()
                                    .addClass('state-icon ' + settings[$button.data('state')].icon);
                            if (isChecked) {
                                $button
                                        .removeClass('btn-success')
                                        .addClass('btn-' + color + ' active');
                            } else {
                                $button
                                        .removeClass('btn-' + color + ' active')
                                        .addClass('btn-primary');
                            }
                        }

                        function init() {
                            updateDisplay();
                            if ($button.find('.state-icon').length == 0) {
                                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                            }
                        }
                        init();
                    });
                });

                $('#checkbox1').change(function () {

                    if (this.checked) {
                        var returnVal = confirm("<?php echo $this->lang->line('are_you_sure'); ?>");
                        $(this).prop("checked", returnVal);

                        $("input[type=radio]").attr('disabled', true);


                    } else {
                        $("input[type=radio]").attr('disabled', false);
                        $("input[type=radio][value='1']").attr("checked", "checked");

                    }

                });


                $('form.form_attendence').on('submit', function (e) {

                    $(this).submit(function () {
                        return false;
                    });
                    return true;

                });

            </script>
