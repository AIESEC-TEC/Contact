// JavaScript Document
$(document).ready(function(){
	$(".lookmore").click(function(){
		var idUsuario = $(this).attr("id");
        $.ajax({
            type: "POST",
            data: {userId: idUsuario},
            url: "../config/userInfo.php",
            success: function(data){
				var resultados = data.split("<-->",10);
				// resultados = { name&lastname[0], cellphone[1], aiesecemail[2],university[3],profesion[4],skype[5],email[6],area[7],LC[8] }
				$("#userInfoName").text(resultados[0]);
				$("#userInfoCell").text(resultados[1]);
				$("#userInfoAiesec").text(resultados[2]);
				$("#userInfoAiesec").attr("href","mailto:"+resultados[2]);
				$("#userInfoUniversity").text(resultados[3]);
				$("#userInfoProfesion").text(resultados[4]);
				$("#userInfoSkype").text(resultados[5]);
				$("#userInfoMail").text(resultados[6]);
				$("#userInfoMail").attr("href","mailto:"+resultados[6]);
				$("#userInfoArea").text(resultados[7]);
				$("#userInfoLc").text(resultados[8]);
				$("#userInfoPhone").text(resultados[9]);
            }
        }).done(function(){
			$("#menu-top").animate({width: 'toggle'});
			$("#buscador").animate({width: 'toggle'});
			$("#contactInfo").animate({width: 'toggle'});
		});
		
	});
	$("#contactInfoBack").click(function(){
		$("#menu-top").animate({width: 'toggle'});
		$("#buscador").animate({width: 'toggle'});
		$("#contactInfo").animate({width: 'toggle'});
	});
});