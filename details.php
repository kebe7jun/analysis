<?php
    require 'conf/DealData.php';
    $data = new DealData();
if($_POST['action'] == 'search')
    $res = $data->getLastestData(3);
else
    $res = $data->getLastestData(2);
    $time = $res['time'];
    $name = $res['name'];
    $phone = $res['phone'];
    $times = $res['times'];
    $student_count = $res['count'];
    $count1 = $res['count1'];
    for($i=0;$i <$student_count; $i++ )
        if($name[$i] == $_GET['name'])
        {
            $pos = $i;
            break;
        }
$pages = ceil($data->getCounts()/40.0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>十佳大学生信息统计</title>
		<link rel="stylesheet" href="css/960.css" type="text/css" media="screen" charset="utf-8" />
		<!--<link rel="stylesheet" href="css/fluid.css" type="text/css" media="screen" charset="utf-8" />-->
        <link rel="stylesheet" href="css/template.css" type="text/css" media="screen" charset="utf-8" />
        <link rel="stylesheet" href="css/copy.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/colour.css" type="text/css" media="screen" charset="utf-8" />
	</head>
	<body>
		
					<h1 id="head">2014重庆理工大学十佳大学生评选统计</h1>
		
		<ul id="navigation">
            <li><a href="/">最新信息</a></li>
            <li><span class="active">单人信息</a></span></li>
		</ul>
		
			<div id="content" class="container_16 clearfix">
				<div class="grid_16">
					<p>
						<h1><?php  echo $_GET['name'];  ?></h1>
                        <label>总票数：<?php  echo $times[$_GET['name']][0]['web']+$times[$_GET['name']][0]['phone'];  ?></label>
                        <label>Web端：<?php  echo $times[$_GET['name']][0]['web'];  ?></label>
                        <label>Phone端：<?php  echo $times[$_GET['name']][0]['phone'];  ?></label>
                    <hr>
					</p>
				</div>
                <form action="" method="post">
                    <input type="hidden" name="action" value="search" />
                    <div class="grid_7">
                        <p>
                            <label>开始时间</label>
                            <input type="date" name="date0"/>
                            <input type="time" name="time0" />
                        </p>
                    </div>
                    <div class="grid_7">
                        <p>
                            <label>结束时间</label>
                            <input type="date" name="date1"/>
                            <input type="time" name="time1" />
                        </p>
                    </div>
                    <div class="grid_2">
                        <p>
                            <label>&nbsp;</label>
                            <input type="submit" value="Search" />
                        </p>
                    </div>
                </form>
				<div class="grid_16">
					<table>
						<thead>
							<tr>
								<th>时间段</th>
								<th>Web票数</th>
								<th>Phone票数</th>
								<th colspan="2" width="10%">平均增长速度（票/分）</th>
							</tr>
						</thead>
						<tbody>
                        <?php  for($x = 0; $x<$count1-1; $x++){   ?>
							<tr>
								<td><?php echo date("m-d H:i",$time[$x+1])."--".date("m-d H:i",$time[$x]);   ?></td>
								<td><?php echo $times[$_GET['name']][$x]['web']-$times[$_GET['name']][$x+1]['web'] ; ?></td>
								<td <?php
	 if ($times[$_GET['name']][$x]['phone']-$times[$_GET['name']][$x+1]['phone'] >=30){
	echo "style=\"color:red; font-weight:900\"";
} else if ( $times[$_GET['name']][$x]['phone']-$times[$_GET['name']][$x+1]['phone']>=20){
	echo "style=\"color:yellow; font-weight:900\"";
} 
?>
><?php echo $times[$_GET['name']][$x]['phone']-$times[$_GET['name']][$x+1]['phone'] ; ?></td>
								<td><?php  echo  (($times[$_GET['name']][$x]['web']-$times[$_GET['name']][$x+1]['web'])/10);  ?></td>
                                <td><?php  echo  (($times[$_GET['name']][$x]['phone']-$times[$_GET['name']][$x+1]['phone'])/10);  ?></td>
							</tr>
                        <?php } ?>
                        <tr style="text-align: center">
                            <td>截止到<?php echo date("m-d H:i",$time[$x]);   ?></td>
                            <td><?php echo $times[$_GET['name']][$x]['web']; ?></td>
                            <td><?php echo $times[$_GET['name']][$x]['phone'] ; ?></td>
                            <td>--</td>
                            <td>--</td>
                        </tr>
						</tbody>
					</table>
				</div>
                <div id="page" style="width: <?php echo $pages*17;  ?>px;margin-left: <?php echo (960-23*$pages)/2;   ?>px">
                    <table>
                        <tr>
                            <?php
                            for($i = 1; $i<=$pages; $i++){ ?>
                                <td style="padding: 2px;">
                                    <a href="details.php?name=<?php echo $_GET['name']; ?>&page=<?php echo $i; ?>"><?php if((!isset($_GET['page']) && $i == 1) || $_GET['page'] == $i)

                                            echo '<span style="color:yellowgreen">'.$i."</span>";
                                        else echo $i;
                                        ?></a>
                                </td>
                            <?php } ?>
                        </tr>
                    </table>
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
