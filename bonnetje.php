<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname   = 'bonnetje';

    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    echo "Connected successfully";
    echo "<br>";


$sql = 'SELECT * FROM bonnetjeinfo';
$result = $conn->query($sql);
$row="";
    $btwTariefLaag = 9;
    $btwTariefHoog = 21;
    $btwTotaalLaag = 0;
$btwTotaalHoog = 0;
$sum = 0;
$exclbtwvoedsel = 0;
$exclbtwalcohol = 0;
$tafel = "";
?>

<style>
    body{
		text-align: center;
		font-family: "Lucida Console";
		
    }
	
	.Bon{
	}
    table{
        margin: 0 auto;
    }
    .logo{
        background-color: aqua;
        width: 30%;
        height: 100px;
        margin: 0 auto;
    }
    hr{
        width: 30%;
    }
	
	table hr{
		width: 100% !important;
	}
</style>

<div class="Bon">
	<div class="logo"><p>Bruut</p></div>

<table>
	<tr>
	<td>Tafel :</td>
	</tr>
	<td>Bediend door: </td>
    <tr>
    <th>Aantal</th>
    <th>Omschrijving</th>
    <th>P/St</th>
    </tr>
    
<?php
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$sum += $row['PrijsPerStuk'];
		$tafel = $row['Tafelnummer'];
		$btwproducten ="";
		if($row['BTW'] == 9.00) {
            $btwTotaalLaag += ($row['PrijsPerStuk'] / 100) * $btwTariefLaag;
        	}elseif($row['BTW'] == 21){
            $btwTotaalHoog +=  ($row['PrijsPerStuk'] / 100) * $btwTariefHoog;
        }
    
		if($row['BTW'] == 9.00){
			$exclbtwvoedsel += $row['PrijsPerStuk'];
		}else{
			$exclbtwalcohol += $row['PrijsPerStuk'];
			
		}
		
		
        echo "<tr>" ;
        echo "<td>" .$row["Aantal"]. "</td>";
        echo "<td>".$row["Omschrijving"]."</td>";
        echo "<td>".$row["PrijsPerStuk"]."</td>";
        echo "</tr>";  
		
	}
	
		echo "<tr><td colspan='3'><hr width='100%' color='blue'></td></tr>";
		echo "<tr rowspan='3'><th colspan='2'>Totaal:</th><td>". $sum. "</td></tr>" ;
		echo "<tr><td colspan='3'><hr width='100%' color='blue'></td></tr>";
		echo "<table>" .
		 "<tr>" .
		 "<td>BTW%</td>" .
		 "<td>BTW</td>" .
		 "<td>Excl.:</td>" .
		 "<td>Incl.:</td>" .
		 "</tr>" ;
		echo "<tr>";
		echo "<td>9.00</td>";
		echo "<td>".$btwTotaalLaag ."</td>";
		echo "<td>yyy</td>";
		echo "<td>" .$exclbtwvoedsel ."</td>";
		echo "</tr>";
	
		echo "<tr>";
		echo "<td>21.00</td>";
		echo "<td>" .$btwTotaalHoog. "</td>";
		echo "<td>yyy</td>";
		echo "<td>".$exclbtwalcohol."</td>";
		echo "</tr>";
			echo "</table>";
	
    ?>
	
    </table>
    
	<?php
	?>
	
    
</div>

<div class="footer">
<p>Bedankt voor uw bezoek an graag tot ziens<br> www.BRUUT-nijmegen.nl</p>
</div>
<?php
   
}else {
    echo "0 results";
}






?>  

