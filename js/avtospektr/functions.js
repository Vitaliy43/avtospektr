
function str_replace(search, replace, subject) {
	return subject.split(search).join(replace);
}


function myAlert(text){
	
	jAlert(text,'Магазин "Автоспектр"');
}

function refreshCaptcha() {
      img = document.getElementById('imgCaptcha');
      img.src = '/images/captcha.php?' + Math.random();
      return false
}


function show_list_parts(id,url){
	
	if($('#hiddenlist_'+id).css('display')=='none'){
		
		if($('#hiddenlist_'+id+' .dropTable').length>0){
			
		}
		else{
			load_list_parts(id,url);
		}
		$('#hiddenlist_'+id).css({'display':'block'});
	}
	else{
		$('#hiddenlist_'+id).css({'display':'none'});

	}
}

function delete_client(object,id,client_name){
	
	var url=object.href;
	var container_link=$('#link_delete_'+id).html();
	
	jConfirm('Вы уверены, что хотите удалить клиента '+client_name+'?','Магазин "Автоспектр"',function(r){
		
	if(r==true){
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&client_id='+id,
    cache: false,
	beforeSend:function(){
		$('#link_delete_'+id).html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');
		
	},
	error: function(){
		myAlert('Неизвестная ошибка!');
		$('#link_delete_'+id).html(container_link);
	},
    success: function(data){
	
		$('#a_'+id).html(container_link);
		if(data.answer==1){
			
				$('#row_'+id).remove();
			
		}
		else{
			$('#link_delete_'+id).html(container_link);
			myAlert('Неизвестная ошибка');
		}
		
	}
    });
		
	}
	}
	);
}


function set_pricing(url,distributor_id,client_id){
	
	var container_link=$('#set_pricing_'+distributor_id).html();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data:'&type=ajax&client_id='+client_id,
    cache: false,
	beforeSend:function(){
		$('#set_pricing_'+distributor_id).html('<img src="/images/avtospektr/ajax-loaders/menu.gif">');
	},
	error:function(){
		$('#set_pricing_'+distributor_id).html(container_link);
		myAlert('Неизвестная ошибка!');
	},
    success: function(data){
		$('#set_pricing_'+distributor_id).html(container_link);	
		TINY.box.show({html:data.content,boxid:'frameless',animate:true,close:true});

    }
    });
}


function view_downloader(type){

	if(type == 'insert')
		var operation = 'Загрузить';
	else
		var operation = 'Обновить';
	
	if($('#downloader_file').css('display')=='none'){
	
		$('#downloader_file').show('normal');
		$('#link_downloader_catalog').html('Скрыть загрузчик');
	}
	else{
		$('#downloader_file').hide('normal');
		$('#link_downloader_catalog').html(operation+' файл каталога');
	
	}
}

function ajaxFileUpload(main_url)
	{
	
	
		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});
		

		$.ajaxFileUpload
		(
			{	
				url:main_url+'uploads/ajaxfileupload.php',
				secureuri:false,
				fileElementId:'catalog_file',
				dataType: 'json',
				data:{name:'logan', id:'id'},
				cache: false,
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
					
						if(data.error != '')
						{
							myAlert(data.error);
						}else
						{
								document.location.reload();
								$('#downloader_file').html(data.content);
//								if(typeof(data.date) != 'undefined')
//									$('#link_downloader_catalog').next('(последняя дата изменения - '+data.date+')');
								
						}
						
					}
					
				},
				error: function (data, status, e)
				{
					
					//myAlert(e);
				}
			}
		)
		
		 	

	}

function ship_product(url,id){
	
	$('#store_'+id).remove();
	window.open(url);
	
}

function show_document(url){
	window.open(url);
}

function drop_menu(object){
		$(object).find("ul").stop(true,true).slideDown();
		$(object).find("ul").slideUp();
}

function show_table_price_group(url){
	
	var container_table_price_group=$('.discount').html();
	
	$.ajax({
	type: "POST",
	url: url,
	dataType: 'json',
	data: 'type=ajax',
	cache: false,
	beforeSend: function() {
		$('.discount').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
	},
	error: function(){
		myAlert('Неизвестная ошибка!');
		$('.discount').html(container_table_price_group);
	},
	success: function(data){
		
		$(".discount").html(data.content);
	}
	});
}

function link_purchase_point(url){
		
	$.ajax({
	type: "POST",
	url: url,
	dataType: 'json',
	data: 'type=ajax',
	cache: false,
	error: function(){
		myAlert('Неизвестная ошибка!');
	},
	success: function(data){
		if(data.answer==1){
			document.location.reload();
		}
		else{
			myAlert(data.content);
		}
	}
	});
}

function change_purchase_point(url){
	
	var purchase_point=$('#purchase_points option:selected').val();
	
	$.ajax({
	type: "POST",
	url: url,
	dataType: 'json',
	data: 'type=ajax&purchase_point='+purchase_point,
	cache: false,
	error: function(){
		myAlert('Неизвестная ошибка!');
	},
	success: function(data){
		if(data.answer==1){
			document.location.reload();
		}
		else{
			myAlert('Неизвестная ошибка!');
		}
	}
	});
}

function validate_remind(url){

var loginmail=$('#loginmail').val();
var answer;
var content='';
var remind_first=$('#remind_first').val();
	
	$.ajax({
	type: "POST",
	url: url,
	dataType: 'json',
	data: 'type=ajax&loginmail='+loginmail+'&remind_first='+remind_first,
	cache: false,
	error: function(){
		myAlert('Неизвестная ошибка!');
	},
	success: function(data){
		answer=data.answer;
		content=data.content;
		if(answer==0){
		$('#container_remind_password').html(data.content);
		}
		else if(answer==1){
		myAlert(content);
		}
	
	}
	});


}


function output_search_result(manufacturer,url){

var search_code=document.getElementById('DetailNum').value;
var Sort=$('#SortType option:selected').val();
var cross=document.getElementById('ch_email').value;
var content=$('#content').html();
var photoBox=$('#photoBox').html();
var tzCheckBox=$('.tzCheckBox');

var for_cross=$('#for_cross').val();



$.ajax({
type: "POST",
url: url,
dataType: 'json',
data: 'type=ajax&manufacturer='+manufacturer+'&search_code='+search_code+'&sort='+Sort+'&cross='+cross+'&for_cross='+for_cross,
cache: false,
beforeSend: function() {
	$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
	$('.search_panel').before('<div style="width:100%;text-align:center;">Подождите, идет подгрузка....</div>');
},
error: function(){
	myAlert('Неизвестная ошибка!');
	$('#content').html(content);
},
success: function(data){
//	TINY.box.hide();
	$("#content").html(data.content);
}
});

} 


function set_distributor(){

	var counter_distributors=$('#counter_distributors').val();
	var distributor_id=$('#adder #select_missing_distributors option:selected').val();
	var distributor_name=$('#adder #select_missing_distributors option:selected').html();
	var markup_id=$('#last_markup').val();
	var input_distributor='<input type="text" class="input_markups" name="markup_'+distributor_id+'" id="markup_'+distributor_id+'">%';
	

	content='<tr><td>'+distributor_name+'</td><td>'+input_distributor+'</td></tr>';
		//alert('#row_markup_'+markup_id);
	$('#row_markup_'+markup_id).after(content);
	if(counter_distributors==0){
		$('#adder').remove();
		$('#add_markup').remove();
	}
	
	
}


function check_reg(reg,word){

	if(reg=='russian'){
		word='user='+word;
	}
	else{
		word='email='+word;
	}
	
	$.ajax({
	type: "POST",
    url: '/user/checkreg',
	dataType: 'json',
	data: 'type=ajax&reg='+reg+'&'+word,
    cache: false,
    success: function(data){
		if(data.answer==1){
			return true;
		}
		else{
			return false;
		}
		}
    });
	
}

function validate_profile(object){
	
	url=object.action;
	
	var address=$('#input_address').val();
	var type_payment=$('#input_type_payment option:selected').val();
	var telephone=$('#input_telephone').val();
	var email=$('#input_email').val();
	var content_profile_user=$('#profile_user').html();
	if($('#profile_old_password').length>0){
		var old_password=$('#profile_old_password').val();
	}
	else{
		var old_password='';
	}
	var new_password=$('#profile_new_password').val();
	var confirm_new_password=$('#profile_confirm_password').val();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&profile_address='+address+'&profile_telephone='+telephone+'&profile_email='+email+'&profile_old_password='+old_password+'&profile_new_password='+new_password+'&profile_confirm_password='+confirm_new_password+'&type_payment='+type_payment,
    cache: false,
	beforeSend:function(){
		$('#profile_user').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');	
	},
	error: function(){
		myAlert('Неизвестная ошибка!');
		$('#profile_user').html(content_profile_user);
	},
    success: function(data){
		$('#profile_user').html(data.content);
	}
    });
	
}

function validate_vin(url){

	
	var numberVin=$('#numberVin').val();
	var year=$('#year option:selected').val();
	var brands=$('#brands option:selected').val();
	var model=$('#model').val();
	var type_engine=$('#type_engine option:selected').val();
	var engine_capacity=$('#engine-capacity').val();
	var gear=$('#gear option:selected').val();
	var car_bodies=$('#car_bodies option:selected').val();
	var transmission=$('#transmission option:selected').val();
	var air=$('#air option:selected').val();
	var Abs=$('#abs option:selected').val();
	var gur=$('#gur option:selected').val();
	var additional_info=$('#additional_info').val();
	var necessary_parts=$('#necessary_parts').val();
	
	if(numberVin==''){
		myAlert('Не заполнено поле "Номер VIN или номер кузова!"');
		$('#numberVin').focus();
		return false;
	}
	if(year==''){
		myAlert('Не указан год!');
		$('#year').focus();
		return false;
	}
	if(brands=='0'){
		myAlert('Не указана марка автомобиля!');
		$('#brands').focus();
		return false;
	}
	if(model==''){
		myAlert('Не указана модель автомобиля!');
		$('#model').focus();
		return false;
	}
	if(necessary_parts==''){
		myAlert('Не указаны небходимые запчасти!');
		$('#necessary_parts').focus();
		return false;
	}

	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&submit=1&numberVin='+numberVin+'&year='+year+'&brands='+brands+'&model='+model+'&type_engine='+type_engine+'&engine-capacity='+engine_capacity+'&gear='+gear+'&car_bodies='+car_bodies+'&transmission='+transmission+'&air='+air+'&abs='+Abs+'&gur='+gur+'&additional_info='+additional_info+'&necessary_parts='+necessary_parts,
    cache: false,
	beforeSend:function(){
		$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');	
	},
	error: function(){
		myAlert('Неизвестная ошибка!');
		$('#content').html(content);
	},
    success: function(data){
		$('#content').html(data.content);
	}
    });
	
}


