@extends('dashboard.lessons.lesson')

@section('lesson')
    <div class="lesson__header">
        <div class="lesson__title">
            <h2 class="lesson__h2">Прослушайте и выбирите правильный ответ</h2>
            <span class="lesson__description">Сhoose the right answer</span>
        </div>
        <div class="lesson__help">
            <button class="lesson__help__button">
                <img src="/design/images/help-icon.png" srcset="/design/images/help-icon@2x.png 2x" alt="">
            </button>
        </div>
    </div>
    <div class="lesson__main lesson__choose">
        @if($lesson->meta->body->image)
        <div class="lesson__images">
            <img src="{{ asset( $lesson->meta->body->image ) }}" alt="">
        </div>
        @endif
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
        <div class="lesson__buttons">
            <form class="lesson__buttons__form lesson__input__word" method="POST" id="{{ $lesson->name }}"
                  action="{{ route('dashboard.lesson.check', [$lesson->section->level->name, $lesson->section->name, $lesson->name]) }}">
                {{ csrf_field() }}

                <span>
                    @foreach(str_split($lesson->meta->body->word) as $symbol)
                        @if (in_array($symbol, $lesson->meta->body->vars_true))
                            @foreach($lesson->meta->body->vars_true as $item)
                                @if($symbol === $item)
                                    <input type="text" class="lesson__input__word__missing__letter" name="result[]" placeholder="_" value="" maxlength='1'/>
                                    @break;
                                @endif
                            @endforeach
                        @else
                            {{ $symbol }}
                        @endif
                    @endforeach
                </span>


            </form>
            <div class="lesson__input__border lesson__input__button__border"></div>
        </div>

    </div>

@endsection

@section('button-lesson-check')
    <a href="#check" class="control__next" onclick="event.preventDefault();checkLesson('{{ $lesson->name }}');">{{ __('lesson.check') }}</a>
    {{--<form id="{{ $lesson->name }}" action="{{ route('dashboard.lesson.check', [$lesson->section->level->name, $lesson->section->name, $lesson->name]) }}" method="POST" style="display: none;">--}}
    {{--@csrf--}}
    {{--</form>--}}
@endsection

@section('scripts')
@endsection