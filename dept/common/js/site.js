$(function() {
	smartRollover();
	opacityRollover();
	externalLink();
	smoothScroll();
});

/* smartRollover
============================================================================================================ */
function smartRollover() {
	var imgCount = 0;
	var images_pre = new Array();
	$('img[src*="_off."],input[src*="_off."]').each (function(){
		images_pre[imgCount] = new Image();
		images_pre[imgCount].src = $(this).attr("src").replace("_off.", "_on.");
		$(this).hover(
			function () {
				$(this).attr("src", $(this).attr("src").replace("_off.", "_on."));
			},
			function () {
				$(this).attr("src", $(this).attr("src").replace("_on.", "_off."));
			}
		);
		imgCount ++;
	});
}

/* opacityRollover
============================================================================================================ */
function opacityRollover() {
	if(!$.browser.msie) {
		$('img[src*="_op."],input[src*="_op."]').hover(
			function () {
				$(this).css('opacity', 0.7);
			},
			function () {
				$(this).css('opacity', 1);
			}
		);
	}
}

/* externalLink
============================================================================================================ */
function externalLink() {
	var notBlank = new Array("");

	var n = "";
	for (var i = 0; i < notBlank.length; i ++) if(notBlank[i]) n += ":not([href*='" + notBlank[i] + "'])";
	if(document.domain) n += ":not([href*='" + document.domain + "'])";

	$("a[rel='external'], a[href$='.pdf']").attr("target", "_blank");
	$("a[href^=http]"+n).attr("target", "_blank");

	if(!location.href.match(/^http/)){
		$("a[href$='/']").not("a[href^='http']").each( function(){
			$(this).attr('href', $(this).attr('href') + 'index.html');
		});
		$("a[href*='/#']").not("a[href^='http'],a[href$='.html']").each( function(){
			var n = $(this).attr('href').lastIndexOf("/#") + 1;
			$(this).attr('href', $(this).attr('href').substring(0, n) + 'index.html' + $(this).attr('href').substring(n));
		});
	}
}

/* smoothScroll
============================================================================================================ */
function smoothScroll() {
	$('a[href^="#"], a[href^="' + location.pathname + '#"]').each (function(){
		var hash = this.hash;
		if(hash.length > 1 && !this['rel']){
			$(this).click(function() {
				goScroll(hash);
				return false;
			})
		}
	});
}
function goScroll(hash) {
	var target = $(hash).offset().top;

	$('body,html')
		.animate({scrollTop: target >= 15 ? target - 15 : target}, 600, 'swing', function(){$(this).unbind("mousewheel DOMMouseScroll");})
		.bind("mousewheel DOMMouseScroll",function(){
			$(this).queue([]).stop();
			$(this).unbind("mousewheel DOMMouseScroll");
		})
}
