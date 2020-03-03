<?php
$con=mysqli_connect("localhost","root","","eduline") or die("Connection Failed");
?>
<html>
<head>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://kit.fontawesome.com/924e911748.js" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
 <style type="text/css">
 .live-icon{background:#830F3E;border-radius:50%;cursor:pointer;position:fixed;bottom:200px;right:50px;transition:0.5s;width:60px;height:60px;z-index:1}
 .live-icon:before{background:#830F3E;border-radius:100%;content:"";position:absolute;top:-20px;left:-20px;width:100px;height:100px;z-index:-1;animation:pulseA 2s ease-out;animation-fill-mode:both;animation-iteration-count:infinite}
 .live-icon:hover::before{animation:pulseA 0.5s ease-out;animation-fill-mode:both;animation-iteration-count:infinite}
 @keyframes pulseA{
  0%{opacity:0;transform:scale(0);}
  25%{opacity:1;transform:scale(0.3);}
  50%{opacity:.6;transform:scale(0.6);}
  75%{opacity:.3;transform:scale(0.9);}
  100%{opacity:0;transform:scale(1);}
 }
 .fa-comments{color:white;cursor:pointer;font-size:25px;position:fixed;bottom:185px;right:50px;width:60px;height:60px;z-index:2}
 .fa-comments:before{position:absolute;top:0px;left:15px;width:60px;height:60px;z-index:-1;animation:pulseB 2s ease-out;animation-fill-mode:both;animation-iteration-count:infinite}
 .fa-comments:hover::before{animation:none}
 @keyframes pulseB{
  0%{opacity:0;transform:scale(0);}
  25%{opacity:.3;transform:scale(0.3);}
  50%{opacity:.6;transform:scale(0.6);}
  75%{opacity:.9;transform:scale(0.9);}
  100%{opacity:1;transform:scale(1);}
 }
 
 .live-chat{background:white;box-shadow:1px 1px 5px black;display:none;opacity:0;position:fixed;bottom:0px;right:50px;transition:0.5s;width:300px;height:33px;z-index:2}
 .chat-theme{background:#830F3E;border:1px solid #830F3E;box-shadow:1px 1px 3px black;color:white;cursor:pointer;font-size:18px;font-weight:bold;padding:5px;text-align:center}
 .fa-minus,.fa-times{color:white;font-size:18px}
 
 .chat-border{border:1px solid grey;border-radius:15px;margin:auto;transition:0.5s;width:285px;height:410px}
 .chat-AImsg{color:grey;font-size:14px;padding:10px;text-align:justify}
 form{padding:10px}
 .reg-name{font-size:12px;font-weight:bold}
 .reg-input{padding-bottom:10px}
 .reg-input input{font-size:12px;outline:none;padding:5px;width:100%}
 .regname1,.regname2,.regcode1,.regcode2{display:none}
 #warningName,#warningEmail,#warningPassword,#warningVerify{color:red;font-size:14px}
 #eye{cursor:pointer;float:right;font-size:12px;width:25px;position:relative;bottom:38px}
 .fa-eye-slash{color:#999}
 .fa-eye{color:#830F3E}
 #submit{background:#830F3E;border:none;border-radius:5px;box-shadow:1px 1px 5px black;color:white;cursor:pointer;font-size:15px;font-weight:bold;outline:none;padding:10px;text-align:center;width:100%}
 .fa-circle-notch{color:white;display:none;float:right;font-size:18px;animation:fa-spin 1s infinite linear}
 #option-link{color:#830F3E;cursor:pointer;font-size:15px;font-weight:bold;padding:10px;text-align:center;text-decoration:underline}
 
 .user-list{display:none;height:410px;opacity:0;overflow:auto;transition:1s;z-index:2}
 
 .chat-talk{display:none;opacity:0;transition:1s;z-index:2}
 .chat-height{height:390px;overflow:auto}
 .chat-padding{padding-top:5px}
 .chat-padding:first-child{padding-top:5px}
 .chat-admin,.chat-user{color:grey;font-size:13px}
 .chat-admin{transform:translate(5px,0px);width:100px}
 .chat-user{text-align:right;transform:translate(-5px,0px);width:auto}
 .chatad,.chatuse{background:black;border-radius:5px;color:white;font-size:13px;padding:5px;max-width:100px;word-wrap:break-word}
 .chatad{position:relative;left:5%}
 .chatuse{float:right;position:relative;right:5%}
 .chatad::after{border-color:transparent black transparent transparent;border-style:solid;border-width:5px;content:"";position:absolute;top:35%;right:100%}
 .chatuse::after{border-color:transparent transparent transparent black;border-style:solid;border-width:5px;content:"";position:absolute;top:35%;left:100%}
 #chatform{padding:0px}
 #cmsg{font-size:12px;outline:none;padding:11px;padding-right:35px;width:100%}
 #cmsg::placeholder{color:grey;font-size:12px}
 .fa-paper-plane{color:grey;cursor:pointer;float:right;font-size:18px;position:relative;bottom:25px;transition:0.5s;width:30px}
 .fa-paper-plane:hover{color:#830F3E}
 .fa-rotate-45{transform:rotate(45deg)}
 </style>
</head>
 
<body>
 <div class="live-icon">
  <i class="fas fa-comments"></i>
 </div>
 <script>
 $('.live-icon').click(function()
 {
  $('.live-icon').css('display','none');
  $('.live-icon').css('opacity','0');
  $('.live-chat').css('display','block');
  setTimeout(function()
  {
   $('.live-chat').css('height','480px');
   $('.live-chat').css('opacity','1');
  },200);
 });
 </script>
 <div class="live-chat">
  <div class="chat-theme"><span id="chat-theme">ELine CHAT</span><span style="float:right;width:50px"><i class="fa fa-minus"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i></span></div>
  <script>
  $('#chat-theme').click(function(){$('.live-chat').css('height','480px');});
  $('.fa-minus').click(function(){$('.live-chat').css('height','33px');});
  $('.fa-times').click(function()
  {
   $('.live-icon').css('display','block');
   $('.live-chat').css('height','33px');
   $('.live-chat').css('opacity','0');
   setTimeout(function()
   {
	$('.live-icon').css('opacity','1');
	$('.live-chat').css('display','none');
   },500);
  });
  </script>
  <br>
  
  <div class="chat-border">
   <div class="chat-AImsg">Welcome to ELine Chat! Chat with us if you need help</div>
   <form autocomplete="off" method="post">
    <input type="text" id="btn" name="btn" value="1" style="opacity:0;position:absolute;top:0px;z-index:-1">
    <input type="text" id="sendE" name="sendE" value="0" style="opacity:0;position:absolute;top:0px;z-index:-1">
	<input type="text" id="otp" name="otp" value="<?php if(isset($_POST['submit'])){echo $_POST['otp'];}?>" style="opacity:0;position:absolute;top:0px;z-index:-1">
    <div class="reg-name regname1">Name <span style="color:red">*</span></div>
    <div class="reg-input regname2">
	 <input type="text" id="chatname" name="chatname" onfocusout="Name(this);" oninput="Name(this);" oninvalid="Name(this);" onkeypress="return(event.charCode>=32&&event.charCode<=32)||(event.charCode>=65&&event.charCode<=90)||(event.charCode>=97&&event.charCode<=122)" title="Please fill out your full name"><br>
	 <script>
	 function toUpperCase(str){return str.split(/\s+/).map(s=>s.charAt(0).toUpperCase()+s.substring(1).toLowerCase()).join(" ");}
     $('#chatname').on('keyup', function(event)
	 {	
      var upper=$(this);
      upper.val(toUpperCase(upper.val()));
     });
	 
	 function Name(names)
	 {
	  var alphabet=/^[A-Za-z ]+$/;
	  var name=document.getElementById('chatname').value;
	  if(name==''){names.setCustomValidity('Please fill out your full name');
	               document.getElementById('warningName').innerHTML="Please fill out your full name";
	       	      }
	  else if(name.match(alphabet)){names.setCustomValidity('');
	                                document.getElementById('warningName').innerHTML="";
		                           }
	  else{names.setCustomValidity('Please enter english only');
	       document.getElementById('warningName').innerHTML="Please enter english only";
		  }
	 }
	 </script>
	 <span id="warningName"></span><br>
    </div>
	
	<div class="reg-name">Email <span style="color:red">*</span></div>
    <div class="reg-input">
	 <input type="email" id="chatemail" name="chatemail" onfocusout="Email(this);" oninput="Email(this);" oninvalid="Email(this);" title="Please fill out your email" required><br>
     <script>
     function Email(emails)
	 {
      var mailformat=/^([a-zA-Z]\w+)@([a-zA-Z0-9]{2,})\.([a-z]{2,3})$/;
	  var email=document.getElementById('chatemail').value;
	  if(email==''){emails.setCustomValidity('Please fill out your email');
		            document.getElementById('warningEmail').innerHTML="Please fill out your email";
			       }
  	  else if(email.match(mailformat)){emails.setCustomValidity('');
	                                   document.getElementById('warningEmail').innerHTML="";
								      }
	  else{emails.setCustomValidity('Please enter proper email');
	       document.getElementById('warningEmail').innerHTML="Please enter proper email";
		  }
	 }
	 </script>
	 <span id="warningEmail"></span><br>
    </div>
	
	<div class="reg-name">Password <span style="color:red">*</span></div>
    <div class="reg-input">
	 <input type="password" id="chatpass" name="chatpass" onfocusout="Password(this);" oninput="Password(this);" oninvalid="Password(this);" onkeypress="return(event.charCode>=48&&event.charCode<=57)||(event.charCode>=65&&event.charCode<=90)||(event.charCode>=97&&event.charCode<=122)" title="Please fill out your password" required><br>
     <script>
	 $('#chatpass').select(function(){this.selectionStart=this.selectionEnd;return false;});
	 
     function Password(pass)
	 {
	  var alphanumeric=/^[A-Za-z0-9]+$/;
	  var chatpass=document.getElementById('chatpass').value;
	  if(chatpass==""){pass.setCustomValidity('Please enter your password');
		               document.getElementById('warningPassword').innerHTML="Please enter your password";
					  }
	  else if(chatpass.match(alphanumeric)){pass.setCustomValidity('');
		                                    document.getElementById('warningPassword').innerHTML="";
									       }
	  else{pass.setCustomValidity('Please avoid enter any symbol');
		   document.getElementById('warningPassword').innerHTML="Please avoid enter any symbol";
		  }
	 }
	 </script>
	 <span id="warningPassword"></span><br>
	 <i class="fa fa-eye-slash" id="eye"></i>
	 <script>
	 var pwd=document.getElementById('chatpass');
	 $("#eye").click(function(){$(this).toggleClass("fa-eye-slash fa-eye fa-lg");(pwd.type=='password')?pwd.type='text':pwd.type='password';});
	 </script>
    </div>
	
	<div class="reg-name regcode1">Verification Code<span style="color:red">*</span></div>
    <div class="reg-input regcode2">
	 <input type="text" id="chatverify" name="chatverify" onfocusout="Verify(this);" oninput="Verify(this);" oninvalid="Verify(this);" onkeypress="return(event.charCode>=48&&event.charCode<=57)||(event.charCode>=65&&event.charCode<=90)||(event.charCode>=97&&event.charCode<=122)" title="Please fill out verify code"><br>
     <script>
	 $('#chatverify').keyup(function(){this.value=this.value.toUpperCase();});
	 
     function Verify(very)
	 {
	  var chatverify=document.getElementById('chatverify').value;
	  if(chatverify==""){very.setCustomValidity('Please enter your verfiy code');
		                 document.getElementById('warningVerify').innerHTML="Please enter your verify code";
					    }
	  else{very.setCustomValidity('');
		   document.getElementById('warningVerify').innerHTML="";
		  }
	 }
	 </script>
	 <span id="warningVerify"></span><br>
    </div>

	<div><button type="submit" id="submit" name="submit"><span id="submitType">Log In</span> <i class="fas fa-circle-notch fa-spin"></i></button></div>
	<div id="option-link">Register</div>
	<script>
	$('#option-link').click(function()
	{
	 document.getElementById('chatname').value="";
	 document.getElementById('chatemail').value="";
	 document.getElementById('chatpass').value="";
	 document.getElementById('warningName').innerHTML="";
	 document.getElementById('warningEmail').innerHTML="";
	 document.getElementById('warningPassword').innerHTML="";
	 document.getElementById('warningVerify').innerHTML="";
	 if(this.innerHTML=='Register')
	 {
	  document.getElementById('btn').value=0;
	  $('.regname1,.regname2').css('display','block');
	  $('#chatname').prop('required',true);
	  document.getElementById('submitType').innerHTML='Register';
	  document.getElementById('option-link').innerHTML='Log In';
	  if(document.getElementById('sendE').value==1)
	  {
	   $('.regcode1,.regcode2').css('display','block');
	   $('#chatverify').prop('required',true);
	  }
	 }
	 else if(this.innerHTML=='Log In')
	 {
	  document.getElementById('btn').value=1;
	  $('.regname1,.regname2,.regcode1,.regcode2').css('display','none');
	  document.querySelector('#chatname').required=false;
	  document.querySelector('#chatverify').required=false;
	  document.getElementById('submitType').innerHTML='Log In';
	  document.getElementById('option-link').innerHTML='Register';
	  document.getElementById('sendE').value=0;
	 }
	 $('.chat-border').css('opacity','0');
     setTimeout(function(){$('.chat-border').css('opacity','1');},500);
	});
	</script>
   </form>
  </div>
  
  <div class="user-list">
   <table>
   <?php
   $select="select * from chatuser order by chatname ASC";
   $query=mysqli_query($con,$select);
   $alpha=array();
   while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
   {
	
	if($row['chatname'][0]=='A')
	{
	 
	}
   }
   
   $a=0;
   while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
   {
	echo"
	<tr>
	 <td>".$row['chatname']."</td>
	 <td>".."</td>
	 
    <div class='chat-padding'>
     <div class='chat-user'>$chatname</div>
     <div class='chatuse'>".$row['chatmsg']."</div>
    </div>";
   }
   ?>
   </table>
  </div>
  
  <div class="chat-talk">
   <div class="chat-height">
    <div class='chat-auto'>
	 <div class='chat-admin'>David</div>
     <div class='chatad'>Hi, what can I help you?</div>
    </div>
    <div class="chat-padding">
	</div>
   </div>
   <form name="chatform" id="chatform">
	<input type="text" id="cname" name="cname" style="opacity:0;position:absolute;top:0px;z-index:-1">
    <input type="text" id="cmail" name="cmail" style="opacity:0;position:absolute;top:0px;z-index:-1">
    <input type="text" id="cmsg" name="cmsg" placeholder="Text Here"><i class="fas fa-paper-plane fa-rotate-45" onclick="send()"></i>
   </form>
   <script>
   function send()
   {
	if(!chatform.cmsg.value=='')
	{
	 var chatname=chatform.cname.value;
	 var chatemail=chatform.cmail.value;
	 var chatmsg=chatform.cmsg.value;
	 
	 var xmlhttp=new XMLHttpRequest();
	 xmlhttp.onreadystatechange=function()
	 {
	  if(this.readyState==4 && this.status==200)
	  {document.getElementsByClassName('chat-padding').innerHTML=xmlhttp.responseText;}
	 }
	}
	xmlhttp.open('GET','chatinload.php?id=1&chatname='+chatname+'&chatemail='+chatemail+'&chatmsg='+chatmsg,true);
	xmlhttp.send();
	document.getElementById('cmsg').value='';
	
	$(document).ready(function(e)
    {
	 $.ajaxSetup({cache:false})
	 setInterval(function(){$('.chat-padding').load('chatinload.php?id=2&chatname='+chatname,function(responseTxt,statusTxt,xhr)
	 {
	  if(statusTxt=='error')
	  {alert('Error: '+xhr.status+': '+xhr.statusText);}
	 });
     },2000);
    });
   }
   </script>
  </div>
  
  <?php
  if(isset($_POST['submit']))
  {
   $btn=$_POST['btn'];
   $sendE=$_POST['sendE'];
   $otp=$_POST['otp'];
   
   if($btn=='0')
   {
	$chatname=$_POST['chatname'];
    $chatemail=$_POST['chatemail'];
    $chatpass=$_POST['chatpass'];
	 
	echo"<script>
	$('.live-icon').css('display','none');
    $('.live-icon').css('opacity','0');
    $('.live-chat').css('display','block');
    $('.live-chat').css('height','480px');
    $('.live-chat').css('opacity','1');
	</script>";
	
	if($sendE=='0')
	{
	 $select="select chatemail from chatuser where chatemail='$chatemail'";
	 $query=mysqli_query($con,$select);
	 if(mysqli_num_rows($query)>0)
     {
	  echo"<script>
      const Toast=Swal.mixin({toast:true,showConfirmButton:false})
      Toast.fire({type:'warning',title:'Your have been register',position:'top-right',timer:2000})
	  document.getElementById('btn').value=0;
	  $('.regname1,.regname2').css('display','block');
	  $('#chatname').prop('required',true);
	  document.getElementById('submitType').innerHTML='Register';
	  document.getElementById('option-link').innerHTML='Log In';
	  </script>";
	 }
	 else
	 {
	  $alphabet="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $numeric="0123456789";
      $otp="";
      for($a=1;$a<=3;$a++)
      {$otp .= substr($alphabet,(rand()%(strlen($alphabet))),1);}
      for($a=1;$a<=3;$a++)
      {$otp .= substr($numeric,(rand()%(strlen($numeric))),1);}
  
      $to=$chatemail;
      $subject="EduLine Chat Verification Code";
      $message="
	  <head>
	   <style type='text/css'>
	   .let-bor{border:3px solid #555;margin:auto;padding:20px;width:60%}
	   .let-head{font-size:30px;font-weight:bold;text-align:center}
	   .letter{font-size:20px;font-style:italic}
	   </style>
	  </head>
	  <body>
	   <div class='let-bor'>
	    <div class='let-head'>EduLine Chat</div><br><br>
	    <div class='letter'>
		 Welcome to EduLine Chat<br>
		 We need your verification code to confirm your account.<br>
		 Thanks for your cooperation!<br><hr><br>
	     Your Verification Code is: <b style='color:red'>$otp</b>
		</div>
	   </div>
	  </body>";
      $from="davidliew990212@gmail.com";
      $headers = "MIME-Version:1.0"."\r\n";
      $headers.="Content-type:text/html;charset=UTF-8"."\r\n";
      $headers.="From: $from"."\r\n";
      if(mail($to,$subject,$message,$headers))
      {
       echo"<script>
	   const Toast=Swal.mixin({toast:true,showConfirmButton:false})
       Toast.fire({type:'success',title:'Verify Code Sent',html:'<br />Please check your email',position:'top-right',timer:2000})
	   document.getElementById('sendE').value=1;
	   $('.regcode1,.regcode2').css('display','block');
	   $('#chatverify').prop('required',true);
	   document.getElementById('otp').value='".$otp."';
	   </script>";
      }
      else
      {
       echo"<script>
	   const Toast=Swal.mixin({toast:true,showConfirmButton:false})
       Toast.fire({type:'warning',title:'Failed to send verify code',position:'top-right',timer:2000})
	   </script>";
      }
	  echo"<script>
	  document.getElementById('btn').value=0;
	  $('.regname1,.regname2').css('display','block');
	  $('#chatname').prop('required',true);
	  document.getElementById('submitType').innerHTML='Register';
	  document.getElementById('option-link').innerHTML='Log In';
	  document.getElementById('chatname').value='".$chatname."';
	  document.getElementById('chatemail').value='".$chatemail."';
	  document.getElementById('chatpass').value='".$chatpass."';
	  </script>";
	 }
	}
	
	else if($sendE=='1')
	{
	 if($_POST['chatverify']==$otp)
	 {
	  $insert="insert into chatuser (chatname,chatemail,chatpass) values ('$chatname','$chatemail','$chatpass')";
	  $query=mysqli_query($con,$insert);
	  if($query)
	  {
	   echo"<script>
       const Toast=Swal.mixin({toast:true,showConfirmButton:false})
       Toast.fire({type:'success',title:'Register successfully',position:'top-right',timer:2000})
	   document.querySelector('#chatname').required=false;
	   document.querySelector('#chatverify').required=false;
	   </script>";
	  }
	  else
	  {
	   echo"<script>
       const Toast=Swal.mixin({toast:true,showConfirmButton:false})
       Toast.fire({type:'warning',title:'Register failed',position:'top-right',timer:2000})
	   document.getElementById('btn').value=0;
	   document.getElementById('sendE').value=1;
	   $('.regname1,.regname2,.regcode1,.regcode2').css('display','block');
	   $('#chatname').prop('required',true);
	   $('#chatverify').prop('required',true);
	   document.getElementById('submitType').innerHTML='Register';
	   document.getElementById('option-link').innerHTML='Log In';
	   document.getElementById('chatname').value='".$chatname."';
	   document.getElementById('chatemail').value='".$chatemail."';
	   document.getElementById('chatpass').value='".$chatpass."';
	   </script>";
	  }
	 }
	 else
	 {
	  echo"<script>
      const Toast=Swal.mixin({toast:true,showConfirmButton:false})
      Toast.fire({type:'warning',title:'The verify code is invalid',position:'top-right',timer:2000})
	  document.getElementById('btn').value=0;
	  document.getElementById('sendE').value=1;
	  $('.regname1,.regname2,.regcode1,.regcode2').css('display','block');
	  $('#chatname').prop('required',true);
	  $('#chatverify').prop('required',true);
	  document.getElementById('submitType').innerHTML='Register';
	  document.getElementById('option-link').innerHTML='Log In';
	  document.getElementById('chatname').value='".$chatname."';
	  document.getElementById('chatemail').value='".$chatemail."';
	  document.getElementById('chatpass').value='".$chatpass."';
	  </script>";
	 }
	}
   }
   
   if($btn=='1')
   {
    $chatemail=$_POST['chatemail'];
	$chatpass=$_POST['chatpass'];
	
	echo"<script>
	$('.live-icon').css('display','none');
    $('.live-icon').css('opacity','0');
    $('.live-chat').css('display','block');
    $('.live-chat').css('height','480px');
    $('.live-chat').css('opacity','1');
	</script>";
	 
	$select1="select * from chatadmin where chatemail='$chatemail' and chatpass='$chatpass'";
	$query1=mysqli_query($con,$select1);
	$select2="select * from chatuser where chatemail='$chatemail' and chatpass='$chatpass'";
	$query2=mysqli_query($con,$select2);
	
	if(mysqli_num_rows($query1)>0)
	{
	 $fa=mysqli_fetch_array($query1,MYSQLI_ASSOC);
	 $chatname=$fa["chatname"];
	 echo"<script>
	 document.getElementById('cname').value='".$chatname."';
	 document.getElementById('cmail').value='".$chatemail."';
	 $('.fa-circle-notch').css('display','block');
	 $('.chat-border').css('opacity','0');
	 $('.user-list').css('display','block');
	 setTimeout(function()
	 {
	  $('.chat-border').css('display','none');
	  $('.user-list').css('opacity','1');
	 },1000);
	 </script>";
	}
	else if(mysqli_num_rows($query2)>0)
	{
	 $fa=mysqli_fetch_array($query2,MYSQLI_ASSOC);
	 $chatname=$fa["chatname"];
	 echo"<script>
	 document.getElementById('cname').value='".$chatname."';
	 document.getElementById('cmail').value='".$chatemail."';
	 $('.fa-circle-notch').css('display','block');
	 $('.chat-border').css('opacity','0');
	 $('.chat-talk').css('display','block');
	 setTimeout(function()
	 {
	  $('.chat-border').css('display','none');
	  $('.chat-talk').css('opacity','1');
	 },1000);
	 var cname=document.getElementById('cname').value;
	 $('.chat-padding').load('chatinload.php?id=2&chatname='+cname,function(responseTxt,statusTxt,xhr)
	 {
	  if(statusTxt=='error')
	  {alert('Error: '+xhr.status+': '+xhr.statusText);}
	 });
	 </script>";
	}
	else
	{
	 echo"<script>
     const Toast=Swal.mixin({toast:true,showConfirmButton:false})
     Toast.fire({type:'warning',title:'Your email or password is invalid',position:'top-right',timer:2000})
	 document.querySelector('#chatname').required=false;
	 document.querySelector('#chatverify').required=false;
	 </script>";
	}
   }
  }
  ?>
 </div>
</body>
</html>