<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>PandaSchool</title>	
<!--	<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
	<link rel="stylesheet" href="/design/css/main.css">	
</head>
<body>

<div class="dashboard" id="app">
	
	<header>
		<div class="panel">
			<div class="container panel__contaner">
				<div class="logo">
					<a href="/" class="logo__link">
						<img src="/design/images/logo.png" srcset="/design/images/logo@2x.png 2x" alt="">
					</a>
				</div>
				<div class="panel__control">
					<!-- Languages -->
					<a href="#" class="languages dropdown" data-toggle="languages__menu">
						<div class="language__active">
							<div class="language__image">
								<span class="language__flag">
									<img src="/design/images/flags/en.png" srcset="/design/images/flags/en@2x.png 2x" alt="">
								</span>
								
							</div>
							<div class="language__title">
								British English
							</div>
							<span class="arrow-down arrow-down--center arrow-down--bottom">
								<img class="arrow-down" src="/design/images/arrow_down.png" srcset="/design/images/arrow_down@2x.png 2x" alt="">
							</span>
						</div>
						<ul class="toggle__menu" id="languages__menu">
							<li class="language__item">
								<div class="language__image">
									<span class="language__flag">
										<img src="/design/images/flags/en.png" srcset="/design/images/flags/en@2x.png 2x" alt="">
									</span>
								</div>
								<div class="language__title">
									British English
								</div>
							</li>
							<li class="language__item">
								<div class="language__image">
									<span class="language__flag">
										<img src="/design/images/flags/en.png" srcset="/design/images/flags/en@2x.png 2x" alt="">
									</span>
								</div>
								<div class="language__title">
									France
								</div>
							</li>
						</ul>
					</a> 
					
					<!--User -->
					<a href="#" class="user dropdown" data-toggle="user__menu">
						<div class="user__profile">
							<div class="language__image">
								<span class="user__image">
									<img src="/design/images/user.png" srcset="/design/images/user@2x.png 2x" alt="">
								</span>
								
							</div>
							<span class="arrow-down user__arrow-down arrow-down--bottom">
								<img class="arrow-down"  src="/design/images/arrow_down.png" srcset="/design/images/arrow_down@2x.png 2x" alt="">
							</span>
						</div>
						<ul class="toggle__menu profile" id="user__menu">
							<li class="profile__item">
								<div class="profile__title">
									British English
								</div>
							</li>
							<li class="profile__item">
								<div class="language__title">
									France
								</div>
							</li>
						</ul>
					</a> 
					
					
				</div>
			</div>
		</div>
	</header>