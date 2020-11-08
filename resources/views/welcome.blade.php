@extends('layouts.app')
@section('content')


	<v-app>
		<v-navigation-drawer app>
		<ul>
			<li>
				<router-link to='/'>Home</router-link>
			</li>
			<li>
				<router-link to='/about'>About</router-link>
			</li>
		</ul>
		</v-navigation-drawer>

		<v-app-bar app>
		Bienvenue !
		</v-app-bar>

		<!-- Sizes your content based upon application components -->
		<v-main>

		<!-- Provides the application the proper gutter -->
		<v-container fluid>
			<!-- If using vue-router -->
			<router-view></router-view>
		</v-container>
		</v-main>

		<v-footer app>
		<!-- -->
		</v-footer>
	</v-app>
	
@endsection
