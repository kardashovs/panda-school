function nextLesson(href) {
    event.preventDefault();
    $('.lesson__content').removeClass('lesson__content--active');
    setTimeout(function () {
        location.href=href
    }, 700);
}

function checkLesson(id) {
    event.preventDefault();

    $('.lesson__content').removeClass('lesson__content--active');
    setTimeout(function () {
        document.getElementById(id).submit();
    }, 700)
}

function hidePreviewBlock() {
    $('.lesson__content').removeClass('lesson__content--active');
    $('#hidePreview').hide();


    $('#check').show();

    setTimeout(function () {
        $('.lesson__media--slider').hide();
        $('.swiper-button-prev').hide();
        $('.swiper-button-next').hide();
        $('.associal-slider__paginate').hide();
        $('.lesson__media__block').hide();
        $('.lesson__media').show();

        $('.lesson__content').addClass('lesson__content--active');
    }, 1000)
}

$(document).ready(function(){

	$(document).on('click', function (e) {
		if(!$(e.target).hasClass('dropdown'))
            $('.toggle__menu').fadeOut();

	});


    setTimeout(() => {$('.lesson__content').addClass('lesson__content--active')}, 500)

	$('.lesson__help__button').on('click', function () {
		$('.lesson__help__container').fadeToggle()
    });

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
		let audio = new Audio($(this).attr('data-sound'));
		audio.play();
	});
	
	$('.lesson__media__play').on('click', function() {
		let audio = new Audio($(this).attr('data-sound'));
		audio.play();
        audio.addEventListener('loadedmetadata', function() {
            // console.log(audio.duration);
        });
	});
	
	$('.lesson__media__replay').on('click', function() {
		let audio = new Audio($(this).attr('data-sound'));
		audio.play();
	});
	
});