function validate_registration(object){

	url=object.action;
	
	var user=$('#user').val();
	var passwd=$('#passwd').val();
	var fio=$('#fio').val();
	var address=$('#address').val();
	var telephone=$('#telephone').val();
	var email=$('#email').val();
	var txtCaptcha=$('#txtCaptcha').val();
	var	check=$('#check').val(); 
	var type_contragent=document.getElementsByName('type_contragent').value;
	var content=$('#content').html();

	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&user='+user+'&passwd='+passwd+'&fio='+fio+'&address='+address+'&telephone='+telephone+'&email='+email+'&submit=1&type_contragent='+type_contragent+'&txtCaptcha='+txtCaptcha,
    cache: false,
	beforeSend:function(){
		$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');	
	},
	error: function(){
		myAlert('Неизвестная ошибка!');
		$('#content').html(content);
	},
    success: function(data){
		$('#content').html(data.content);
	}
    });
	
}

function check_captcha(txtCaptcha){
	
	$.ajax({
	type: "POST",
    url: '/user/checkcaptcha',
	dataType: 'json',
	data: 'type=ajax&txtCaptcha='+txtCaptcha,
    cache: false,
    success: function(data){
		if(data.answer==1){
			return true;
		}
		else{
			return false;
		}
		}
    });
}

function check_email(email){
	
	$.ajax({
	type: "POST",
    url: '/user/checkemail',
	dataType: 'json',
	data: 'type=ajax&email='+email,
    cache: false,
    success: function(data){
		if(data.answer==1){
			return true;
		}
		else{
			return false;
		}
		}
    });
}

function check_login(user){
	
	$.ajax({
	type: "POST",
    url: '/user/checklogin',
	dataType: 'json',
	data: 'type=ajax&user='+user,
    cache: false,
    success: function(data){
	myAlert(data.answer);
		return data.answer;
		
		}
    });
}

function turn_contragent(object){
	
	id=object.id;
	check=$('#check').val(); 
	
	 
		
		if(check=='individual'){
			$('#container_fio span').text('Наименование организации');
			$('#container_address span').text('Юридический адрес');
			$('#check').val('juridical');
		}
		else{
			$('#container_fio span').text('Фамилия и иннициалы');
			$('#container_address span').text('Домашний адрес');
			$('#check').val('individual');

		}
		
	
}

function validate_editor(url){
	
	var header=$('#content_header').val();

	if(header.length<2){
		myAlert('У материала отсутствует заголовок!');
		return false;
	}
	document.editor_form.submit();
}


function validate_basket(url){
	
	var buffer=$('#ids').val();
	var ids=buffer.split(',');
	var summa=$('#summa').val();
	var orders='';
	var comments = '';
	
	$(".price textarea").each(function(){
		var id = $(this).attr('id');
        var comment = $(this).val();
		comment = encodeURIComponent(comment);
		if(comment != '')
			comments += '&'+id+'='+comment;
	}); 
	
	for(i=0;i<ids.length;i++){
		
		if($('#check_'+ids[i]).attr('checked')=='checked'){
			num=$('#quantity_'+ids[i]).val();
			orders+=ids[i]+'-'+num;
			if(i!=ids.length-1){
				orders+=';';
			}
		}
	}
	
	if(orders==''){
		myAlert('Не выбрано ни одной детали!');
		return false;
	}
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&orders='+orders+'&summa='+summa+comments,
    cache: false,
	beforeSend:function(){
		$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');

	},
    success: function(data){
		$('#content').html(data.content);
		document.title = data.title;
		
		if(data.answer==1){
			$('.menu_cart').html(data.num);

		}

	}
    });
	
}

function validate_add_employee(object){
	
	url=object.action;
	
	var user_id=$('#user_id option:selected').val();
	var role_id=$('#role_id option:selected').val();
	var container_edit_block=$('.edit_block').html();
	
	if(user_id==0){
	 	myAlert('Не выбран пользователь!');
		return false;
	 }
	
	if(role_id==0){
	 	myAlert('Не выбрана назначаемая роль!');
		return false;
	 }
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&user_id='+user_id+'&role_id='+role_id+'&add=1',
    cache: true,
	beforeSend:function(){
		$('.edit_block').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>')	
	},
	error:function(){
		myAlert('Неизвестная ошибка!');
		$('.edit_block').html(container_edit_block);
		},
    success: function(data){
		$('.edit_block').html(container_edit_block);
		TINY.box.show({html:'Данные успешно добавлены!',animate:false,close:false,mask:false,boxid:'success',autohide:2,top:-100,left:-100});
		$('#content').html(data.content);
		
	}
    });
}

function validate_add_purchase_point(object){
	
	var url=object.action;
	var name=$('#purchase_point_name').val();
	var address=$('#purchase_point_address').val();
	var telephone=$('#purchase_point_telephone').val();
	var markup=$('#purchase_point_markup').val();
	var delivery_time=$('#purchase_point_delivery_time').val();
	var manager_id=$('#manager_id option:selected').val();
	var container_edit_block=$('.edit_block').html();
	
	if($('#add').length>0){
		var type='add';
	}
	else{
		var type='update';
	}
	
	if($('#purchase_point_id').length>0){
		var point_id=$('#purchase_point_id').val();
	}
	else{
		var point_id='0';
	}
	
	if(name==''){
	 	myAlert('Не указано наименование торговой точки!');
		return false;
	 }
	 
	 if(address==''){
	 	myAlert('Не указан адрес торговой точки!');
		return false;
	 }
	 
	 if(telephone==''){
	 	myAlert('Не указан телефон торговой точки!');
		return false;
	 }
	 
	 if(markup<0){
	 	myAlert('Наценка торговой точки не может быть отрицательной!');
		return false;
	 }
	 
	 if(delivery_time<0){
	 	myAlert('Время доставки торговой точки не может быть отрицательной!');
		return false;
	 }
	 
	 if(manager_id==0){
	 	myAlert('Не выбран менеджер торговой точки!');
		return false;
	 }
	 
	 $.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&manager_id='+manager_id+'&purchase_point_name='+name+'&purchase_point_address='+address+'&purchase_point_telephone='+telephone+'&purchase_point_markup='+markup+'&purchase_point_delivery_time='+delivery_time+'&'+type+'=1&purchase_point_id='+point_id,
    cache: true,
	beforeSend:function(){
		$('.edit_block').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
	},
	error:function(){
		myAlert('Неизвестная ошибка!');
		$('.edit_block').html(container_edit_block);
	},
    success: function(data){
		if(data.answer==1){
			TINY.box.show({html:'Данные успешно добавлены!',animate:false,close:false,mask:false,boxid:'success',autohide:2,top:-100,left:-100});
			$('#content').html(data.content);
		}
		else{
			$('.edit_block').html(data.content);

		}	
		
	}
    });
}

function validate_edit_firm(object){
	
	var url=object.action;
	var firm_name=$('#firm_name').val();
	var inn=$('#inn').val();
	var banking_details=$('#banking_details').val();
	var main_address=$('#main_address').val();
	var main_telephone=$('#main_address').val();
	var content=$('#content').html();
	
	if(firm_name==''){
		myAlert('Поле "Наименование организации" не может быть пустым!');
		return false;
	}
	
	if(inn==''){
		myAlert('Поле "ИНН" не может быть пустым!');
		return false;
	}
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&firm_name='+firm_name+'&inn='+inn+'&banking_details='+banking_details+'&main_address='+main_address+'&main_telephone='+main_telephone+'&update=1',
    cache: true,
	beforeSend:function(){
		$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
	},
	error:function(){
		myAlert('Неизвестная ошибка!');
		$('#container').html(content);
	},
    success: function(data){
		$('#content').html(data.content);
	}
    });

}

function validate_add_client(object){
	
	url=object.action;
	var limit_credit=$('#limit_credit').val();
	var markups='';
	var client_id=$('#client_id option:selected').val();
	var container_edit_block=$('.edit_block').html();

	
	if(client_id==0){
	 	myAlert('Не выбран пользователь!');
		return false;
	 }
	
	if($('#limit_credit').val()<=0){
	 	myAlert('Лимит для кредита не может быть отрицательным или равняться нулю!');
		return false;
	 }
	 
	 for(i=0;i<distributors.length;i++){
		
		if($('#markup_'+distributors[i]).length>0){
			//markups+=distributors[i]+':'+$('#markup_'+distributors[i]).val()+',';
			if($('#markup_'+distributors[i]).val()=='' || $('#markup_'+distributors[i]).val()=='0'){
				myAlert('Одно из полей наценок пустое или равно 0!');
		 		return false;   
			}
		}
	}
	
	
	for(i=0;i<distributors.length;i++){
		
		if($('#markup_'+distributors[i]).length>0){
			markups+=distributors[i]+':'+$('#markup_'+distributors[i]).val()+',';
		}
	}
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&client_id='+client_id+'&limit_credit='+limit_credit+'&markups='+markups+'&add=1',
    cache: true,
	beforeSend:function(){
		$('.edit_block').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
	},
	error:function(){
		myAlert('Неизвестная ошибка!');
		$('.edit_block').html(container_edit_block);
	},
    success: function(data){
		TINY.box.show({html:'Данные успешно добавлены!',animate:false,close:false,mask:false,boxid:'success',autohide:2,top:-100,left:-100});
		$('#content').html(data.content);
		
	}
    });
	 

}

