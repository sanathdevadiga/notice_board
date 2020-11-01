   var $map1 = jQuery.noConflict();
      $map1( document ).ready(function() {

    var map;
     var mapOptions;
          var marker;
          var m1;
          var m2;
          var m3;
    var markers = [
    {
        "title": 'Bannur',
        "lat": '   12.7796986',
        "lng": '75.1901126',
        "description": 'Bannur,puttur'
      
    },
    {

        "title": 'PIO mall',
        "lat": '12.8803372',
        "lng": '74.8428997',
        "description": 'Slekin technical solution'
    },
    {
        "title": 'Bolwar',
        "lat": ' 12.7680622',
        "lng": '75.1897967',
        "description": 'Bolwar,puttur'
    },
    {
        "title": 'Mura',
        "lat": '12.781157',
        "lng": '75.1718152',
        "description": 'Mura,puttur'
    },
    {
        "title": 'Mangal store',
        "lat": '12.7782817',
        "lng": '75.1785579',
        "description": 'Mangal store,puttur.'
    }
    ];
     

    window.onload = function () {
         mapOptions = {
            center: new google.maps.LatLng(markers[1].lat, markers[1].lng),
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
           map = new google.maps.Map(document.getElementById("mapdiv"), mapOptions);
       LoadMap('jkhj');
    }
   

    function LoadMap(payload) {
       

        //Create and open InfoWindow.
        var infoWindow = new google.maps.InfoWindow();
var l;

//console.log(payload.substring(10,12));
if(payload.search("Empty")!=-1)
{
console.log("empty");
 l={text: "Garbage empty", color: "green",fontSize: "20px"};
}else if(payload.search("Medium")!=-1)
{
 l={text: "Garbage Medium", color: "orange",fontSize: "20px"};
}else if(payload.search("FULL")!=-1)
{
 l={text: "Garbage FULL", color: "red",fontSize: "20px"};
}
var icon = { 
    url: 'b.png',
    origin: new google.maps.Point(0, 0),
    labelOrigin: new google.maps.Point(20,0)
};  
var myLatlng;
var data ;
if(payload.substring(0,3).search("BOL")!=-1)
{
   data = markers[2];
            
            myLatlng = new google.maps.LatLng(data.lat, data.lng);
  try{
         if(m1==null)
         {
m1 = new google.maps.Marker({
                position: myLatlng,
                map: map,
                label:l,
                icon: icon,
                title: data.title
            });

  console.log("Create");
         }else
         {

    var label = m1.getLabel();
    label.color=l.color;
    label.text=l.text;
    m1.setLabel(label);
 
         } 
         }catch(e){}
         
}else if(payload.substring(0,3).search("PIO")!=-1)
{
   data = markers[1];
            
            myLatlng = new google.maps.LatLng(data.lat, data.lng);

if(m2==null)
{
m2 = new google.maps.Marker({
                position: myLatlng,
                map: map,
                label:l,
                icon: icon,
                title: data.title
            });

}else
{
   var label = m2.getLabel();
    label.color=l.color;
    label.text=l.text;
    m2.setLabel(label);
}
}else if(payload.substring(0,3).search("HST")!=-1)
{
   data = markers[0];
            
            myLatlng = new google.maps.LatLng(data.lat, data.lng);
  try{
            marker.setMap(null);
         }catch(e){}
marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                label:l,
                icon: icon,
                title: data.title
            });
}

    }

});