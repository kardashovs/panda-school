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
    <div class="lesson__media lesson__media--choose">
        <div class="lesson__media__block">
            <div class="lesson__media__panel">
                <button class="lesson__media__button">
                    <img src="/design/images/vol.png" srcset="/design/images/vol@2x.png 2x" alt="">
                </button>
                <button class="lesson__media__button">
                    <img src="/design/images/play.png" srcset="/design/images/play@2x.png 2x" alt="">
                </button>
                <button class="lesson__media__button">
                    <img src="/design/images/replay.png" srcset="/design/images/replay@2x.png 2x" alt="">
                </button>
            </div>
        </div>
    </div>

@endsection

@section('button-lesson-check')
    <a href="#check" class="control__next" onclick="event.preventDefault();checkLesson('{{ $lesson->name }}');">Далее</a>
    <form id="{{ $lesson->name }}" action="{{ route('dashboard.lesson.check', [$lesson->section->level->name, $lesson->section->name, $lesson->name]) }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection