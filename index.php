<?php
    require 'conf/DealData.php';
    $data = new DealData();
    //$data->getAndSaveData();
    $res = $data->getLastestData(1);
    $time = $res['time'];
    $name = $res['name'];
    $phone = $res['phone'];
    $times = $res['times'];
    $student_count = $res['count'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>十佳大学生信息统计</title>
		<link rel="stylesheet" href="css/960.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" charset="utf-8" />
        <link rel="stylesheet" href="css/colour.css" type="text/css" media="screen" charset="utf-8" />
        <link rel="stylesheet" href="css/copy.css" type="text/css" media="screen" charset="utf-8" />
		<!--[if IE]><![if gte IE 6]><![endif]-->
		<script src="js/glow/1.7.0/core/core.js" type="text/javascript"></script>
		<script src="js/glow/1.7.0/widgets/widgets.js" type="text/javascript"></script>
		<link href="js/glow/1.7.0/widgets/widgets.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript">
			glow.ready(function(){
				new glow.widgets.Sortable(
					'#content .grid_5, #content .grid_6',
					{
						draggableOptions : {
							handle : 'h2'
						}
					}
				);
			});
		</script>
		<!--[if IE]><![endif]><![endif]-->
	</head>
	<body>

		<h1 id="head" style="">2015重庆理工大学十佳大学生评选统计 </h1>
		
		<ul id="navigation">
			<li><span class="active">最新信息</span></li>
		</ul>

			<div id="content" class="container_16 clearfix">
				<div class="grid_5">
                    <?php for($num = 0; $num<$student_count/3; $num++){ ?>
					<div class="box">
						<h2><?php echo $name[$num]; ?></h2>
						<div class="utils">
							<a href="details.php?name=<?php echo $name[$num]; ?>">View More</a>
						</div>
                        <div style="width: 100%;">
                            <table>
                                <tbody>
                                <tr>
                                    <td><b>Total</b></td>
                                    <td><?php echo $times[$name[$num]][0]['phone']+$times[$name[$num]][0]['web'] ; ?></td>
                                </tr>
                            </table>
                            <div style="width: 100%; height: 20px;text-align: center;font-size: 18px"><b><?php echo date("m-d H:i", $time[1])."--".date("m-d H:i", $time[0]);   ?></b></div>
                            <table>
                                <tbody>
                                <tr>
                                    <td>Web</td>
                                    <td><?php echo $times[$name[$num]][0]['web']-$times[$name[$num]][1]['web'] ; ?></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><?php echo $times[$name[$num]][0]['phone']-$times[$name[$num]][1]['phone'] ; ?></td>
                                </tr>
                                </tbody>
                            </table>
                            <div style="width: 100%; height: 20px;text-align: center;font-size: 18px"><b><?php echo date("m-d H:i", $time[2])."--".date("m-d H:i", $time[1]);   ?></b></div>
                            <table>
                                <tbody>
                                <tr>
                                    <td>Web</td>
                                    <td><?php echo $times[$name[$num]][1]['web']-$times[$name[$num]][2]['web'] ; ?></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><?php echo $times[$name[$num]][1]['phone']-$times[$name[$num]][2]['phone'] ; ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
					</div>
                    <?php }?>
				</div>
				<div class="grid_6">
                    <?php for(; $num<$student_count/3*2; $num++){ ?>
                        <div class="box">
                            <h2><?php echo $name[$num]; ?></h2>
                            <div class="utils">
                                <a href="details.php?name=<?php echo $name[$num]; ?>">View More</a>
                            </div>
                            <div style="width: 100%;">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td><b>Total</b></td>
                                        <td><?php echo $times[$name[$num]][0]['phone']+$times[$name[$num]][0]['web'] ; ?></td>
                                    </tr>
                                </table>
                                <div style="width: 100%; height: 20px;text-align: center;font-size: 18px"><b><?php echo date("m-d H:i", $time[1])."--".date("m-d H:i", $time[0]);   ?></b></div>
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>Web</td>
                                        <td><?php echo $times[$name[$num]][0]['web']-$times[$name[$num]][1]['web'] ; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td><?php echo $times[$name[$num]][0]['phone']-$times[$name[$num]][1]['phone'] ; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div style="width: 100%; height: 20px;text-align: center;font-size: 18px"><b><?php echo date("m-d H:i", $time[2])."--".date("m-d H:i", $time[1]);   ?></b></div>
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>Web</td>
                                        <td><?php echo $times[$name[$num]][1]['web']-$times[$name[$num]][2]['web'] ; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td><?php echo $times[$name[$num]][1]['phone']-$times[$name[$num]][2]['phone'] ; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php }?>
                    </div>
				<div class="grid_5">
                    <?php for(; $num<$student_count; $num++){ ?>
                        <div class="box">
                            <h2><?php echo $name[$num]; ?></h2>
                            <div class="utils">
                                <a href="details.php?name=<?php echo $name[$num]; ?>">View More</a>
                            </div>
                            <div style="width: 100%;">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td><b>Total</b></td>
                                        <td><?php echo $times[$name[$num]][0]['phone']+$times[$name[$num]][0]['web'] ; ?></td>
                                    </tr>
                                </table>
                                <div style="width: 100%; height: 20px;text-align: center;font-size: 18px"><b><?php echo date("m-d H:i", $time[1])."--".date("m-d H:i", $time[0]);   ?></b></div>
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>Web</td>
                                        <td><?php echo $times[$name[$num]][0]['web']-$times[$name[$num]][1]['web'] ; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td><?php echo $times[$name[$num]][0]['phone']-$times[$name[$num]][1]['phone'] ; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div style="width: 100%; height: 20px;text-align: center;font-size: 18px"><b><?php echo date("m-d H:i", $time[2])."--".date("m-d H:i", $time[1]);   ?></b></div>
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>Web</td>
                                        <td><?php echo $times[$name[$num]][1]['web']-$times[$name[$num]][2]['web'] ; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td><?php echo $times[$name[$num]][1]['phone']-$times[$name[$num]][2]['phone'] ; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php }?>
				</div>
			</div>
        <div id="copy">
            <img src="images/lglogo.png" class="logo">
            <p>主办方：重庆理工大学党委学生工作部、学生工作处</p>
            <p>技术支持：重庆理工CFC团队</p>
            <h1>最终解释权归重庆理工大学</h1>
        </div>
	</body>
</html>