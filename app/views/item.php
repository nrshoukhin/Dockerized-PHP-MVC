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
  			<h2>Items</h2>	
  		</div>
  		<div class="col-6">
  			<a class="btn btn-success" style="float: right;" href="<?= ROOT ?>/home/buyer_report">Back</a>	
        <a class="btn btn-success" style="float: right; margin-right: 5px;" href="<?= ROOT ?>">Create Report</a>  
  		</div>
  	</div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Item Name</th>
        </tr>
      </thead>
      <tbody>
      	<?php
      	foreach ($items as $key => $value) {

      	?>
      		<tr>
      		  <td><?= $value->item ?></td>
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
