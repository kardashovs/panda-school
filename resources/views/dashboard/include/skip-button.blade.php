@if($next_lesson)
<a href="{{ route('dashboard.lesson', [$next_lesson->section->level->name, $next_lesson->section->name, $next_lesson->name]) }}" class="control__skip" onclick="event.preventDefault();nextLesson('{{ route('dashboard.lesson', [$next_lesson->section->level->name, $next_lesson->section->name, $next_lesson->name]) }}')">{{ __('lesson.skip') }}</a>

@endif