@extends('layouts.app')
@section('content')
	<v-app>

		<!-- Menu -->
		<menubar></menubar>

		<!-- Main content -->
		<v-main>
			<v-container>
				<router-view></router-view>
			</v-container>
		</v-main>

		<!-- Footer -->
		<v-footer app color="primary">
			<v-row justify="center">
				<v-col class="text-center" cols="12">2020 — <strong>Metalquizz</strong></v-col>
			</v-row>
		</v-footer>

	</v-app>
@endsection