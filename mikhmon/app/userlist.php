<?php
/*
 *  Copyright (C) 2017, 2018 Laksamadi Guko.
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
session_start();
?>
<?php
error_reporting(0);
require('./lib/api.php');
include('./config.php');

if(!isset($_SESSION['usermikhmon'])){
	header("Location:login.php");
}


$prof = $_GET['profile'];
$API = new RouterosAPI();
$API->debug = false;
if ($API->connect( $iphost, $userhost, $passwdhost )) {
	$API->write('/ip/hotspot/user/print', false);
	$API->write('?=profile='.$prof.'');
	$ARRAY = $API->read();

	$API->write('/ip/hotspot/user/print', false);
	$API->write('=count-only=', false);
	$API->write('?=profile='.$prof.'');
	$ARRAY2 = $API->read();

	$API->disconnect();
}
$listphp = "userlist.php";
?>
<?php
	//remove user
	$id = $_GET['id'];
	$prof = $_GET['profile'];
	if(isset($id)){
	if ($API->connect( $iphost, $userhost, $passwdhost )) {
	  $API->comm("/ip/hotspot/user/remove", array(
	    ".id"=> "$id",));
	    $API->disconnect();
	    header("Location:userlist.php?profile=$prof#");
	}
	}
	// disable user
	$id = $_GET['d'];
	if(isset($id)){
	if ($API->connect( $iphost, $userhost, $passwdhost )) {
	  $API->write('/ip/hotspot/user/set', false);
	  $API->write('=.id='.$id, false);
	  $API->write('=disabled=yes');
	  $API->read();
	  $API->disconnect();
	  header("Location:userlist.php?profile=$prof#");
	}
	}
	//enable user
	$id = $_GET['e'];
	if(isset($id)){
	if ($API->connect( $iphost, $userhost, $passwdhost )) {
	  $API->write('/ip/hotspot/user/set', false);
	  $API->write('=.id='.$id, false);
	  $API->write('=disabled=no');
	  $API->read();
	  $API->disconnect();
	  header("Location:userlist.php?profile=$prof#");
	}
	}
	//reset user
	$id = $_GET['idr'];
	$sname = $_GET['usr'];
	if(isset($_POST['resetuser'])){
	if ($API->connect( $iphost, $userhost, $passwdhost )) {
	  $API->write('/ip/hotspot/user/set', false);
	  $API->write('=.id='.$id, false);
	  $API->write('=limit-uptime=0');
	  $API->read();
	  $API->disconnect();
	}
	header("Location:userlist.php?profile=$prof#");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mikrotik Hotspot Monitor</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;"/>
		<link rel="icon" href="img/favicon.png" />
		<link rel="stylesheet" href="css/style.css" media="screen">
		<script>
			function Reload() {
				location.reload();
			}
			function goBack() {
				window.history.back();
			}
			
		</script>
	</head>
	<body>
	<div class="main">
	<table class="tnav">
		<tr>
			<td style="text-align: center;" colspan=2>Mikrotik Hotspot Monitor</td>
		</tr>
		<tr>
			<td><?php print_r($prof);?> Aktif  : <?php print_r($ARRAY2);?></td>
			<td>
				<button class="material-icons" onclick="Reload()" title="Reload">autorenew</button>
				<div class="dropdown" style="float:right;">
							<button class="material-icons dropbtn">local_play</button>
								<div class="dropdown-content">
									<a style="border-bottom: 1px solid #ccc;" href="#">Ganerate</a>
									<a href="genkv.php">1 Voucher</a>
									<a href="genkvs.php">1-99 Voucher</a>
									<a href="genupm.php">1 Custom User Pass</a>
								</div>
						</div>
						<div class="dropdown" style="float:right;">
							<button class="material-icons dropbtn">find_in_page</button>
								<div class="dropdown-content">
									<a style="border-bottom: 1px solid #ccc;" href="#">User by profile</a>
									<?php
								$proflist = array ('1'=>$profile1,$profile2,$profile3,$profile4,$profile5,$profile6,$profile7,$profile8,$profile9,$profile10,$profile11,$profile12,$profile13,$profile14,$profile15);
								
									if($profile1 == ""){
									}elseif ($profile2 == ""){
										for ($i = 1; $i <= 1; $i++) {
										echo "<a href='./userlist.php?profile=$proflist[$i]'>$proflist[$i]</a>";
									}
									}elseif ($profile3 == ""){
										for ($i = 1; $i <= 2; $i++) {
										echo "<a href='./userlist.php?profile=$proflist[$i]'>$proflist[$i]</a>";
									}
									}elseif ($profile4 == ""){
										for ($i = 1; $i <= 3; $i++) {
										echo "<a href='./userlist.php?profile=$proflist[$i]'>$proflist[$i]</a>";
									}
									}elseif ($profile5 == ""){
										for ($i = 1; $i <= 4; $i++) {
										echo "<a href='./userlist.php?profile=$proflist[$i]'>$proflist[$i]</a>";
									}
									}elseif ($profile6 == ""){
										for ($i = 1; $i <= 5; $i++) {
										echo "<a href='./userlist.php?profile=$proflist[$i]'>$proflist[$i]</a>";
									}
									}elseif ($profile7 == ""){
										for ($i = 1; $i <= 6; $i++) {
										echo "<a href='./userlist.php?profile=$proflist[$i]'>$proflist[$i]</a>";
									}
									}elseif ($profile8 == ""){
										for ($i = 1; $i <= 7; $i++) {
										echo "<a href='./userlist.php?profile=$proflist[$i]'>$proflist[$i]</a>";
									}
									}elseif ($profile9 == ""){
										for ($i = 1; $i <= 8; $i++) {
										echo "<a href='./userlist.php?profile=$proflist[$i]'>$proflist[$i]</a>";
									}
									}elseif ($profile10 == ""){
										for ($i = 1; $i <= 9; $i++) {
										echo "<a href='./userlist.php?profile=$proflist[$i]'>$proflist[$i]</a>";
									}
									}elseif ($profile11 == ""){
										for ($i = 1; $i <= 10; $i++) {
										echo "<a href='./userlist.php?profile=$proflist[$i]'>$proflist[$i]</a>";
									}
									}elseif ($profile12 == ""){
										for ($i = 1; $i <= 11; $i++) {
										echo "<a href='./userlist.php?profile=$proflist[$i]'>$proflist[$i]</a>";
									}
									}elseif ($profile13 == ""){
										for ($i = 1; $i <= 12; $i++) {
										echo "<a href='./userlist.php?profile=$proflist[$i]'>$proflist[$i]</a>";
									}
									}elseif ($profile14 == ""){
										for ($i = 1; $i <= 13; $i++) {
										echo "<a href='./userlist.php?profile=$proflist[$i]'>$proflist[$i]</a>";
									}
									}elseif ($profile15 == ""){
										for ($i = 1; $i <= 14; $i++) {
										echo "<a href='./userlist.php?profile=$proflist[$i]'>$proflist[$i]</a>";
									}
									}else{
										for ($i = 1; $i <= 15; $i++) {
										echo "<a href='./userlist.php?profile=$proflist[$i]'>$proflist[$i]</a>";
									}
									}
								?>
								</div>
				</div>
				<button class="material-icons" onclick="location.href='../';" title="Dashboard">dashboard</button>
				<button class="material-icons" onclick="goBack()" title="Back">arrow_back</button>
			</td>
		</tr>
	</table>
		<div style="overflow-x:auto;">
		  
		  
			<table id="tUser" style="white-space: nowrap;" class="zebra" >
				<tr>
				  <th title="Hapus User" style="text-align:center;">X</th>
				  <th title="Disable | Enable User" style='text-align:center;'>D/E</th>
					<th >
					  <div style="width:90%;">
					    <input style="width:90%;" type="text" id="CariU" size="auto" onkeyup="fCariU()" placeholder="User" title="Filter User berdasarkan Username">
					  </div>
					</th>
					<th >Password</th>
					<th >
					  <div style="width:90%;">
					    <input style="width:90%;" type="text" id="CariS" onkeyup="fCariS()" placeholder="Server" title="Filter User berdasarkan Server">
					  </div>
					</th>
					<th >Profile</th>
					<th >Uptime</th>
					<th >
					  <div style="width:90%;">
					    <input style="width:90%;" type="text" id="CariG" onkeyup="fCariG()" placeholder="Generated" title="Filter User berdasarkan tanggal Generate">
					  </div>
					</th>
				</tr>
				
				<?php
					$TotalReg = count($ARRAY);

						for ($i=0; $i<$TotalReg; $i++){
						  echo "<tr>";
						  $regtable = $ARRAY[$i];
						  echo "<td style='text-align:center;'><a title='Hapus User' style='color:#000;' href=userlist.php?profile=$prof&id=".$regtable['.id'] . ">X</a></td>";
						  if($regtable['disabled'] == "true"){echo "<td style='text-align:center;'><a title='Enable User'style='color:#000;' href=userlist.php?profile=$prof&e=".$regtable['.id'] . ">E</a></td>";}else{echo "<td style='text-align:center;'><a title='Disable User' style='color:#000;' href=userlist.php?profile=$prof&d=".$regtable['.id'] . ">D</a></td>";}
							echo "<td><a style='color:#000;' title='Klik untuk melihat masa aktifnya' href=userlist.php?profile=$prof&usr=" . $regtable['name'] . "&idr=" . $regtable['.id'] . "#cekuser>". $regtable['name']. "</a></td>";
							echo "<td><input disabled style='border:none; clolor:black;' type='password' value='" . $regtable['password'];
							echo "' id='".$regtable['name'] ."'><input title='Show/Hide Password' type='checkbox' onclick='".$regtable['name'] ."()'><script>function ".$regtable['name'] ."(){var x = document.getElementById('".$regtable['name'] ."');if (x.type === 'password') {x.type = 'text';} else {x.type = 'password';}}</script></td>";
							echo "<td>" . $regtable['server'];echo "</td>";
							echo "<td>" . $regtable['profile'];echo "</td>";
							echo "<td>" . $regtable['uptime'];echo "</td>";
							$vt = substr($regtable['comment'],0,2); echo "<td>" . substr($regtable['comment'],strlen($regtable['comment'],0) - 12,12) . "-" . $vt;
							if($vt == "kv"){
							  echo " | <a style='color:#000;' title='Cetak' href=vouchers/printkvs.php?id=" . $regtable['comment'] . " target='_blank'>Cetak</a>";echo " | <a style='color:#000;' title='Cetak QR' href=vouchers/printkvsqr.php?id=" . $regtable['comment'] . " target='_blank'> QR</a>";
							  
							}elseif($vt == "up"){
							  echo " | <a style='color:#000;' title='Klik untuk melihat masa aktifnya' href=vouchers/printvs.php?id=" . $regtable['comment'] . " target='_blank'>Cetak</a>";echo " | <a style='color:#000;' title='Klik untuk melihat masa aktifnya' href=vouchers/printvsqr.php?id=" . $regtable['comment'] . " target='_blank'> QR</a>";
							  
							}echo " |</td>";
							
							echo"</tr>";
							}
					?>
			</table>
		</div>
		<div id="cekuser" class="modal-window">
		<div>
			<a style="font-wight:bold;"href="userlist.php?profile=<?php echo $prof;?>#" title="Close" class="modal-close">X</a>
			<h3>Info User</h3>
	<?php
	$name = $_GET['usr'];
	if(isset($name)){
	if ($API->connect( $iphost, $userhost, $passwdhost )) {
	$API->write('/system/scheduler/print', false);
	$API->write('?=name='.$name.'');
	$ARRAY1 = $API->read();
	$regtable = $ARRAY1[0];
				$exp = $regtable['next-run'];
				$strd = $regtable['start-date'];
				$strt = $regtable['start-time'];
				$cek = $regtable['interval'];
					$ceklen = strlen(substr($cek,0));
					$cekw = substr($cek, 0,2);
					$cekw1 = substr($cekw, 0,1) ."Minggu";
					$cekd = substr($cek, 2,2);
					$cekd1 = substr($cek, 2,1) ."Hari";
				if ($ceklen > 3){
					$cekall = $cekw1 ." ".$cekd1;
				}elseif (substr($cek, -1) == "h"){
					$cek1 = substr($cek, 0,-1);
					$cekall = $cek1 ."Jam";
				}elseif (substr($cek, -1) == "d"){
					$cek1 = substr($cek, 0,-1);
					$cekall = $cek1 ."Hari";
				}elseif (substr($cek, -1) == "w"){
					$cek1 = substr($cek, 0,-1);
					$cekall = $cek1 ."Minggu";
				}elseif($cekall == ""){
					}
				 $cekall;

	$API->write('/ip/hotspot/user/print', false);
	$API->write('?=name='.$name.'');
	$ARRAY2 = $API->read();
	$regtable = $ARRAY2[0];
	  $uptime = $regtable['uptime'];
	  $uptimelimit = $regtable['limit-uptime'];
	  if($uptimelimit == "1s"){
	    $uplimit = "Expired";
	    $uplimitt = "Status";
	    $resetuser = "<td ><input type='submit' name='resetuser' class='btnsubmit' value='Reset'/></td>";
	  }else{
	    $uplimit = "$uptimelimit";
	    $uplimitt = "Limit Uptime";
	    $resetuser = "";
	  }
	  $byteo =  formatBytes2($regtable['bytes-out'],0);
	  $byteolimit = formatBytes2($regtable['limit-bytes-out'],0);

	echo "<div style='overflow-x:auto;'>";
	echo "<form autocomplete='off' method='post' action=''>";
	echo "<table>";
	echo "	<tr>";
	echo "		<td >User/Kode Voucher</td>";
	echo "		<td >:</td>";
	echo "		<td > $name</td>";
	echo "	</tr>";
	echo "	<tr>";
	echo "		<td >Masa Aktif</td>";
	echo "		<td >:</td>";
	echo "		<td >$cekall</td>";
	echo "	</tr>";
	echo "	<tr>";
	echo "		<td >Dari</td>";
	echo "		<td >:</td>";
	echo "		<td >$strd $strt</td>";
	echo "	</tr>";
	echo "	<tr>";
	echo "		<td >Sampai</td>";
	echo "		<td >:</td>";
	echo "		<td >$exp</td>";
	echo "	</tr>";
	echo "	<tr>";
	echo "		<td >$uplimitt</td>";
	echo "		<td >:</td>";
	echo "		<td >$uplimit</td>";
	echo "	</tr>";
	echo "	<tr>";
	echo "		<td >Uptime</td>";
	echo "		<td >:</td>";
	echo "		<td >$uptime</td>";
	echo "	</tr>";
	echo "	<tr>";
	echo "		<td >Limit Bytes Out</td>";
	echo "		<td >:</td>";
	echo "		<td >$byteolimit</td>";
	echo "	</tr>";
	echo "	<tr>";
	echo "		<td >Bytes Out</td>";
	echo "		<td >:</td>";
	echo "		<td >$byteo</td>";
	echo "	</tr>";
	echo "		<td ></td>";
	echo "		<td ></td>";
	echo "		$resetuser";
	echo "	</tr>";
	echo "</table>";
	echo "</form>";
	echo "</div>";
	
	$API->disconnect();
}
}
?>
    </div>
    </div>
	</div>
<script>
function fCariU() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("CariU");
  filter = input.value.toUpperCase();
  table = document.getElementById("tUser");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
function fCariS() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("CariS");
  filter = input.value.toUpperCase();
  table = document.getElementById("tUser");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
function fCariG() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("CariG");
  filter = input.value.toUpperCase();
  table = document.getElementById("tUser");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[7];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
<?php

function formatBytes($bytes, $precision = 2) {
$units = array('B', 'KB', 'MB', 'GB', 'TB');

$bytes = max($bytes, 0);
$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
$pow = min($pow, count($units) - 1);

// Uncomment one of the following alternatives
// $bytes /= pow(1024, $pow);
// $bytes /= (1 << (10 * $pow));

return round($bytes, $precision) . ' ' . $units[$pow];
}

function formatBytes2($size, $decimals = 0){
$unit = array(
'0' => 'Byte',
'1' => 'KiB',
'2' => 'MiB',
'3' => 'GiB',
'4' => 'TiB',
'5' => 'PiB',
'6' => 'EiB',
'7' => 'ZiB',
'8' => 'YiB'
);

for($i = 0; $size >= 1024 && $i <= count($unit); $i++){
$size = $size/1024;
}

return round($size, $decimals).' '.$unit[$i];
}

?>
	</body>
</html>
