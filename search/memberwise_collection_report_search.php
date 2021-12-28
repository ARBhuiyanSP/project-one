<style>
.dtext{
	text-decoration:underline;
}
.linktext{
	font-size:12px;
}

</style>
<div class="card mb-3">
    <div class="card-header">
	
		<button class="btn btn-info linktext" onclick="window.location.href='collection_report.php';"> Collection Report Search</button>
		<button class="btn btn-success linktext"> Memberwise Collection Report </button>
	</div>

    <div class="card-body">
        <form class="form-horizontal" action="" id="warehouse_stock_search_form" method="GET">
            <div class="table-responsive">          
                <table class="table table-borderless search-table">
                    <tbody>
                        <tr>  
							<td>
                                <div class="form-group">
									<label for="sel1">Member:</label>
									<select class="form-control select2" id="member_id" name="member_id">
										<option value="">Select</option>
										<?php
										$parentCats = getTableDataByTableName('members', '', 'name');
										if (isset($parentCats) && !empty($parentCats)) {
											foreach ($parentCats as $pcat) {
												if($_GET['member_id'] == $pcat['member_id']){
													$selected	= 'selected';
													}else{
													$selected	= '';
													}
												?>
												<option value="<?php echo $pcat['member_id'] ?>" <?php echo $selected; ?>><?php echo $pcat['name'] ?></option>
											<?php }
										} ?>
									</select>
								</div>
                            </td>
							<td>
                                <div class="form-group">
                                    <label for="todate">From Date</label>
                                    <input type="text" class="form-control" id="from_date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" autocomplete="off" required >
                                </div>
                            </td>
							<td>
                                <div class="form-group">
                                    <label for="todate">To Date</label>
                                    <input type="text" class="form-control" id="to_date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" autocomplete="off" required >
                                </div>
                            </td>
							
							<td>
                                <div class="form-group">
                                    <label for="todate">.</label>
									<button type="submit" name="submit" class="form-control btn btn-primary">Search</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
<?php
if(isset($_GET['submit'])){
	
	$member_id		=	$_GET['member_id'];
	$from_date		=	$_GET['from_date'];
	$to_date		=	$_GET['to_date'];
	
	
?>
<center>
	
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10" id="printableArea">
			<div class="row">
				<div class="col-sm-12">	
					<center>
						<p>
							<img src="images/Saif_Engineering_Logo_165X72.png" height="100px;"/><br>
							<span>Collection Report</span><br>
							<?php
								$sqlname	=	"SELECT * FROM `members` WHERE `member_id`='$member_id'";
								$resultname = mysqli_query($conn, $sqlname);
								$rowname=mysqli_fetch_array($resultname);	
							?>
							<span>Member Name : <?php echo $rowname['name'];?></span><br>
							<span>Member ID : <?php echo $member_id;?></span><br>
							From  <span class="dtext"><?php echo date("jS F Y", strtotime($from_date));?> </span> Till  <span class="dtext"><?php echo date("jS F Y", strtotime($to_date));?> </span><br>
						</p>
					</center>
				</div>
			</div>
				<table id="" class="table table-bordered table-striped ">
					<thead>
						<tr>
							<th>Date</th>
							<th>Ref</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$sql	=	"SELECT * FROM `balance_sheet` WHERE `member_id`='$member_id' AND `type`='collection' AND `date` BETWEEN '$from_date' AND '$to_date'";
						$result = mysqli_query($conn, $sql);
						while($row=mysqli_fetch_array($result))
						{
						?>
										
							<tr>
								<td><?php echo $row['date']; ?></td>
								<td><?php echo $row['balance_ref']; ?></td>
								<td><?php echo $row['deposit_amount']; ?></td>
							</tr>
						<?php } ?>
							<tr>
								<td colspan="2">Total Collection</td>
								<td style="text-align:right;">
									<?php	
									$sqlinval = "SELECT SUM(`deposit_amount`) AS totalinval FROM `balance_sheet` WHERE `member_id`='$member_id' AND `type`='collection' AND `date` BETWEEN '$from_date' AND '$to_date'";
									$resultinval= mysqli_query($conn, $sqlinval);
									$rowinval = mysqli_fetch_object($resultinval) ;								
									
									$totalinvalue = $rowinval->totalinval;
									echo $english_format_number = number_format($totalinvalue);
									?>
								</td>
							</tr>
					</tbody>
				</table>
				<center><div class="row">
					<div class="col-sm-6"></br></br>--------------------</br>Receiver Signature</div>
					<div class="col-sm-6"></br></br>--------------------</br>Authorised Signature</div>
				</div></center></br>
				<div class="row">
					<div class="col-sm-12" style="border:1px solid gray;border-radius:5px;padding:10px;color:#f26522;">
						<center><h5>Notice***</br><span style="font-size:14px;color:#000000;">Please Check Everything Before Signature</span></h5></center>
						
					</div>
				</div>
			</div>			
		</div>
		<center><button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print" aria-hidden="true" style="    font-size: 17px;"> Print</i></button></center>
		<div class="col-md-1"></div>
</center>
<?php }?>
<script>
function printDiv(divName) {
	 var printContents = document.getElementById(divName).innerHTML;
	 var originalContents = document.body.innerHTML;

	 document.body.innerHTML = printContents;

	 window.print();

	 document.body.innerHTML = originalContents;
}
</script>
<script>
    $(function () {
        $("#from_date").datepicker({
            inline: true,
            dateFormat: "yy-mm-dd",
            yearRange: "-50:+10",
            changeYear: true,
            changeMonth: true
        });
    });
</script>
<script>
    $(function () {
        $("#to_date").datepicker({
            inline: true,
            dateFormat: "yy-mm-dd",
            yearRange: "-50:+10",
            changeYear: true,
            changeMonth: true
        });
    });
</script>


