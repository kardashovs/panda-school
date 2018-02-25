@extends('layouts.dashboard')

@section('content')
    <div class="lesson">
        <div class="lesson--border-top"></div>
        <div class="lesson__content">
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
                Ошибка шаблона
            </div>
        </div>
        <div class="lesson--control-panel">
            @include('dashboard.include.skip-button')
            <a href="/dashboard/1/App%5CModels%5CTypeOne/1" class="control__next">Далее</a>
        </div>
    </div>
@endsection