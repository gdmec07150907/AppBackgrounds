<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>速捷管理后台</title>

   <!-- Bootstrap -->
    <link href="/speed/Public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/speed/Public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/speed/Public/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/speed/Public/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="/speed/Public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/speed/Public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/speed/Public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/speed/Public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/speed/Public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/speed/Public/css/custom.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/speed/Public/css/common.css"/>
    <script src="/speed/Public/JQM/jquery-1.10.2/jquery.js"></script>
   
  <script type="text/javascript">
var w,h,className;
function getSrceenWH(){
  w = $(window).width();
  h = $(window).height();
  $('#goodsdialogBg').width(w).height(h);
}

window.onresize = function(){  
  getSrceenWH();
}  
$(window).resize();  

$(function(){
  getSrceenWH();
  
  //显示弹框
  $('.fuck #update').click(function(){
    className = $(this).attr('class');
    $('#addressdialogBg').fadeIn(300);
    $('#addressdialog').removeAttr('class').addClass('animated '+className+'').fadeIn();
  });
  
  //关闭弹窗
  $('.claseDialogBtn').click(function(){
    $('#addressdialogBg').fadeOut(300,function(){
      $('#addressdialog').addClass('bounceOutUp').fadeOut();
    });
  });
});
</script>
<script>
$(function(){
  $(".address").each(function(){
    var tmp = $(this).children().eq(7);
    var btn = tmp.children();

    btn.bind("click",function(){
      var id = btn.parent().parent().children("td").get(0).innerHTML;
      $("#id").val(id);
      var postcode = btn.parent().parent().children("td").get(1).innerHTML;
      $("#postcode").val(postcode);
      var province = btn.parent().parent().children("td").get(2).innerHTML;
      $("#province").val(province);
      var city = btn.parent().parent().children("td").get(3).innerHTML;
      $("#city").val(city);
      var area = btn.parent().parent().children("td").get(4).innerHTML;
      $("#area").val(area);
      var street = btn.parent().parent().children("td").get(5).innerHTML;
      $("#street").val(street);
      var streetno = btn.parent().parent().children("td").get(6).innerHTML;
      $("#streetno").val(streetno);
    })
  })
})
</script>
    <?php
 session_start(); $getName = $_SESSION['user_name']; ?>

    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>速捷管理后台</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix" id="$sessions" name="list">
              <div class="profile_pic">
                <img src="../Public/images/2.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $getName?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> 账户管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index">客户账户</a></li>
                      <li><a href="driver">司机账户</a></li>
                      <li><a href="admin">管理员账户</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> 订单管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="goods">快件信息</a></li>
                      <li><a href="address">快件地址</a></li>
                     <li><a href="evaluate">订单评价</a></li>
                    </ul>
                  </li>
                  <!--  
                  <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="general_elements.html">General Elements</a></li>
                      <li><a href="media_gallery.html">Media Gallery</a></li>
                      <li><a href="typography.html">Typography</a></li>
                      <li><a href="icons.html">Icons</a></li>
                      <li><a href="glyphicons.html">Glyphicons</a></li>
                      <li><a href="widgets.html">Widgets</a></li>
                      <li><a href="invoice.html">Invoice</a></li>
                      <li><a href="inbox.html">Inbox</a></li>
                      <li><a href="calendar.html">Calendar</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Tables</a></li>
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Chart JS</a></li>
                      <li><a href="chartjs2.html">Chart JS2</a></li>
                      <li><a href="morisjs.html">Moris JS</a></li>
                      <li><a href="echarts.html">ECharts</a></li>
                      <li><a href="other_charts.html">Other Charts</a></li>
                    </ul>
                  </li>
                  
                  <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                      <li><a href="fixed_footer.html">Fixed Footer</a></li>
                    </ul>
                  </li>
                </ul>
                -->
              </div>
              
              <!-- 
              <div class="menu_section">

                <h3>Live On</h3>

                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>                  
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
                
              </div>
             -->
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>


        <!-- top navigation -->
</head>
<?php
 session_start(); $getName = $_SESSION['user_name']; ?>
<body class="nav-md">
<div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../Public/images/2.jpg" alt=""><?php echo $getName ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>订单评价管理表</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                  <div class="fuck"> 
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>快件编号</th>
                          <th>邮政编码</th>
                          <th>省</th>
                          <th>市</th>
                          <th>区</th>
                          <th>街区</th>
                          <th>门牌号</th>
                          <th>操作</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$address): $mod = ($i % 2 );++$i;?><tr class="address">
                          <td><?php echo ($address["goods_id"]); ?></td>
                          <td><?php echo ($address["address_id"]); ?></td>
                          <td><?php echo ($address["delivery_province"]); ?></td>
                          <td><?php echo ($address["delivery_city"]); ?></td>
                          <td><?php echo ($address["delivery_area"]); ?></td>
                          <td><?php echo ($address["delivery_street"]); ?></td>
                          <td><?php echo ($address["delivery_streetno"]); ?></td>
                          <td><button><a href="javascript:;" id="update">修改</a></button></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <div id="addressdialogBg"></div>
    <div id="addressdialog" class="animated">
      <img class="dialogIco" width="50" height="50" src="../Public/images/ico.png" alt="" />
      <div class="dialogTop">
        <a href="javascript:;" class="claseDialogBtn">关闭</a>
      </div>
      <form action="/speed/index.php/Home/Address/addressUpdatado" method="post" id="editForm">
        <ul class="editInfos">
          <li><label>快件&nbsp;&nbsp;&nbsp;&nbsp;编号：<input type="text" name="id" required value="" class="ipt" id="id" readonly="true"/></label></li>
          <li><label>邮政&nbsp;&nbsp;&nbsp;&nbsp;编码：<input type="text" name="postcode" required value="" class="ipt" id="postcode"/></label></li>
          <li><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;省：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="province" required value="" class="ipt" id="province"/></label></li>
          <li><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;市：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="city" required value="" class="ipt" id="city"/></label></li>
          <li><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;区：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="area" required value="" class="ipt" id="area"/></label></li>
          <li><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;街区：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="street" required value="" class="ipt" id="street"/></label></li>
          <li><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;门牌：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="streetno" required value="" class="ipt" id="streetno"/></label></li>
          <li><input type="submit" value="确认提交" class="submitBtn" name="sub" /></li>
        </ul>
      </form>
    </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            速捷后台管理系统 from ----King of ducks---
          </div>
          <div class="clearfix"></div>
        </footer> 
<!-- jQuery -->
    <script src="/speed/Public/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/speed/Public/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="/speed/Public/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/speed/Public/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="/speed/Public/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="/speed/Public/vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- morris.js -->
    <script src="/speed/Public/vendors/raphael/raphael.min.js"></script>
    <script src="/speed/Public/vendors/morris.js/morris.min.js"></script>
    <!-- gauge.js -->
    <script src="/speed/Public/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="/speed/Public/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- Skycons -->
    <script src="/speed/Public/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="/speed/Public/vendors/Flot/jquery.flot.js"></script>
    <script src="/speed/Public/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="/speed/Public/vendors/Flot/jquery.flot.time.js"></script>
    <script src="/speed/Public/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="/speed/Public/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="/speed/Public/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="/speed/Public/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="/speed/Public/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="/speed/Public/vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="/speed/Public/vendors/moment/min/moment.min.js"></script>
    <script src="/speed/Public/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="/speed/Public/js/custom.min.js"></script>
  </body>
</html>