function validate_edit_distributor(object){
	
	var url=object.action;
	//url='http://avtospektr.vit/admin/distributors/edit?distributor_id=2';
	var name=$('#name').val();
	var site=$('#site').val();
	var address=$('#address').val();
	var telephone=$('#telephone').val();
	var email=$('#email').val();
	var period_delivery=$('#period_delivery').val();
	var add_price_default=$('#add_price_default').val();
	var id_enter=$('#id_enter').val();
	var access_login=$('#access_login').val();
	var access_password=$('#access_password').val();
	if($('#enable_discount').attr('checked')=='checked')
		var enable_discount=1;
	else
		var enable_discount=0;
	
	var buffer=period_delivery.split('/');
	if(buffer.length==0){
		myAlert('В поле "Сроки поставки" требуется разделитель / , отделяющий минимальный срок от максимального!');
		return false;
	}
	else{
		
		
		var regText = "\\D+"
		var i = buffer[0].search(new RegExp(regText, "g"));
			
		if(i!=-1){
			myAlert('В поле "Сроки поставки" один из символов не является цифрой!');
			return false;
		}
		
		var i = buffer[1].search(new RegExp(regText, "g"));

		 
		if(i!=-1){
			myAlert('В поле "Сроки поставки" один из символов равен нулю или не является цифрой!');
			return false;
		}
	}
	
	if(add_price_default<0){
		myAlert('В поле "Базовая наценка" не может быть отрицательных значений!');
		return false;
	}
	
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&name='+name+'&site='+site+'&address='+address+'&telephone='+telephone+'&email='+email+'&period_delivery='+period_delivery+'&add_price_default='+add_price_default+'&id_enter='+id_enter+'&access_login='+access_login+'&access_password='+access_password+'&update=1&enable_discount='+enable_discount,
    cache: true,
	beforeSend:function(){
		$('.edit_block').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
	},
    success: function(data){
		$('.edit_block').html(data.content);
		ajax_link('/admin/distributors');
		//TINY.box.show({html:'Данные успешно обновлены!',animate:false,close:false,mask:false,boxid:'success',autohide:2,top:-14,left:-17});
		

	}
    });
	
}

function test(){
	
	var limit_order=$('#price_group_limit_order').attr('checked');
	myAlert(limit_order);
}

function validate_add_price_group(object){
	
	url=object.action;
		var name=$('#price_group_name').val();
		var amount=$('#price_group_amount').val();
		var discount=$('#price_group_discount').val();
		var flag_insert=$('#flag_insert').val();
		if($('#price_group_limit_order').attr('checked')=='checked')
			var limit_order=1;
		else
			var limit_order=0;
		if($('#price_group_limit_store').attr('checked')=='checked')
			var limit_store=1;
		else
			var limit_store=0;
		var edit_block=$('.edit_block').html();
		
		
		if(name==''){
			myAlert('Название группы не может быть пустым!');
			$('#price_group_name').focus();
			return false;
		}
		
		if(amount<0){
			myAlert('Оборот не может быть отрицательным!');
			$('#price_group_amount').focus();
			return false;
		}
		
		if(discount<0){
			myAlert('Скидка не может быть отрицательной!');
			$('#price_group_discount').focus();
			return false;
		}
		
		if(discount>=100){
			myAlert('Скидка не может быть больше или равна 100%!');
			$('#price_group_discount').focus();
			return false;
		}
		
		$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&price_group_name='+name+'&price_group_amount='+amount+'&price_group_discount='+discount+'&flag_insert='+flag_insert+'&price_group_limit_order='+limit_order+'&price_group_limit_store='+limit_store,
    cache: false,
	beforeSend:function(){
		$('.edit_block').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
	},
	error:function(){
		$('.edit_block').html(edit_block);
		myAlert('Ошибка загрузки!');
	},
    success:function(data){
		if(data.answer==1){
			$('#content').html(data.content);	
//			TINY.box.hide();
			TINY.box.show({html:'Данные успешно добавлены!',animate:false,close:false,mask:false,boxid:'success',autohide:2,top:-100,left:-100});
		}
		else{
			$('.edit_block').html(edit_block);
			myAlert(data.error);
		}
		
	}
    });
	
}

function validate_edit_price_group(object,group_id){
	
	 	url=object.action;
		var name=$('#price_group_name').val();
		var amount=$('#price_group_amount').val();
		var discount=$('#price_group_discount').val();
		var flag_change=$('#flag_change').val();
		if($('#price_group_limit_order').attr('checked')=='checked')
			var limit_order=1;
		else
			var limit_order=0;
		if($('#price_group_limit_store').attr('checked')=='checked')
			var limit_store=1;
		else
			var limit_store=0;
		var edit_block=$('.edit_block').html();
		
		
		if(name==''){
			myAlert('Название группы не может быть пустым!');
			$('#price_group_name').focus();
			return false;
		}
		
		if(amount<0){
			myAlert('Оборот не может быть отрицательным!');
			$('#price_group_amount').focus();
			return false;
		}
		
		if(discount<0){
			myAlert('Скидка не может быть отрицательной!');
			$('#price_group_discount').focus();
			return false;
		}
		
		if(discount>=100){
			myAlert('Скидка не может быть больше или равна 100%!');
			$('#price_group_discount').focus();
			return false;
		}
		
		$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&group_id='+group_id+'&price_group_name='+name+'&price_group_amount='+amount+'&price_group_discount='+discount+'&flag_change='+flag_change+'&price_group_limit_order='+limit_order+'&price_group_limit_store='+limit_store,
    cache: false,
	beforeSend:function(){
		$('.edit_block').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
	},
	error:function(){
		$('.edit_block').html(edit_block);
		myAlert('Ошибка загрузки!');
	},
    success:function(data){
		if(data.answer==1){
			$('.edit_block').html(data.content);
			var buffer=data.row+'<td id="link_'+group_id+'">'+$('#link_'+group_id).html()+'</td>';
			$('#row_'+group_id).html(buffer);
		}
		else{
			$('.edit_block').html(edit_block);
			myAlert(data.error);
		}
		
	}
    });
		
}

function validate_password(id,answer_id,confirmation_id,answer_confirmation_id){
		 
	var text=$('#'+id).val();
	var confirmation_text=$('#'+confirmation_id).val();
	if(text==''){
		var answer='';
			
	}
	else if(text.length<4){
		var answer='<span style="color:red;" class="validate_message">Короткий пароль!</span>';
	}
	else{
		var answer='<span style="color:green;" class="validate_message">Подходящий пароль</span>';
	}
	
	if($('#message_confirmation').length>0){
		
		validate_confirmation(confirmation_id,answer_confirmation_id,id);
	}
	
	$('#'+answer_id).html(answer);
}

function validate_confirmation(id,answer_id,password_id){
	
	var text=$('#'+id).val();
	var password_text=$('#'+password_id).val();
	if(text==''){
		var answer='';
	}
	else if(text!=password_text){
		var answer='<span style="color:red;" id="message_confirmation" class="validate_message">Не совпадает!</span>';
	}
	else{
		var answer='<span style="color:green;" id="message_confirmation" class="validate_message">Совпадает</span>';
	}
	
	$('#'+answer_id).html(answer);
}


function validate_edit_employee(object,employee_id){

	 url=object.action;
	 var fio=$('#employee_fio').val();
	 var password=$('#employee_password').val();
	 var confirmation_password=$('#employee_confirmation_password').val();
	 var role_id=$('#role_id option:selected').val();
	 var address=$('#employee_address').val();
	 var telephone=$('#employee_telephone').val();
	 var email=$('#employee_email').val();
	 var container_edit_block=$('.edit_block').html();
	 
	 if(fio==''){
	 	myAlert('Поле "Фамилия" не может быть пустым!');
		return false;
	 }
	 
	 if(email==''){
	 	myAlert('Поле "E-mail" не может быть пустым!');
		return false;
	 }
	 
	 if(role_id==0){
	 	myAlert('Не выбрана группа пользователей!');
		return false;
	 }

	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&employee_id='+employee_id+'&employee_fio='+fio+'&employee_password='+password+'&employee_confirmation_password='+confirmation_password+'&role_id='+role_id+'&employee_address='+address+'&employee_telephone='+telephone+'&employee_email='+email+'&update=1',
    cache: false,
	beforeSend:function(){
		$('.edit_block').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
	},
	error:function(){
		$('.edit_block').html(container_edit_block);
		myAlert('Неизвестная ошибка');
	},
    success: function(data){
		if(data.answer==1){
			TINY.box.hide();
			$('#content').html(data.content);
		}
		else{
			$('.edit_block').html(data.content);

		}
		
			
	}
    });	
	
}

function validate_edit_client(object,client_id){

 		url=object.action;
		var edit_block=$('.edit_block').html();
		  
	  for(i=0;i<distributors.length;i++){
		
		if($('#markup_'+distributors[i]).length>0){
			if($('#markup_'+distributors[i]).val()=='' || $('#markup_'+distributors[i]).val()<0){
				myAlert('Одно из полей наценок пустое или содержит значение меньше 0!');
		 		return false;   
			}
		}
	}
	  
	 
	 if($('#limit_credit').val()<0){
	 	myAlert('Лимит для кредита не может быть отрицательным!');
		return false;
	 }
	 
	
	var limit_credit=$('#limit_credit').val();
	var markups='';
	
	for(i=0;i<distributors.length;i++){
		
		if($('#markup_'+distributors[i]).length>0){
			markups+=distributors[i]+':'+$('#markup_'+distributors[i]).val()+',';
		}
	}
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&client_id='+client_id+'&limit_credit='+limit_credit+'&markups='+markups+'&update=1',
    cache: true,
	beforeSend:function(){
		$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
	},
	error:function(){
		$('#content').html(edit_block);
		myAlert('Неизвестная ошибка!');
	},
    success: function(data){
		$('#content').html(data.content);
			
	}
    });
		
}

