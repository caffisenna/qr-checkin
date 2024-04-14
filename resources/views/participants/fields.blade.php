<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '氏名:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('bsid', '登録番号:') !!}
    {!! Form::text('bsid', null, [
        'class' => 'form-control',
        'maxlength' => '11',
        'pattern' => '^\d{1,11}$',
        'title' => '半角整数11桁以内で入力してください',
        'required' => true,
    ]) !!}
    @error('bsid')
        <div class="error text-danger">{{ $message }}</div>
    @enderror
</div>


<!-- Prefecture Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prefecture', '県連盟:') !!}
    {!! Form::text('prefecture', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- District Field -->
<div class="form-group col-sm-6">
    {!! Form::label('district', '地区:') !!}
    {!! Form::text('district', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role', '役務:') !!}
    {!! Form::text('role', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Field1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('field1', 'フィールド1:') !!}
    {!! Form::text('field1', null, ['class' => 'form-control']) !!}
</div>

<!-- Field2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('field2', 'フィールド2:') !!}
    {!! Form::text('field2', null, ['class' => 'form-control']) !!}
</div>

<!-- Field3 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('field3', 'フィールド3:') !!}
    {!! Form::text('field3', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('event_id', 'イベント:') !!}
    {{-- {!! Form::text('event_id', null, ['class' => 'form-control']) !!} --}}
    <select name="event_id" id="" class="form-control">
        <option value=""></option>
        @foreach ($events as $event)
            @if (isset($participants))
                <option value="{{ $event->uuid }}" {{ $event->uuid == $participants->event_id ? 'selected' : '' }}>
                    {{ $event->name }}</option>
            @else
                <option value="{{ $event->uuid }}">
                    {{ $event->name }}</option>
            @endif
        @endforeach
    </select>
</div>
