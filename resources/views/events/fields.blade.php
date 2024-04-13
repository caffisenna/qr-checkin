<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'カテゴリ:') !!}
    {!! Form::text('category', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'イベント名:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', '開催日:') !!}
    {!! Form::date('date', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Prefecture Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prefecture', '県連:') !!}
    {!! Form::text('prefecture', null, ['class' => 'form-control',]) !!}
</div>

<!-- District Field -->
<div class="form-group col-sm-6">
    {!! Form::label('district', '地区:') !!}
    {!! Form::text('district', null, ['class' => 'form-control',]) !!}
</div>
