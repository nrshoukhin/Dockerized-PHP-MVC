<!DOCTYPE html>
<html>
<head>
  <title>Report</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>

  <div class="container" style="padding: 20px 0px">
  	<div class="row">
  		<div class="col-6 text-left">
  			<h2>Report</h2>	
  		</div>
  		<div class="col-6">
  			<a class="btn btn-success" style="float: right;" href="<?= ROOT ?>">Crate Record</a>	
  		</div>
  	</div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Buyer</th>
          <th>Email</th>
          <th>Reciept ID</th>
          <th>Amount</th>
          <th>IP</th>
          <th>Note</th>
          <th>City</th>
          <th>Phone</th>
          <th>Entry at</th>
          <th>Entry by</th>
          <th>Item</th>
        </tr>
      </thead>
      <tbody>
      	<?php
      	$item = $this->loadModel('items');
      	foreach ($buyers as $key => $value) {

      	?>
      		<tr>
      		  <td><?= $value->buyer ?></td>
      		  <td><?= $value->buyer_email ?></td>
      		  <td><?= $value->receipt_id ?></td>
      		  <td><?= $value->amount ?></td>
      		  <td><?= $value->buyer_ip ?></td>
      		  <td><?= $value->note ?></td>
      		  <td><?= $value->city ?></td>
      		  <td><?= $value->phone ?></td>
      		  <td><?= date("d-m-Y",strtotime($value->entry_at)) ?></td>
      		  <td><?= $value->entry_by ?></td>
            <td><a href="<?= ROOT ?>/home/item_report/<?= $value->id ?>">Show Item</a></td>
      		</tr>
      	<?php
      	}
      	?>
        <!-- Add more rows as needed -->
      </tbody>
    </table>
  </div>

</body>
</html>
