@extends('layouts.dashboard')

@section('content')

    <div class="lesson">

        <div class="lesson--border-top"></div>
        <div class="lesson__content">
            @if(session('lesson-complited') )
                <div class="lesson__status">
                    <div class="lesson__status__image">
                    @if(session('lesson-complited') === 'true')
                        <img src="{{ asset('design/images/complete.png') }}" alt="">
                    @else
                        <img src="{{ asset('design/images/no-complete.png') }}" alt="">
                    @endif
                    </div>
                    <div class="progress__status">
                        <div class="progress__level">
                            <div class="progress__level__image">
                                <img src="{{ asset('design/images/level.png') }}" srcset="{{ asset('design/images/level@2x.png') }} 2x" alt="">
                            </div>
                            <div class="progress__level__text">
                                Level: {{ $levelCount }}
                            </div>
                        </div>
                        <div class="progress__per">
                            <div class="progress__level__image">
                                <img src="{{ asset('design/images/percent.png') }}" srcset="{{ asset('design/images/percent@2x.png') }} 2x" alt="">
                            </div>
                            <div class="progress__level__text">
                                <span data-percent="{{ $levelPercent }}">{{ session('oldPercent') }}</span>%
                            </div>
                        </div>
                        <div class="progress__line">
                            <div class="progress__line__percent progress__line__percent--lesson" style="width: {{ session('oldPercent') }}%">

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

            @if(session('lesson-complited') )
                @if(session('next'))
                <a href="{{ session('next') }}" id="next-lesson" onclick="event.preventDefault();nextLesson('{{ session("next") }}')" class="control__next" >Далее</a>
                @endif
            @else
                @yield('button-lesson-check')
            @endif
        </div>

    </div>

@endsection

@section('scripts-lesson')
    @if(session('oldPercent'))
    <script>
        const timeout = 1500;
        const h = parseInt($('.progress__level__text span').attr('data-percent') - $('.progress__level__text span').text()  );
        let percent = parseInt($('.progress__level__text span').text())
        console.log($('.progress__level__text span').text(), $('.progress__level__text span').attr('data-percent'))

        setTimeout(() => {
            const interval = setInterval(() => {

                if(parseInt($('.progress__level__text span').attr('data-percent')) === percent)
                    clearInterval(interval);
                else
                {
                    if (h > 0)
                        percent++;
                    else
                        percent--;

                    $('.progress__level__text span').text(percent)
                    $('.progress__line__percent--lesson').css('width', percent+'%')
                }


            }, 500 / Math.abs(h));
        }, timeout)




        // setTimeout(() => {
        //     let i;
        //     setInterval(() => {
        //         console.log(i++)
        //         break;
        //     }, timeout / h)
        // }, timeout)
        $('.progress__level__text')
    </script>
    @endif
@endsection