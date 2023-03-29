$(function() {
	$('.btn a').click( function(e){
		e.preventDefault();
		$.fancybox({
			href: '#consultIndexFlow',
			centerOnScroll: true,
			padding: 0
		});
	});

	setBtnSlide();
	mainSet();
});

var nowNum = 0;
var btnNum = 0;
var slideNum = 6;
var btnView = 6;
var dep = 100;

var img = "#consultIndexFlow dl";
var btn = "#consultIndexFlow li";
var btn_l = "#consultIndexFlow .l";
var btn_r = "#consultIndexFlow .r";


function mainSet(){
	mainChange(0, false, true);
}

function mainChange(num, hf, ff) {
	var t = hf ? 200 : 400;
	if(num != nowNum || ff) {
		$(btn).unbind().each (function(i){
			if(i != num) {
				$(this).css({cursor:'pointer', opacity:0.7}).hover(
					function () {
						$(this).css('opacity', 1);
					},
					function () {
						$(this).css('opacity', 0.7);
					}
				).click( function(){
					mainChange(i, true);
				});
			}else {
				$(this).css({cursor:'default', opacity:1});
			}
		});

		$(img + ":eq("+(num)+")").stop().css({zIndex:dep, opacity:0}).show().animate({opacity:1}, t, 'linear');

		dep ++;
		nowNum = num;

		if(nowNum < btnNum) {
			btnSlide(nowNum);
		}else if(nowNum > btnNum + (btnView-1)) {
			btnSlide(Math.min(nowNum - (btnView-1), $(btn).size() - btnView));
		}
	}
}

function setBtnSlide() {
	$(btn_l).addClass('disabled').css('opacity', 0.3);
	$(btn_r).addClass('disabled').css('opacity', 0.3);
	btnSlide(0)
}

function btnSlide(num) {
	if($(btn).size() <= btnView) return;

	btnNum = num;
	$("#consultIndexFlow ul").stop().animate({left:-(71+8) * num}, 600);

	var l = $(btn_l);
	var r = $(btn_r);

	if(num == 0) {
		l.unbind().css('opacity', 0.3).addClass('disabled').css('cursor', 'default');
	} else if(l.hasClass('disabled')) {
		l.removeClass('disabled').css('cursor', 'pointer').css('opacity', 1).hover(
			function () {
				$(this).css('opacity', 0.8);
			},
			function () {
				$(this).css('opacity', 1);
			}
		).click( function(){
			btnSlide(Math.max(btnNum - slideNum, 0));
		});
	}
    if(num == $(btn).size() - (btnView)) {
		r.unbind().css('opacity', 0.3).addClass('disabled').css('cursor', 'default');
	} else if(r.hasClass('disabled')) {
		r.removeClass('disabled').css('cursor', 'pointer').css('opacity', 1).hover(
			function () {
				$(this).css('opacity', 0.7);
			},
			function () {
				$(this).css('opacity', 1);
			}
		).click( function(){
			btnSlide(Math.min(btnNum + slideNum, $(btn).size() - btnView));
		});
	}
}

