function nextLesson(href) {
    event.preventDefault();
    $('.lesson__content').height(0);
    setTimeout(function () {
        location.href=href
    }, 700);
}

function checkLesson(id) {
    event.preventDefault();

    $('.lesson__content').height(0);
    setTimeout(function () {
        document.getElementById(id).submit();
    }, 700)
}

$(document).ready(function(){

	$(document).on('click', function (e) {
		if(!$(e.target).hasClass('dropdown'))
            $('.toggle__menu').fadeOut();
	});

	const childrenLessonContent = $('.lesson__content').children();
	let heightLessonContent = 0;

    $(childrenLessonContent).each(function (index, element) {
        if($(element).css('display') != 'none')
		heightLessonContent += $(element).outerHeight(true);
    });

    $('.lesson__content').height(heightLessonContent);



	$('.dropdown').on('click', function() {	
		$('.toggle__menu').fadeOut();
		$('#'+$(this).attr('data-toggle')).stop();
		if($(this).hasClass('active'))
			{
				$(this).removeClass('active');
				$('#'+$(this).attr('data-toggle')).fadeToggle();
			}
		else 
			{
				$(this).addClass('active');
				$('#'+$(this).attr('data-toggle')).fadeToggle();
			}
	});
	
	$('.section__content__main').on('click', function() {
		$('.section__content__dropdown').stop();
		$(this).parent().find('.section__content__dropdown').slideToggle(300);
	});
	
	$('.level-section--bg').on('click', function() {
		if($(this).parent().hasClass('level-section--select')){
			$(this).parent().removeClass('level-section--select');
			$(this).parent().find('.level-section__lessons').removeClass('level-section__lessons--show');
		} else {
			$(this).parent().addClass('level-section--select');
			$(this).parent().find('.level-section__lessons').addClass('level-section__lessons--show');
		}
	});
	
	$('.alphaber__char').on('click', function() {
		var audio = new Audio($(this).attr('data-sound'));
		audio.play();
	});
	
	$('.lesson__media__play').on('click', function() {
		var audio = new Audio($(this).attr('data-sound'));
		audio.play();
	});
	
	$('.lesson__media__replay').on('click', function() {
		var audio = new Audio($(this).attr('data-sound'));
		audio.play();
	});
	
});