function search_first(url){
	
	search_code=$('#DetailNum').val();
	cash=0;
	filter=$('#filter').val();
	Sort=$('#SortType option:selected').val();
	term=$('#term option:selected').val();
	CrossType=$('#CrossType option:selected').val();
	
	if(search_code=='' || search_code=='Поиск запчастей'){
		myAlert('Поле номера запчасти пустое!');
		return false;
	}

	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&search_code='+search_code+'&sort='+Sort+'&term='+term+'&cash='+cash+'&filter='+'&CrossType='+CrossType+'&submit=1',
    cache: false,
	beforeSend:function(){
		$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
	},
    success: function(data){
		$('#content').html(data.content);	
	}
    });
	
}

function add_markup(){
	
	var markup_id=$('#last_markup').val();
	var counter_distributors=$('#counter_distributors').val();
	var height_tiny=$('#frameless').height();
		
	if(counter_distributors>0){
		
		content='<tr id="adder"><td>'+$('#missing_distributors').html()+'</td><td>'+$('#container_input_distributor').html()+'</td></tr>';
		$('#row_markup_'+markup_id).after(content);
		height_tiny+=50;
		$('#frameless').height(height_tiny);
		$('#counter_distributors').val(counter_distributors-1);
		
	}
	
}


function choice_year(url){
	
	year=$('#choice_year option:selected').val();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&year='+year,
    cache: false,
	beforeSend:function(){
		$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
		
	},
    success: function(data){
		$('#content').html(data.content);
	}
    });
}

 

function show_client_info(id){
	
	content=$('#hidden_info_'+id).html();
	width=get_resolution('width');
	width=Math.round(width/2);
	height=150;
	TINY.box.show({html:content,boxid:'frameless',width:width,height:height,animate:true,close:true});	
}

function show_sale(url,client_id,sum){
	
	var container_show_sale=$('#show_sale_'+client_id).html();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&type_option=show_sale&client_id='+client_id+'&sum_client='+sum,
    cache: true,
	beforeSend:function(){
		$('#show_sale_'+client_id).css({'text-decoration':'none'});
		$('#show_sale_'+client_id).html('<span>Подождите секунду...&nbsp;&nbsp;<img src="/images/avtospektr/ajax-loaders/menu.gif"></span>');

	},
	error:function(){
		$('#show_sale_'+client_id).css({'text-decoration':'underline'});
		$('#show_sale_'+client_id).html(container_show_sale);
		myAlert('Ошибка подгрузки!');
	},
    success: function(data){
		$('#show_sale_'+client_id).html('<span>Открыть</span>');
		$('#show_sale_'+client_id).css({'text-decoration':'underline'});

		width=get_resolution('width');
		width=Math.round(width/2);
		height=(data.num_items*25)+100;
		TINY.box.show({html:data.content,boxid:'frameless',width:width,height:height,animate:true,close:true});	
	}
    });
}

function load_list_parts(id,url){

//alert(url)

	if($('#flag_admin').length>0){
		var flag_admin=1;
	}
	else{
		var flag_admin=0;

	}
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&for_sales=1&sale_id='+id+'&flag_admin='+flag_admin,
    cache: true,
	beforeSend:function(){
		$('#list_'+id).css({'text-decoration':'none'});
		$('#list_'+id).html('<span>Подождите секунду...&nbsp;&nbsp;<img src="/images/avtospektr/ajax-loaders/menu.gif" style="margin-bottom:-3px;"></span>');
	

	},
    success: function(data){
		$('#list_'+id).css({'text-decoration':'underline'});
		if(flag_admin==1){
			$('#list_'+id).text('Показать');
		}
		else{
			$('#list_'+id).text('Смотреть');

		}
		
		width=get_resolution('width');
		width=Math.round(width/2);
		height=(data.num_items*25)+100;
		//alert(height)
		TINY.box.show({html:data.content,boxid:'frameless',width:width,height:height,animate:true,close:true});	
	}
    });
	
}


////////////////////////////////////////// Очищаем номер от разделителей,если включен флаг "без разделителей"

function clean_number(number){
	
	number=str_replace(' ','',number);
	number=str_replace('.','',number);
	
	return number;
}

function check_turner(id){
	
	if($('#'+id).val()=='On'){
		$('#'+id).val('Off');
	}
	else{
		$('#'+id).val('On');

	}
}

function filter_payments(type,url){

	var date1=$('#formDate1').val();
	var date2=$('#formDate2').val();
	var type_payments=$('#type_payments option:selected').val();
	var type_operation=$('#type_operation option:selected').val();
	
	if(type=='admin'){
			
		if($('#client').tagName=='input'){
			var client=$('#client').val();
			var client_id='';
		}
		else{
			var client='';
			var client_id=$('#client option:selected').val();
		}
		
	}
	else{
		var client='';
		var client_id='';
	}
	
	if(client_id=='0'){
		client_id='';
	}
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&date1='+date1+'&date2='+date2+'&type_payment='+type_payments+'&type_operation='+type_operation+'&flag_filter='+flag_filter+'&client='+client+'&client_id='+client_id,
    cache: false,
	beforeSend:function(){
	$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
	},
    success: function(data){
	resize_content();
	$('#content').html(data.content);
	
	}
    });
	 
}


function filter_orders(type,url){

	var date1=$('#formDate1').val();
	var date2=$('#formDate2').val();
	var number=$('#input_number').val();
	var manufacturer=$('#manufacturer_number').val();
	var description=$('#description').val();
	var flag_filter=$('#flag_filter').val();
	var without_dividers=$('#without_dividers').val();
	
	if($('#status_id').length>0)
		var status_id=$('#status_id option:selected').val();
	else
		var status_id='';
	
	if(type=='admin'){
		
		
		if($('#client').tagName=='input'){
			var client=$('#client').val();
			var client_id='';
		}
		else{
			var client='';
			var client_id=$('#client option:selected').val();
		}
		
		var distributor_id=$('#distributor').val();

	
	}
	else{
		var client='';
		var client_id='';
		var distributor_id='0';
	}
	
	if(without_dividers=='On'){
		number=clean_number(number);
	}
	
	if(client_id=='0'){
		client_id='';
	}
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&date1='+date1+'&date2='+date2+'&number='+number+'&manufacturer='+manufacturer+'&description='+description+'&flag_filter='+flag_filter+'&without_dividers='+without_dividers+'&client='+client+'&distributor_id='+distributor_id+'&client_id='+client_id+'&status_id='+status_id,
    cache: false,
	beforeSend:function(){
	
		$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');

	},
    success: function(data){
		resize_content();
		$('#content').html(data.content);
	
	}
    });
}

function filter_vin(type,url){
	

	var date1=$('#formDate1').val();
	var date2=$('#formDate2').val();
	
	var brand=$('#brands option:selected').val();
	var year=$('#year option:selected').val();
	var model=$('#model').val();
	var necessary_parts=$('#necessary_parts').val();
	var number_vin=$('#number_vin').val();

	
	if(type=='admin'){
		var client_id=$('#client_id option:selected').val();
	}
	else{
		var client_id='';
		
	}
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&date1='+date1+'&date2='+date2+'&brand='+brand+'&year='+year+'&model='+model+'&flag_filter=1&necessary_parts='+necessary_parts+'&client_id='+client_id+'&number_vin='+number_vin,
    cache: false,
	beforeSend:function(){
	$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
	},
    success: function(data){
	resize_content();
	$('#content').html(data.content);
	}
    });
}

function filter(type,url){
	
	switch(type){
		
		case 'client_orders':
		filter_orders('client',url);
		break;
		case 'admin_orders':
		filter_orders('admin',url);
		break;
		case 'client_payments':
		filter_payments('client',url);
		break;
		case 'admin_payments':
		filter_payments('admin',url);
		break;
		case 'client_vin':
		filter_vin('client',url);
		break;
		case 'admin_vin':
		filter_vin('admin',url);
		break;
	}
}

function view_profile_password(){
	
	
	if($('#container_profile_password').css('display')=='none'){
	
		$('#container_profile_password').show('normal');
		$('#profile_password').html('Скрыть блок пароля');

	}
	else{
		$('#container_profile_password').hide('normal');
		$('#profile_password').html('Сменить пароль');

	}
	
}




function view_filter(){
	
	
	if($('#container_filter').css('display')=='none'){
	
		$('#container_filter').show('slow');
		$('#turner_filter a').html('Скрыть фильтр &raquo;');
	}
	else{
		$('#container_filter').hide('slow');
		$('#turner_filter a').html('Показать фильтр &raquo;');
	
	}
	
}

function reset_filter(type,page){
	
	if(type=='all'){
		$('#formDate1').val('00.00.0000');
		$('#formDate2').val('00.00.0000');
		
		if(page=='orders'){
			$('#input_number').val('');
			$('#manufacturer_number').val('');
			$('#description').val('');
		}
		else if(page=='payments'){
			$('#type_payments').val('0')
			$('#type_operation').val('all');
		}
		
	}
	else if(type=='date'){
		
		$('#formDate1').val('00.00.0000');
		$('#formDate2').val('00.00.0000');
	}
	
	if($('#distributor').length>0){
		$('#distributor').val('all');
	}
	
	if($('#client').length>0){
		$('#client').val('');
	}
}
	

function reset_filter_vin(type,page){
	
	if(type=='all'){
		$('#formDate1').val('00.00.0000');
		$('#formDate2').val('00.00.0000');
		
		if(page=='orders'){
			$('#input_number').val('');
			$('#manufacturer_number').val('');
			$('#description').val('');
		}
		else if(page=='payments'){
			$('#type_payments').val('0')
			$('#type_operation').val('all');
		}
		
	}
	else if(type=='date'){
		
		$('#formDate1').val('00.00.0000');
		$('#formDate2').val('00.00.0000');
	}
	
	if($('#distributor').length>0){
		$('#distributor').val('all');
	}
	
	if($('#client').length>0){
		$('#client').val('');
	}
}

function check_childs_visibility(id,type){

	
if(type=='menu_catalog')	{
	inner_items=items;
}
else if(type=='client'){
	inner_items=client_items;	
}
else if(type=='admin'){
	inner_items=admin_items;	
}
if(inner_items[id]!=null){
	

first_item=inner_items[id][0];

	


if($('#'+type+' #menu_'+first_item).length>0){
	
if($('#'+type+' #menu_'+first_item).css('display')!='none' || current_controller_id==id){

	return false;
	
}	
}	
}
	return true;
	
}

