<?php include 'header.php';
$id=$_GET['id']; ?>
<style>
.table-bordered {
	border: 1px solid #000000;
}
.table-bordered th, .table-bordered td{
	border: 1px solid #000000;
}
.table th, .table td {
	padding:2px 10px 2px 10px;
}

.challan{
	font-weight:bold;
}
.amountWords{
	text-decoration:underline;
	font-style:italic;
	color:#f26522;
}


</style>

<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css">
<script src="js/jquery.fancybox.js"></script>

<div class="container-fluid">
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Bill Collection Receipt/Invoice
			<?php
				$sqld = "select * FROM `balance_sheet` WHERE `id`='$id'";
				$resultd = mysqli_query($conn, $sqld);
				$rowd = mysqli_fetch_array($resultd);
			?>
			<!-- Your HTML content goes here -->
			<button class="btn btn-default" onclick="printDiv('printableArea')" style="float:right;"><i class="fa fa-print" aria-hidden="true" style="font-size: 17px;"> Print</i></button></div>
			<div class="card-body" id="printableArea">
				<div class="row">
					<div class="col-sm-1"></div>
					<div class="col-sm-10">
						<div class="row">
							<div class="col-sm-6">	
								<p>
								<img src="images/Saif_Engineering_Logo_165X72.png" height="100px;"/></p></div>
							<div class="col-sm-6">
								<table class="table table-bordered">
									<tr>
										<th>Announcement ID:</th>
										<td><?php echo $rowd['balance_ref']; ?></td>
									</tr>
									<tr>
										<th>Collection Date:</th>
										<td><?php
										echo $rowd['date']; ?></td>
									</tr>
								</table>
							</div>
						</div>
						<center><button class="btn btn-block btn-secondary challan">Bill Collection Receipt/Invoice</button></center>
						<table class="table table-bordered">
							<tbody>
							<tr>
							  <th>Date</th>
							  <th>Amount</th>
							  <th>Payment Method</th>
							</tr>
							
							<?php			
							$id	=	$_GET['id'];
							$sql = "select * FROM `balance_sheet` WHERE `id`='$id'";
							$result = mysqli_query($conn, $sql);
							$row = mysqli_fetch_array($result);
							$amount= $row['deposit_amount'];
								?>
							<tr>
							  <td><?php echo $row['date'] ?></td>
							  <td><?php echo $row['deposit_amount']; ?></td>
							  <td>Cash</td>
							</tr>
							</tbody>
						  </table>
						<b>Total Amount in words: 
							<span class="amountWords"><?php echo convertNumberToWords($amount).' Only';?></span>
						</b> 
						<div class="row" style="text-align:center">
							<div class="col-sm-5"></br></br>--------------------</br>Receiver Signature</div>
										
										
										
							<div class="col-sm-2"> </div>
							
							
							
							<div class="col-sm-5"></br></br>--------------------</br>Authorised Signature</div>
						</div></br>
						<div class="row">
							<div class="col-sm-12" style="border:1px solid gray;border-radius:5px;padding:10px;color:#f26522;">
								<h5>Notice***</br><span style="font-size:14px;color:#000000;">Please Check Everything Before Signature</span></h5>
								
							</div>
						</div>
					</div>
					<div class="col-sm-1"></div>
				</div>
			</div>				
			<script>
			function printDiv(divName) {
				 var printContents = document.getElementById(divName).innerHTML;
				 var originalContents = document.body.innerHTML;

				 document.body.innerHTML = printContents;

				 window.print();

				 document.body.innerHTML = originalContents;
			}
			</script>
		</div>
	</div>
<!-- /.container-fluid -->
<?php include 'footer.php' ?>