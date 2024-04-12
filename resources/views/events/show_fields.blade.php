<!-- Category Field -->
<div class="col-sm-12">
    {!! Form::label('category', 'カテゴリ:') !!}
    <p>{{ $events->category }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', '氏名:') !!}
    <p>{{ $events->name }}</p>
</div>

<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', '開催日:') !!}
    <p>{{ $events->date }}</p>
</div>

<!-- Uuid Field -->
<div class="col-sm-12">
    {!! Form::label('uuid', 'イベントID:') !!}
    <p>{{ $events->uuid }}</p>
</div>

<!-- Prefecture Field -->
<div class="col-sm-12">
    {!! Form::label('prefecture', '県連盟:') !!}
    <p>{{ $events->prefecture }}</p>
</div>

<!-- District Field -->
<div class="col-sm-12">
    {!! Form::label('district', '地区名:') !!}
    <p>{{ $events->district }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $events->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $events->updated_at }}</p>
</div>