function change_annotation(){
	
	type_operation=$('#type_operation_payment option:selected').val();
	
	if(type_operation=='add'){
		$('#annotation').text('Оплата');
	}
	else{
		$('#annotation').text('Списание');

	}
}

function set_cars(url,article_id){
	
	var content=$('#content').html();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&article_id='+article_id,
    cache: false,
	beforeSend:function(){
		$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');	
	},
	error: function(){
		$('#content').html(content);
		myAlert('Ошибка загрузки!');
	},
    success: function(data){
		if(data.answer==1){
				$('#content').html(data.content);
				TINY.box.hide();
		}
		else{
			$('#content').html(content);
			myAlert('Ошибка загрузки!');
		}
	}
    });
}

function set_point_menu(url,id){
	
	var point_menu=$('#user_menu option:selected').val();
	var content=$('#content').html();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&point_menu='+point_menu+'&article_id='+id,
    cache: false,
	beforeSend:function(){
		$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');	
	},
	error: function(){
		$('#content').html(content);
		myAlert('Ошибка загрузки!');
	},
    success: function(data){
	
		if(data.answer==1){
			if(data.auto==0){
				$('#content').html(data.content);
			}
			else{
				$('#content').html(content);
				TINY.box.show({html:data.content,boxid:'frameless',animate:true,close:true});		

			}


		}
		else{
			$('#content').html(content);
			myAlert('Ошибка загрузки!');
		}
	}
    });

}

function add_payment(){

	client_id=$('#client_id option:selected').val();
	type_operation=$('#type_operation_payment option:selected').val();
	type_payment=$('#type_payment option:selected').val();
	sum=$('#sum').val();
	annotation=$('#annotation').val();
	date=$('#formDate').val();
	url=$('#payment_form').attr('action');
	
	if(client_id==0){
		myAlert('Для совершения платежа необходимо указать клиента!');
		return false;
	}
	
	if(sum==0){
		myAlert('Сумма должна отличаться от ноля!');
		return false;
	}
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&client_id='+client_id+'&sum='+sum+'&add_payment=1'+'&type_operation='+type_operation+'&type_payment='+type_payment+'&date='+date+'&annotation='+annotation,
    cache: false,
	beforeSend:function(){
		$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
		
	},
    success: function(data){
		ReportWindow=window.open(data.address);
		$('#content').html(data.content);
	}
    });

	
}






function show_client_balance(url){
	
	client_id=$('#client_id option:selected').val();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&client_id='+client_id,
    cache: false,
	beforeSend:function(){
		$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
		
	},
    success: function(data){
		$('#content').html(data.content);
	}
    });
	

}

function set_page_size(object,url){
	
	id=object.id;
	
	if(id.indexOf('up')!=-1){
		pager_place='up';
	}
	else{
		pager_place='down';
	}
		page_size=$('#num_pages_'+pager_place+' option:selected').val();

	
	$.ajax({
	type: "POST",
    url: '/options/pagesize',
	dataType: 'json',
	data: 'type=ajax&page_size='+page_size,
    cache: false,
	beforeSend:function(){
		$('#num_pages_container_'+pager_place).html('<span>Подождите секунду...&nbsp;&nbsp;<img src="/images/avtospektr/ajax-loaders/menu.gif" style="margin-bottom:-3px;"></span>');
		
	},
    success: function(data){
		
		if(data.answer=='true'){
			ajax_link(url);
		}
	}
    });
	
}

function paginate_link_vin(object,type,is_filter){
	
	url=object.href;

	var date1=$('#formDate1').val();
	var date2=$('#formDate2').val();
	
	var flag_filter=$('#flag_filter').val();
	
	var brand=$('#brands option:selected').val();
	var year=$('#year option:selected').val();
	var model=$('#model').val();
	var necessary_parts=$('#necessary_parts').val();
	var number_vin=$('#number_vin').val();
	
	if(type=='admin'){
		
	}
	else{
		var client_id='';
		
	}
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&date1='+date1+'&date2='+date2+'&brand='+brand+'&year='+year+'&model='+model+'&flag_filter='+flag_filter+'&necessary_parts='+necessary_parts+'&client_id='+client_id+'&number_vin='+number_vin,
    cache: false,
	beforeSend:function(){
	$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
	},
    success: function(data){
	resize_content();
	$('#content').html(data.content);
	}
    });
}

function paginate_link(object,type,is_filter){
	
	
	url=object.href;
	
	var date1=$('#formDate1').val();
	var date2=$('#formDate2').val();
	
	var flag_filter=$('#flag_filter').val();
	
	if(url.indexOf('orders')!=-1){
		var number=$('#input_number').val();
		var manufacturer=$('#manufacturer_number').val();
		var description=$('#description').val();
		var without_dividers=$('#without_dividers').val();
		var type_payments='';
		var type_operation='';

	}
	else{
		var number='';
		var manufacturer='';
		var description='';
		var without_dividers='';
		var type_payments=$('#type_payments option:selected').val();
		var type_operation=$('#type_operation option:selected').val();
	}
	
	if(type=='admin'){
		
		
		if($('#client').tagName=='input'){
			var client=$('#client').val();
			var client_id='';
		}
		else{
			var client='';
			var client_id=$('#client option:selected').val();
		}
		
		
		if(url.indexOf('orders')!=-1){
			var distributor_id=$('#distributor').val();
		}
		else{
			var distributor_id='';
		}
	
	}
	else{
		var client='';
		var client_id='';
		var distributor_id='0';
	}
	
	if(without_dividers=='On'){
		number=clean_number(number);
	}
	
	if(client_id=='0'){
		client_id='';
	}
	
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&date1='+date1+'&date2='+date2+'&number='+number+'&manufacturer='+manufacturer+'&description='+description+'&flag_filter='+flag_filter+'&without_dividers='+without_dividers+'&client='+client+'&distributor_id='+distributor_id+'&client_id='+client_id+'&type_operation='+type_operation+'&type_payment='+type_payments,
    cache: false,
	beforeSend:function(){
	$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
	},
    success: function(data){
	resize_content();

	$('#content').html(data.content);
	}
    });
}



function show_article(url,id){

	var container_article=$('#article_'+id).html();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax',
    cache: false,
	beforeSend:function(){
		$('#article_'+id).html('<div><img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');		
		
	},
    success: function(data){
			
		$('#article_'+id).html(container_article);		
		content='<div class="container_tiny">'+data.content+'</div>';
		TINY.box.show({html:content,boxid:'frameless',animate:true,close:true});		
	}
    });
	
}

function show_table_discounts(url){
	
	var table_discounts=$('#link_table_discounts').html();
		
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax',
    cache: false,
	beforeSend:function(){
		$('#link_table_discounts').html('<div><img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');		
		
	},
	error:function(){
		myAlert('Неизвестная ошибка');
		$('#link_table_discounts').html(table_discounts);		
		
	},   
	 success: function(data){
			
		$('#link_table_discounts').html(table_discounts);		
		content='<div class="container_tiny">'+data.content+'</div>';
		TINY.box.show({html:content,boxid:'frameless',animate:true,close:true});		
	}
    });
}

function add_price_group(object){
	
	url=object.href;
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax',
    cache: false,
	beforeSend:function(){
		//$('#link_'+id).html('<div><img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');		
		
	},
    success: function(data){
			
		content='<div class="container_tiny">'+data.content+'</div>';
		TINY.box.show({html:content,boxid:'frameless',animate:true,close:true});		
	}
    });

}

function edit_purchase_point(url,id){
	
	//var url=object.href;
	var container_edit_link=$('#link_edit_'+id).html();
//	myAlert(url);
//	return false;
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax',
    cache: false,
	beforeSend:function(){
		$('#link_edit_'+id).html('<div><img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');		
		
	},
	error:function(){
		$('#link_edit_'+id).html(container_edit_link);
		myAlert('Неизвестная ошибка!');
	},
    success: function(data){
		$('#link_edit_'+id).html(container_edit_link);
		var content='<div class="container_tiny">'+data.content+'</div>';
		TINY.box.show({html:content,boxid:'frameless',animate:true,close:true});		
	}
    });
}

function add_purchase_point(object){
	
	var url=object.href;
	
	var container_add_purchase_point=$('#link_add_purchase_point').html();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax',
    cache: false,
	beforeSend:function(){
		$('#link_add_purchase_point').html('<div><img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');		
		
	},
	error:function(){
		$('#link_add_purchase_point').html(container_add_purchase_point);
		myAlert('Неизвестная ошибка!');
	},
    success: function(data){
		$('#link_add_purchase_point').html(container_add_purchase_point);
		var content='<div class="container_tiny">'+data.content+'</div>';
		TINY.box.show({html:content,boxid:'frameless',animate:true,close:true});		
	}
    });
}

function add_employee(object){
	
	var url=object.href;
	
	var container_add_employee=$('#link_add_employee').html();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax',
    cache: false,
	beforeSend:function(){
		$('#link_add_employee').html('<div><img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');		
		
	},
	error:function(){
		$('#link_add_employee').html(container_add_employee);
		myAlert('Неизвестная ошибка!');
	},
    success: function(data){
		$('#link_add_employee').html(container_add_employee);
		var content='<div class="container_tiny">'+data.content+'</div>';
		TINY.box.show({html:content,boxid:'frameless',animate:true,close:true});		
	}
    });
	
}


function add_client(object){
	
	var url=object.href;
	var container_link=$('.add_client').html();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax',
    cache: false,
	beforeSend:function(){
		$('.add_client').html('<div><img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');		
		
	},
	error: function(){
		$('.add_client').html(container_link);		
		myAlert('Неизвестная ошибка!');
	},
    success: function(data){
		var content='<div class="container_tiny">'+data.content+'</div>';	
		$('.add_client').html(container_link);		
		TINY.box.show({html:content,boxid:'frameless',animate:true,close:true});		
	}
    });

}

