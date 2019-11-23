@extends('layouts.blank')

@section('title', '404')

@section('main_content')
	<!-- main area -->
	<div class="main-content no-padding">
		<div class="page-height-o row-equal align-middle text-center">
			<div class="column">
				<div class="error-number">
					<span>500</span>
				</div>
				<div class="text-uppercase h4">Internal server error</div>
				<p>We are sorry but your request contains bad syntax and cannot be fulfilled..</p>
				<p>{{ $exception->getMessage() }}</p>
				<a href="/" class="btn btn-primary m-r">Return home</a>
			</div>
		</div>
	</div>
	<!-- /main area -->
@stop
