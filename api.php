<?php
$online=@$_GET['online'];
$command="aping 192.168.165.0/24 192.168.175.0/24 192.168.176.0/24";
//$command2="aping 192.168.175.0/24";
//$command3="aping 192.168.176.0/24";
$aping=aping($command);
//$aping2=aping($command2);
//$aping3=aping($command3);
$data=db();


function aping($command){
  exec($command, $outcome, $status);
  array_shift($outcome); // remove first element
  array_shift($outcome); // remove first element
  array_shift($outcome); // remove first element
  foreach ($outcome as $value) {
      $part=explode(' - ',$value);
      $part1=explode(' (',$part['1']);
    
      $result[]= ($part1['0']);
      
    }
    return $result;
}


//print_r(aping($command));
//print_r(db());
function db(){
  include ('db.php');
  $sql = "SELECT * FROM `devices`";
  $query 	= mysqli_query($con, $sql);
  while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
  {
    
    //echo $row['ip'];
    $result[$row['ip']]=$row;

  }
  return $result;
}
function db2(){
  include ('db.php');
  $sql = "SELECT * FROM `devices`";
  $query 	= mysqli_query($con, $sql);
  while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
  {
    
    //echo $row['ip'];
    $result[]=$row;

  }
  return $result;
}

///////////////// shutdown 
function shutdown($ip)
{
  $cmd="shutdown /m ".$ip." /s";
  $res=exec($cmd, $outcome, $status);   
}

date_default_timezone_set('Iran');
$h=date("H");
/////////////////

        foreach ($aping as $key=>$ip):
					$pp[$key]['id']=$key+1;
					$pp[$key]['pc_name']=@$data[$ip]['pc_name'];
					$pp[$key]['operator_name']=@$data[$ip]['operator_name'];
          $pp[$key]['device_type']=@$data[$ip]['type'];
          $pp[$key]['location']=@$data[$ip]['location'];
          $pp[$key]['unit']=@$data[$ip]['unit'];
          $pp[$key]['kasper']=@$data[$ip]['kasper'];          
					$pp[$key]['ip']=$ip;
          $pp[$key]['shutdown']=@$data[$ip]['shutdown'];
          if(@$pp[$key]['shutdown']=="1"){
            if ($h>15)
              {
                //echo $pp[$key]['shutdown'];
                shutdown($pp[$key]['ip']);
              }
          }
        endforeach; 
        if($online=='true'){
          echo(json_encode($pp));	
        }
        else{
          $data2=db2();
          echo(json_encode($data2));
        }
        
        
				 
?>