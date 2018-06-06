<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Games</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
</head>
<body>
<br>
<div class="container">@if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br />
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th class="ali_direita">Time Casa</th>
            <th class="ali_direita"></th>
            <th class="ali_centro">Placar</th>
            <th></th>
            <th class="ali_esquerda">Time Visitante</th>
        </tr>
        </thead>
        <tbody>
            {{--@php--}}
            {{--$date=date('Y-m-d', $team['date']);--}}
            {{--@endphp--}}
            <tr>
                <td>{{$game['id']}}</td>
                <td>{{$game['data']}}</td>
                <td class="ali_direita">{{$team = App\Team::find($game['teams_casa'])->nome}}</td>
                <td class="ali_direita">{{$game['placar_casa']}}</td>
                <th class="ali_centro">x</th>
                <td class="ali_esquerda">{{$game['placar_visitante']}}</td>
                <td>{{$team = App\Team::find($game['teams_visitante'])->nome}}</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-striped">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Nome</th>
            <th>Gol(s)</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        {{--@php--}}
        {{--$date=date('Y-m-d', $team['date']);--}}
        {{--@endphp--}}
        @foreach($gols as $gol)
            <tr>
                <td></td>
                <td></td>
                <td>{{$nome = \App\Player::find($gol->players_id)->nome}}</td>
                <td>{{$gol->gols}}</td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <h2 class="ali_centro">Add Gol</h2><br/>
    <hr>
    <form method="post" action="{{action('InfoGoalController@update', $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label>Quantidade de Gol(s)</label>
                <input type="text" class="form-control" name="quantidade">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <lable ><b>Jogador</b></lable>
                <select class="form-control" multiple id="exampleFormControlSelect2" style="margin-top:5px" name="jogador">
                    @foreach($players as $player)
                        @if(($player['teams_id']==$game['teams_casa']) || ($player['teams_id']==$game['teams_visitante']))
                            <option value="{{$player['id']}}">{{$player['nome']}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-2" style="margin-top:5px">
                <button type="submit" class="btn btn-success">ADICIONAR</button>
            </div>
            <div class="form-group col-md-2" style="margin-top: 5px;">
                <a class="btn btn-danger" href="{{ URL::to('games') }}">BACK</a>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
</script>
</body>
</html>