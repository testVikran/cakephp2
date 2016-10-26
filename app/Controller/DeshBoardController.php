<?php
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DeshBoardController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('GiveHelp','GetHelp','User','UserBank');

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	function giveHelp() {
		$this->autoRender = false;
	    $this->layout = "";
	     if($this->data){
	    	$userData = $this->Session->read('User');
	    	$helpData['amount'] = $this->data['amount'];
	    	$helpData['email'] = $userData['username'];
	    	$helpData['user_id'] = $userData['UserId'];
	    	$helpData['start_time'] = date("Y-m-d h:i:s");
	    	$helpData['is_active'] = 1;
	    	$helpData['end_time'] = date('Y-m-d h:i:s', strtotime(' +2 day'));
	    	$this->GiveHelp->save($helpData);
	    } else {
	    	return false;
	    }
	}
	function getHelp() {
		$this->autoRender = false;
	    $this->layout = "";
	    if($this->data){
	    	$userData = $this->Session->read('User');
	    	$helpData['amount'] = $this->data['amount'];
	    	$helpData['email'] = $userData['username'];
	    	$helpData['user_id'] = $userData['UserId'];
	    	$helpData['start_time'] = date("Y-m-d h:i:s");
	    	$helpData['end_time'] = date('Y-m-d h:i:s', strtotime(' +2 day'));
	    	$this->GetHelp->save($helpData);
	    } else {
	    	return false;
	    } 
	}
	function saveBankDetails() {
		$this->autoRender = false;
	    $this->layout = "";
	    $userData = $this->Session->read('User');
		$data['user_id'] = $userData['UserId'];
		if($this->data){
			$data['bank_name'] = $this->data['bankName'];
			$data['account_number'] = $this->data['accountNumber'];
			$data['ifsc_code'] = $this->data['ifsc'];
			$data['branch'] = $this->data['branch'];
			$data['is_active'] = 1;
			$this->UserBank->updateAll(array("is_active"=>0),array("user_id"=>$userData['UserId']));
			$this->UserBank->save($data);
			$this->redirect( array( 'controller' => 'home_pages', 'action' => 'deshBoard?bankDetails=1' ) );
		}
	}
	function adminLogin(){
		$userData = $this->Session->read('User');
		$data['giveHelp'] = $this->GiveHelp->find('all', array( 'fields' =>array('User.name','GiveHelp.user_id','GiveHelp.amount','GiveHelp.start_time','User.email'),'conditions' => array('GiveHelp.is_active' => 1),
			'joins' => array(
                    array('table'=>'users','alias'=>'User','type'=>'inner','conditions'=>array('GiveHelp.user_id = User.id'))
                )));
		$data['getHelp'] = $this->GetHelp->find('all', array( 'fields' =>array('User.name','GetHelp.user_id','GetHelp.amount','GetHelp.start_time','User.email'),'conditions' => array('GetHelp.is_active' => 1),
			'joins' => array(
                    array('table'=>'users','alias'=>'User','type'=>'inner','conditions'=>array('GetHelp.user_id = User.id'))
                )));
		$this->set('HelpRecords',$data);
	}
	function acceptGetHelp() {
		$this->autoRender = false;
	    $this->layout = "";
		if(!empty($this->data['id'])) {
			$this->GetHelp->updateAll(array("is_active"=>0,"is_accepted" =>1),array("id"=>$this->data['id']));
			return true;
		} else {
			return false;
		}
	}
	function submitGiveHelp() {
		$this->autoRender = false;
	    $this->layout = "";
		if(!empty($this->data['id'])) {
			$this->GiveHelp->updateAll(array("is_active"=>0,"status" =>1),array("id"=>$this->data['id']));
			return true;
		} else {
			return false;
		}
	}
	function checkMemberShipByEmail($emailId = '') {
        $isAvailbale = true;
        $message = false;
        $this->autoRender = false;
        $this->layout = null;
        if (trim($emailId) == '')
            $emailId = $this->data['email'];
        //check if email exists on some mail server
        $isMember = false;
        $loginData = $this->User->find('first', array(
            'fields' => array("User.id"),
            'conditions' => array('User.email' => $emailId)
        ));
        if (isset($loginData['User']['id']) && (int) $loginData['User']['id']) {
            $isMember = (int) $loginData['User']['id'];
        }
        if ($isMember) {
	        $message = 'This email is already registered.';
	        $isAvailbale = false;
            
        } 
        echo json_encode(array('valid' => $isAvailbale, 'message' => $message));
        exit;
    }
    function checkMemberShipByMobile($mobile = '') {
        $isAvailbale = true;
        $message = false;
        $this->autoRender = false;
        $this->layout = null;

        if (trim($mobile) == '')
            $mobile = $this->data['User']['mobile'];

        // condition added if mobile number is changed from profile page
        if ($mobile == "") {
            $mobile = $this->data['mobile'];
        }
        $replace_str = array(" ", "(", ")", "-", "+");
        $mobile = str_replace($replace_str, "", $mobile);

        //check if already registered
        $UserId = $this->User->checkMemberShipByMobile($mobile);
        if ((int) $UserId) {
            $isAvailbale = false;
            $message = 'This mobile number is already registered';
        }
        echo json_encode(array('valid' => $isAvailbale, 'message' => $message));
        exit;
    }
    function checkMemberShipEmail($emailid){
    	$this->autoRender = false;
        $this->layout = null;
        if (trim($emailId) == '')
            $emailId = $this->data['sponcer'];
        //check if email exists on some mail server
        $isMember = false;
        $loginData = $this->User->find('first', array(
            'fields' => array("User.id"),
            'conditions' => array('User.email' => $emailId)
        ));
        if (isset($loginData['User']['id']) && (int) $loginData['User']['id']) {
            $isMember = (int) $loginData['User']['id'];
        }
        return $isMember;
    }
    public function isRegistered() {
        $isMember = false;
        $this->autoRender = false;
        $this->layout = null;
        $loginId = $this->checkMemberShipEmail($this->data['sponcer']);
        if ((int) $loginId) {
            $isMember = true;
        }
        echo json_encode(array('valid' => $isMember));
        exit;
    }
    function getTree($option){
        //$this->layout = null;
        set_time_limit(0);
        $userData = $this->Session->read('User');
        $data['email'] = $userData['email'];
        if ($userData['membership'] == 'safezone') {
            $users = $this->User->find('all', array(
            'fields' => array("User.email",'User.sponcer'),'conditions' => array('User.id >' => $userData['UserId'])
            ));
            foreach ($users as $key => $value) {
                $value['User']['sponcer'] = $data['email'];
                $GLOBALS['SessionData'][] = $value['User'];
            }
        } else{
            $GLOBALS['SessionData'][0]['mobile'] = $userData['mobile'];
            $GLOBALS['SessionData'][0]['email'] = $data['email'];
            $GLOBALS['SessionData'][0]['sponcer'] = $data['email'];
            $this->getRecursiveIcon($userData['mobile']);
        }
       //echo '<pre>'; print_r($GLOBALS['SessionData']);die;
        $this->set('use',$GLOBALS['SessionData']);
    }
    
    function getRecursiveIcon($mobile){
        set_time_limit(0);
        $users = $this->User->find('all', array(
            'fields' => array("User.email",'User.sponcer','User.mobile'),'conditions' => array('User.sponcer' => $mobile)
        ));
         //echo '<pre>'; print_r($users);die;
        if(!empty($users)){
            foreach ($users as $key => $value) {

                $GLOBALS['SessionData'][] = $value['User'];
                
                $this->getRecursiveIcon($value['User']['mobile']); 
            }
        }
    }
    function income($type = null){

        switch ($type) {
            case "active":
                $tp = 'Active-Zone';
                break;
            case "working":
            $tp = 'Working-Zone';
                break;
            case "safe":
            $tp = 'Safe-Zone';
                break;
            case "all":
                $tp = 'All-Zone';
                break;
            default:
                $tp = 'All-Zone';
        }
        $this->set('zone',$tp);
    }
}