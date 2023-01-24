<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<style>
    
</style>
<script type="text/javascript">
    
  window.onload = function () {
    var chartMath = new CanvasJS.Chart("mathGraph",
    {

      title:{
      text: "MATHS HISTORICAL DATA"
      },
       data: [
      {
        type: "line",

        dataPoints: [
        { label: "2013/2014", y: 45 },
        { label: "2014/2015", y: 54 },
        { label: "2015/2016", y: 67 },
        { label: "2016/2017", y: 79 },
        { label: "2017/2018", y: 93 },
        { label: "2018/2019", y: 69 },
        { label: "2019/2020", y: 75 },
        { label: "2020/2021", y: 78 },
        { label: "2021/2022", y: 85 },
        { label: "2022/2023", y: 68 }
        ]
      }
      ]
    });
    var chartEng = new CanvasJS.Chart("engGraph",
    {

      title:{
      text: "ENGLISH HISTORICAL DATA"
      },
       data: [
      {
        type: "line",

        dataPoints: [
        { label: "2013/2014", y: 50 },
        { label: "2014/2015", y: 55 },
        { label: "2015/2016", y: 58 },
        { label: "2016/2017", y: 69 },
        { label: "2017/2018", y: 78 },
        { label: "2018/2019", y: 80 },
        { label: "2019/2020", y: 97 },
        { label: "2020/2021", y: 70 },
        { label: "2021/2022", y: 85 },
        { label: "2022/2023", y: 78 }
        ]
      }
      ]
    });
    var chartSci = new CanvasJS.Chart("sciGraph",
    {

      title:{
      text: "SCIENE HISTORICAL DATA"
      },
       data: [
      {
        type: "line",

        dataPoints: [
        { label: "2013/2014", y: 45 },
        { label: "2014/2015", y: 54 },
        { label: "2015/2016", y: 50 },
        { label: "2016/2017", y: 79 },
        { label: "2017/2018", y: 89 },
        { label: "2018/2019", y: 76 },
        { label: "2019/2020", y: 85 },
        { label: "2020/2021", y: 59 },
        { label: "2021/2022", y: 85 },
        { label: "2022/2023", y: 89 }
        ]
      }
      ]
    });

    chartMath.render();
    chartEng.render();
    chartSci.render();
  }
  
  
</script>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive" src="<?php echo base_url() . "uploads/student_images/default_male.jpg" ?>" alt="User profile picture">
                        <h3 class="profile-username text-center">Muhammad Sumbul</h3>
                        <ul class="list-group list-group-unbordered">
                            <!-- NISN -->
                            <li class="list-group-item listnoback">
                                <b>NISN</b> <a class="pull-right text-aqua">10902589664</a>
                            </li>
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right text-aqua">1</a>
                            </li>
                            <li class="list-group-item listnoback">
                                <b>Form</b> <a class="pull-right text-aqua">A</a>
                            </li>
                            <li class="list-group-item listnoback">
                                <b>Home Room Teacher</b><a class="pull-right text-aqua"> Doni Julian</a>
                            </li>
                            <li class="list-group-item listnoback">
                                <b>Headmaster's Remark</b>
                                <div class="box">
                                    <div class="row col-md-12">
                                        <p>Quisque convallis, eros vehicula commodo auctor, dui tellus facilisis leo, sed ornare magna odio in lorem. Sed fermentum sollicitudin nunc et elementum. Aliquam euismod eros at magna rhoncus sollicitudin. Quisque vel lorem eros. Pellentesque iaculis odio quis odio aliquam, quis imperdiet ante imperdiet. </p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item listnoback">
                                <b>Home Room Teacher's Remark</b>
                                <div class="box">
                                    <div class="row col-md-12">
                                        <p>Quisque convallis, eros vehicula commodo auctor, dui tellus facilisis leo, sed ornare magna odio in lorem. Sed fermentum sollicitudin nunc et elementum. Aliquam euismod eros at magna rhoncus sollicitudin. Quisque vel lorem eros. Pellentesque iaculis odio quis odio aliquam, quis imperdiet ante imperdiet. </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="stdStatistic" class="col-md-9">
                <div class="box box-primary">
                    <div class="nav-tabs-custom theme-shadow">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#substatistic" data-toggle="tab" aria-expanded="true">Subject Statistic</a></li>
                            <li class=""><a href="#subhistory" data-toggle="tab" aria-expanded="true">Historical Subejct</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="substatistic" class="tab-pane active">
                                <div class="row list-group-item listnoback" style="margin-bottom:15px;">
                                    <div class="col-md-3 space35 text-center">
                                        <h3>2022 / 2023</h3>
                                        <h4>Academic Year</h4>
                                        <h5>Second Term</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="">
                                        <div class="topprograssstart">
                                            <p class="text-uppercase mt5 clearfix">Mathematics<span class="pull-right">80/100</span></p>
                                            <div class="progress-group">
                                                <div class="progress progress-minibar">
                                                    <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--./topprograssstart-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="">
                                        <div class="topprograssstart">
                                            <p class="text-uppercase mt5 clearfix">English<span class="pull-right">90/100</span></p>
                                            <div class="progress-group">
                                                <div class="progress progress-minibar">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 90%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--./topprograssstart-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="">
                                        <div class="topprograssstart">
                                            <p class="text-uppercase mt5 clearfix">Sciene<span class="pull-right">75/100</span></p>
                                            <div class="progress-group">
                                                <div class="progress progress-minibar">
                                                    <div class="progress-bar progress-bar-green" style="width: 75%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--./topprograssstart-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="">
                                        <div class="topprograssstart">
                                            <p class="text-uppercase mt5 clearfix">Economics<span class="pull-right">60/100</span></p>
                                            <div class="progress-group">
                                                <div class="progress progress-minibar">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--./topprograssstart-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="">
                                        <div class="topprograssstart">
                                            <p class="text-uppercase mt5 clearfix">Geography<span class="pull-right">50/100</span></p>
                                            <div class="progress-group">
                                                <div class="progress progress-minibar">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--./topprograssstart-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="">
                                        <div class="topprograssstart">
                                            <p class="text-uppercase mt5 clearfix">Biology<span class="pull-right">100/100</span></p>
                                            <div class="progress-group">
                                                <div class="progress progress-minibar">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 100%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--./topprograssstart-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="">
                                        <div class="topprograssstart">
                                            <p class="text-uppercase mt5 clearfix">Chemistry<span class="pull-right">45/100</span></p>
                                            <div class="progress-group">
                                                <div class="progress progress-minibar">
                                                    <div class="progress-bar progress-bar-red" style="width: 45%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--./topprograssstart-->
                                    </div>
                                </div>
                            </div>
                            <!-- BAR CHART -->
                                <div class="tab-pane" id="subhistory">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col100">
                                            <div class="box box-info borderwhite">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Mathematics</h3>
                                                    <div class="box-tools pull-right">
                                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <div id="mathGraph" style="width: 100%; height: 300px"></div>
                                                </div>
                                            </div>
                                            <div class="box box-info borderwhite">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">English</h3>
                                                    <div class="box-tools pull-right">
                                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <div id="engGraph" style="width: 100%; height:300px;"></div>
                                                </div>
                                            </div>
                                            <div class="box box-info borderwhite">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Sciene</h3>
                                                    <div class="box-tools pull-right">
                                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <div id="sciGraph" style="width: 100%; height: 300px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<style>
    #stdStatistic h3 {
        color: #df2223;
    }
</style>