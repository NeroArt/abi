


<div class="wrapper wrapper--w790">
    <div class="card card-5">

        <div class="card-body">

{{-- originalmente no era waiting-form, era is-invalid (Pone el div color rojo, si esta incorrecto) --}}




<div class="form-group">
    <label class="control-label" for="nivel">Nivel</label>
    <select class="input100 {{$errors->has('nivel')?'waiting-form':old('nivel')}}" type="text" value="{{ isset($grupo->nivel)?$grupo->nivel:'' }}" name="nivel" id="nivel" required>
    <option class="invalid-feedback2" value="{{ isset($grupo->nivel)?$grupo->nivel:'' }}">{{ isset($grupo->nivel)?$grupo->nivel: 'selecciona una opción' }}</option>
    <option>Inicial</option>
    <option>Básico</option>
    <option>Intermedio</option>
    <option>Avanzado</option>
</select>    

    {!! $errors->first('nivel','<div class="invalid-feedback">:message</div>') !!}
</div>



<div class="form-group">

    <label class="control-label" for="grado">Grado</label>
    <select class="input100 {{$errors->has('grado')?'waiting-form':old('grado')}}" type="text" value="{{ isset($grupo->grado)?$grupo->grado:'' }}" name="grado" id="grado" required>

        {{-- invalid-feedback2 sirve para marcar que era una opcion anterior --}}
        <option class="invalid-feedback2" value="{{ isset($grupo->grado)?$grupo->grado:'' }}">{{ isset($grupo->grado)?$grupo->grado:'selecciona una opción' }}</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
    </select>    

    {!! $errors->first('grado','<div class="invalid-feedback">:message</div>') !!}
    
</div>




<div class="form-group">
    <label class="control-label" for="seccion">Sección</label>
    <select class="input100 {{$errors->has('seccion')?'waiting-form':old('seccion')}}" type="text" value="{{ isset($grupo->seccion)?$grupo->seccion:'' }}" name="seccion" id="seccion" required>
        <option class="invalid-feedback2" value="{{ isset($grupo->seccion)?$grupo->seccion:'' }}">{{ isset($grupo->seccion)?$grupo->seccion: 'selecciona una opción' }}</option>
        <option>A</option>
        <option>B</option>
    </select>    

    {!! $errors->first('seccion','<div class="invalid-feedback">:message</div>') !!}

</div>



<div class="form-group">
    <label class="control-label" for="descripcion">Descripcion</label>
    <input class="input101 {{$errors->has('descripcion')?'waiting-form':old('descripcion')}}" type="text" value="{{ isset($grupo->descripcion)?$grupo->descripcion:'' }}" name="descripcion" id="descripcion" placeholder="Ejemplo: Curso Septiembre-Noviembre 2021" required />

    {!! $errors->first('descripcion','<div class="invalid-feedback">:message</div>') !!}
</div>


<div class="form-group">
    <label class="control-label" for="fecha_inicio">Fecha de inicio del curso (Antes que la fecha del fin de curso)</label>
    <input class="input100 {{$errors->has('fecha_inicio')?'waiting-form':old('fecha_inicio')}}" type="date" value="{{ isset($grupo->fecha_inicio)?$grupo->fecha_inicio:'' }}" name="fecha_inicio" id="fecha_inicio"  required />

    {!! $errors->first('fecha_inicio','<div class="invalid-feedback">:message</div>') !!}
</div>



<div class="form-group">
    <label class="control-label" for="fecha_fin">Fecha de final del curso (Posterior al inicio del curso)</label>
    <input class="input100 {{$errors->has('fecha_fin')?'waiting-form':old('fecha_fin')}}" type="date" value="{{ isset($grupo->fecha_fin)?$grupo->fecha_fin:'' }}" name="fecha_fin" id="fecha_fin" required />

    {!! $errors->first('fecha_fin','<div class="invalid-feedback">:message</div>') !!}
</div>


<!-- /////////////////////////////////////////////////////////////////////////////////////////// -->


<div class="wrapper wrapper--w790">

    <div style="background-color:#dde3e3;border: 1px solid rgb(0, 0, 0); width:100%; padding:20px;">

<label class="control-label" for="lunes" ><h4>¿Qué días se practicaran los entrenamientos?
</h4></label>
<label for="" style="color:#a02a0d;"><strong>Obligatorio activar un día, como mínimo.</strong></label>
<br>
<div class="form-group">
    <label class="control-label" for="lunes" >Lunes</label>
    <select class="input100 {{$errors->has('lunes')?'waiting-form':old('lunes')}}" type="text" value="{{ isset($grupo->lunes)?$grupo->lunes:'' }}" name="lunes" id="lunes" required>
    <option class="invalid-feedback2" value="{{ isset($grupo->lunes)?$grupo->lunes:'' }}">{{ isset($grupo->lunes)?$grupo->lunes: 'Selecciona una opción' }}</option>
    <option>Activo</option>
    <option>Inactivo</option>
