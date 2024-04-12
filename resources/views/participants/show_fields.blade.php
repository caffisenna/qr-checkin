<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', '氏名:') !!}
    <p>{{ $participants->name }}</p>
</div>

<!-- BSID Field -->
<div class="col-sm-12">
    {!! Form::label('bsid', '登録番号:') !!}
    <p>{{ $participants->bsid }}</p>
</div>

<!-- Uuid Field -->
<div class="col-sm-12">
    {!! Form::label('uuid', 'UUID:') !!}
    <p>{{ $participants->uuid }}</p>
</div>

<!-- Prefecture Field -->
<div class="col-sm-12">
    {!! Form::label('prefecture', '県連:') !!}
    <p>{{ $participants->prefecture }}</p>
</div>

<!-- District Field -->
<div class="col-sm-12">
    {!! Form::label('district', '地区:') !!}
    <p>{{ $participants->district }}</p>
</div>

<!-- Role Field -->
<div class="col-sm-12">
    {!! Form::label('role', '役務:') !!}
    <p>{{ $participants->role }}</p>
</div>

<!-- Field1 Field -->
<div class="col-sm-12">
    {!! Form::label('field1', '自由フィールド:') !!}
    <p>{{ $participants->field1 }}</p>
</div>

<!-- Field2 Field -->
<div class="col-sm-12">
    {!! Form::label('field2', '自由フィールド2:') !!}
    <p>{{ $participants->field2 }}</p>
</div>

<!-- Field3 Field -->
<div class="col-sm-12">
    {!! Form::label('field3', '自由フィールド3:') !!}
    <p>{{ $participants->field3 }}</p>
</div>

<!-- Event Id Field -->
<div class="col-sm-12">
    {!! Form::label('event_id', 'イベントID:') !!}
    <p>{{ $participants->event_id }}</p>
</div>

<!-- チェックイン Field -->
<div class="col-sm-12">
    {!! Form::label('checked_in_at', 'チェックイン:') !!}
    <p>{{ $participants->checked_in_at }}</p>
</div>

