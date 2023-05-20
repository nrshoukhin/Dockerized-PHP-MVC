<?php 
class Home extends Controller
{
	protected $errors = array();

	public function index()
	{
		$buyer = $this->loadModel('buyers');
		$item = $this->loadModel('items');
		if( !empty($_POST) ){

			if (isset($_COOKIE['check24hour'])) {
			    echo json_encode(["formSubmittedWithin24"=>true]);
			    exit();
			}

			$this->validate( $_POST );
			if( empty($this->errors) ){
				$dbdata['amount'] = $_POST['amount'];
				$dbdata['buyer'] = $_POST['buyer_name'];
				$dbdata['receipt_id'] = $_POST['receipt_id'];
				$dbdata['buyer_email'] = $_POST['buyer_email'];
				$dbdata['buyer_ip'] = $_SERVER['REMOTE_ADDR'];
				$dbdata['note'] = $_POST['note'];
				$dbdata['city'] = $_POST['city'];
				$dbdata['phone'] = $_POST['phone'];
				$dbdata['hash_key'] = hash('sha512', "xpeedstudio" . $dbdata['receipt_id']);
				$dbdata['entry_at'] = date("Y-m-d");
				$dbdata['entry_by'] = $_POST['entry_by'];
				

				if($buyer_id = $buyer->insert( $dbdata )){
					foreach ($_POST['item'] as $key => $value) {
						$dbitem = array();
						$dbitem['buyer_id'] = $buyer_id;
						$dbitem['item'] = $value;
						$item->insert( $dbitem );
					}

					$expiration_time = time() + 24 * 60 * 60;

					// Set the cookie value
					$cookie_value = true;

					// Set the cookie
					setcookie('check24hour', $cookie_value, $expiration_time);

					echo json_encode(["success"=>true]);
				}

				exit();
			}else{
				echo json_encode( $this->errors );
				exit();
			}
		}
		$this->view('form');
	}

	public function validate($data)
	{
		$this->errors = [];

		foreach ($data as $key => $value) {
			if( $key == "buyer_name" ){
				if (!preg_match('/^[a-zA-Z0-9\s]{1,20}$/', $value)) {
			        $this->errors['buyer_name'] = "Invalid input! Please enter only text, numbers, and spaces, up to 20 characters.";
			    }
			}else if( $key == "buyer_email" && !filter_var($value,FILTER_VALIDATE_EMAIL) ){
				$this->errors['buyer_email'] = "Email is not valid";
			}else if( $key == "receipt_id" && !preg_match('/^[a-zA-Z]+$/', $value) ){
				$this->errors['receipt_id'] = "Please provide only text";
			}else if( $key == "item" ){
				$counter = 0;
				$filteredArray = array_filter($value, function ($checkValue, $key) {
			        if( !preg_match('/^[a-zA-Z\s]+$/', $checkValue) ){
			        	$this->errors['item'][$key] = "Please provide only text";
			        }
			    }, ARRAY_FILTER_USE_BOTH);
			}else if( $key == "amount" && !preg_match('/^\d+$/', $value) ){
				$this->errors['amount'] = "Please provide only numbers";
			}else if( $key == "note" && str_word_count($value) > 30 ){
				$this->errors['note'] = "Maximum 30 words allowed.";
			}else if( $key == "city" && !preg_match('/^[a-zA-Z\s]+$/', $value) ){
				$this->errors['city'] = "Only text and space are allowed";
			}else if( $key == "phone" && !preg_match('/^(\+?88)?01[3-9]\d{8}$/', $value) ){
				$this->errors['phone'] = "Invalid Phone Number";
			}else if( $key == "entry_by" && !preg_match('/^\d+$/', $value) ){
				$this->errors['entry_by'] = "Please provide only numbers";
			}
		}
	}

	public function buyer_report(){
		$buyer = $this->loadModel('buyers');
		$buyer->fetchAll();
		$buyers = $buyer->get();
		$this->view('report',['buyers'=>$buyers]);
	}

	public function item_report($buyer_id){
		$item = $this->loadModel('items');
		$item->fetchAll();
		$item->where(['buyer_id'=>$buyer_id]);
		$items = $item->get();
		$this->view("item",['items'=>$items]);
	}	

}