</select>    
<br>
<label class="control-label" for="martes" > Martes</label>
    <select class="input100 {{$errors->has('martes')?'waiting-form':old('martes')}}" type="text" value="{{ isset($grupo->martes)?$grupo->martes:'' }}" name="martes" id="martes" required>
    <option class="invalid-feedback2" value="{{ isset($grupo->martes)?$grupo->martes:'' }}">{{ isset($grupo->martes)?$grupo->martes: 'Selecciona una opción' }}</option>
    <option>Activo</option>
    <option>Inactivo</option>
</select>    
<br>
<label class="control-label" for="miercoles" >Miércoles </label>
    <select class="input100 {{$errors->has('miercoles')?'waiting-form':old('miercoles')}}" type="text" value="{{ isset($grupo->miercoles)?$grupo->miercoles:'' }}" name="miercoles" id="miercoles" required>
    <option class="invalid-feedback2" value="{{ isset($grupo->miercoles)?$grupo->miercoles:'' }}">{{ isset($grupo->miercoles)?$grupo->miercoles: 'Selecciona una opción' }}</option>
    <option>Activo</option>
    <option>Inactivo</option>
</select>    

<br>
<label class="control-label" for="jueves" >Jueves</label>
    <select class="input100 {{$errors->has('jueves')?'waiting-form':old('jueves')}}" type="text" value="{{ isset($grupo->jueves)?$grupo->jueves:'' }}" name="jueves" id="jueves" required>
    <option class="invalid-feedback2" value="{{ isset($grupo->jueves)?$grupo->jueves:'' }}">{{ isset($grupo->jueves)?$grupo->jueves: 'Selecciona una opción' }}</option>
    <option>Activo</option>
    <option>Inactivo</option>
</select>    
<br>
<label class="control-label" for="viernes" >Viernes</label>
    <select class="input100 {{$errors->has('viernes')?'waiting-form':old('viernes')}}" type="text" value="{{ isset($grupo->viernes)?$grupo->viernes:'' }}" name="viernes" id="viernes" required>
    <option class="invalid-feedback2" value="{{ isset($grupo->viernes)?$grupo->viernes:'' }}">{{ isset($grupo->viernes)?$grupo->viernes: 'Selecciona una opción' }}</option>
    <option>Activo</option>
    <option>Inactivo</option>
</select>    
<br>
<label class="control-label" for="sabado" >Sábado </label>
    <select class="input100 {{$errors->has('sabado')?'waiting-form':old('sabado')}}" type="text" value="{{ isset($grupo->sabado)?$grupo->sabado:'' }}" name="sabado" id="sabado" required>
    <option class="invalid-feedback2" value="{{ isset($grupo->sabado)?$grupo->sabado:'' }}">{{ isset($grupo->sabado)?$grupo->sabado: 'Selecciona una opción' }}</option>
    <option>Activo</option>
    <option>Inactivo</option>
</select>    
<br>
<label class="control-label" for="domingo" >Domingo</label>
    <select class="input100 {{$errors->has('domingo')?'waiting-form':old('domingo')}}" type="text" value="{{ isset($grupo->domingo)?$grupo->domingo:'' }}" name="domingo" id="domingo" required>
    <option class="invalid-feedback2" value="{{ isset($grupo->domingo)?$grupo->domingo:'' }}">{{ isset($grupo->domingo)?$grupo->domingo: 'Selecciona una opción' }}</option>
    <option>Activo</option>
    <option>Inactivo</option>
</select>    



</div>
</div>
</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////// -->

<br>
<div class="form-group">
    <label class="control-label" for="estado">Estado</label>
    <select class="input100 {{$errors->has('estado')?'waiting-form':old('estado')}}" type="text" value="{{ isset($grupo->estado)?$grupo->estado:'' }}" name="estado" id="estado" required>
    <option class="invalid-feedback2" value="{{ isset($grupo->estado)?$grupo->estado:'' }}">{{ isset($grupo->estado)?$grupo->estado: 'Selecciona una opción' }}</option>
    <option>Activo</option>
    <option>Inactivo</option>
</select>    

    {!! $errors->first('estado','<div class="invalid-feedback">:message</div>') !!}
</div>




<input type="submit" class="btn btn-success" value="{{$Modo=='crear' ? 'Agregar':'Modificar'}}">

{{-- Se agrega para para dirigirse a listadogrupos o principal de grupos --}}


</div>

</div>
</div>