function edit_distributor(object,id){
	
	url=object.href;
	link_content=$('#link_'+id).html();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&distributor_id='+id,
    cache: false,
	beforeSend:function(){
		$('#link_'+id).html('<div><img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');		
		
	},
    success: function(data){
			
		$('#link_'+id).html(link_content);		

		content='<div class="container_tiny">'+data.content+'</div>';
		TINY.box.show({html:content,boxid:'frameless',animate:true,close:true});		
	}
    });
}

function edit_price_group(object,id){
	
	var url=object.href;
	var link_content=$('#link_'+id).html();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&price_group_id='+id,
    cache: false,
	beforeSend:function(){
		$('#link_'+id).html('<div><img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');			
	},
	error: function(){
		$('#link_'+id).html(link_content);		
		myAlert('Неизвестная ошибка!');
	},
    success: function(data){
			
		$('#link_'+id).html(link_content);		
		content='<div class="container_tiny">'+data.content+'</div>';
		TINY.box.show({html:content,boxid:'frameless',animate:true,close:true});		
	}
    });
	
}

function edit_employee(object,id){
	
	var url=object.href;
	var link_content=$('#link_'+id).html();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax',
    cache: false,
	beforeSend:function(){
		$('#link_'+id).html('<div><img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');			
	},
	error: function(){
		$('#link_'+id).html(link_content);		
		myAlert('Неизвестная ошибка!');
	},
    success: function(data){
			
		$('#link_'+id).html(link_content);		
		content='<div class="container_tiny">'+data.content+'</div>';
		TINY.box.show({html:content,boxid:'frameless',animate:true,close:true});		
	}
    });
	
}

function edit_client(object,id){
	
	var url=object.href;
	var link_content=$('#link_'+id).html();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&client_id='+id,
    cache: false,
	beforeSend:function(){
		$('#link_'+id).html('<div><img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');			
	},
	error: function(){
		$('#link_'+id).html(link_content);		
		myAlert('Неизвестная ошибка!');
	},
    success: function(data){
			
		$('#link_'+id).html(link_content);		
		content='<div class="container_tiny">'+data.content+'</div>';
		TINY.box.show({html:content,boxid:'frameless',animate:true,close:true});		
	}
    });
	
}

function link_to(object){
	
	url=object.href;
	ajax_link(url);
}

function to_work(url,id,redirect_url){
	
	if($('#dist_ord_id').val()==''){
		myAlert('Заполните id заказа!');
		$('#dist_ord_id').focus();
		return false;
	}	
	var dist_ord_id=$('#dist_ord_id').val();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&type_option=start_order&order_id='+id+'&dist_ord_id='+dist_ord_id,
    cache: false,
	beforeSend:function(){
		$('#popup_ajax_loader').html('<div><span>Идет загрузка...<img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');		
		
	},
    success: function(data){
		
		TINY.box.hide();
		$('#container_status_'+id).html(data.status);
		$('#order_id_'+id).html(data.order);
		$('#row_'+id).css({'background':data.color});
		$('#data_order_'+id).html(data.modified);
			
	}
    });
	
}

function deactivate_purchase_point(url,id){
	
	var conatainer_deactivate_link=$('#deactivate_link_'+id).html();
	jConfirm('Вы уверены, что хотите деактивировать данную точку?','Магазин "Автоспектр"',function(r){
		
	if(r==true){
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax',
    cache: false,
	beforeSend:function(){
		$('#deactivate_link_'+id).html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');
		
	},
	error: function(){
		myAlert('Неизвестная ошибка!');
		$('#deactivate_link_'+id).html(conatainer_deactivate_link);
	},
    success: function(data){
	
		$('#deactivate_link_'+id).html(conatainer_deactivate_link);
		if(data.answer==1){
			$('#row_'+id).remove();
			
		}
		else{
			myAlert('Не удалось деактивировать торговую точку');
		}
		
	}
    });
		
	}
	}
	);
}

function delete_content(url,id){
	
	
	jConfirm('Вы уверены, что хотите удалить данный материал?','Магазин "Автоспектр"',function(r){
		
	if(r==true){
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax',
    cache: false,
	beforeSend:function(){
		//$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
		
	},
	error: function(){
		myAlert('Неизвестная ошибка!');
	},
    success: function(data){
	
		if(data.answer==1){
			$('#row_'+id).remove();
		}
		
	}
    });
		
	}
	}
	);
}

function delete_order(object,order_id,url_redirect){
	
	
	jConfirm('Вы уверены, что хотите удалить заказ №'+order_id+'?','Магазин "Автоспектр"',function(r){
		
	if(r==true){
		url=object.href;
		
		
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&order_id='+order_id,
    cache: false,
	beforeSend:function(){
		//$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');
		
	},
    success: function(data){
		//$('#content').html(data.content);
			//$.scrollTo('#content',1000);
		ajax_link(url_redirect);
	
	}
    });
		
	}
	}
	);
	
}

function change_status(id,type,path,distributor){

	
	var status=$('#status_'+id+' option:selected').val();
	
	var content_status=$('#container_status_'+id).html();
	var url=path+type+'/option/set';
    
	if(status==11 || status==2){
		
        
		if(status==11)
			var message='Отправить заказ на выдачу?';
		else
			var message='Пустить заказ в работу?';
		
		jConfirm(message,'Магазин "Автоспектр"',function(r){
		
        
		if(r==true){
			call_change_status(id,status,url);
			
		}
		else{
			$('#status_'+id).val($('#current_status').val());
		}
		
		}
		);
	}
	else{
		
		call_change_status(id,status,url);
		
	}
	
}

function call_change_status(id,status,url){

	if(status==2)
		var type_option='start_order';
	else
		var type_option='change_status';
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&type_option='+type_option+'&order_id='+id+'&status='+status,
    cache: false,
	beforeSend:function(){
		
		if(status==11){
			$('#container_status_'+id).html('<div><span>Идет загрузка...<img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');	
		}
			
	},
    success: function(data){
		
		if(status==11){
			myAlert('Заказ №'+id+' перемещен в раздел "Выдача товара"!');
			$('#row_'+id).remove();
		}
		else{
			if(data.answer==1){
				$('#row_'+id).css({'background':'#'+status_colors[status]});
				$('#status_'+id).css({'background':'#'+status_colors[status]});
				$('#data_order_'+id).html(data.modified);
			}
			else if(data.answer==2){
				$('#container_status_'+id).html(data.status);
				$('#order_id_'+id).html(data.order);
				$('#row_'+id).css({'background':data.color});
				$('#data_order_'+id).html(data.modified);
			}
			else{
				myAlert('Ошибка смены статуса!');
			}
			
			
		}
			
	}
    });
}


function cut_text(object){

	document.getElementById(object).value='';

} 

function ajax_link_autoparts(url){

	var karkas=$('.karkas').html();

	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax',
    cache: false,
	beforeSend:function(){
		$('.karkas').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');	
	},
	error: function(){
		$('.karkas').html(karkas);
		myAlert('Ошибка загрузки!');
	},
    success: function(data){
		if(data.layout=='content'){
			$('.karkas').html(karkas);
			$('#content').html(data.content);
		}
		else if(data.layout=='karkas'){
			$('.karkas').html(data.content);
		}
	}
    });
	
}

function user_menu(main_url){

	var point=$('#user_menu option:selected').val();
	
	if(point=='main'){
		var url=main_url;
	}
	else{
		var url=main_url+'site/'+point;
	}
	document.location.href = url;

}

function ajax_link(url){

	var content=$('#content').html();
	var layout=$('#layout').val();
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax',
    cache: false,
	beforeSend:function(){
		$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');	
	},
	error: function(){
		$('#content').html(content);
		myAlert('Ошибка загрузки!');
	},
    success: function(data){
		if(url.indexOf('user/logout')!=-1 && layout=='autoparts')
			document.location.href=$('#link_logo').attr('href');
		else
			$('#content').html(data.content);
		if(typeof(data.title) != 'undefined')
			document.title = data.title;
			if(supportsHistoryAPI == true){
				history.pushState(null,document.title,document.location.href);
				history.replaceState(null,null,url);
			}
			
	}
    });
	
}

function navigation(url){
	
	var content=$('#content').html();
	var layout=$('#layout').val();
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax',
    cache: false,
	beforeSend:function(){
		$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');	
	},
	error: function(){
		$('#content').html(content);
		myAlert('Ошибка загрузки!');
	},
    success: function(data){
		if(url.indexOf('user/logout')!=-1 && layout=='autoparts')
			document.location.href=$('#link_logo').attr('href');
		else
			$('#content').html(data.content);
		if(typeof(data.title) != 'undefined')
			document.title = data.title;
		
	}
    });
}

function ajax_link_order(url){

	var content=$('#content').html();
	var layout=$('#layout').val();
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax',
    cache: false,
	beforeSend:function(){
		$('#content').html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/content.gif"></div>');	
	},
	error: function(){
		$('#content').html(content);
		myAlert('Ошибка загрузки!');
	},
    success: function(data){
		$('#content').html(data.content);
		$('#client_2').html(data.num);
		show_document(data.document_link);
		if(typeof(data.title) != 'undefined')
			document.title = data.title;
		
	}
    });
	
}

function add_to_basket(url,id){
	
	var container_basket=$('#basket_'+id).html();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax',
    cache: false,
	beforeSend:function(){
		$('#basket_'+id).html('<div style="padding-left:7px;"><img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');	
	},
	error:function(){
		$('#basket_'+id).html(container_basket);	
		myAlert('Ошибка подгрузки!');
	},
    success: function(data){
		$('#basket_'+id).html(container_basket);
		if(data.answer==1){
			$('.menu_cart').html(data.content);
		}
	}
    });
}


function get_content(object,type){
	
	url=object.href;	
	buffer=object.id.split('_');
	check=check_childs_visibility(buffer[1],type);
		
	if(check==true){
		
	ajax_link(url);
	
	}
	
	submenu(object,type);

}


