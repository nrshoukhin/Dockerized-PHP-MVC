<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Xpeedstudio</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
	<style type="text/css">
		.hidden{
			display: none;
		}
	</style>
</head>
<body style="padding-top: 30px;"  style="padding: 20px 0px">
	<div class="container">
		<div class="row">
			<div class="col-6 text-left">
				<h2>Buyer Form</h2>	
			</div>
			<div class="col-6">
				<a class="btn btn-success" style="float: right;" href="<?= ROOT ?>/home/buyer_report">Report</a>	
			</div>
		</div>
		<form method="post">
			<div class="row">
				<div class="col-12">
					<div class="mb-3">
					  	<label for="buyer-name" class="form-label">Buyer</label>
					  	<input type="text" class="form-control" id="buyer-name" placeholder="Provide your name" name="buyer_name" value="<?= empty($_POST['buyer_name'])?'':$_POST['buyer_name'] ?>">
					  	<small style="color: red; <?= empty($this->errors['buyer_name'])?'display: none;':'' ?>" id="buyer-name-error">Invalid input! Please enter only text, numbers, and spaces, up to 20 characters.</small>
					</div>
					<div class="mb-3">
					  	<label for="buyer-email" class="form-label">Buyer Email</label>
					  	<input type="email" class="form-control" id="buyer-email" placeholder="Provide your email" oninput="validateEmail()" name="buyer_email" value="<?= empty($_POST['buyer_email'])?'':$_POST['buyer_email'] ?>">
					  	<small style="color: red; <?= empty($this->errors['buyer_email'])?'display: none;':'' ?>" id="buyer-email-error">Invalid email.</small>
					</div>
					<div class="mb-3">
					  	<label for="receipt-id" class="form-label">Receipt ID</label>
					  	<input type="text" class="form-control" id="receipt-id" placeholder="Provide Receipt ID" oninput="checkOnlyText(this)" name="receipt_id" value="<?= empty($_POST['receipt_id'])?'':$_POST['receipt_id'] ?>">
					  	<small style="color: red; <?= empty($this->errors['receipt_id'])?'display: none;':'' ?>" id="receipt-id-error">Please provide only text</small>
					</div>
					<div class="mb-3">
					  	<label for="receipt-id" class="form-label">Items</label>
					  	<div id="textFieldContainer">
					  		<?php
					  		if( !empty($_POST['item']) ){
					  			foreach ($_POST['item'] as $key => $value) {
					  				?>
					  				<div class="form-group">
					  					<div class="row mb-3">
					  						<div class="col-6"><input type="text" class="form-control item-field" name="item[]" placeholder="Enter text" oninput="isTextOnly(this)" value="<?= $value ?>"></div>
					  						<div class="col-3">
					  							<?php if( count($_POST['item']) > 1 ){ ?>
					  							<button type="button" class="btn btn-danger btn-sm remove-item" onclick="removeTextField(this)">X</button>
					  							<?php } ?>
					  						</div>
					  						<small style="<?= empty($this->errors['item'][$key])?'display: none;':'' ?>color: red;">Please provide only text and spaces</small>
					  					</div>					  	    	
					  				</div>
					  				<?php
					  			}
					  		}else{
					  		?>
					  	  	<div class="form-group">
					  	  		<div class="row mb-3">
					  	  			<div class="col-6"><input type="text" class="form-control item-field" name="item[]" placeholder="Enter text" oninput="isTextOnly(this)"></div>
					  	  			<div class="col-3">
					  	  				<button type="button" class="btn btn-danger btn-sm remove-item hidden" onclick="removeTextField(this)">X</button>
					  	  			</div>
					  	  			<small style="display: none;color: red;">Please provide only text and spaces</small>
					  	  		</div>					  	    	
					  	  	</div>
					  	  	<?php } ?>
					  	</div>
					  	<button type="button" class="btn btn-success btn-sm add-item" onclick="addTextField()">Add Item</button>
					</div>
					<div class="mb-3">
					  	<label for="amount" class="form-label">Amount</label>
					  	<input type="text" class="form-control" id="amount" name="amount" placeholder="Provide Amount" oninput="onlyNumbers(this)" value="<?= empty($_POST['amount'])?'':$_POST['amount'] ?>">
					  	<small style="color: red; <?= empty($this->errors['amount'])?'display: none;':'' ?>" id="amount-error">Invalid Amount. Provide only numbers.</small>
					</div>
					<div class="mb-3">
					  	<label for="note" class="form-label">Note</label>
					  	<textarea class="form-control" id="note" rows="3" oninput="validateWordCount(this)" name="note"><?= empty($_POST['note'])?'':$_POST['note'] ?></textarea>
					  	<small style="color: red; <?= empty($this->errors['note'])?'display: none;':'' ?>" id="note-error">Maximum 30 words allowed.</small>
					</div>
					<div class="mb-3">
					  	<label for="city" class="form-label">City</label>
					  	<input type="text" name="city" class="form-control" id="city" placeholder="Provide City" oninput="validateTextAndSpaces(this)" value="<?= empty($_POST['city'])?'':$_POST['city'] ?>">
					  	<small style="color: red; <?= empty($this->errors['city'])?'display: none;':'' ?>" id="city-error">Only text and space are allowed</small>
					</div>
					<div class="mb-3">
					  	<label for="city" class="form-label">Phone</label>
					  	<input type="text" name="phone" class="form-control" id="phone" placeholder="Provide Phone" oninput="validatePhoneNumber(this)" value="<?= empty($_POST['phone'])?'':$_POST['phone'] ?>">
					  	<small style="color: red; <?= empty($this->errors['phone'])?'display: none;':'' ?>" id="phone-error">Invalid Phone Number</small>
					</div>
					<div class="mb-3">
					  	<label for="entry-by" class="form-label">Entry by</label>
					  	<input type="text" name="entry_by" class="form-control" id="entry-by" oninput="onlyNumbers(this)" value="<?= empty($_POST['entry_by'])?'':$_POST['entry_by'] ?>">
					  	<small style="color: red; <?= empty($this->errors['entry_by'])?'display: none;':'' ?>" id="entry-by-error">Please provide only numbers</small>
					</div>
				</div>
			</div>
			<div class="col-12 text-center mb-4">
				<button class="btn btn-primary" type="submit">Submit</button>
			</div>
		</form>
	</div>
