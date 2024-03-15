<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> Select Student</h3>
                    </div>
                    <div class="box-body">
                        <form role="form" action="<?php echo site_url('student/searchvalidation') ?>" method="post" class="class_search_form">
                            <?php if ($this->session->flashdata('msg')) { ?> <div class="alert alert-success"> <?php echo $this->session->flashdata('msg') ?> </div> <?php } ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('class'); ?></label> <small class="req"> *</small>
                                                <select autofocus="" id="class_id" name="class_id" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                </select>
                                                <span class="text-danger" id="error_class_id"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('section'); ?></label>
                                                <select id="section_id" name="section_id" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--./col-md-6-->
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('search_by_keyword'); ?></label>
                                                <input type="text" name="search_text" id="search_text" class="form-control" value="<?php echo set_value('search_text'); ?>" placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div><!--./col-md-6-->
            </div><!--./row-->
        </div>

        <?php
        //if (isset($resultlist)) {
        ?>
        <div class="nav-tabs-custom border0 navnoshadow">
            <div class="box-header ptbnull"></div>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i> <?php echo $this->lang->line('list'); ?> <?php echo $this->lang->line('view'); ?></a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-newspaper-o"></i> <?php echo $this->lang->line('details'); ?> <?php echo $this->lang->line('view'); ?></a></li>
            </ul>
            <div class="tab-content">
                <div class="table-responsive mailbox-messages">
                    <table class="table table-striped table-bordered table-hover example">
                        <thead>
                            <tr>
                                <th>Admission No</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($student_list as $student) {
                            ?>
                                <tr>
                                    <td class="mailbox-name"><?php echo $student['admission_no'] ?></td>
                                    <td class="mailbox-name"><?php echo $student['firstname'] ?></td>
                                    <td class="mailbox-name"><?php echo $student['class'] ?></td>
                                    <td class="mailbox-date pull-right">
                                        <?php if ($this->rbac->hasPrivilege('rapor', 'can_edit')) { ?>
                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/nilaistudent/addNilai/<?php echo $student['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="add nilai"><i class="fa fa-plus"></i></a>
                                        <?php } ?>
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
</div><!--./box box-primary -->
<?php
//  }
?>
</div>
</div>
</section>
</div>

<script type="text/javascript">
    function getSectionByClass(class_id, section_id) {
        if (class_id != "" && section_id != "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {
                    'class_id': class_id
                },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(i, obj) {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        }
    }
    $(document).ready(function() {
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        getSectionByClass(class_id, section_id);
        $(document).on('change', '#class_id', function(e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {
                    'class_id': class_id
                },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(i, obj) {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        emptyDatatable('student-list', 'data');
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $("form.class_search_form button[type=submit]").click(function() {
            $("button[type=submit]", $(this).parents("form")).removeAttr("clicked");
            $(this).attr("clicked", "true");
        });

        $(document).on('submit', '.class_search_form', function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var $this = $("button[type=submit][clicked=true]");
            var form = $(this);
            var url = form.attr('action');
            var form_data = form.serializeArray();
            form_data.push({
                name: 'search_type',
                value: $this.attr('value')
            });
            $.ajax({
                url: url,
                type: "POST",
                dataType: 'JSON',
                data: form_data, // serializes the form's elements.
                beforeSend: function() {
                    $('[id^=error]').html("");
                    $this.button('loading');
                    resetFields($this.attr('value'));
                },
                success: function(response) { // your success handler

                    if (!response.status) {
                        $.each(response.error, function(key, value) {
                            $('#error_' + key).html(value);
                        });
                    } else {



                        if ($.fn.DataTable.isDataTable('.student-list')) { // if exist datatable it will destrory first
                            $('.student-list').DataTable().destroy();
                        }
                        table = $('.student-list').DataTable({
                            // "scrollX": true,
                            dom: 'Bfrtip',
                            buttons: [{
                                    extend: 'copy',
                                    text: '<i class="fa fa-files-o"></i>',
                                    titleAttr: 'Copy',
                                    className: "btn-copy",
                                    title: $('.student-list').data("exportTitle"),
                                    exportOptions: {
                                        columns: ["thead th:not(.noExport)"]
                                    }
                                },
                                {
                                    extend: 'excel',
                                    text: '<i class="fa fa-file-excel-o"></i>',
                                    titleAttr: 'Excel',
                                    className: "btn-excel",
                                    title: $('.student-list').data("exportTitle"),
                                    exportOptions: {
                                        columns: ["thead th:not(.noExport)"]
                                    }
                                },
                                {
                                    extend: 'csv',
                                    text: '<i class="fa fa-file-text-o"></i>',
                                    titleAttr: 'CSV',
                                    className: "btn-csv",
                                    title: $('.student-list').data("exportTitle"),
                                    exportOptions: {
                                        columns: ["thead th:not(.noExport)"]
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    text: '<i class="fa fa-file-pdf-o"></i>',
                                    titleAttr: 'PDF',
                                    className: "btn-pdf",
                                    title: $('.student-list').data("exportTitle"),
                                    exportOptions: {
                                        columns: ["thead th:not(.noExport)"]
                                    },

                                },
                                {
                                    extend: 'print',
                                    text: '<i class="fa fa-print"></i>',
                                    titleAttr: 'Print',
                                    className: "btn-print",
                                    title: $('.student-list').data("exportTitle"),
                                    customize: function(win) {

                                        $(win.document.body).find('th').addClass('display').css('text-align', 'center');
                                        $(win.document.body).find('table').addClass('display').css('font-size', '14px');
                                        $(win.document.body).find('h1').css('text-align', 'center');
                                    },
                                    exportOptions: {
                                        columns: ["thead th:not(.noExport)"]

                                    }

                                }
                            ],


                            "language": {
                                processing: '<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span class="sr-only">Loading...</span> '
                            },
                            "pageLength": 100,
                            "processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": baseurl + "student/dtstudentlist",
                                "dataSrc": 'data',
                                "type": "POST",
                                'data': response.params,

                            },
                            "drawCallback": function(settings) {

                                $('.detail_view_tab').html("").html(settings.json.student_detail_view);
                            }

                        });



                        //=======================
                    }
                },
                error: function() { // your error handler
                    $this.button('reset');
                },
                complete: function() {
                    $this.button('reset');
                }
            });

        });

    });

    function resetFields(search_type) {

        if (search_type == "search_full") {
            $('#class_id').prop('selectedIndex', 0);
            $('#section_id').find('option').not(':first').remove();
        } else if (search_type == "search_filter") {

            $('#search_text').val("");
        }
    }
</script>