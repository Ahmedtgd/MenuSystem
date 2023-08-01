<html><head><style>
body, html {
  height: 100%;
  margin: 0;
}

.bgimg {
  height: 100%;
  background-position: center;
  background-size: cover;
  position: relative;
  color: white;
  font-family: "Courier New", Courier, monospace;
  font-size: 25px;
}

.topleft {
  position: absolute;
  top: 0;
  left: 16px;
  background: radial-gradient(bisque, transparent);
  padding: 10px;
}

.bottomleft {
  position: absolute;
  bottom: 0;
  left: 16px;
}

.middle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
      background: radial-gradient(bisque, transparent);
    padding: 25px;
}

hr {
  margin: auto;
  width: 40%;
  background: black;
  color: black;
}
p{
    font-weight: 700;
    color: black;
}
h1{
    color: black;
}
</style>
</head><body>
@php
$path = asset('images/commingsoon.jpg');
@endphp
<div class="bgimg" style="background-image: url({{$path}});">
  <div class="topleft">
    <p>AUR Restaurants</p>
  </div>
  <div class="middle">
    <h1>COMING SOON</h1>
    <hr>
    <p>AurCloud.com</p>
  </div>
  <div class="bottomleft">
    <!--<p>Some text</p>-->
  </div>
</div>



</body></html>