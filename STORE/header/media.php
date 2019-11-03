<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
  <style media="screen">
    .footermedia{
      position:absolute;;
      width:100%;
      text-align:center;
      bottom:0px;;
      clear:both;
      left:0px;
      padding:10px 0px;
  background:linear-gradient(45deg, #0e0416,#151719, #0e0416);

    }
    .footermedia .media{
      position:relative;
      width:70%;

      left:50%;
      margin-top:0px;
      transform:translate(-50%,0%);
      display:grid;
      grid-gap:0px;
      grid-template-columns: repeat(4,1fr);
    }
    .media nav{
      position:relative;
      margin:15px 0px;

      padding:15px;


      color:black;


    }
    .footermedia .media nav i{
      position:relative;
      width:auto;
      padding:10px 55px;
      background:linear-gradient(45deg, #0e0416,#151719, #0e0416);
      border-radius:25px;
      color:white;
      text-decoration:none;
    }
    @media(max-width:800px)
    {
      .footermedia .media{
        position:relative;
        width:auto;


        margin-top:0px;

        display:grid;
        grid-gap:0px;
        grid-template-columns: repeat(4,1fr);
      }
      .media nav{
        position:relative;
        margin:0px 0px;

        padding:10px 15px;


        color:black;


      }
      .footermedia .media nav i{
        position:relative;
        width:auto;
        padding:10px 25px;
        background:linear-gradient(45deg, #0e0416,#151719, #0e0416);
        border-radius:25px;
        color:white;
        text-decoration:none;
      }
      .poweredby{
        position:relative;
        margin:0px 15px;
        padding:0px;
        border-radius:10px;
        text-align:center;
        opacity:0.3;
        color:white;
      }
    }
    .poweredby{
      position:relative;
      opacity:0.3;
      margin:10px 15px;
      padding:5px;
      color:white;
      border-radius:10px;
      text-align:center;


    }

  </style>
</head>

<div class="footermedia">

    <div class="media">
      <nav>
      <a href=""><i class="fab fa-facebook-f" style="background: #3b5998 "></i></a>
      </nav>

      <nav>
      <a href="#"> <i class="fab fa-instagram" style="background:linear-gradient(135deg,#405de6,red)"></i></a>
      </nav>

      <nav>
        <a href="#"> <i class="fab fa-twitter"style="background:#1da1f2;"></i></a>
      </nav>
      <nav>
        <a href="whatsapp://send?text=<?php echo urlencode ('http://www.srijansingh.tk'); ?>" target="_blank" "> <i class="fab fa-whatsapp" style="background:#25d366;"></i></a>
      </nav>


  </div>



</div>
