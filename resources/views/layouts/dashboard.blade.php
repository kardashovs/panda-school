<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panda School – Панель ученика школа</title>
    <!--	<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
    <link rel="stylesheet" href="{{ asset('design/css/main.css')  }}">
</head>
<body>

<div class="dashboard" id="app">

    <header>
        <div class="panel">
            <div class="container panel__contaner">
                <div class="logo">
                    <a href="{{ route('dashboard.home') }}" class="logo__link">
                        <img src="{{ asset('design/images/logo.png') }}" srcset="{{ asset('design/images/logo@2x.png') }} 2x" alt="">
                    </a>
                </div>
                <div class="panel__control">
                    <!-- Languages -->
                    <div class="languages">
                        <button class="dropdown--absolute dropdown" data-toggle="languages__menu"></button>
                        <div class="language__active">
                            <div class="language__image">
								<span class="language__flag">
									<img src="{{ asset( Auth::user()->language->icon ) }}" srcset="{{ asset( Auth::user()->language->icon2x ) }} 2x" alt="">
								</span>

                            </div>
                            <div class="language__title">
                                {{ Auth::user()->language->title }}
                            </div>
                            <span class="arrow-down arrow-down--center arrow-down--bottom">
								<img class="arrow-down" src="{{ asset('design/images/arrow_down.png') }}" srcset="{{ asset('design/images/arrow_down@2x.png') }} 2x" alt="">
							</span>
                        </div>
                        <ul class="toggle__menu" id="languages__menu">
                            @foreach( $languages as $language)
                            @if(Auth::user()->language->id !== $language->id)
                            <li class="language__item">
                                <a href="#{{$language->name}}" class="language__item__link" onclick="event.preventDefault();
                                        document.getElementById('language-{{ $language->id }}').submit();">
                                    <div class="language__image">
                                        <span class="language__flag">
                                            <img src="{{ asset( $language->icon ) }}" srcset="{{ asset( $language->icon2x ) }} 2x" alt="">
                                        </span>
                                    </div>
                                    <div class="language__title">
                                        {{ $language->title }}
                                    </div>
                                </a>
                                <form id="language-{{ $language->id }}"
                                      action="{{ route('dashboard.language.changeLearnLanguage', [ $language->id ]) }}"
                                      method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>

                    <!--User -->
                    <div class="user">
                        <button class="dropdown--absolute dropdown" data-toggle="user__menu"></button>
                        <div class="user__profile">
								<span class="user__image">
									<img src="{{ asset('design/images/user.png') }}" srcset="{{ asset('design/images/user@2x.png') }} 2x" alt="">
								</span>
                            <span class="arrow-down user__arrow-down arrow-down--bottom">
								<img class="arrow-down"  src="/design/images/arrow_down.png" srcset="/design/images/arrow_down@2x.png 2x" alt="">
							</span>
                        </div>
                        <ul class="toggle__menu profile" id="user__menu">
                            <li class="profile__item">
                                <a href="#" class="profile__link">
                                    <div class="profile__title">
                                        Профиль
                                    </div>
                                </a>
                            </li>
                            <li class="profile__item">
                                <a href="#" class="profile__link">
                                    <div class="profile__title">
                                        Настройки
                                    </div>
                                </a>
                            </li>
                            <li class="profile__item">
                                <a href="{{ route('logout') }}" class="profile__link" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" >
                                    <div class="profile__title">
                                        Выйти
                                    </div>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </header>

    <div class="container content">
        <div class="body">
            @yield('content')
        </div>

        <div class="sidebar">
            <div class="sidebar--mb progress-bar">
                <div class="progress__title">
                    Общий уровень <br> знаний языка
                </div>
                <div class="progress__status">
                    <div class="progress__level">
                        <div class="progress__level__image">
                            <img src="/design/images/level.png" srcset="/design/images/level@2x.png 2x" alt="">
                        </div>
                        <div class="progress__level__text">
                            Level: 1
                        </div>
                    </div>
                    <div class="progress__per">
                        <div class="progress__level__image">
                            <img src="/design/images/percent.png" srcset="/design/images/percent@2x.png 2x" alt="">
                        </div>
                        <div class="progress__level__text">
                            20%
                        </div>
                    </div>
                    <div class="progress__line">
                        <div class="progress__line__percent" style="width: 30%">

                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar--mb social-links">
                <div class="social-link__title">
                    We in social networks
                </div>
                <div class="social-links__links">
                    <a href="#" class="social-links__link">
                        <img src="/design/images/facebook.png" srcset="/design/images/facebook@2x.png 2x" alt="">
                    </a>
                    <a href="#" class="social-links__link">
                        <img src="/design/images/instagram.png" srcset="/design/images/instagram@2x.png 2x" alt="">
                    </a>
                    <a href="#" class="social-links__link">
                        <img src="/design/images/vk.png" srcset="/design/images/vk@2x.png 2x" alt="">
                    </a>
                </div>
            </div>
        </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.3/lib/draggable.bundle.legacy.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>
<script src="{{ asset('design/js/lib.js') }}"></script>
<script src="{{ asset('design/js/main.js') }}"></script>

@yield('scripts')

</body>
</html>