<?php
session_start();
//session_destroy();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css"> 
    <title>Document</title>
    
</head>
<body>
    <div class="maindiv" >
<table class='undiv' id ='admindiv' >
    <tr><td><input type="text" placeholder="Admin Name" id='adname' ></td></tr>
    <tr><td><input type="text" placeholder="Password" id ='adpass' ></td></tr>
    <tr><td><button id='adminbtn' >Login</button></td></tr>
</table>
<div class='undiv'  id='empdiv' >

    <table>
        <tr><td>ID:</td><td><input type="text" placeholder="Employee ID" id='empid' ></td> <td><input type ='button' value = 'Search' id='btnsearch' > </tr>
        <tr><td>Name:</td><td><input type="text" placeholder= "Name" id='name'><td><tr>
    <tr><td>Salary:</td><td><input type="text" id='salary' ></td></tr>
    <tr><td>Designation:</td><td><input type = "text" id='desg'></td></tr> 
    <tr><td>Address:</td><td><input type="text" id='addr' ></td></tr>   
    <tr><td></td><td><input type="button" id='btnadd' value='ADD' ></td><td><input type="button" id='btnupdate' value='Update' ></td></tr>    
    </table>
    <div class='adiv' ><a id='showemp' href='#'>See All Employee</a></div>
</div>
<div id='dispemp' ></div>
    </div>
    <script>

        


         var adminarr = [{name : "kshitiz", pass : 1234} ]
         var empArr=[];
         $(document).ready(function(){
            
            $('#btnupdate').hide();
            $('#empdiv').hide();
            $('#adminbtn').on('click',function(){
            var adname = document.getElementById('adname').value;
            var adpass = document.getElementById('adpass').value;
            for(let i=0; i<adminarr.length; i++){
                
            if (adminarr[i].name == adname  && adminarr[i].pass == adpass){
                $('#empdiv').show();
                $('#admindiv').hide();
           }
            
        }

           }) 


           $('#btnadd').on('click',function(){
               var empid = document.getElementById('empid').value;
               var name = document.getElementById('name').value;
               var salary = document.getElementById('salary').value;
               var desg = document.getElementById('desg').value;
               var addr = document.getElementById('addr').value;
               console.log(empArr);
              
               $.ajax({
                   url :"functions.php",
                   type : "POST",
                   datatype :"JSON",
                   data :{
                       empid : empid,
                       name :name,
                       salary: salary,
                       desg :desg,
                       addr :addr,
                       "action" : "add"
                   }

               }).done(function(data){
                empArr = JSON.parse(data);
                
               })
            
           }) 
           $('#btnsearch').on('click',function(){
            var empid = document.getElementById('empid').value;
               $.ajax({
                   url : "functions.php",
                   type: "POST",
                   datatype : "JSON",
                 data:{
                       sid:empid,
                       "action" : "search"
                 }
               }).done(function(data){
                   empArr = JSON.parse(data);
                  for(let i = 0; i<empArr.length;i++){
                      if(empArr[i].id==empid){
                          document.getElementById('name').value = empArr[i].name;
                          document.getElementById('salary').value = empArr[i].salary;
                          document.getElementById('desg').value = empArr[i].desg;
                          document.getElementById('addr').value = empArr[i].addr;
                          $('#btnupdate').show();

                      }
                  }
               })
               
           })
        
           $('#btnupdate').on('click',function(){  

            var uid = document.getElementById('empid').value;
             var name = document.getElementById('name').value;
               var salary = document.getElementById('salary').value;
               var desg = document.getElementById('desg').value;
               var addr = document.getElementById('addr').value;
              
               $.ajax({
                   url :"functions.php",
                   type : "POST",
                   datatype :"JSON",
                   data :{
                      uid : uid,
                      uname :name,
                       usalary: salary,
                       udesg :desg,
                       uaddr :addr,
                       "action" : "update"
                   }

               }).done(function(data){
                empArr = JSON.parse(data); 
               })
           }) 
$('#showemp').on('click',function(){
$.ajax({
    url:"functions.php",
    type:"POST",
    datatype : "JSON",
    data:{
        "action" : "display"
    }
}).done(function(data){
    empArr = JSON.parse(data);
    display(empArr);
})

})

        })
function display(empArr){
    html = "<table border=1px ><tr><th>ID</th><th>Name</th><th>Salary</th><th>Designation</th><th>Address</th></tr>";
    for(let i = 0 ; i<empArr.length ; i++){
        html += "<tr><td>"+empArr[i].id+"</td><td>"+empArr[i].name+"</td><td>"+empArr[i].salary+"</td><td>"+empArr[i].desg+"</td><td>"+empArr[i].addr+"</td></tr>";
    }
    html += "</table>";
document.getElementById('dispemp').innerHTML= html;
}

    </script>
</body>
</html>