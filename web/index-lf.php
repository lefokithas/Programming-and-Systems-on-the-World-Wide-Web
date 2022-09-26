<?php
include_once 'cus_header.php';

if ($_SESSION["useruid"] === NULL) {
  header("location: ../index.php?error=nologin");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Leaflet Tutorial</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">

  <!-- leaflet css  -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@v0.74.0/dist/L.Control.Locate.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@v0.74.0/dist/L.Control.Locate.min.js" charset="utf-8"></script>


  <style>
    body {
      margin: 100;
      padding: 100;
    }
  </style>
</head>

<body>
  <div id="map" style="position:absolute; width: 100%;height:85%;margin-top:100px"></div>
  <div class="container">

  </div>
</body>

</html>

<!-- leaflet js  -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.74.0/dist/L.Control.Locate.min.js" charset="utf-8"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<link href="Leaflet.AnimatedSearchBox.css" rel="stylesheet">
<script src="Leaflet.AnimatedSearchBox.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fuse.js@5.0.10-beta/dist/fuse.min.js"></script>


<script>
  var currentdate = new Date();
  var day = currentdate.toLocaleString('en-US', {
    weekday: 'long'
  });
  var hour = currentdate.getHours();
  // Map initialization


  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showMarker);

  } else {
    alert("Geolocation is not supported by this browser.");
  }


  function showMarker(position) {
    var userPosition = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
    userPosition.bindPopup("<b>You are here!</b>");
  }
  var map = L.map('map').setView([38.246639, 21.734573], 14);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>'
  }).addTo(map);

  const attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
  const url = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
  L.tileLayer(url, {
    attribution
  }).addTo(map);

  var searchbox = L.control.searchbox({
    position: 'topright',
    expand: 'left'
  }).addTo(map);


  var MarkerIcon=L.Icon.extend({
  options: {
      iconSize:     [25, 41],
      shadowSize:   [41, 41],
      iconAnchor:   [12, 41],
      shadowAnchor: [12, 41],
      popupAnchor:  [1, -34],

}
});


var greenIcon=new MarkerIcon({iconUrl:'images/marker-green-16px.png'});
var orangeIcon=new MarkerIcon({iconUrl:'images/marker-orange-16.png'});
var redIcon=new MarkerIcon({iconUrl:'images/marker-red-16.png'});

L.greenIcon=function(){
  return new L.Icon();
};

L.orangeIcon=function(){
  return new L.Icon();
};

