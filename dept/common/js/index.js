$(function() {
	// background
	$('#background img').maxImage({
		isBackground: true,
		slideShow: true,
		position: 'absolute',
		verticalAlign: 'top',
		overflow: 'auto',
		slideShowTitle: false,
		slideDelay: 6,
		maxFollows: 'height',
		verticalAlign: 'top'
	})

	if(navigator.userAgent.indexOf("MSIE") != -1) {
		$('#headContainer p').each(function() {
			var bg_src = $('img', this).attr('src');
			$(this).height($(this).height()).width($(this).width()).css({
				'background': 'none',
				'filter': 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src=' + bg_src + ', sizingMethod="scale");'
			});
			$('img', this).hide();
		});
	}
});

var nowNum = 0;

function setMainText() {
	var text = $('#headContainer p:eq(' + nowNum + ')');
	$('#headContainer p').not(text).fadeOut(800);
	text.fadeIn(800, 'linear');
	nowNum = (nowNum + 1)%3;
}

