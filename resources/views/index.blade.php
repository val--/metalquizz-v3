@extends('layouts.app')
@section('content')
	<v-app>

		<!-- Menu -->
		<v-app-bar app dark>
			<v-toolbar-title>Metal Quizz</v-toolbar-title>
			<v-spacer></v-spacer>
			<v-btn to='/'>Home</v-btn>
			<v-btn to='/dashboard'>Dashboard</v-btn>
			<v-btn to='/login'>Login</v-btn>
			<v-btn to='/register'>Register</v-btn>
		</v-app-bar>

		<!-- Main content -->
		<v-main>
			<v-container fluid>
				<router-view></router-view>
			</v-container>
		</v-main>

		<!-- Footer -->
		<v-footer app dark>
			<v-row justify="center"no-gutters>
				<v-col class="text-center" cols="12">2020 — <strong>Metalquizz</strong></v-col>
			</v-row>
		</v-footer>
	</v-app>
@endsection