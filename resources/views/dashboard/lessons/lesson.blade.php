@extends('layouts.dashboard')

@section('content')

    <div class="lesson">

        <div class="lesson--border-top"></div>
        <div class="lesson__content">
            @if(session('lesson-complited') )
                <div class="lesson__status">
                    <div class="lesson__status__title">
                        @if(session('lesson-complited') === 'true')
                            Великолепно!
                        @else
                            Не правильно!
                        @endif
                    </div>
                    <div class="lesson__status__image">
                        <img src="{{ asset('design/images/complete.png') }}" alt="">
                    </div>
                    <div class="progress__status">
                        <div class="progress__level">
                            <div class="progress__level__image">
                                <img src="{{ asset('design/images/level.png') }}" srcset="{{ asset('design/images/level@2x.png') }} 2x" alt="">
                            </div>
                            <div class="progress__level__text">
                                Level: 1
                            </div>
                        </div>
                        <div class="progress__per">
                            <div class="progress__level__image">
                                <img src="{{ asset('design/images/percent.png') }}" srcset="{{ asset('design/images/percent@2x.png') }} 2x" alt="">
                            </div>
                            <div class="progress__level__text">
                                10%
                            </div>
                        </div>
                        <div class="progress__line">
                            <div class="progress__line__percent" style="width: 30%">

                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(session('lesson-complited') != 'true' && session('lesson-complited') != 'false' )

                @yield('lesson')

            @endif
        </div>

        <div class="lesson--control-panel">
            @include('dashboard.include.skip-button')

            @if(session('lesson-complited'))
                <a href="{{ session('next') }}" id="next-lesson" onclick="event.preventDefault();nextLesson('{{ session("next") }}')" class="control__next" >Далее</a>
            @else
                @yield('button-lesson-check')
            @endif
        </div>

    </div>

@endsection