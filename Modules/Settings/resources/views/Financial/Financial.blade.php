@extends('users::layouts.master')

@section('title', __('Financial Settings'))

@section('content')
<div class="container">
    <h2 class="mb-4">{{ __('Financial Settings') }}</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Currency Settings -->
    <form method="POST" action="{{ route('settings.currency.save') }}" class="card mb-4">
        @csrf
        <div class="card-body">
            <h5 class="card-title text-primary mb-3">{{ __('Currency Settings') }}</h5>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">{{ __('Default Currency') }}</label>
                    <select name="default_currency" class="form-select">
                        @foreach(['USD', 'EUR', 'IQD'] as $code)
                        <option value="{{ $code }}" {{ $code == $currency->default_currency ? 'selected' : '' }}>{{ $code }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">{{ __('Price Display') }}</label>
                    <select name="price_display" class="form-select">
                        <option value="symbol" {{ $currency->price_display == 'symbol' ? 'selected' : '' }}>
                            {{ __('Currency Symbol') }}
                        </option>
                        <option value="name" {{ $currency->price_display == 'name' ? 'selected' : '' }}>
                            {{ __('Currency Name') }}
                        </option>
                    </select>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Save Changes') }}
                </button>
            </div>
        </div>
    </form>

    <!-- Tax Settings -->
    <form method="POST" action="{{ route('settings.tax.save') }}" class="card mb-4">
        @csrf
        <div class="card-body">
            <h5 class="card-title text-primary mb-3">{{ __('Tax Settings') }}</h5>

            <div class="row g-3">
                @foreach($countries as $country)
                    <div class="col-md-6">
                        <label class="form-label">{{ $country->name['en'] }} ({{ __('Tax Rate (%)') }})</label>
                        <input type="number" 
                               name="tax_rates[{{ $country->id }}]" 
                               value="{{ old('tax_rates.' . $country->id, $country->taxSetting->default_rate ?? 0) }}" 
                               class="form-control"
                               min="0" 
                               step="0.01">
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Save Changes') }}
                </button>
            </div>
        </div>
    </form>

    <!-- Payment Gateway -->
    <form method="POST" action="{{ route('settings.gateway.save') }}" class="card mb-4">
        @csrf
        <div class="card-body">
            <h5 class="card-title text-primary mb-3">{{ __('Payment Gateway') }}</h5>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">{{ __('PayPal API Key') }}</label>
                    <input type="text" name="api_key" 
                        value="{{ old('api_key', $gateway->api_key) }}" 
                        class="form-control">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">{{ __('PayPal Secret Key') }}</label>
                    <input type="text" name="secret_key" 
                        value="{{ old('secret_key', $gateway->secret_key) }}" 
                        class="form-control">
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2">
                    {{ __('Save Changes') }}
                </button>
                <a href="{{ route('settings.gateway.test') }}" class="btn btn-secondary">
                    {{ __('Test Connection') }}
                </a>
            </div>
        </div>
    </form>

    <!-- Invoice Settings -->
    <form method="POST" action="{{ route('settings.invoice.save') }}" enctype="multipart/form-data" class="card mb-4">
        @csrf
        <div class="card-body">
            <h5 class="card-title text-primary mb-3">{{ __('Invoice Settings') }}</h5>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">{{ __('Company Name') }}</label>
                    <input type="text" name="company_name" 
                        value="{{ old('company_name', $invoice->company_name) }}" 
                        class="form-control">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">{{ __('Tax Number') }}</label>
                    <input type="text" name="tax_number" 
                        value="{{ old('tax_number', $invoice->tax_number) }}" 
                        class="form-control">
                </div>
                
                <div class="col-12">
                    <label class="form-label">{{ __('Company Address') }}</label>
                    <textarea name="company_address" class="form-control" rows="3">{{ old('company_address', $invoice->company_address) }}</textarea>
                </div>
                
                <div class="col-12">
                    <label class="form-label">{{ __('Invoice Template') }}</label>
                    <input type="file" name="invoice_template" class="form-control">{{ old('logo_path', $invoice->logo_path) }}
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Save Changes') }}
                </button>
            </div>
        </div>
    </form>

    <form method="POST" action="{{ route('settings.policy.save') }}" class="card mb-4">
        @csrf
        <div class="card-body">
            <h5 class="card-title text-primary mb-3">{{ __('Policies') }}</h5>
    
            <!-- سياسة الدفع -->
            <div class="row g-3">
                <!-- سياسة الدفع -->
<div class="col-12">
    <label class="form-label">{{ __('Payment Policy') }}</label>
    <div class="policy" id="payment_policy_display">
        @if($policies && $policies->payment_policy)
            {!! $policies->payment_policy !!}
        @else
            <p>{{ __('No data available. Please add payment policy.') }}</p>
        @endif
    </div>
    
    <!-- تعديل الشروط هنا -->
    <textarea name="payment_policy" class="form-control" rows="5" id="payment_policy_input" style="display:none;">
        {!! old('payment_policy', $policies->payment_policy ?? '') !!}
    </textarea>
    
    @if($policies && $policies->payment_policy)
        <button type="button" class="btn btn-warning mt-2" id="edit_payment_policy">
            {{ __('Edit') }}
        </button>
    @endif
</div>
                
                <!-- سياسة الاسترداد -->
<div class="col-12">
    <label class="form-label">{{ __('Refund Policy') }}</label>
    <div class="policy" id="refund_policy_display">
        @if($policies && $policies->refund_policy)
            {!! $policies->refund_policy !!}
        @else
            <p>{{ __('No data available. Please add refund policy.') }}</p>
        @endif
    </div>
    
    <!-- تعديل الشروط هنا -->
    <textarea name="refund_policy" class="form-control" rows="5" id="refund_policy_input" style="display:none;">
        {!! old('refund_policy', $policies->refund_policy ?? '') !!}
    </textarea>
    
    @if($policies && $policies->refund_policy)
        <button type="button" class="btn btn-warning mt-2" id="edit_refund_policy">
            {{ __('Edit') }}
        </button>
    @endif
</div>
            </div>
    
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Save Changes') }}
                </button>
            </div>
        </div>
    </form>
    
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // إظهار/إخفاء الحقول حسب الحالة الأولية
        togglePolicyFields('payment');
        togglePolicyFields('refund');
    
        // أحداث النقر على أزرار التعديل
        document.getElementById('edit_payment_policy')?.addEventListener('click', () => togglePolicyEdit('payment'));
        document.getElementById('edit_refund_policy')?.addEventListener('click', () => togglePolicyEdit('refund'));
    
        function togglePolicyFields(type) {
            const displayDiv = document.getElementById(`${type}_policy_display`);
            const inputField = document.getElementById(`${type}_policy_input`);
            const editButton = document.getElementById(`edit_${type}_policy`);
    
            if (inputField.value.trim()) {
                displayDiv.style.display = 'block';
                inputField.style.display = 'none';
                if (editButton) editButton.style.display = 'inline-block';
            } else {
                displayDiv.style.display = 'none';
                inputField.style.display = 'block';
                if (editButton) editButton.style.display = 'none';
            }
        }
    
        function togglePolicyEdit(type) {
            const displayDiv = document.getElementById(`${type}_policy_display`);
            const inputField = document.getElementById(`${type}_policy_input`);
            const editButton = document.getElementById(`edit_${type}_policy`);
    
            displayDiv.style.display = 'none';
            inputField.style.display = 'block';
            if (editButton) editButton.style.display = 'none';
        }
    });
    </script>
@endsection
