$(function(){
		
	$(window).load(function(){
		$(".wrap").css("minHeight", $(window).height()+1);
		var sect = $(".section");
		var i = 0;
		sect.eq(i).fadeIn(600);
		i++;
		setInterval(function(){
			sect.eq(i).fadeIn(400);
			i++;
		}, 400);
	});
	$(".parameters tr:odd").addClass("odd");
	$(".language").click(function(){
		var lang = $(this).data("lang");
		var a_lang = "en";
		if(lang === "en"){
			a_lang = "ru";
			$(".model").removeClass("ru");
		}else{
			$(".model").addClass("ru");
		}
		$(this).data("lang", a_lang).text(a_lang);
		$.ajax({
			url: '/js/lang_'+lang+'.json',
			dataType: "json",
			scriptCharset: "windows-1251",
			contentType: "application/x-www-form-urlencoded; charset=windows-1251",
			beforeSend: function ( xhr ) {
				xhr.overrideMimeType("text/plain; charset=windows-1251");
			},
			success: function(data) {
				$.each(data, function(key, val) {
					$("#"+key).html(val);
				});
				$(".parameters tr:odd").addClass("odd");
			}
		});
		
	});

	$.pixlayout({clip: true, src: "maket.jpg", show:true, center:false, top:0, left:0, fixed:true});
	
});