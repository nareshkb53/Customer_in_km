
<?php

$file_name='Customers _Assignment_Coding Challenge (Upto 6 Years) (2).txt';

$Cust_in_100km=customer_in_range($file_name);

/*
| This function will take two parameters first is the name of the file and 2nd No of KM and will return the user_id and name of the customer in an array format 
| Step 1.:- Get the text file into string using the file_get_contents 
| Step 2.:-Explodeded the data with new line   
| Step 3.:-For the sorting of the array user_id is used as a key in the array 
| Step 4.:-caluclate  the distance using distance_in_km function with two parametr that is declared below 
| Step 5.:-If the Distance is Less then or Equal to the 100KM then saved that pair into the cust_in_100km
| Step 6.:-Unset the unnecessary values that are parasent in the $Cust_data_arra 
| Step 6.:-For the sorting of the array user_id is used as a key of the array and array is sorted using the key sort function 
| Step 7.:-Return the array within the given kilometer range 
*/

function customer_in_range($file_name,$KM=100){
	$Customer_json_data = file_get_contents($file_name);
	$Customer_json_data=explode("\n", $Customer_json_data); 

	$Cust_in_100km=array();//Output data(Customer with in the rage of given KM)

	foreach ($Customer_json_data as $json_data) {
		$Cust_data_array=json_decode($json_data,true);
		$key=$Cust_data_array['user_id'];
		$Cust_data_array['DistanceInKM']=distance_in_km($Cust_data_array['latitude'],$Cust_data_array['longitude']);
		if($Cust_data_array['DistanceInKM']<=$KM){
			unset($Cust_data_array['DistanceInKM'],$Cust_data_array['latitude'],$Cust_data_array['longitude']);
			$Cust_in_100km[$key]=$Cust_data_array;		
		}	
	}	
	ksort($Cust_in_100km);

	return $Cust_in_100km;
}


/*
| function to calculte the distance 
| This function will take two parameter $latitude and $lnlongitude
| $Dublin_latitude  is the latitude of the Dublin that is 53.339428
| $Dublin_longitude is the lnlongitude of the Dublin that is -6.257664
| This function will return the data in integer form 
*/
function distance_in_km($latitude,$longitude){
	$Dublin_latitude=53.339428;
	$Dublin_longitude=-6.257664;
	if ( $Dublin_latitude==$latitude && $Dublin_longitude==$longitude) {
		return 0;
	}else{
		$theta=$Dublin_longitude-$longitude;
		$dist = sin(deg2rad($Dublin_latitude)) * sin(deg2rad($latitude)) +  cos(deg2rad($Dublin_latitude)) * cos(deg2rad($latitude)) * cos(deg2rad($theta));
    	$dist = acos($dist);
    	$dist = rad2deg($dist);
    	$miles = $dist * 60 * 1.1515;
    	$unit = strtoupper($unit);
    	return ($miles * 1.609344);
	}
	
}
//Function distance_in_km ends
?>

<!-- For the Representation of the  data   -->

<!DOCTYPE html>
<html>
<head>
	<title>Customer for food and drinks in Dublin near by 100KM -Assignment </title>
</head>
<body>
	<table border='1'>
		<thead>
			<tr>
				<td>User_id</td>
				<td>Name</td>
				
			</tr>
		</thead>
		<body>
			<?php  foreach ($Cust_in_100km as  $value) :?>
				<tr>
					<td> <?php echo $value['user_id'];?></td>
					<td> <?php echo $value['name'];?></td>
					
				</tr>
			<?php endforeach;?>
		</body>
	</table>

</body>
</html>