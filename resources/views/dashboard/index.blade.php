@extends('layouts.dashboard')

@section('content')



    <!--ADV-->
    <div class="adv"></div>
    <!--End ADV-->

    <!--Levels -->
    <div class="sections">
        @foreach($levels as $level)
        @if($level->sections->count() > 0)
        <div class="section">
            <div class="section__image" style="background-image: url({{$level->image}})"></div>
            <div class="section__content">
                <div class="section__content__main">
                    <div class="section__main--left">
                        <div class="section__main__title">
								<span class="section__title">
									{{ $level->title }}
								</span>
                        </div>

                        <div class="section__main__description">
                                @if($level->paid)
								<span class="locked">
									<img src="{{ asset('design/images/lock.png') }}"
                                         srcset="{{ asset('design/images/lock@2x.png') }} 2x" alt="">
								</span>
                                @endif
                            <span class="section__description">
									{{ $level->description }}
								</span>
                        </div>

                    </div>
                    <div class="section__main--right">
                        <div class="section__progress">
								<span class="section__progress--right">
									<img src="/design/images/progress-circle.png" srcset="/design/images/progress-circle@2x.png 2x" width="17px" height="17px" alt="">
								</span>
                            <span class="section__progress--text">10%</span>
                        </div>
                        <div class="section__progress-bar">
                            <div class="section__progress-bar__level" style="width:10%"></div>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->paid && $level->paid || !$level->paid)

                    <div class="section__content__dropdown" style="display: none">
                        <div class="section__dropdown--left">
                            <div class="section__dropdown__title">
                                    <span class="section__title">
                                        Выбери урок <br>и начни обучение
                                    </span>
                            </div>
                        </div>
                        <div class="section__dropdown--right">
                            <div class="level-sections">
                                @foreach($level->sections as $key=>$section)
                                    @if($section->lessons->count() > 0)
                                        <div class="level-section">
                                            <div class="level-section--bg">
                                                <div class="level-section__index">{{ $key+1 }}</div>
                                            </div>
                                            <div class="level-section__lessons">
                                                <div class="level-section__text">
                                                    Задания
                                                </div>
                                                @foreach($section->lessons as $key=>$lesson)
                                                        <a href="{{ route('dashboard.lesson', [$lesson->section->level->name, $lesson->section->name, $lesson->name]) }}" class="level-section__lesson">
                                                            <span>{{ $key+1 }}</span>
                                                        </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                @endif
            </div>
        </div>
        @endif
        @endforeach
    </div>

    <!--End Levels -->




@endsection