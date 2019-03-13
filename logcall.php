<!DOCTYPE html>
<html>
<head>
<title>Log Call</title>
//Zenden
<?php include "header.php"; 

	if(isset($_POST['btnProcessCall']))
	{
		$con = mysql_connect("localhost", "zxndxn", "emzen__");
		if(!$con)
			die ("Cannot connect to database;" . mysql_error());
		mysql_select_db("zenden_pessdb", $con);
		
		$sql = "INSERT INTO incident(callerName, phoneNumber,  incidentTyped, incidentLocation, incidentDesc,incidentStatusid) 
	    VALUES('$_POST[callerName]', '$_POST[contactNumber]', '$_POST[incidentType]', '$_POST[Location]', '$_POST[incidentDesc]', '1')";
		
		//echo $sql;
		if(!mysql_query($sql, $con))
				die("Error: " . mysql_error());
			
		mysql_close($con);
	}
?>

</head>
<body>

<?php 
					// localhost, accountName, password
$con =mysql_connect("localhost","zxndxn","emzen__");
if(!$con)
{
	die('Connect connect to database :'.mysql_error());
}
				// databaseName
mysql_select_db("zenden_pessdb",$con);
$result = mysql_query("SELECT * FROM incidenttype");
$incidentType;

while($row = mysql_fetch_array($result))
{
	//incidentTypeId,incidentTypeDesc
	$incidentType[$row['incidentTypeId']] = $row['incidentTypeDesc'];

}
mysql_close($con);
?>
	<form name="frmlogcall" method="POST" action="dispatch.php"><fieldset>
			<legend>Log Call</legend>
<table>
	<tr>
		<td align="right">Caller's name:</td>
		<td><p><input type="text" name="callerName"/></p></td>
	</tr><br><br>
			
	<tr>
		<td align="right">Contact No:</td>
		<td><p><input type="text" name="contactNumber"/></p></td>
	</tr><br><br>
			
	<tr>
		<td align="right">Location:</td>
		<td><p><input type="text" name="Location"></p></td>
	</tr>
				
			<tr></tr>
	<tr>
		<td align="right" class="td_label">Incident Type:</td>
		<td class="td_Date">
			<p>
			<select name="incidentType" id="incidentType">
				<?php foreach($incidentType as $key => $value){?>
					<option value="<?php echo $key?>"><?php echo $value ?></option>
				<?php } ?>
			</select>
			</p>
		</td>
	</tr>
	<tr>
		<td>Description:</td>
		<td><p><textarea name="incidentDesc" rows="5" cols="50"></textarea></p></td>
	</tr>
	<tr>
		<td><input type="reset" value="Reset"></td>
		<td><input type="submit" name="btnProcessCall" value="Process Call"></td>
	</tr>
</table>
  <br><br>
		</fieldset>
	</form>
</body>
</html>