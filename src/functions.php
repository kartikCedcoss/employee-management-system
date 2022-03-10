<?php
session_start();
if(!isset($_SESSION['emp'])){
    $_SESSION['emp']=array();
}

?>
<?php
$empid = $_POST['empid'];
$name = $_POST['name'];
$salary = $_POST['salary'];
$desg = $_POST['desg'];
$addr = $_POST['addr'];
$sid = $_POST['sid'];
$uid =$_POST['uid'];
$uname = $_POST['uname'];
$usalary = $_POST['usalary'];
$udesg = $_POST['udesg'];
$uaddr = $_POST['uaddr'];


$action = $_POST['action'];


class emp{
public $empid ;
public $name; 
public $salary;
public $desg;
public $addr;
    public function addemp($empid,$name,$salary,$desg,$addr){
       

        $this -> empid = $empid;
        $this->name = $name;
        $this->salary = $salary;
        $this->desg = $desg;
        $this->addr = $addr;
        

        $data = array("id"=>$this->empid , "name"=> $this->name , "salary"=> $this->salary,"desg"=>$this->desg, "addr"=>$this->addr);
        array_push($_SESSION['emp'],$data);
       

    }

     public function searchemp($sid){
         $this->empid = $sid;
          foreach($_SESSION['emp'] as $key=> $val ){
             if($val['id']==$this->empid){
                return  json_encode( $_SESSION['emp']);

             } 
          }
     }

     public function updateemp($uid,$name,$salary,$desg,$addr){
        $this->empid = $uid;
        $this->name = $name;
        $this->salary = $salary;
        $this->desg = $desg;
        $this->addr = $addr;

        foreach($_SESSION['emp'] as $key=> $val ){
            
            if($val['id']==$this->empid){
                $_SESSION['emp'][$key]['name'] = $this->name;
               $_SESSION['emp'][$key]['salary'] = $this->salary;
               $_SESSION['emp'][$key]['desg'] = $this->desg;
               $_SESSION['emp'][$key]['addr'] = $this->addr;  
               
            } 
         }

     }
    
}
switch($action){
    case "add":
        {
        $obj = new emp();
        $obj -> addemp($empid,$name,$salary,$desg,$addr);
        echo json_encode($_SESSION['emp']);
        
        }
        break ;

    case "search":
        {
        $obj = new emp();
       echo  $obj -> searchemp($sid);      
    }
    break ;
case "update":
        {
        $obj = new emp();
         $obj -> updateemp($uid,$uname,$usalary,$udesg,$uaddr);
        echo json_encode($_SESSION['emp']);
       
        
        }
        break ;
  case "display":
    {
        echo json_encode($_SESSION['emp']);
    }

}

?>