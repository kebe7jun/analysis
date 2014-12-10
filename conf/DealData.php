<?php
header("Content-type: text/html; charset=utf-8");
	include 'MysqlCon.php';
	class DealData extends MysqlCon
    {
		public function getAndSaveData($url)
		{
            //$url = 'http://'.$_SERVER['HTTP_HOST'].'/returnfiletest.php';
			// $info = '{"web":[{"name":"唐 林","number":28},{"name":"李 涵","number":27},{"name":"顾明贇","number":25},{"name":"杨正清","number":24},{"name":"杨云梅","number":23},{"name":"姜 彬","number":20},{"name":"郑 彬","number":19},{"name":"沈越非","number":16},{"name":"黄 凯","number":15},{"name":"张 越","number":14},{"name":"鲁天琪","number":13},{"name":"刘世程","number":12},{"name":"朱晓娇","number":11},{"name":"梁修明","number":7},{"name":"郝一帆","number":6}],"phone":[{"name":"郝一帆","number":344},{"name":"顾明贇","number":139},{"name":"姜 彬","number":130},{"name":"李 涵","number":130},{"name":"唐 林","number":129},{"name":"沈越非","number":23},{"name":"杨正清","number":18},{"name":"杨云梅","number":17},{"name":"梁修明","number":12},{"name":"郑 彬","number":11},{"name":"张 越","number":3},{"name":"黄 凯","number":2},{"name":"刘世程","number":2},{"name":"鲁天琪","number":2},{"name":"朱晓娇","number":1}],"scence":[{"name":"张 越","number":0},{"name":"黄 凯","number":0},{"name":"刘世程","number":0},{"name":"鲁天琪","number":0},{"name":"顾明贇","number":0},{"name":"姜 彬","number":0},{"name":"唐 林","number":0},{"name":"李 涵","number":0},{"name":"杨云梅","number":0},{"name":"杨正清","number":0},{"name":"沈越非","number":0},{"name":"梁修明","number":0},{"name":"朱晓娇","number":0},{"name":"郝一帆","number":0},{"name":"郑 彬","number":0}]}';
			$info = file_get_contents($url);
            if(strpos($info,'{"web"')===0)   // 判断数据是否正确
            {
                $con = parent::connectToMysql();
                $sql = "insert into data (id, data, time) value(null, '".$info."', ".time()." ) ";      //将数据写入数据库。
                echo mysqli_query($con, $sql)?"Ok.       ":"Failed to write into Database.            ";
                parent::closeMysql($con);
            }
            else
                echo "The data gotten from internet is ERROR.             ";     //返回错误码
        }
		public function getLastestVotedCount()
		{
            $con = parent::connectToMysql();
            $sql = "select * from data order by id desc limit 3";      //查询最新数据
            $result  = mysqli_query($con, $sql);
            $i = 0;
            while(($result1[$i++] = mysqli_fetch_array($result)) && $i<3)
            {
            }
            parent::closeMysql($con);
            return json_encode($result1);
		}
        public function getLastestVotedCountByTime($start = 0, $end = -1)
        {
            if($end == -1)
                $end = time();
            $con = parent::connectToMysql();
            if(!isset($_GET['page']))
            {
                $page = 1;
            }
            else
                $page = $_GET['page'];
            $sql = "select * from data where time>".$start." and time < ".$end." order by id desc limit ".(($page-1)*40).",40";      //查询最新数据
            $result  = mysqli_query($con, $sql);
            $i = 0;
            while($result2 = mysqli_fetch_array($result) )
            {
                $result1[$i++] = $result2;
            }
            parent::closeMysql($con);
            return json_encode($result1);
        }
        public function getCounts()
        {
            $con = parent::connectToMysql();
            $sql = "select count(*) from data";
            $result = mysqli_query($con, $sql);
            $result = mysqli_fetch_array($result);
            parent::closeMysql($con);
            return $result[0];
        }
        public function getLastestData($type = 1)
        {
            if($type == 1)
            {
               $data = json_decode($this->getLastestVotedCount());      //获取大致信息
            }
            else if($type == 2)
            {
                $data = json_decode($this->getLastestVotedCountByTime(0, time()));     //获取全部信息
            }
            else if($type == 3)
            {
                $t = $this->getTime();
                $data = json_decode($this->getLastestVotedCountByTime($t[0], $t[1]));     //获取全部信息
            }
            for($i = 0; $i<count($data);$i++)
            {
                $info[$i] = $data[$i]->data;
                $in = json_decode($info[$i]);
                $time[$i] = $data[$i]->time;
                $web = $in->web;
                $student_count = count($web);
                for($j = 0; $j<$student_count;$j++)
                {
                    $name[$j] = $web[$j]->name;
                    $times[$web[$j]->name][$i]['web'] = $web[$j]->number;
                }
                $phone = $in->phone;
                for($j = 0; $j<$student_count;$j++)
                {
                    $times[$phone[$j]->name][$i]['phone'] = $phone[$j]->number;
                }
            }
            $action = Array
            (
                'name'=> $name,
                'count'=> $student_count,
                'count1'=>count($data),
                'phone'=>$phone,
                'time'=>$time,
                'times'=> $times
            );
            return $action;
        }
        public function getTime()
        {
            if(!isset($_POST['date0']))
                return false;
            $date = explode('-',$_POST['date0']);
            $date1[0] = intval($date[0]);
            $date1[1] = intval($date[1]);
            $date1[2] = intval($date[2]);
            $time = explode(':',$_POST['time0']);
            $time1[0] = intval($time[0]);
            $time1[1] = intval($time[1]);
            $time1[2] = 0;
            $t[0] = mktime($time1[0], $time1[1], $time1[2], $date1[1], $date1[2], $date1[0]);
            $date = explode('-',$_POST['date1']);
            $date1[0] = intval($date[0]);
            $date1[1] = intval($date[1]);
            $date1[2] = intval($date[2]);
            $time = explode(':',$_POST['time1']);
            $time1[0] = intval($time[0]);
            $time1[1] = intval($time[1]);
            $time1[2] = 0;
            $t[1] = mktime($time1[0], $time1[1], $time1[2], $date1[1], $date1[2], $date1[0]);
            if($t[1]>$t[0])
                return $t;      //返回时间
            else
                return false;       //
        }
	}
?>
