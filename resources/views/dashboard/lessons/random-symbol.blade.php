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
    <div class="lesson__main lesson__choose">
        @if($lesson->meta->body->image)
            <div class="lesson__images">
                <img src="{{ asset( $lesson->meta->body->image ) }}" alt="">
            </div>
        @endif

            <form id="{{ $lesson->name }}"
                  action="{{ route('dashboard.lesson.check', [$lesson->section->level->name, $lesson->section->name, $lesson->name]) }}"
                  method="POST">
                @csrf
                <div class="lesson__buttons lesson__buttons__slider draganddrop">

                    @foreach($lesson->shuffleVars($lesson->meta->body->vars_true)  as $item)
                        <input class="lesson__button lesson__button__slider__city lesson__sound--city"
                               name="result[]" value="{{ $item }}"
                               readonly
                        />
                    @endforeach
                </div>
            </form>
            <div class="lesson__input__border lesson__input__button__border"></div>


            <div class="lesson__media__block lesson__media__block--static">
                <div class="lesson__media__panel">
                    <button class="lesson__media__button lesson__media__vol">
                        <img src="/design/images/play.png" srcset="/design/images/play@2x.png 2x" alt="">
                    </button>
                    <button class="lesson__media__button lesson__media__play"
                            data-sound="{{ asset( $lesson->meta->body->sound ) }}">
                        <img src="/design/images/vol.png" srcset="/design/images/vol@2x.png 2x" alt="">
                    </button>
                    <button class="lesson__media__button lesson__media__replay"
                            data-sound="{{ asset( $lesson->meta->body->sound ) }}">
                        <img src="/design/images/replay.png" srcset="/design/images/replay@2x.png 2x" alt="">
                    </button>
                </div>
            </div>


    </div>
@endsection

@section('button-lesson-check')
    <a href="#check" id="check" class="control__next"
       onclick="event.preventDefault();checkLesson('{{ $lesson->name }}');">Далее</a>
@endsection

@section('scripts')
    <script>
        const droppable = new Draggable.Swappable(document.querySelectorAll(".draganddrop"), {
            draggable: ".lesson__button__slider__city, .lesson__button__drop__insert",
            droppable: ".draganddrop",
        });


    </script>
@endsection