</body>
</html>
<script type="">
	var form = document.querySelector('form');
  	var buyerName = document.getElementById('buyer-name');
  	var errorFound = false;

  	form.addEventListener('submit', function(event) {
    	if( errorFound == true ){
    		event.preventDefault(); // Prevent form submission
    	}else{
    		event.preventDefault();
    		fetch("<?= ROOT ?>/", {
    		  method: 'POST',
    		  body: new FormData(form)
    		})
    		  .then(response => response.json())
    		  .then(data => {
    		  	console.log(data);
    		  	if( data.success ){
    		  		window.location.href = "<?= ROOT ?>/home/buyer_report";
    		  	}else if( data.formSubmittedWithin24 ){
    		  		alert( "The form can only be submitted once within a 24-hour period." );
    		  	}else{
    		  		if( data.buyer_name ){
    		  			document.getElementById("buyer-name-error").style.display = "block";
    		  		}
    		  		if( data.buyer_email ){
    		  			document.getElementById("buyer-email-error").style.display = "block";
    		  		}
    		  		if( data.receipt_id ){
    		  			document.getElementById("receipt-id-error").style.display = "block";
    		  		}
    		  		if( data.item ){
    		  			for (let index in data.item) {
    		  				console.log(index);
    		  			  	const elements = document.querySelectorAll('.item-field');
    		  			  	const closestRow = elements[index].closest(".row");
    		  			  	closestRow.querySelector("small").style.display="block";
    		  			}
    		  		}
    		  		if( data.amount ){
    		  			document.getElementById("amount-error").style.display = "block";
    		  		}
    		  		if( data.city ){
    		  			document.getElementById("city-error").style.display = "block";
    		  		}
    		  		if( data.entry_by ){
    		  			document.getElementById("entry-by-error").style.display = "block";
    		  		}
    		  		if( data.phone ){
    		  			document.getElementById("phone-error").style.display = "block";
    		  		}
    		  		if( data.note ){
    		  			document.getElementById("note-error").style.display = "block";
    		  		}
    		  	}
    		  })
    		  .catch(error => {
    		    // Error handling
    		    console.error(error);
    		  });
    	}
  	});

  	buyerName.addEventListener("input", function(event) {

    	var fieldValue = buyerName.value;

    	if (validateInputOfTextSpaceNumbersAndMaximum20Characters(fieldValue)) {
      		errorFound = false;
      		document.getElementById("buyer-name-error").style.display = "none";
    	} else {
      		errorFound = true;
      		document.getElementById("buyer-name-error").style.display = "block";
    	}
  	});

  	function validateInputOfTextSpaceNumbersAndMaximum20Characters(inputValue) {
    	var pattern = /^[a-zA-Z0-9\s]*$/;

    	if (inputValue.length > 20) {
      		return false; // Length exceeds 20 characters
    	}

    	return pattern.test(inputValue);
  	}

  	function validateEmail() {
  	    var emailField = document.getElementById("buyer-email");
  	    var email = emailField.value.trim();

  	    // Regular expression pattern for email validation
  	    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  	    if (emailPattern.test(email)) {
  	      	errorFound = false;
      		document.getElementById("buyer-email-error").style.display = "none";
  	    } else {
  	      	errorFound = true;
  	      	document.getElementById("buyer-email-error").style.display = "block";
  	    }
  	}

  	function checkOnlyText(element) {
  		console.log( element.id );
  	    var textField = document.getElementById(element.id);
  	    var inputValue = textField.value;

  	    // Regular expression pattern for alphabetic characters
  	    var textPattern = /^[A-Za-z]+$/;

  	    if (textPattern.test(inputValue)) {
  	      	errorFound = false;
      		document.getElementById(element.id+"-error").style.display = "none";
  	    } else {
  	      	errorFound = true;
  	      	document.getElementById(element.id+"-error").style.display = "block";
  	    }
  	}

  	function onlyNumbers(element) {
  	    var numberField = document.getElementById(element.id);
  	    var inputValue = numberField.value;

  	    // Regular expression pattern for numeric characters
  	    var numberPattern = /^\d+$/;

  	    if (numberPattern.test(inputValue)) {
  	      	errorFound = false;
      		document.getElementById(element.id+"-error").style.display = "none";
  	    } else {
  	      	errorFound = true;
  	      	document.getElementById(element.id+"-error").style.display = "block";
  	    }
  	}

  	function validateWordCount(element) {
  	    var textField = document.getElementById(element.id);
  	    var inputValue = textField.value;

  	    var words = inputValue.split(/\s+/); // Split input value into an array of words

  	    if (words.length <= 30) {
	      	errorFound = false;
    		document.getElementById(element.id+"-error").style.display = "none";
  	    } else {
  	      	errorFound = true;
  	      	document.getElementById(element.id+"-error").style.display = "block";
  	    }
  	}

  	function validateTextAndSpaces(element) {
  	    var textField = document.getElementById(element.id);
  	    var inputValue = textField.value;

  	    // Regular expression pattern for alphabetic characters and spaces
  	    var textPattern = /^[A-Za-z\s]+$/;

  	    if (textPattern.test(inputValue)) {
  	      	errorFound = false;
    		document.getElementById(element.id+"-error").style.display = "none";
  	    } else {
  	      	errorFound = true;
  	      	document.getElementById(element.id+"-error").style.display = "block";
  	    }
  	}

  	function validatePhoneNumber(element){
  		var phoneNumberInput = document.getElementById(element.id);

  		var phoneNumber = phoneNumberInput.value;
	    var countryCode = "+88";

	    if (phoneNumber.indexOf(countryCode) !== 0) {
	    	formattedPhoneNumber = phoneNumberInput.value.replace(/^\+?\d*/, "");
	      	phoneNumberInput.value = countryCode + formattedPhoneNumber;
	    }

	    var phonePattern = /^(?:\+?88|0088)?\s?01[3-9]\d{8}$/;


	    if (phonePattern.test(phoneNumber)) {
  	      	errorFound = false;
    		document.getElementById(element.id+"-error").style.display = "none";
  	    } else {
  	      	errorFound = true;
  	      	document.getElementById(element.id+"-error").style.display = "block";
  	    }
  	}

  	function addTextField() {
  	    var textFieldContainer = document.getElementById("textFieldContainer");

  	    var newTextField = document.createElement("div");
  	    newTextField.classList.add("form-group");
  	    newTextField.innerHTML = `
  	      <div class="row mb-3">
  	      	<div class="col-6"><input type="text" class="form-control item-field" name="item[]" placeholder="Enter text" oninput="isTextOnly(this)"></div>
  	      	<div class="col-3">
  	      		<button type="button" class="btn remove-item btn-danger btn-sm" onclick="removeTextField(this)">X</button>
  	      	</div>
  	      	<small style="display: none;color: red;">Please provide only text</small>
  	      </div>
  	    `;

  	    textFieldContainer.appendChild(newTextField);

  	    var removeButton = document.querySelectorAll('.remove-item');

  	    removeButton.forEach(function(element) {
  	          element.classList.remove('hidden');
  	    });
  	}

  	function removeTextField(button) {

  		button.closest('.form-group').remove();

  		var itemFields = document.querySelectorAll('.item-field');
  	    var count = itemFields.length;
  	    console.log(count);

  	    if( count == 1 ){
  	    	var removeButton = document.querySelectorAll('.remove-item');
  	    	removeButton.forEach(function(element) {
  	    	      element.classList.add('hidden');
  	    	});
  	    }
  	}

  	function isTextOnly(element) {
  	  	// Regular expression to match only letters and spaces
  	  	var regex = /^[A-Za-z\s]+$/;
  	  	if (regex.test(element.value)) {
  	  		errorFound = false;
  	  		element.closest(".form-group").querySelector('small').style.display = "none";
  		}else{
  			errorFound = true;
  			element.closest(".form-group").querySelector('small').style.display = "block";
  		}
  	}
</script>