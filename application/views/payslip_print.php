<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="application/pdf; charset=utf-8" />
<title>Payslip</title>
<style>

* {
  font-size: 11px;
  letter-spacing: -0.5px;
  font-weight: 700 !important;
}

table {
  border-collapse: collapse;
  width: 100%;
}

tr th {
  text-align: center;
}

tr.borderless td {
  border: none !important;
}

td, th {
  /* border: 1px solid #aaa; */
  /* text-align: left; */
  padding: 3px;
}

tr.title {
  background: #eee;
}

tr.break td {
  border: 0;
}

tr.grand-total td {
  border-top: 3px double #666;
}

.text-left {
  text-align: left;
}

.text-center {
  text-align: center;
}

.text-right {
  text-align: right;
}


@page { margin: 24px; }
body { margin: 24px; }

</style>
</head>
<body>

<img src="<?php echo FCPATH . 'assets/images/letterhead.png' ?>" style="width: 40%">

<h1 style="font-size: 15px;">PAYSLIP</h1>
<table style="margin-top:15px;">
	<tr>
		<td><?php echo date('F d, Y', strtotime($payroll[0]->paydate)); ?></td>
		<td></td>
		<td>No. Of Days: <?php echo number_format($payroll[0]->no_of_days,2,'.',','); ?></td>
	</tr>
	<tr>
	<td>
	Name: <u><?php echo strtoupper($payroll[0]->last_name.', '.$payroll[0]->first_name); ?></u>
	</td>
	<td>
	<!-- Employee Id: <u><?php echo $payroll[0]->employee_id; ?></u> -->
	-
	</td>
	<td>
	Daily Pay: <u><?php echo number_format($payroll[0]->daily_compensation, 2 ,'.',','); ?></u>
	</td>
	</tr>
	</table>
	<table width="100%" style="margin-top:10px"	frame="box" cellspacing="10">
		<tr>
			<td>
				Gross Pay:
			</td>
			<td align="right"><?php echo number_format($payroll[0]->basepay,2 ,'.',','); ?> </td>
		</tr>
		<tr>
			<td align="right">
				<i>add:</i>
			</td>
			<td>
            <?php 
				$totaladditional = 0;
				if(count($additionals) > 0){
					echo '<table cellpadding=0>';
					foreach($additionals as $add){
						echo '<tr>';
						if($add->name == "Others"){
							echo '<td width="200px">'.$add->name.'('.$add->note.')</td><td>';
						}
						else {
							echo '<td width="200px">'.$add->name.'</td><td>';
						}
						echo number_format($add->amount,2,'.',',').'</td>';
						echo '</tr>';
						$totaladditional += $add->amount;
					}
					echo '</table>';
				}else{
					echo '0.00';
				}
            ?>
			</td>
		</tr>
		<tr>
			<td>
				Total Additional:
			</td>
			<td  align="right"><?php echo number_format($totaladditional, 2 ,'.',',') ?></td>
		</tr>
		<tr>
			<td align="right">
				<i>less:</i>
			</td>
			<td>
            <?php 
				$totaldeduction = 0;
				if($deductions){
					echo '<table cellpadding=0>';
					foreach($deductions as $deduction){
						echo '<tr>';
						if($deduction->name == "Others"){
							echo '<td width="200px">'.$deduction->name.'('.$deduction->note.')</td><td>';
						}
						else {
							echo '<td width="200px">'.$deduction->name.'</td><td>';
						}
						echo '('.number_format($deduction->amount,2,'.',',').')</td>';
						echo '</tr>';
						$totaldeduction += $deduction->amount;
					}
					echo '</table>';
				}else{
					echo '0.00';
				}
            ?>
			</td>
		</tr>
		<tr>
			<td>
				Total Deduction:
			</td>
			<td  align="right">(<?php echo number_format($totaldeduction, 2 ,'.',',') ?>)</td>
		</tr>
		<tr>
			<td align="right">
				Net Pay:
			</td>
			<td align="right">
				<b><u>PHP <?php echo number_format($payroll[0]->net_pay, 2 ,'.',',') ?></u></b>
			</td>
		</tr>
	</table>
	<table  width="100%" style="margin-top:50px" cellspacing="10"">
		<tr>
			<td>___________________________</td>
			<td>___________________________</td>
		</tr>
		<tr>
			<td>Prepared by:</td>
			<td>Received by:</td>
		</tr>
	</table>	

</body>
</html>
