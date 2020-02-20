<!DOCTYPE html>
<html>
<head>
	<title>SEAAN 2018</title>
	<style type="text/css">
	div.header {
	    display: block; text-align: center; 
	    position: running(header);
	}
	div.footer {
	    display: block; text-align: center;
	    position: running(footer);
	}
	@page {
	    @top-center { content: element(header) }
	}
	@page { 
	    @bottom-center { content: element(footer) }
	}
	.pagebreak { page-break-before: always; } /* page-break-after works, as well */
	</style>
	<script type="text/javascript">
		window.print();
	</script>
</head>
<body>
	<div class='header'><img src="<?=base_url()?>assets/header.jpg" width="100%" height="125px"/></div>
	
	
<p style="text-align: right;">Bandar Lampung, <?=$tanggal?></p>

<p>Dear Colleague,</p>

<p>We are pleased to inform you that your abstract, entitled :</p>

<p style="text-align: center;">&ldquo;<?=$tittle?>&rdquo;</p>

<p>has been reviewed and accepted to be presented at <strong>10th South East Asia Astronomy Network (SEAAN) 2018 Meeting</strong> to be held on 19-21 October 2018 taking place at Bukit Randu, Hotel and Restaurant, Lampung, Sumatera, Indonesia.</p>
<table>
	<tr>
		<td><strong>Session</strong></td>
		<td>: <?=$session?></td>
	</tr>
	<tr>
		<td><strong>Authors</strong></td>
		<td>: <?=$author?></td>
	</tr>
</table><br/>

<table border="1" cellspacing="0" width="100%">
	<tbody>
		<tr>
			<td style="vertical-align:top; width:157.25pt">
			<strong>Review Decision</strong>
			</td>
			<td style="vertical-align:top; width:310.25pt">
			Accepted
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top; width:157.25pt">
			<strong>Reviewer Comments</strong>
			</td>
			<td style="vertical-align:top; width:310.25pt">
			<?=$status?>
			</td>
		</tr>
	</tbody>
</table>

<p style="text-align: justify;">Kindly confirm us your acceptance on this decision until 13 September 2018. If you do not confirm until the due date, regretfully we will assume that you withdraw from the meeting, your presentation will be cancelled and the abstract will not appear in the program book.</p>

<p  style="text-align: justify;">Please submit your full paper to the SEAAN system <a href="http://register.seaan2018.itera.ac.id/">http://register.seaan2018.itera.ac.id/</a> over your personal account (Deadline 22 October 2018), and make the payment for registration fee before the deadline (Early Bird: September 7, 2018 and Regular: September 31, 2018), visit our website for more information.</p>

<p><strong>Registration Fees</strong></p>

<table border="1" cellspacing="0" width="100%">
	<tbody>
		<tr>
			<td style="vertical-align:top">
			<strong>Participant</strong>
			</td>
			<td style="vertical-align:top">
			<strong>Early Bird</strong>
			</td>
			<td style="vertical-align:top">
			<strong>Regular</strong>
			</td>
			<td style="vertical-align:top">
			<strong>On Site</strong>
			</td>
		</tr>
		<tr>
			<td colspan="4" style="vertical-align:top">
			<strong>Presenter</strong>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top">
			<strong>Student</strong>
			</td>
			<td style="vertical-align:top">
			500.000 IDR (34 USD)
			</td>
			<td style="vertical-align:top">
			600.000 IDR (40 USD)
			</td>
			<td style="vertical-align:top">
			650.000 IDR (44 USD)
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top">
			<strong>General</strong>
			</td>
			<td style="vertical-align:top">
			750.000 IDR (50 USD)
			</td>
			<td style="vertical-align:top">
			900.000 IDR (60 USD)
			</td>
			<td style="vertical-align:top">
			1.000.000 IDR (67 USD)
			</td>
		</tr>
	</tbody>
</table>

<p><strong>Please transfer to:</strong></p>
<table>
	<tr>
		<td>Beneficiary Name</td>
		<td>: Wirid Birastri</td>
	</tr>
	<tr>
		<td>Account Number</td>
		<td>: 0250998545</td>
	</tr>
	<tr>
		<td>Name of Bank</td>
		<td>: PT Bank Negara Indonesia (Persero) Tbk.</td>
	</tr>
	<tr>
		<td>Branch</td>
		<td>: Tanjung Karang</td>
	</tr>
	<tr>
		<td>Swift Code</td>
		<td>: BNINIDJA</td>
	</tr>
</table>

<p>Please send the proof of payment to&nbsp;&nbsp; : <a href="mailto:seaan2018@itera.ac.id">seaan2018@itera.ac.id</a></p>

		<div class="pagebreak"> 
		<p>Looking forward to seeing you at the <strong>10th</strong> <strong>South East Asia </strong><strong>Astronomy Network (SEAAN) 201</strong><strong>8 Meeting</strong>.</p>

		<img src="<?=base_url()?>assets/signature.jpg" width="150"/>

		<p><strong>Prof. Dr. Toto Winata</strong></p>

		<p>Chairman of SEAAN 2018</p>

		</div>






</body>
</html>