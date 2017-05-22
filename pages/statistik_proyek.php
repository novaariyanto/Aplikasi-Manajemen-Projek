<?php
$pic = $_SESSION['id_user'];

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Statistik</title>

</head>
<body>
          <div id="container" class="col-sm-11" style="height: 500px;" ></div>
          <?php

	// $qry2 = mysqli_query($koneksi,"SELECT sum(percent_progress)as progres,sum(status)as total  FROM tb_task where id_project = $id_project and $id_user = $id_user and status=1 ")or die(mysqli_error($koneksi));
	// 	$da = mysqli_fetch_object($qry2);
	

        $result = mysqli_query($koneksi,"SELECT *  FROM tb_project
         	where pic='$pic' and status > 0" );

			
while ($row = mysqli_fetch_array($result)) {

	$id  = $row['id_project'];
	$qry = mysqli_query($koneksi,"SELECT 
		SUM(tb_task.percent_progress) as persen,
		count(tb_task.id_task) as total 
		from tb_task INNER JOIN tb_project 
		on tb_task.id_project = tb_project.id_project 
		where tb_task.id_project = '$id'

		")or die(mysqli_error($koneksi));

	$da = mysqli_fetch_object($qry);
		$total = $da->total;
		$progres = $da->persen;
		$progress = number_format($progres,2,'.','.');
		@$persen = $progress/$total;
		if(is_nan($persen)){
			$persen = 0;
		}
			

		

	$name = "'".$row['project_name']."'";
	$data[] = "[$name,$persen]";

}

?>

   <script type="text/javascript">
  $(document).ready(function(){
//Create the chart
// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Statistik Pekerjaan'
    },
    subtitle: {
        text: 'kejarkoding.blogspot.com'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Persentase'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },
    series: [{
    	data: [<?php echo join($data,','); ?>]
    }]


});
  });
</script>
</body>
</html>