function logout(){
	
	$.ajax({
	type: "POST",
    url: '/user/logout',
	data:'type=ajax',
	dataType: 'json',
    cache: false,
    success: function(data){
	
	if(data.answer==1){
		$('#authorization').html(data.content);
		$('#menu_authorization').css({'margin-bottom':'10px'});
		
		$.post("/", {type: "ajax"}, function(data){
  			$('#content').html(data.content);
		},'json');
		resize_content();
	}
	
	}
    });
	
	
}




function login(){
	
	
	if($('#login').val()==''){
		myAlert('Поле <<Логин>> не может быть пустым!');
		return false;
	}
	
	if($('#password').val()==''){
		myAlert('Поле <<Пароль>> не может быть пустым!');
		return false;
	}
	
	 $.ajax({
	type: "POST",
    url: '/user/login',
	dataType: 'json',
	data:'login='+$('#login').val()+'&password='+$('#password').val()+'&type=ajax',
    cache: false,
    success: function(data){
	if(data.answer==0){
		$("#authorization").html(data.content);
		
		$('#menu_authorization').css({'margin-bottom':'0px'});
		resize_content();
		
	}
	else if(data.answer==1){
		myAlert('Пользователя с таким логином нет!');
		return false;
	}
	else if(data.answer==2){
		myAlert('Неправильный пароль!');
		return false;
	}
	
	else{
		myAlert('Неизвестная ошибка авторизации!');
		return false;
	}
    }
    });

}

function resize_content(){

/*
	
	var sidebar_height = $('#sidebar').height();
		
		sidebar_height = (sidebar_height*1) - 14;
		
		$('#content_substrate').css({'min-height':sidebar_height});
		
		
		container_height=$('#header').height()+$('#firms').height()+$('#nav_bar').height()+$('.main_container').height()+22;
	
		$('.left_green').css({'height':container_height});
		$('.right_green').css({'height':container_height});
	*/	
	
}


function operation_branch(type,id,event){


	
	if(event=='beforeSend'){
		$('#'+type+' #menu-name_'+id).css({'display':'none'});
		$('#'+type+' #menu-img_'+id).css({'display':'none'});
		
		if(type!='menu_catalog'){
			$('#'+type+' #menu-icon_'+id).css({'display':'none'});

		}
		$('#'+type+' #before-menu-name_'+id).css({'display':'table-cell'});
		$('#'+type+' #before-menu-img_'+id).css({'display':'table-cell'});
	}
	else{
		
		$('#'+type+' #menu-name_'+id).css({'display':'table-cell'});
		$('#'+type+' #menu-img_'+id).css({'display':'table-cell'});
		
		if(type!='menu_catalog'){
			$('#'+type+' #menu-icon_'+id).css({'display':'table-cell'});

		}
		$('#'+type+' #before-menu-name_'+id).css({'display':'none'});
		$('#'+type+' #before-menu-img_'+id).css({'display':'none'});
	}
	
}

function remove_element_pricing(object){
	
	var buffer_id=object.id;
	var distributor_id=$('#distributor_id').val();
	var client_id=$('#client_id').val();
	if(object.className=='edit_pricing'){
		var buffer = buffer_id.split('_');
		var id = buffer[3];
		var container_link=$('#link_pricing_edit_'+id).html();
		var url=object.href;
		
	jConfirm('Вы уверены, что хотите удалить данную наценку?','Магазин "Автоспектр"',function(r){
		
	if(r==true){
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax&distributor_id='+distributor_id+'&client_id='+client_id,
    cache: false,
	beforeSend:function(){
		$('#link_pricing_edit_'+id).html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');
		
	},
	error: function(){
		myAlert('Неизвестная ошибка!');
		$('#link_pricing_edit_'+id).html(container_link);
	},
    success: function(data){
	
		if(data.answer==1){
			
			$('.tcontent #price_point_edit_'+id).remove();
			var last_element=$('.tcontent #submit_pricing').prev();
			var pricing=$('#frameless').height();
			var new_height=(pricing-last_element.height())-2;
			$('#frameless').height(new_height);	
			$('#block_link_'+distributor_id).html(data.link_content);
			$('#block_link_'+distributor_id+' .link_info').tipTip({content:data.markups_title});

			
		}
		else{
			myAlert('Неизвестная ошибка');
			$('#link_pricing_edit_'+id).html(container_link);

		}
		
	}
    });
		
	}
	}
	);
		
	}
	else{
		var buffer = buffer_id.split('_');
		var id = buffer[2];
		$('.tcontent #price_point_'+id).remove();
		var last_element=$('.tcontent #submit_pricing').prev();
		var pricing=$('#frameless').height();
		var new_height=(pricing-last_element.height())-2;
		$('#frameless').height(new_height);

	}
	
}

function remove_element(object){
	
	var buffer_id=object.id;
		var buffer = buffer_id.split('_');
		var id = buffer[2];
		$('.tcontent #row_point_'+id).remove();
		var last_element=$('.tcontent #submit_add_point').prev();
		var add_point_catalog=$('#frameless').height();
		var new_height=(add_point_catalog-last_element.height())-10;
		$('#frameless').height(new_height);
	
	
}

function add_element_pricing(){
	
	var last_element=$('.tcontent #submit_pricing').prev();
	var last_id=last_element.attr('id');
	var buffer = last_id.split('_');
	var new_id=(buffer[2]*1)+1;
	var add_point_catalog=$('#frameless').height();
	var new_height=add_point_catalog+last_element.height()+2;
	var content='<tr id="price_point_'+new_id+'">';
	content+='<td nowrap="">Ценовой предел:</td>';
	content+='<td><input type="text" id="price_name_'+new_id+'" name="price_name_'+new_id+'" class="pricing"></td>';
	content+='<td>Наценка:</td><td><input type="text" id="markup_name_'+new_id+'" name="markup_name_'+new_id+'" class="pricing"></td>';
	content+='<td><a href="#add_point_catalog" onclick="add_element_pricing();return false;" title="Добавить пункт" style="margin-left:5px;">';
	content+='<img src="/images/avtospektr/add.png"/></a></td>';
	content+='<td><a href="#add_point_catalog" onclick="remove_element_pricing(this);return false;" title="Удалить пункт" style="margin-left:5px;" id="link_pricing_'+new_id+'">';
	content+='<img src="/images/avtospektr/icon_delete.png"/></a></td></tr>';
	$('#frameless').height(new_height);
	$('.tcontent #submit_pricing').before(content);
}

function add_element(){

	var last_element=$('.tcontent #submit_add_point').prev();
	var last_id=last_element.attr('id');
	var buffer = last_id.split('_');
	var new_id=(buffer[2]*1)+1;
	var add_point_catalog=$('#frameless').height();
	var new_height=add_point_catalog+last_element.height()+10;
	var content='<div style="margin-top:10px;" id="row_point_'+new_id+'">Название пункта:&nbsp;';
	content+='<span style="margin-left:5px;"><input type="text" id="point_name_'+new_id+'" name="point_name_'+new_id+'" class="add_point">';
	content+='<a href="#add_point_catalog" onclick="add_element();return false;" title="Добавить пункт" style="margin-left:10px;">';
	content+='<img src="/images/avtospektr/add.png"/></a>';
	content+='<a href="#add_point_catalog" onclick="remove_element(this);return false;" title="Удалить пункт" style="margin-left:10px;" id="link_point_'+new_id+'">';
	content+='<img src="/images/avtospektr/icon_delete.png"/></a>';
	content+='</span></div>';
	$('#frameless').height(new_height);
	$('.tcontent #submit_add_point').before(content);
		
}

function remove_point(url,id){
	
	var container_link=$('#a_'+id).html();
	jConfirm('Вы уверены, что хотите удалить пункт "'+container_link+'"?','Магазин "Автоспектр"',function(r){
		
	if(r==true){
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data: 'type=ajax',
    cache: false,
	beforeSend:function(){
		$('#a_'+id).html('<div class="ajax_loader"><img src="/images/avtospektr/ajax-loaders/menu.gif"></div>');
		
	},
	error: function(){
		myAlert('Неизвестная ошибка!');
		$('#a_'+id).html(container_link);
	},
    success: function(data){
	
		$('#a_'+id).html(container_link);
		if(data.answer==1){
			
			if(data.recursive==1)
				document.location.href=data.url;
			else
				$('#menu_'+id).remove();
			
		}
		else{
			myAlert('Неизвестная ошибка');
		}
		
	}
    });
		
	}
	}
	);
}

function modal_edit_point_catalog(url,id){
	
	var container_link=$('#menu-img_'+id).html();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data:'&type=ajax',
    cache: false,
	beforeSend:function(){
		$('#menu-img_'+id).html('<img src="/images/avtospektr/ajax-loaders/menu.gif">');
	},
	error:function(){
		$('#menu-img_'+id).html(container_link);
		myAlert('Неизвестная ошибка!');
	},
    success: function(data){
		$('#menu-img_'+id).html(container_link);	
		$('#edit_point_catalog h3').html(data.header);
		var point_name='<input type="text" id="point_name" name="point_name" class="add_point" value="'+data.name+'">';
		$('#container_point_name').html(point_name);
//		myAlert(data.name);
		$('#item_id').val(id);
		var container_add_point=$('#container_edit_point_catalog').html();
		TINY.box.show({html:container_add_point,boxid:'frameless',animate:true,close:true});
		$('.tcontent #edit_point_catalog #point_name').html(data.name);

    }
    });
}

function modal_add_point_catalog(url,id,parent_id,level){
	
	if(id!=0)
		var container_link=$('#menu-img_'+id).html();
	else
		var container_link=$('.add_client').html();
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data:'&type=ajax&parent_id='+parent_id,
    cache: false,
	beforeSend:function(){
		if(id!=0)
			$('#menu-img_'+id).html('<img src="/images/avtospektr/ajax-loaders/menu.gif">');
		else
			$('.add_client').html('<img src="/images/avtospektr/ajax-loaders/menu.gif">');
	},
	error:function(){
		if(id!=0)
			$('#menu-img_'+id).html(container_link);
		else
			$('.add_client').html(container_link);
		myAlert('Неизвестная ошибка!');
	},
    success: function(data){
		if(id!=0)
			$('#menu-img_'+id).html(container_link);
		else
			$('.add_client').html(container_link);
		$('#add_point_catalog h3').html(data.header);
		$('#parent_id').val(parent_id);
		$('#item_level').val(level);
		var container_add_point=$('#container_add_point_catalog').html();
		TINY.box.show({html:container_add_point,boxid:'frameless',animate:true,close:true});	
    }
    });
	
}