L.redIcon=function(){
  return new L.Icon();
};


  const stores = $.ajax({
    url: 'map.php',
    method: 'GET',
    dataType: 'json',
    success: function(data) {
      console.log(data)

    }
  });
  //const storesfinal=JSON.parse(stores)
  //const storesfinal=JSON.stringify(stores)
  //console.log(storesfinal)
  console.log(stores)
  //stores=JSON.parse(stores)


  stores.done(searchResult)
  //stores=JSON.parse(stores)


  function searchResult(res) {
    var storeNames = [];
    for (let i = 0; i < res.length; i++) {
      storeNames.push(res[i].name);
      console.log(storeNames)


    }
    var storeTypes=[];
    var storeType=[];
    for(let i=0;i<res.length;i++){
      storeTypes.push(res[i].types);
      //console.log(storeTypes)

      for(j=0;j<storeTypes.length;j++){
        const secondaryArray=storeTypes[j].split(",")
        console.log(secondaryArray)
        for(k=0;k<secondaryArray.length;k++){
          storeType.push(secondaryArray[k])
          //console.log(storeType)
        }
        console.log(storeType)
        }

       // console.log(storesType)

        //console.log(storeType)
        }


        const store_type = [...new Set(storeType)];
        console.log(store_type);




      //const store_type = [...new Set(storeType)];
     // console.log(unique);



        let kappa=[storeNames+","+store_type];
        console.log(kappa)
        const search_info=kappa.toString().split(",");
        console.log(search_info);







    var fuse = new Fuse(search_info, {
      shouldSort: true,
      threshold: 0.6,
      location: 0,
      distance: 100,
      minMatchCharLength: 1
    });



    searchbox.onInput("keyup", function(e) {
      if (e.keyCode == 13) {
        search();
      } else {
        var value = searchbox.getValue();
        if (value != "") {
          var results = fuse.search(value);
          searchbox.setItems(results.map(res => res.item).slice(0, 3));
        } else {
          searchbox.clearItems();
        }
      }
    });


    searchbox.onButton("click", search);

    function search() {
      var value = searchbox.getValue();
      var storeInfo = []
      for (var i in res) {
        if (res[i].name == value || res[i].types== value) {
          storeInfo.push(res[i])
          console.log(value)


        }    console.log(storeInfo)


      }


      //marker.bindPopup("Name: " + storeInfo[0].name);
      map.setView([storeInfo[0].lat, storeInfo[0].lng], 15);
      var marker=L.marker(L.latLng(storeInfo[0].lat,storeInfo[0].lng),{icon:greenIcon}).addTo(map)
    //marker.bindPopup("Name: '" + storeInfo[0].name+"'");


    }

  }


   // marker.bindPopup("Name: " + storeInfo[0].name);
   // map.setView([storeInfo[0].lat, storeInfo[0].lng], 15);



  /*
  async function postData(url='',data={}) {
    const response= await fetch(url,{
      method:'POST',
      mode:'cors',
      cache:'no-cache',
      credentials:'include',
      headers:{
        'Content-Type':'application/json'
      },
      redirect:'follow',
      referrerPolicy:'no-referrer',
      body:JSON.stringify(data)

    });
    return response.json();
  }
  postData('map.php',{})
  .then((data)=>{
    console.log(data);
  })
  */
  /*
  const div=document.getElementById("search");
  const url1="map.php";
  let pois=[];
  fetch(url1)
  .then(response =>response.json())
  .then(json=>{
    poi=json.results;
    showPoi();

  })

  function showPoi(){
    pois.map(function(poi){
      let id=document.createElement("id");
      let name=document.createElement("name");
      let type=document.createElement("type");
      let lat=document.createElement("lat");
      let lng=document.createElement("lng");


      span.innerHTML= `$(poi.name)$(poi.type)`;
      id.appendChild(lat);
      id.appendChild(lng);
      div.appendChild(id);

    });
  };

  function findMatches(word){
    if (!word) word=null;
      return pois.filter(poi=>{
        const regex = new RegExp(word,"gi");
        return poi.name.match(regex) || poi.type.match(regex)
      });
  }
  */


  /*
  const stores=$.ajax({
    url:'map.php',
    method:'GET',
    dataType:'json',
    success:function(data){
    }
  })
  stores.done(search)

  function search(results){
    storeName=[]
    for (i=0;i<results.length;i++){
      storeName.push(resukts[i].name)
    }


    var searchbox = L.control.searchbox({
  			position: 'topright',
  			expand: 'left',
  			width: '450px',
  			autocompleteFeatures: ['setValueOnClick']
  		}).addTo(map)








  searchbox.onInput("keyup",function(e){
    var value= searchbox.getValue();
    if(value!=""){
      var results=search(value);
      searchbox.setItems(results.map(result=>results.item).slice(0,3));


    }else{
      searchbox.clearItems();
    }
  });


  searchbox.onButton("click",search);
  function search(){
    var value=searchbox.getValue();
    var info=[]

    for (var i in results){
      if(results[i]==value){
        info.push(results[i])
        console.log(value)
      }
    }

  }
  }
  //console.log(stores)
  //alert(stores)


  //const getStores=(id,name,adress,types,lat,lng,rating,ranting_n,day,time,popularity)=>{
    $('#searchBtn').click(function(){
      $.ajax({
        type:"GET",
        url:"map.php"
      }).done(function(data)
      {
        var jsonData=JSON.parse(data);
        var jsonLength=jsonData.results.length;

      });

    });


   // };














  /*const stores=$.ajax({
    url:'map.php',
    method:'GET',
    dataType:'json',
    success:function(data){
    }
  })
  stores.done(search)
  $(document).ready(function(){
    $('#search').on('keyup',function(e){
      if(e.keyCode==13){ //if hit enter


        search();
    }
  })
  });
  //addEventListener("click",search)

  function search(result){
    storeNames=[];
    for (let i=0;i<result.length;i++){
        storeNames.push(result[i].name);
    }
    const val=document.getElementById('search').value;
    const btn=document.querySelector('submit');
    btn.onclick=function(){

      var value=val.getValue();
      var info=[];
      for(i=0;i<result.length;i+7){
        if((result[i].name==value || result[i].type==value) && result[i].day==day && result ){
          for(j=i;j<i+2;j++){
            if(result[j].name==result[j+1].name){
              result[j].popularity+=result[j+1].popularity;
            }
          }
          result[j].popularity=result[j].popularity/3;
        }

          info.push(result[i]);

      }

    population=Math.round(info[0].populartity);
    if(population>=0 && population<=32){
        var marker=L.marker([info[0].lat,info[0].lng],{icon:greenIcon}).addTo(map);
    }else if(population>32 && population<=65){
        var marker=L.marker([info[0].lat,info[0].lng],{icon:orangeIcon}).addTo(map);
    }else if(population>65){
        var marker=L.marker([info[0].lat,info[0].lng],{icon:redIcon}).addTo(map);
    }

    marker.bindPopup("Name: "+info[0].name+"<br>Popularity: "+info[0].popularity+"<br>Address: "+info[0].address);
    map.setView([info[0].lat,info[0].lng],15);



    }

  }*/
</script>

<?php
include_once 'footer.php';
?>
