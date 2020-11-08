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
								<li>
					<router-link to='/login'>Login</router-link>
				</li>
				<li>
					<router-link to='/register'>Register</router-link>
				</li>
				<li>
					<router-link to='/dashboard'>Dashboard</router-link>
				</li>
			</ul>
		</v-navigation-drawer>

		<v-app-bar app>
			Bienvenue !
		</v-app-bar>

		<v-main>
			<v-container fluid>
				<router-view></router-view>
			</v-container>
		</v-main>
		<v-footer app>
		<!-- -->
		</v-footer>
	</v-app>
@endsection
