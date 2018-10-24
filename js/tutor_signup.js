$(document).ready(function(){



    $("#location-input").blur(function(){
      var location = $(this).val();
        axios.get('https://maps.googleapis.com/maps/api/geocode/json' ,{
          params:{
            address:location,
            key: 'AIzaSyCxbLjg1a5b0sR7l3GuArkgPT1REoFOtkU'
          }
      })
      .then(function(response){
        // Log full response
        console.log(response);

        // Formatted address
        var formattedAddress = response.data.results[0].formatted_address;
        var state = response.data.results[0].address_components[5].long_name;
        var city = response.data.results[0].address_components[3].long_name;
        var zip = response.data.results[0].address_components[7].long_name;


        // Geometry
        var lat = response.data.results[0].geometry.location.lat;
        var lng = response.data.results[0].geometry.location.lng;

        //output
        var formattedAddressOutput = `${"<input type='text' name = 'address' class='text-input' value='" + formattedAddress + "'>"}`;
        var stateOutput = `${"<input type='text' name = 'state' class='text-input' value='" + state + "'>"}`;
        var cityOutput = `${"<input type='text' name = 'city' class='text-input' value='" + city + "'>"}`;
        var zipOutput = `${"<input type='text' name = 'zip' class='text-input' value='" + zip + "'>"}`;
        var latOutput = `${"<input type='text' name = 'lat' class='text-input' value='" + lat + "'>"}`;
        var lngOutput = `${"<input type='text' name = 'lng' class='text-input' value='" + lng + "'>"}`;


        // Address Components
        var addressComponents = response.data.results[0].address_components;
        var addressComponentsOutput = '<ul class="list-group">';
        for(var i = 0;i < addressComponents.length;i++){
          addressComponentsOutput += `
            <li class="list-group-item"><strong>${addressComponents[i].types[0]}
            </strong>: ${addressComponents[i].long_name}</li>
          `;
        }
        addressComponentsOutput += '</ul>';



        // Output to app
        document.getElementById('full-address').innerHTML = formattedAddressOutput;
        document.getElementById('lat').innerHTML = latOutput;
        document.getElementById('lng').innerHTML = lngOutput;



      })
      .catch(function(error){
        console.log(error);
      });


      $("#location-input").hide();
    });

  $("#username").blur(function(){
    var username = $(this).val();
    $.ajax({
      url:"scripts/check_user.php",
      method:"POST",
      data:{user_name:username},
      dataType:"text",
      success:function(html)
      {
        $("#username-error").html(html);
      }
    });

  });


  $(".password").click(function(){
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
        $(".fa-eye-slash").show();
        $(".fa-eye").hide();
    } else {
        x.type = "password";
        $(".fa-eye").show();
        $(".fa-eye-slash").hide();
    }

  });

});
