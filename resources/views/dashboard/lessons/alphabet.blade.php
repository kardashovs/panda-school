@extends('dashboard.lessons.lesson')

@section('lesson')
    <div class="lesson__header">
        <div class="lesson__title">
            <h2 class="lesson__h2">Давайте выучим алфавит</h2>
            <span class="lesson__description">Let’s learn the alphabet</span>
        </div>
        <div class="lesson__help">
            <button class="lesson__help__button">
                <img src="/design/images/help-icon.png" srcset="/design/images/help-icon@2x.png 2x" alt="">
            </button>
        </div>
    </div>
    <div class="lesson__alphabet">
        @foreach($lesson->meta->body->alphabet as $item)
            <div class="lesson__aphabet__item">
                <div class="alphaber__char" data-sound="http://www.english-source.ru/media/sounds/{{strtolower($item->title)}}.mp3">
                    {{ strtoupper($item->title) }} {{strtolower($item->title)}}
                </div>
            </div>
        @endforeach
    </div>

@endsection

@section('button-lesson-check')
    <a href="#check" class="control__next" onclick="event.preventDefault();checkLesson('{{ $lesson->name }}');">Далее</a>
    <form id="{{ $lesson->name }}" action="{{ route('dashboard.lesson.check', [$lesson->section->level->name, $lesson->section->name, $lesson->name]) }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection