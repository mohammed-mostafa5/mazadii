<!-- Product Duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_duration', __('models/siteOptions.fields.product_duration').':') !!}
    {!! Form::number('product_duration', null, ['class' => 'form-control']) !!}
</div>

<!-- Deposit Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deposit_percentage', __('models/siteOptions.fields.deposit_percentage').':') !!}
    {!! Form::number('deposit_percentage', null, ['class' => 'form-control']) !!}
</div>

<!-- Subscription Fees Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subscription_fees', __('models/siteOptions.fields.subscription_fees').':') !!}
    {!! Form::number('subscription_fees', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    {{-- <a href="{{ route('adminPanel.siteOptions.index') }}" class="btn btn-default">@lang('crud.cancel')</a> --}}
</div>
