<?php
require_once('customers_in_km.php');
$file_name='Customers _Assignment_Coding Challenge (Upto 6 Years) (2).txt';
$Cust_in_km=customer_in_range($file_name);
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
			<?php  foreach ($Cust_in_km as  $value) :?>
				<tr>
					<td> <?php echo $value['user_id'];?></td>
					<td> <?php echo $value['name'];?></td>					
				</tr>
			<?php endforeach;?>
		</body>
	</table>
</body>
</html>