function validate_edit_point_catalog(){
	
	var url=$('#edit_point_catalog form').attr('action');
	var point_name=$('.tcontent #container_point_name .add_point').val();
	var item_id=$('.tcontent #item_id').val();
	var edit_point=$('#edit_point_catalog').html();
	
	if(point_name==''){
		myAlert('Название пункта не может быть пустым!');
		return false;
	}
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data:'&type=ajax&item_id='+item_id+'&point_name='+point_name,
    cache: false,
	beforeSend:function(){
		$('.tcontent #edit_point_catalog').html('<img src="/images/avtospektr/ajax-loaders/content.gif">');
		
	},
	error:function(){
		$('.tcontent #edit_point_catalog').html(edit_point);
		myAlert('Неизвестная ошибка!');
	},
    success: function(data){
		if(data.answer==1){
			TINY.box.hide();
			$('#a_'+item_id).text(data.name);
		}
		else{
			$('.tcontent #edit_point_catalog').html(edit_point);
			myAlert('Неизвестная ошибка!');		}
    }
    });
	
}

function validate_set_pricing(){
	
	var url=$('#add_pricing form').attr('action');
	var points=$('.tcontent .pricing');
	var add_pricing=$('#add_pricing').html();
	var distributor_id=$('.tcontent #distributor_id').val();
	var client_id=$('.tcontent #client_id').val();
	var box='';
	if($('#pricing_update').length>0){
		var type_edit='pricing_update';
	}
	else if($('#pricing_insert').length>0){
		var type_edit='pricing_insert';
	}
	
	for(i=0;i<points.length;i++){
		key=points[i].id;
		value=points[i].value;
		num_value=value*1;
		if(value==''){
			myAlert('Одно из полей является пустым!');
			return false;
		}
		if(num_value<0){
			myAlert('В одном из полей имеется значение меньше 0!');
			return false;
		}
		box+=key+'='+value;
		if(i!=points.length-1)
			box+='&';
	}
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data:'&type=ajax&'+type_edit+'=1&distributor_id='+distributor_id+'&'+box+'&client_id='+client_id,
    cache: false,
	beforeSend:function(){
		$('.tcontent add_pricing').html('<img src="/images/avtospektr/ajax-loaders/content.gif">');
		
	},
	error:function(){
		$('.tcontent #add_pricing').html(add_pricing);
		myAlert('Неизвестная ошибка!');
	},
    success: function(data){
		if(data.answer==1){
			TINY.box.hide();
			
			if(data.link_content!=''){
			
			if(data.type_change=='insert'){
				$('#block_link_'+distributor_id).html(data.link_content);
				$('#block_link_'+distributor_id+' .link_info').tipTip({content:data.markups_title});
				myAlert('Данные успешно добавлены!');
			}
			else{
				$('#block_link_'+distributor_id).html(data.link_content);
				$('#block_link_'+distributor_id+' .link_info').tipTip({content:data.markups_title});
				myAlert('Данные успешно обновлены!');
			}
				
			}
				
				
		}
		else{
			$('.tcontent #add_pricing').html(add_pricing);
			if(data.error=='')
				myAlert('Неизвестная ошибка!');		
			else
				myAlert(data.error);
			}
    }
    });
}

function validate_add_point_catalog(){
	
	var url=$('#add_point_catalog form').attr('action');
	var points=$('.tcontent .add_point');
	var add_point=$('#add_point_catalog').html();
	var parent_id=$('.tcontent #parent_id').val();
	var level=$('.tcontent #item_level').val();
	var box='';
	for(i=0;i<points.length;i++){
		key=points[i].id;
		value=points[i].value;
		if(value==''){
			myAlert('Одно из полей является пустым!');
			return false;
		}
		box+=key+'='+value;
		if(i!=points.length-1)
			box+='&';
	}
	
	$.ajax({
	type: "POST",
    url: url,
	dataType: 'json',
	data:'&type=ajax&level='+level+'&parent_id='+parent_id+'&'+box,
    cache: false,
	beforeSend:function(){
		$('.tcontent add_point_catalog').html('<img src="/images/avtospektr/ajax-loaders/content.gif">');
		
	},
	error:function(){
		$('.tcontent #add_point_catalog').html(add_point);
		myAlert('Неизвестная ошибка!');
	},
    success: function(data){
		if(data.answer==1){
			document.location.href=data.url;
		}
		else{
			$('.tcontent #add_point_catalog').html(add_point);
			myAlert('Неизвестная ошибка!');		}
    }
    });
	
}


function submenu(object,type){

	object_id = object.id;
	buffer_id = object_id.split('_');
	id = buffer_id[1];
	buffer_object = document.getElementById('menu_'+id);
	object_class = buffer_object.className;
	buffer1 = object_class.split(' ');
	
	if(buffer1.length>2){
		buffer2 = buffer1[2].split('_');

	}
	else{
		buffer2 = buffer1[1].split('_');

	}
	
	
	
	curr_level = buffer2[1];

	
	buffer = object_id.split('_');
	id = buffer[1];
	
	
	var next_elem = $('#'+type+' #menu_'+id).next();
	if(next_elem.length>0){
		next_elem_class = next_elem.attr('class');
	
	buffer1 = next_elem_class.split(' ');
	
	if(buffer1.length>2){
		buffer2 = buffer1[2].split('_');
		next_level = buffer2[1]*1;
//		next_level+=1;
	}
	else{
		next_level=0;
	}
	}
	else{
		next_level=0;
	}
	
	
	
	if(next_level>curr_level ){
	
	
		operateChilds(id,curr_level,next_level,type);
		
		
	}

	
	else{
		
	if(type=='menu_catalog'){
		url='/catalog/menu/submenu';
	}
	else{
		url='/'+type+'/menu/submenu';
	}
	
	
	
	 $.ajax({
	type: "POST",
    url: url,
	data: 'parent_id='+id+'&level='+curr_level+'&type=ajax',
	dataType: 'json',
    cache: true,
	beforeSend:function(){
		 operation_branch(type,id,'beforeSend');
	},
    success: function(data){
		 operation_branch(type,id,'success');
		hideOtherElems(curr_level,next_level,type);
	
   	if(data.have_childs){
		 $('#'+type+' #menu_'+id).after(data.content);
		 if(type=='menu_catalog'){
		 		//$.scrollTo('#'+type+' #menu_'+id,1000,{offset:-200});

		 }

	}
	else{
		 show_item(id);
	}
	
	$('#'+type+' #prev_id').val(id);
	
	resize_content();
		
		
   
    }
	
    });

	}
	
	

}


function hideOtherElems(curr_level,next_level,type){
	
	if(curr_level==next_level || curr_level>next_level){
		next_level=(curr_level*1)+1;
	}
	

	
	for(i=next_level;i<5;i++){
		
		$('#'+type+' .level_'+i).css({'display':'none'});

	}	
	
	
}

function operateChilds(id,curr_level,next_level,type){
	

if(type=='menu_catalog')	{
	inner_items=items;
}
else if(type=='client'){
	inner_items=client_items;	
}

first_element=inner_items[id][0];


if($('#'+type+' #menu_'+first_element).css('display')!='none'){
	
	for(i=0;i<inner_items[id].length;i++){
		
		$('#'+type+' #menu_'+inner_items[id][i]).css({'display':'none'});
	}
	
	if(type=='menu_catalog'){
			//$.scrollTo('#'+type+' #menu_'+id,1000,{offset:-200});

	}
	else{
			//$.scrollTo('#content',1000);

	}
}

else{

	hideOtherElems(curr_level,next_level,type);


	for(i=0;i<inner_items[id].length;i++){
	
		elem=$('#'+type+' #menu_'+inner_items[id][i]);
		if(elem.length>0){
			
		
		//alert('#'+type+' #menu_'+inner_items[id][i])
		elem_class = elem.attr('class');
		
		buffer1 = elem_class.split(' ');
	
		buffer2 = buffer1[buffer1.length-1].split('_');
		level = buffer2[1]*1;

		if(level==next_level){
			$('#'+type+' #menu_'+inner_items[id][i]).css({'display':'table-row'});

		}
	}	
		
	}
	
	if(type=='menu_catalog'){
		//$.scrollTo('#'+type+' #menu_'+id,1000,{offset:-200});
	
	}
	else{
		//$.scrollTo('#content',1000);

	}
}




}

function get_resolution(type){
	
	
	var height=0; var width=0;
if (self.screen) {
width = screen.width
height = screen.height
}
else if (self.java) {
var jkit = java.awt.Toolkit.getDefaultToolkit();
var scrsize = jkit.getScreenSize();
width = scrsize.width;
height = scrsize.height;
}

resolution = new Array();
resolution['width']=width;
resolution['height']=height;


return resolution[type];


}


function set_width(){
	
	width=get_resolution('width');
	
	if(width!=1280){
		adapt_for_resolution(width);

	}
	
	
}

function adapt_for_resolution(width){

	var q=width/1280;
	
	
	$('#container').width(1000*q);
	$('#container_footer').width(1000*q);
	$('#header').css({'background':'url(../../images/avtospektr/header_'+width+'.jpg)','height':212*q+'px'});
	$('#firms').css({'background':'url(../../images/avtospektr/list_firms_'+width+'.jpg)','height':52*q+'px'});
//	$('.label').css({'height':})
	$('#sidebar').css({'width':301*q});
	$('#option_catalog').width(300*q);
	$('#option_main').width(149*q);
	$('#option_autoparts').width(198*q);
	$('#option_menu').width(198*q);
	$('#option_contacts').width(151*q);
	
}


function show_item(id){
	
	//alert(id);
	
}




