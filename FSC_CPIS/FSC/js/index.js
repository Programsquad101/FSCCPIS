$(document).ready(function(){

  $("#student-btn").click(function(){
    $("#student").show();
    $("#faculty").hide();
    $("#tutor").hide();
	
  });

  $("#faculty-btn").click(function(){
    $("#student").hide();
    $("#faculty").show();
    $("#tutor").hide();
  });

  $("#tutor-btn").click(function(){
    $("#student").hide();
    $("#faculty").hide();
    $("#tutor").show();
  });


});
