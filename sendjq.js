$(document ).ready(function() {
	$('button[type="submit"]').click(function(){
	
	/*Валидация полей формы*/
	$('#feedback').validate({
	//Правила валидации
	rules: {
        name: {
            required: true,
        },
		 mobile: {
            required: true,
        },

    },
	//Сообщения об ошибках
    messages: {
		name: {
            required: "Обязательно укажите имя",
        },
		mobile: {
			required: "Укажите номер телефона",
		},
    },
	
	/*Отправка формы в случае успеха валидации*/
    submitHandler: function(){
         sendAjaxForm('feedback', 'ajax-form.php'); //Вызываем функцию отправки формы
		 return false; 
    }
	});
});

	function sendAjaxForm(feedback, url) {
					$.ajax({
						url:     url, //url страницы (ajax-form.php)
						type:     "POST", //метод отправки
						dataType: "html", //формат данных
						data: $("#"+feedback).serialize(),  // Сеарилизуем объекты формы
						success: function(response) { //Данные отправлены успешно
							
							//Ваш код если успешно отправлено
							alert('Успешно отправлено!');
						},
						error: function(response) { // Данные не отправлены
							
							//Ваш код если ошибка
							alert('Ошибка отправления');
						}
					});

}
});