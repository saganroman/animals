@extends('layouts.app')
@section('title','| Головна')
@section('content')
    <script>
        var markers = [];
        <?php
                foreach ($animals as $animal)
                {
                $LatLng = false;
                $LatLng = explode(',', $animal->LatLn);
                ?>

                marker = ['{{$animal->name}}', '<?php echo $animal->species->name;?>', '{!! $animal->breed->name !!}', '<?php echo trim($animal->content); ?>', '{!!URL::asset('images')!!}/{{$animal->photo}} ', '{!!URL::asset('images')!!}/s_{{$animal->photo}} ', '{{$animal->address}}', '<?php echo trim($LatLng[0]);?>', '<?php echo trim($LatLng[1]);?>'];
        markers.push(marker);
        <?php  }
        ?>
        //  console.log($animal->species);


    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-10">

                <div id="map"></div>

                <script>


                </script>


            </div>

            <div class="col-md-2">

                <form action="/search" method="get">
                    {{ csrf_field() }}

                    <div class=" form-group">
                        <label for="Input2">Вид тварини</label>
                        <select class=" form-control" id="Input2" name="species">
                            <option selected> Всі</option>

                            @foreach( $species as $specy)
                                @if ((isset($s))and($specy->id==$s)) {
                                <option selected value="{{$specy->id}}">{{$specy->name}}</option>}
                                @else{
                                <option value="{{$specy->id}}">{{$specy->name}}</option>}
                                @endif
                            @endforeach


                        </select>

                    </div>
                    <div class=" form-group">
                        <label for="Input3">Порода тварини</label>
                        <select class=" form-control" id="Input3" name="breed" disabled>
                            @if((isset($b))and   ($b!='Всі')){<option selected> <?php echo($br->name);?> </option>}
                            @else{<option selected> Всі</option>}
                                @endif
                        </select>
                    </div>
                    <button type="submit" class="btn  btn-success myBtn">Шукати!</button>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHnwJxlNzPi5tU6LVJaRFrqKWLPwuUvjA&libraries=places,drawing&callback=initMap"
            async defer></script>

    <script type="text/javascript" src="{{ URL::asset('js/handler.js') }}"></script>
@endsection
