$(function() {
	var def_text = "お問い合せ内容をご記入ください。";
	$('textarea').focus( function(){
		if($(this).val() == def_text) {
			$(this).removeClass('empty').val('');
		}
	}).blur( function(){
		if($(this).val() == '') {
			$(this).val(def_text).addClass('empty')
		}
	}).trigger('blur');

	$('form').submit( function(){
		if($('textarea', this).val() == def_text) {
			$('textarea', this).val('');
		}
	})
});


