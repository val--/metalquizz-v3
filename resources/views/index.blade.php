@extends('layouts.app')
@section('content')
	<v-app style="background: rgba(0,0,0,0);">

		<!-- Menu -->
		<menubar></menubar>

		<!-- Main content -->
		<v-main>
			<v-container>
				<transition name="fade" mode="out-in">
					<router-view></router-view>
				</transition>
			</v-container>
		</v-main>

		<!-- Footer -->
		<v-footer app>
			<v-row justify="center">
				<v-col class="text-center" cols="12">2020 — <strong>Metalquizz</strong></v-col>
			</v-row>
		</v-footer>

	</v-app>
@endsection