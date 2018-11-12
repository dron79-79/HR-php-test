@extends('layouts.layout')
@section('title')
    Погода в Брянске
@endsection
@section('content')
    <div class="container">
	<h3>Погода в Бранске</h3>
        <div class="col-xs-6 ">
	    @foreach($weather as $title => $data)
		<div class="col-xs-12">
		    <div class="col-xs-6 item-title">
			@switch($title)
			    @case('temp_now_C')
				Температура (°C)
			    @break
			    @case('humidity_percentage')
				Влажность (%)
			    @break
			    @case('state_desc')
				Описание
			    @break
			    @case('wind_speed_ms')
				Скорость ветра (метр/сек)
			    @break
			    @case('city')
				Город
			    @break
			    @case('date')
				Дата
			    @break
			@endswitch
		    </div>
		    <div class="col-xs-6 item-data">
			{{$data}}
		    </div>
		</div>
	    @endforeach
        </div>
    </div>
@endsection
