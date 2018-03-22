@extends('layouts.dashboard')

@section('content')



    <!--ADV-->
    <div class="adv"></div>
    <!--End ADV-->

    <!--Levels -->
    <div class="sections">
        @foreach($levels as $level)
        {{--@if($level->sections->count() > 0)--}}
        @if(true)

        <div class="section">

            <div class="section__content">
                <div class="section__content__main">
                    <div class="section__image" style="background-image: url({{$level->image}})"></div>
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
                                @else
                                <span class="locked">
									<img src="{{ asset('design/images/free-level.png') }}" width="25" alt="">
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
                            <span class="section__progress--text">{{ $level->level_percent }}%</span>
                        </div>
                        <div class="section__progress-bar">
                            <div class="section__progress-bar__level" style="width:{{ $level->level_percent }}%"></div>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->paid && $level->paid || !$level->paid)

                    <div class="section__content__dropdown" style="display: none">
                    @foreach($level->sections as $key=>$section)
                        @if($section->lessons->count() > 0)
                        <div class="section__content__list">
                            <div class="section__dropdown__title">{{$section->title}}</div>
                            <div class="section__dropdown__progress">
                                <div class="section__circle">
                                    <div class="section__circle--small">
                                        <span>{{ $section->section_percent }}%</span>
                                    </div>
                                    <div class="section__circle--bg"
                                         style="background: linear-gradient(270deg, #ADF66B 0%, #00FFC8 {{ $section->section_percent }}%, #E8EAFF 0%);">
                                    </div>
                                </div>
                            </div>
                            <div class="section__dropdown__tasks">
                                @foreach($section->lessons as $key=>$lesson)

                                <div class="section__circle section__circle--task">
                                    <div class="section__circle--small section__circle__task--small">
                                        @if($key === 0 || $lesson->users->first())
                                            <img src="{{ $lesson->template->image }}"  class="section__task__icon" alt="">
                                        @elseif($section->lessons[$key-1]->users->first() && $section->lessons[$key-1]->users->first()->pivot->complete)
                                            <img src="{{ $lesson->template->image }}"  class="section__task__icon" alt="">
                                        @else
                                            <img src="{{ asset('/design/images/lock-icon.png') }}" height="20" alt="">
                                        @endif
                                    </div>
                                    <div class="section__circle--bg"

                                         @if($lesson->users->first() && $lesson->users->first()->pivot->complete)
                                            style="background: linear-gradient(270deg, #ADF66B 0%, #00FFC8 100%, #E8EAFF 0%);"
                                         @elseif($lesson->users->first() && !$lesson->users->first()->pivot->complete)
                                            style="background: linear-gradient(270deg, #ADF66B -30%, #FF3D00 15%, #E8EAFF 0%);"
                                         @else

                                         @endif
                                    >

                                    </div>
                                    @if($key === 0 || $lesson->users->first())
                                    <a href="{{ route('dashboard.lesson', [$lesson->section->level->name, $lesson->section->name, $lesson->name]) }}"
                                        class="section__task__link"></a>
                                    @elseif($section->lessons[$key-1]->users->first() && $section->lessons[$key-1]->users->first()->pivot->complete)
                                    <a href="{{ route('dashboard.lesson', [$lesson->section->level->name, $lesson->section->name, $lesson->name]) }}"
                                       class="section__task__link"></a>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    @endforeach
                    </div>

                @endif
            </div>
        </div>
        @endif
        @endforeach
    </div>

    <!--End Levels -->




@endsection