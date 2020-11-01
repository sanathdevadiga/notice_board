<!DOCTYPE html>
<html lang="en">
<head>
    <title>SDIT</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="refresh" content="200">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <script src="{{asset('vendor/jquery/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('include/js/mqtt.js')}}" type="text/javascript"></script> 

  <!-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script> -->
<!-- <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->
<!-- <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> -->

    <script src="{{asset('include/js/config.js')}}" type="text/javascript"></script> 
    <style>
        .container{
            width:100%;
        }
        body{
            /* background-color:black; */
            background-color:white;
            animation:animation 20s infinite;
            transition:10s;
            animation-timing-function: linear;
        }
        h1{
            padding:10px;
        }
        .outer-container,.right,.left{
            /* border:1px solid black; */
            height:80vh;
        }
        .outer-container{
            display:grid;
            grid-template-columns:2fr 4fr 2fr;
            grid-template-columns:2fr 4fr 2fr;
            grid-gap:5px;
        }
        .left,.right{
            display:grid;
            grid-template-rows:1fr 1fr;
            grid-gap:5px;

        }
        .left div,.right div{
            /* border:1px solid black; */
        }
        .main,.div1,.div2,.div3,.div4{
            background-position:center;
            /* animation:animation 40s infinite; */
            transition: 2s;
            
            width:100%;
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }
        @keyframes animation{
            20%{
                background-color:orange;

             }
           40%{
                background-color:yellow;

           }
            60%{
                background-color:green;

            }
            80%{
                background-color:yellow;
            }
        } 

        body{
            margin:0;
            padding:0;
            /* background-image: linear-gradient(to right,green,red,green); */
            /* position:relative; */
        } 
        section{
            height: 100vh;
            background:#000;
        }
        section h1{
            margin:0;
            padding:0;
            position:absolute;
            top:50%;
            transform: translateY(-50%);
            width:100%;
            text-align: center;
            
        }
        section h1 span{
            color:#ddd;
            font-size: 2vw;
            font-family: sans-serif;
            letter-spacing: .2em;
            opacity: 0;
            display: inline-block;
            animation: animate 4s linear forwards;
        }
        @keyframes animate{
            0%{
                opacity: 0;
                transform: rotateY(90deg);
                filter: blur(10px);
                font-size:2vw;
            }
            100%{
                opacity: 1;
                transform: rotateY(0deg);
                filter: blur(0);
                font-size:10vw;
            }
        }
        section::before{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right,#f00,#f00,#0f0,#0ff,#ff0,#0ff);
            mix-blend-mode: color;
            pointer-events: none;
        }
        video{
            object-fit: cover;
            height:100vh;
        }
        h1 span:nth-child(1){
            animation-delay: 2s;
        }
        h1 span:nth-child(2){
            animation-delay: 2.5s;
        }
        h1 span:nth-child(3){
            animation-delay: 3s;
        }
        h1 span:nth-child(4){
            animation-delay: 3.5s;
        }
        h1 span:nth-child(5){
            animation-delay: 3s;
        }
        h1 span:nth-child(6){
            animation-delay: 3.5s;
        }
        h1 span:nth-child(7){
            animation-delay: 4s;
        }

        .sdetails{
            width:100%;
            background-color:black;
            color:white;
            
        }
        
        table,tr,td,th{
            border:1px solid black;
            border-collapse:collapse;
            padding:10px;
        }
        .sdit{
            font-size: 40px;
            /* background: -webkit-linear-gradient(green, yellow, red);*/
            text-align:center;
           /* -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;*/
            letter-spacing:5px; 
            animation: spacing 4s infinite;

        }

        @keyframes spacing{
            0%{
                letter-spacing:100px; 
                
            }
            50%{
                letter-spacing:5px; 
               
            }
            100%{
                letter-spacing:100px; 
               
            }
        }

        #sdetails{
            position:absolute;
            top:80%;
            left:50%;
            transform:translate(-50%,-50%);

        }

        .sdetails table,tr,th,td{
            border:1px solid white;
            border-collapse:collpase;
        }
    </style>
</head>
<body>
    <section id="section">
        <video id='video' src="{{asset('website/smoke.mp4')}}" autoplay muted></video>
        <h1>
            <span>S</span>
            <span>D</span>
            <span>I</span>
            <span>T</span>
        </h1>
    </section>

    <div class="container" id="container">
        <h1 class="sdit">SDIT</h1>


        <div class="outer-container">
            <div class="left">
                <div class="div1"></div>
                <div class="div2"></div>
            </div>  
            <div class="main" style="height:10">
                <!-- <video  height="10" width="10"  autoplay muted>
                    <source  src="{{asset('image/VID_20190907_111559.mp4')}}" type="video/mp4">
                </video> -->
            </div>
            <div class="right">
                <div class="div3"></div>
                <div class="div4"></div>
            </div>
        </div>

</div>
<div id="sdetails">
            <table class="sdetails" id="table">
                <thead>
                    <tr>        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    </tr>
                </tbody>
            </table>
</div>
<!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->
<!-- <script type="text/javascript" src="{{asset('include/js/jquery.slicebox.js')}}"></script> -->

