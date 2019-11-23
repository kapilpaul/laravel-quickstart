@extends('layouts.blank')

@section('title', '404')

@section('main_content')
	<!-- main area -->
	<div class="main-content no-padding">
		<div class="page-height row-equal align-middle text-center">
			<div class="column">
				<div class="error-number">
					<span>404</span>
				</div>
				<div class="m-b h4">PAGE NOT FOUND</div>
				<p>Sorry, but the page you were trying to view does not exist.</p>
				<a href="/" class="btn btn-primary m-r">Return home</a>
			</div>
		</div>
	</div>
	<!-- /main area -->
@stop
