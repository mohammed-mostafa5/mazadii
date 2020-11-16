<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Amyal l New Order</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--<link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"  type="text/css"/>

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">-->



<style>
a, a:hover, a:visited, a:focus, a:active {outline:none !important;}
.color_white {color:#fff;}
.bg_white{ background: #fff !important;}
.bg_gray {background:#5e5f61}
.bg_orange {background:#f69e3c;border-bottom:30px solid #5e5f61;}
.email-box {background:#fff; border-bottom:30px solid #5e5f61; min-height:400px; padding:25px; margin-top:-50px}
.bg_orange.orders {padding-top:0 !important}
.horizontal2 {
   display: block;
    padding-left: 0;
    margin: 20px auto 20px;
    width: 100%;
}

/*.horizontal2 li {
    padding: 6px 5px;
    display: inline-block;
    text-align: center;
    border-radius: 50%;
    border: #fff solid 2px;
    height: 36px;
    width: 36px;
	margin-right:2px;
	background:#5e5f61;
}*/

.horizontal2 li a {
    color: white;
    font-size: 15px;
}

/*.horizontal2 li:hover {background: #f99d1e; cursor:pointer}*/
footer h4 a {color:#5e5f61 !important; margin-bottom:0}
footer h4 {margin-bottom:0; margin-top:5px}

.btn-gry { font-size:15px; font-weight:normal; line-height:30px;  border-radius:0!important; margin-right:10px; background:#5f6062 !important; color:#fff !important; padding:6px 16px }


body {font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    background-color: #fff; margin:0; }
</style>



</head>

<body >
 <header>
   <div class=" bg_white text-center" style=" background: #fff !important; text-align:center">
     <div class="container" style="  margin-right: auto; margin-left: auto; max-width:600px; width:100%">
      <div class="row" style="">
        <div class="col-md-12" style="width:100%;">
                <div class=" p-t-50 p-b-50" style="padding-top:50px; padding-bottom:50px">
      			 <a href="index.html" style="outline:none" ><img src="http://izoneoptics.com/new/images/logo.png"></a>
     			</div>
                    
          </div> 
      </div>
     </div>
   </div>
 
 </header>
 
 <div class="contents">
  <div class="bg_gray" style="background:#444">
  <div class="container" style=" margin-right: auto; margin-left: auto; width:100%; max-width:600px">
   <div class="row" style=" ">
   <div class="col-md-12 col-sm-12 col-xs-12" style="width:100%; ">
  	 <div class="p-t-30 p-b-80" style="padding-top:30px; padding-bottom:80px">
    <h1 class="color_white" style="font-size:40px; text-align: center; color:#fff; padding-left:10px">Order</h1>
   </div>
   </div>
   </div>
   </div>
  </div>
 
 
  <div class="orders bg_orange" style="background:#eee;border-bottom:10px solid #d9534f ; padding:0 5px !important">
    <div class="container" style=" margin-right: auto; margin-left: auto; width:100%; max-width:600px">
   <div class="row" style="">
      <div class="col-md-12 col-sm-12 col-xs-12" style="width:100%; ">
       <div class="email-box clearfix" style="clear:both !important; background:#fefefe; position:relative; border-bottom:20px solid #444; min-height:300px; padding:25px; margin-top:-50px">
      
        <h4>Order ID :{{ $data->id ?? '' }}</h4>
        <p>Order from: {{ $data->pharmacy->name ?? '' }}</p> 
        <p>Order to: {{ $data->comapany->name ?? '' }}</p> 
        <p>{{ $data->lens_type ?? '' }}</p>
           
       </div>
       <div class="clearfix" style="clear:both !important"></div>
       <div class="text-center m-t-30 m-b-30" style="margin-top:30px; margin-bottom:30px; text-align:center">
       
            </div>
      </div>
      
      </div>
   </div>
  </div>
 </div>
 

<div class="clearfix" style="clear:both !important"></div>

 <footer class="bg_white text-center p-b-30" style="background:#fff; text-align:center; padding-bottom:15px; padding-top: 15px; width:100%">
  <div class="container" style=" margin-right: auto; margin-left: auto; width:100%; max-width:600px">
   <div class="row" style=" ">
    
    
     
    <div class="clearfix" style="clear:both !important"></div>
    <h4 style="margin-bottom:0; margin-top:5px; color:#5e5f61 !important; text-decoration:none; margin-bottom:0">
    Copyrights © {{date('Y')}} All Rights Reserved by Izone Inc.</h4>
   
    
   </div>
  </div>
 
 </footer>

</body>
</html>
