$(document).ready( function () {
	//$("#salida").val("<table border='1' cellpadding='2' cellspacing='2'>"+$("#example").html()+"</table>");
	$("#ingresar").click(function(){
		$.ajax({
			type: "POST",
			async: false,
			url: "../config/login.php",
			data: { useremail: $("#usuario-login-name").val(), password: $("#usuario-login-pass").val()},
			success: function(data){
				if ( data == "--loginwrong--" ) {
					alert("Wrong email or password!");
				}
				location.reload();
			}
		});
	});
	$("#quit-session").click(function(){
		$.ajax({
			type: "POST",
			async: false,
			url: "../config/logout.php"
		});
		location.reload();
	});
	$("#exportar-contactos").click(function(){
		$("#protectora").fadeIn(function(){
			$("#buscador").hide();
			$("#exportar-contactos-div").fadeIn();
		});
	});
	$("#protectora").click(function(){
		$(this).fadeOut();
	});
	$("#exportar-contactos-div").click(function(e){
		e.stopPropagation();
	});
	$( "#progressbar" ).progressbar({
      value: 15
    });
	/*
	$("#progressbar").on( "click", function( event ) {
      var target = $( event.target ),
        progressbar = $( "#progressbar" ),
        progressbarValue = progressbar.find( ".ui-progressbar-value" );
 
      if ( target.is( "#numButton" ) ) {
        progressbar.progressbar( "option", {
          value: Math.floor( Math.random() * 100 )
        });
      } else if ( target.is( "#colorButton" ) ) {
        progressbarValue.css({
          "background": '#' + Math.floor( Math.random() * 16777215 ).toString( 16 )
        });
      } else if ( target.is( "#falseButton" ) ) {
        progressbar.progressbar( "option", "value", false );
      }
    });
	*/
	var prBar = 15;
    var target =  progressbar = $( "#progressbar" ),progressbarValue = progressbar.find( ".ui-progressbar-value" );
	progressbarValue.css({"background": '#00CC33'});
	$("#exportar-contactos-div input[type=checkbox]").change(function(e){
		if($(this).is(":checked")){
			var suma = prBar + parseInt($(this).attr("valor"));
			if (suma <= 100){
				prBar = suma;
				progressbar.progressbar( "option", {value: prBar});
				if ( suma  > 50 ) {
					progressbarValue.css({"background": '#FF9900'});
				}
				if ( suma  > 80 ) {
					progressbarValue.css({"background": '#CC0000'});
				}
			}
			else {
				$("#moreThanAllowed").fadeIn(500).delay(2000).fadeOut(1000);
				$(this).attr('checked', false);
			}
		}
		else {
			prBar = prBar - parseInt($(this).attr("valor"));
			progressbar.progressbar( "option", {value: prBar});
			if (prBar - parseInt($(this).attr("valor")) < 80 ){
				progressbarValue.css({"background": '#FF9900'});
			}
			if (prBar - parseInt($(this).attr("valor")) < 50 ){
				progressbarValue.css({"background": '#00CC33'});
			}
		}
	});
	$("#cancelExport").click(function(){
		$("#exportar-contactos-div").fadeOut(function(){
			$("#buscador").show();
			$("#protectora").fadeOut();
		});
		
	});
	$("#desactivar").click(function(){
		$('#example').detach();
	});
});