<h3>Nuevo jugador</h3>
<hr>
<form action="{{route('player.store')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" name="team_id" value="{{$team_id}}">
    <input type="hidden" name="type_team" value="{{$team->type}}">
    {{--Campos basicos--}}
    <div class="form-group row">
        <div class="col-md-6">
            <label>Nombre</label>
            <input type="text"
                   name="name"
                   required
                   value="{{ old('name') }}"
                   maxlength="100"
                   class="form-control" placeholder="Ingrese nombre">
        </div>
        <div class="col-md-6">
            <label>Apellido</label>
            <input type="text"
                   name="last_name"
                   required
                   value="{{ old('last_name') }}"
                   maxlength="100"
                   placeholder="Ingrese Apellido"
                   class="form-control">
        </div>

    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label>Dni</label>
            <input type="text"
                   name="dni"
                   maxlength="20"
                   value="{{ old('dni', 0000000000) }}"
                   placeholder="Ingrese Dni"
                   class="form-control">
        </div>
        <div class="col-md-6">
            <label>Edad</label>
            <input type="number"
                   name="age"
                   value="{{old('age', 18)}}"
                   placeholder="Ingrese edad"
                   class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label>Genero</label>
            <select name="type" class="form-control">
                <option value="Male">Masculino</option>
                <option value="Female">Femenino</option>
            </select>
        </div>
        <div class="col-md-6">
            <label>Número de Camiseta</label>
            <input type="number"
                   required
                   name="number"
                   class="form-control"
                   placeholder="Ingrese el numero de camiseta" value="{{ old('number', 0) }}">
        </div>
    </div>
    <div class="form-group">
        <label>Observaciones</label>
        <textarea name="observation" cols="30" rows="5" class="form-control">

                        </textarea>
        <br>
        <input type="submit" value="Guardar" class="btn btn-success">
    </div>
</form>