<script type="text/javascript">
     $(document).ready(function() {

        var events={};
        var iterator1=0;
        var iterator2=0;
        var iterator3=0;
        var iterator4=0;
        var iterator5=0;
        // $(".main").css("background-image", "url(" + imageUrl + ")"); 

        $.ajax({
            'url':'{{route('geteve')}}',
            'method':'get',
            'dataType':'json',
            'success':function (data) {
                // event_length=data.length;
                // alert(JSON.stringify(data));
                events=data;
                if(events.length>=5){
                    iterator2=1;
                    iterator3=2;
                    iterator4=3;
                    iterator5=4;
                }
                else{
                    $('.left').css('grid-template-rows','0fr 0fr');
                    $('.right').css('grid-template-rows','0fr 0fr');
                }
            }
            
        })

        $.ajax({
            'url':'{{route('deleteevents')}}',
            'method':'get',
            'dataType':'json',
            'success':function (data) {

            }
            
        })

        
        
        $('#container').hide();
        // $('#sdetails').hide();


        function changeEvents(){
            // alert(events[iterator].image);
            // alert(path);
            var flagsUrl = '{{URL::asset('/image/')}}';
            // console.log(iterator1);
            $(".div1").css("background-image", "url("+flagsUrl+"/"+ events[iterator1++].image+")");
            $(".div2").css("background-image", "url("+flagsUrl+"/"+ events[iterator2++].image+")");
            $(".main").css("background-image", "url("+flagsUrl+"/"+ events[iterator3++].image+")");
            $(".div3").css("background-image", "url("+flagsUrl+"/"+ events[iterator4++].image+")");
            $(".div4").css("background-image", "url("+flagsUrl+"/"+ events[iterator5++].image+")");

            if(iterator1==events.length){
                iterator1=0;
            }
            if(iterator2==events.length){
                iterator2=0;
            }
            if(iterator3==events.length){
                iterator3=0;
            }
            if(iterator4==events.length){
                iterator4=0;
            }
            if(iterator5==events.length){
                iterator5=0;
            }
        }
        var counter=1;
        function showhide(){
            counter++;
            // console.log(counter);
            if(counter==8){
                $('#section').hide();
                // alert("hii");
                $('#container').show();
               
            }
        }
        timer = setInterval(showhide, 1300);
 
        myVar = setInterval(changeEvents, 10000);




            
     })
    


    var mqtt;
    var reconnectTimeout = 1000;
    var host,port;
    useTLS = false;
   	username = null;
	password = null;
    function MQTTconnect() {

       host="broker.mqtt-dashboard.com";
       port="8000";


  if (typeof path == "undefined") {
    path = '/mqtt';
  }

  mqtt = new Paho.MQTT.Client(host,parseInt(port),
      path,
      "web_" + parseInt(Math.random() * 100, 10)
  );
        var options = {
            timeout: 60,
            useSSL: false,
            cleanSession:true,
            onSuccess: onConnect,
            onFailure: function (message) {
       

       			// alert("fail to connect"+message);
            }
        };

        mqtt.onConnectionLost = onConnectionLost;
        mqtt.onMessageArrived = onMessageArrived;

        if (username != null) {
            options.userName = username;
            options.password = password;
        }
       // console.log("Host="+ host + ", port=" + port + ", path=" + path + " useSSL = fa + " username=" + username + " password=" + password);
 
        mqtt.connect(options);
      
      

    }



     function onConnect() {

    //    alert("connected");
      
        mqtt.subscribe("slekin/qqq", {qos: 0});
        

      
    }

  function onConnectionLost(response) {
   
        setTimeout(MQTTconnect, reconnectTimeout);
  
    };

    function onMessageArrived(message) {

        var topic = message.destinationName;
        var payload = message.payloadString;
        console.log(payload);
        if(payload!=""){
            console.log(payload);
            var id=payload;

            
            $.ajax({
                'url':'{{route('getstudentsubject')}}',
                'method':'get',
                'dataType':'json',
                cache:false,
                'data':"id="+id,
                'success':function (data) {
                    // alert(JSON.stringify(data));

                    // data=JSON.parse(data);
                    $('#table thead tr th').remove();


                     $('#table thead tr').append('<th>'+data[0].usn+'</th>');
                            data.forEach(function (item) {
                                // $('#subname').append($('<option>', { value : item.subname }).text( item.subname));
                                $('#table thead tr').append('<th>'+item.subname+'</th>');
                            });

                            $('#table tbody tr').remove();
                            $.ajax({
                                'url':'{{route('getstudentmarks')}}',
                                'method':'get',
                                'dataType':'json',
                                cache:false,
                                'data':"id="+id,
                                'success':function (data) {
                                    // alert(data);
                                    
                                    // data=JSON.parse(data);
                                    var value='<tr><td>Mark</td>';
                                    for(c=0;c<data.length;c++) {
                                        value +='<td>'+data[c].mark+'</td>';
                                    }
                                    value+='</tr>';
                                    $('#table tbody').append(value);

                                },
                                'error':function (data) {
                                    alert(JSON.stringify(data));
                                }


                        })
                        $.ajax({
                                'url':'{{route('getstudentpercentage')}}',
                                'method':'get',
                                'dataType':'json',
                                cache:false,
                                    'data':"id="+id,
                                    'success':function (data) {
                                        // alert(data);
                                        // alert(JSON.stringify(data));

                                        // data=JSON.parse(data);
                                        var value='<tr><td>Attendance</td>';
                                        for(c=0;c<data.length;c++) {
                                            value +='<td>'+Math.abs(data[c].percentage)+'%</td>';
                                        }
                                        value+='</tr>';
                                        $('#table tbody').append(value);

                                    },
                                    'error':function (data) {
                                        alert(JSON.stringify(data));
                                    }


                            })
                }
                

        })

        setTimeout(function(){
            $('#sdetails').show() 
        }, 1000);


           
        }





  
       



    }


    
    MQTTconnect();
   
  

</script>   
</body>
</html>
