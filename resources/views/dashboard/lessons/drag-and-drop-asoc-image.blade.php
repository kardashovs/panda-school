@extends('dashboard.lessons.lesson')

@section('lesson')

    <div class="lesson__header">
        <div class="lesson__header__content">
            <div class="lesson__title">
                <h2 class="lesson__h2">Посмотри</h2>
                <span class="lesson__description">Let’s learn the alphabet</span>
            </div>
        </div>
        <div class="lesson__help">
            <button class="lesson__help__button">
                <img src="/design/images/help-icon.png" srcset="/design/images/help-icon@2x.png 2x" alt="">
            </button>
            <div class="lesson__help__container">
                <div class="lesson__help__container--wysiwyg">
                    {!! $lesson->section->hint !!}
                </div>
            </div>
        </div>
    </div>
    <div class="lesson__media">
        <div class="lesson__media--slider swiper-container">
            <div class="swiper-wrapper associal-slider">
                @foreach($lesson->meta->body->vars as $item)
                    <div class="swiper-slide associal-slider__slide" data-sound-city="{{ $item->sound }}">
                        <div class="associal-slider__slide__img"
                             style="background-image: url({{ asset($item->image) }})"></div>
                        <div class="associal-slider__slide__title">{{$item->title}}</div>
                    </div>
                @endforeach
            </div>

        </div>

        <div class="swiper-button-prev associal-slider__btn"></div>
        <div class="swiper-button-next associal-slider__btn associal-slider__btn--right"></div>

        <div class="associal-slider__paginate"></div>

        <div class="lesson__media" style="display: none">
            <form id="{{ $lesson->name }}"
                  action="{{ route('dashboard.lesson.check', [$lesson->section->level->name, $lesson->section->name, $lesson->name]) }}"
                  method="POST">
                @csrf
                <div class="lesson__choose__content">
                    @foreach($lesson->meta->body->vars as $item)
                        <div class="lesson__choose__content__block">
                            <div class="lesson__choose__content__block__img lesson__sound--city"
                                 data-sound="{{ $item->sound }}"
                                 style="background-image: url({{ $item->image }})"></div>
                            <div class="lesson__choose__content__drag">
                                <div class="lesson__choose__content__block__text draganddrop" data-value="{{ $item->title }}">
                                    <input class="lesson__button__slider__city drag__input" value="" readonly/>
                                </div>
                                <div class="lesson__chosse__input__line"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
                <div class="lesson__buttons lesson__buttons__slider draganddrop">
                    @foreach($lesson->meta->body->vars as $item)
                    <input class="lesson__button lesson__button__slider__city lesson__sound--city"
                           name="result[]" value="{{ $item->title }}"
                           data-sound="{{ $item->sound }}"
                           readonly
                    />
                    @endforeach
                </div>
                <div class="lesson__input__border lesson__input__button__border"></div>

        </div>


        <div class="lesson__media__block lesson__media__block--static">
            <div class="lesson__media__panel">
                <button class="lesson__media__button lesson__media__slider__play">
                    <img src="/design/images/vol.png" srcset="/design/images/vol@2x.png 2x" alt="">
                </button>
                <button class="lesson__media__button lesson__media__slider__volume">
                    <img src="/design/images/play.png" srcset="/design/images/play@2x.png 2x" alt="">
                </button>
                <button class="lesson__media__button lesson__media__slider__replay">
                    <img src="/design/images/replay.png" srcset="/design/images/replay@2x.png 2x" alt="">
                </button>
            </div>
        </div>


    </div>
@endsection

@section('button-lesson-check')
    <a href="#hidePreview" id="hidePreview" class="control__next" onclick="event.preventDefault();hidePreviewBlock();">Далее</a>
    <a href="#check" id="check" class="control__next" style="display: none"
       onclick="event.preventDefault();checkLesson('{{ $lesson->name }}');">Далее</a>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>
    <script>
        var swiper = new Swiper('.lesson__media--slider', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',

            },
            pagination: {
                el: '.associal-slider__paginate',
                type: 'fraction',
            },
            slidesPerView: 3,
            centeredSlides: true,
            spaceBetween: 0,
            speed: 700,
            loop: true
        });
        /* drag and drop */
        var errorsLesson = [true];
        var trueLesson = [];

        function checked() {
            errorsLesson = [];
            trueLesson = [];
            $('.lesson__choose__content__block').each(function (index, value) {
                var container = $(value).find('.lesson__choose__content__block__text');
                var containerInput = container.find('.lesson__button__slider__city');
                if (containerInput.val() == '') {
                    container.parent().find('.lesson__chosse__input__line').removeClass('lesson__chosse__input__line--error');
                    container.parent().find('.lesson__chosse__input__line').removeClass('lesson__chosse__input__line--access');
                } else {
                    if (container.attr('data-value').toLocaleLowerCase() == containerInput.val().toLocaleLowerCase()) {
                        container.parent().find('.lesson__chosse__input__line').addClass('lesson__chosse__input__line--access');
                        container.parent().find('.lesson__chosse__input__line').removeClass('lesson__chosse__input__line--error')
                        trueLesson.push(true);
                    } else {
                        errorsLesson.push(true);
                        container.parent().find('.lesson__chosse__input__line').removeClass('lesson__chosse__input__line--access')
                        container.parent().find('.lesson__chosse__input__line').addClass('lesson__chosse__input__line--error');
                    }
                }
            })

            if (trueLesson.length == 6) {
                $('.control__next').removeClass('control__next--disable');
            } else {
                $('.control__next').addClass('control__next--disable');
            }
        }

        const droppable = new Draggable.Swappable(document.querySelectorAll(".draganddrop"), {
            draggable: ".lesson__button__slider__city, .lesson__button__drop__insert",
            droppable: ".draganddrop",
        });

        droppable.on("drag:over", function (e) {
            $(".draganddrop").removeClass("draggable-droppable--occupied");
            errorsLesson.push(true);

            checked();

        });
    </script>
    <script>
        $('.lesson__media__slider__play').on('click', function () {

            let audio = new Audio($('.swiper-slide-active').attr('data-sound-city'));
            audio.play();
        });

        $('.lesson__sound--city').on('mousedown', function () {
            let audio = new Audio($(this).attr('data-sound'));
            audio.pause();
            audio.play();

        });
    </script>
@endsection
