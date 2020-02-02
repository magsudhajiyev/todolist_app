<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name', 'TODOLIST')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


        <!-- Styles -->
        <style>
            img{
                width: 350px;
                height: 350px;
                border-shadow: 200px;
                padding: 15px;
                position: absolute;
                top: 50%;
                left: 50%;
                -webkit-transform: translate(-50%,-50%);
                -moz-box-shadow: 1px 2px 3px rgba(0,0,0,.5);
                -webkit-box-shadow: 1px 2px 3px rgba(0,0,0,.5);
                box-shadow: 1px 2px 3px rgba(0,0,0,.5);
            }

            body{
                background-color: rgba(246,246,246);
                min-width: 100%;
            }

            .wrapper{
                margin-top: 60px;
                display: flex;
                flex-direction: row;
            }

            .form-group{
                margin: 20px 0;
            }

            .btn-primary{
                margin-top: 10px;
                width: 70px;
            }

            .btn-success{
                margin-right: 5px;
            }

            .btn-danger{
                width: 70px;
            }

            h4{
                margin-right: auto;
            }
        </style>
    </head>
    <body>
        <div class="container">
            {!! Form::open(['action' => 'TodosController@store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {{form::text('body', '', ['class' => 'form-control', 'placeholder' => 'Alışveriş, Spor, Konser v.s.'])}}
                    {{Form::submit('Ekle', ['class' =>'btn btn-primary'])}}
                </div>
            {!! Form::close() !!}
            
            @if(count($todos) > 0 )
                @foreach($todos as $todo)
                    @if($todo->isChecked == 1)
                    <div class="wrapper">
                        <h4><strike>{{$todo->body}}</strike></h4>
                        {!!Form::open(['action'=> ['TodosController@destroy', $todo->id], 'method'=>'POST', 'class'=>'float-right' ])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Sil', ['class' => 'btn btn-danger right'])}}
                        {!!Form::close()!!}
                    </div>
                    <hr>
                    @else
                    <div class="wrapper">
                        <h4>{{$todo->body}}</h4>
                        {!!Form::open(['action'=> ['TodosController@edit', $todo->id], 'method'=>'GET', 'class'=>'float-right' ])!!}
                            {{Form::hidden('_method', 'GET')}}
                            {{Form::submit('Yapıldı', ['class' => 'btn btn-success right'])}}
                        {!!Form::close()!!}

                        {!!Form::open(['action'=> ['TodosController@destroy', $todo->id], 'method'=>'POST', 'class'=>'float-right' ])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Sil', ['class' => 'btn btn-danger right'])}}
                        {!!Form::close()!!}
                    </div>
                    <hr>
                    @endif
                    @endforeach
                @else
                <img src="https://media.giphy.com/media/5qII4FPBe5aqQ/source.gif" alt="lazy-homer">
                @endif
        </div>
    </body>

</html>
