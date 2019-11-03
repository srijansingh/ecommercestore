
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Tuanish</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

     <style media="screen">
     .float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}

.my-float{
	margin-top:16px;
}
     </style>
   </head>
   <body>
     <a href="whatsapp://send?text=<?php echo urlencode ('http://www.srijansingh.tk/indexs.php?details&product_id='.$product_id.'&.'.$product_title.''); ?>" data-action="share/whatsapp/share" class="float" target="_blank">
     <i class="fa fa-whatsapp my-float"></i>
     </a>
   </body>
 </html>
