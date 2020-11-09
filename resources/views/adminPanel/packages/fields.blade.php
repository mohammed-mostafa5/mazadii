<div class="row">
    <div class="col nav-tabs-boxed">

        <ul class="nav nav-pills mb-1" id="pills-tab" role="tablist">
            @php $i = 1; @endphp
            @foreach ( config('langs') as $locale => $name)

            <li class="nav-item">
                <a class="nav-link {{request()->filled('languages')? request('languages') == $name ?'show active':'' : $i?'active':''}}" id="{{$name}}-tab" data-toggle="pill" href="#{{$name}}" role="tab" aria-controls="{{$name}}" aria-selected="{{request()->filled('languages')? request('languages') == $name ?'show active':'' : $i ? 'true' : 'false'}}">{{$name}}</a>
            </li>

            @php $i = 0; @endphp
            @endforeach
        </ul>

        <div class="tab-content" id="pills-tabContent">

            @php $i = 1; @endphp
            @foreach ( config('langs') as $locale => $name)

            <div class="tab-pane fade {{request()->filled('languages')? request('languages') == $name ?'show active':'' : $i?'show active':''}}" id="{{$name}}" role="tabpanel" aria-labelledby="{{$name}}-tab">
                <!-- name Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('name', __('models/packages.fields.name').':') !!}
                    {!! Form::text($locale . '[name]', isset($package)? $package->translateOrNew($locale)->name : '' ,
                    ['class' =>'form-control', 'placeholder' => $name . ' name']) !!}
                </div>
                <!-- duration Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('duration', __('models/packages.fields.duration').':') !!}
                    {!! Form::text($locale . '[duration]', isset($package)? $package->translateOrNew($locale)->duration : '' ,
                    ['class' =>'form-control', 'placeholder' => $name . ' duration']) !!}
                </div>
            </div>

            @php $i = 0; @endphp
            @endforeach


            <!-- Price Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('price', __('models/packages.fields.price').':') !!}
                {!! Form::number('price', null, ['class' => 'form-control']) !!}
            </div>


            <div class="container">
                <h3>Features</h3>
                <div class="row text-center">
                    <div class="col-6">
                        <h4>Name</h4>
                    </div>
                    <div class="col-6">
                        <h4>Value</h4>
                    </div>

                </div>
                <br>
                @if(isset($package))
                
                    @forelse ($package->features as $feature)
                        <div class="row text-center">
                            <div class="col-6">{{$feature->name}}</div>
                            
                            <div class="col-6">{!! Form::text("value[$feature->id]", $feature->pivot->value, ['class' => 'form-control', 'required' => 'required']) !!}</div>
                        </div>
                    @empty
                        @foreach ($features as $feature)
                            <div class="row text-center">
                                <div class="col-6">{{$feature->name}}</div>
                                
                                <div class="col-6">{!! Form::text("value[$feature->id]", null , ['class' => 'form-control', 'required' => 'required']) !!}</div>
                            </div>
                        @endforeach
                    @endforelse
                @else
                        @foreach ($features as $feature)
                            <div class="row text-center">
                                <div class="col-6">{{$feature->name}}</div>
                                
                                <div class="col-6">{!! Form::text("value[$feature->id]", null , ['class' => 'form-control', 'required' => 'required']) !!}</div>
                            </div>
                        @endforeach

                @endif

                {{-- <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{$feature->name}}</td>
                <td>
                    {!! Form::text('value', null, ['class' => 'form-control']) !!}
                </td>
                </tr>
                @endforeach
                </tbody>
                </table> --}}
            </div>


            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('adminPanel.packages.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>


        </div>
    </div>
</div>