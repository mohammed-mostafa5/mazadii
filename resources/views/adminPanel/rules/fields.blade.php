<ul class="nav nav-pills mb-1" id="pills-tab" role="tablist">
    @php $i = 1; @endphp
    @foreach ( config('langs') as $locale => $name)

    <li class="nav-item">
        <a class="nav-link {{$i?'active':''}}" id="{{$name}}-tab" data-toggle="pill" href="#{{$name}}" role="tab" aria-controls="{{$name}}" aria-selected="{{ $i ? 'true' : 'false'}}">{{$name}}</a>
    </li>

    @php $i = 0; @endphp
    @endforeach
</ul>
<div class="tab-content" id="pills-tabContent">
    @php $i = 1; @endphp
    @foreach ( config('langs') as $locale => $name)

    <div class="tab-pane fade {{$i?'show active':''}}" id="{{$name}}" role="tabpanel" aria-labelledby="{{$name}}-tab">
        <!-- title Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('title', __('models/rules.fields.title').':') !!}
            {!! Form::text($locale . '[title]', isset($rule)? $rule->translate($locale)->title : '' , ['class' =>
            'form-control', 'placeholder' => $name . ' title']) !!}
        </div>
        <!-- description Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('description', __('models/rules.fields.description').':') !!}
            {!! Form::textarea($locale . '[description]', isset($rule)? $rule->translate($locale)->description : '' , ['class' =>
            'form-control', 'placeholder' => $name . ' description']) !!}
        </div>

        <script type="text/javascript">
            CKEDITOR.replace("{{ $locale . '[description]' }}", {
                filebrowserUploadUrl: "{{route('adminPanel.ckeditor.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form',
            });
        </script>
    </div>

    @php $i = 0; @endphp
    @endforeach


    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('adminPanel.rules.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
    </div>


</div>
