@extends('users::layouts.master')

@section('title', __('Currencies Settings'))

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('content')
<div style="max-width: 1200px; margin: 10px auto; margin-left:10px; padding: 0 15px;">
    <!-- Success Messages -->
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header Section -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 15px;">
        <h1 style="font-size: 28px; color: #333; margin: 0;">{{ __('Currencies Settings') }}</h1>
        <button 
            style="background: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;"
            data-bs-toggle="modal" 
            data-bs-target="#addCurrencyModal"
        >
            {{ __('Add New') }}
        </button>
    </div>

    <!-- Search Form -->
    <div style="margin-bottom: 20px; display: flex; justify-content: flex-start;">
        <form method="GET" action="{{ route('settings.currencies.index') }}" style="width: 100%; max-width: 400px;">
            <div class="input-group">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request()->get('search') }}" 
                    class="form-control" 
                    placeholder="{{ __('Search by currency name or code') }}" 
                    style="border-radius: 5px 0 0 5px; border: 1px solid #ced4da;">
                <button class="btn btn-outline-secondary" type="submit" style="border-radius: 0 5px 5px 0;">{{ __('Search') }}</button>
            </div>
        </form>
    </div>

    <!-- Currencies Table -->
    <div style="background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa;">
                    <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee;">{{ __('Currency Name') }}</th>
                    <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee;">{{ __('Code') }}</th>
                    <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee;">{{ __('Symbol') }}</th>
                    <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee;">{{ __('Exchange Rate') }}</th>
                    <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee;">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($currencies as $currency)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 15px;">{{ $currency->name }}</td>
                    <td style="padding: 15px;">{{ $currency->code }}</td>
                    <td style="padding: 15px;">{{ $currency->symbol }}</td>
                    <td style="padding: 15px;">{{ $currency->exchange_rate }}</td>
                    <td style="padding: 15px; display: flex; gap: 10px;">
                        <!-- Edit Button -->
                        <button 
                            style="background: #ffc107; color: black; border: none; padding: 5px 12px; border-radius: 4px; cursor: pointer;"
                            data-bs-toggle="modal" 
                            data-bs-target="#editCurrencyModal"
                            data-currency="{{ $currency->toJson() }}"
                        >
                            {{ __('Edit') }}
                        </button>

                        <!-- Delete Button -->
                        <form action="{{ route('settings.currencies.destroy', $currency->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                style="background: #dc3545; color: white; border: none; padding: 5px 12px; border-radius: 4px; cursor: pointer;"
                            >
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Currency Modal -->
    <div class="modal fade" id="addCurrencyModal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 500px; margin: 1.75rem auto;">
            <div class="modal-content" style="border: none; border-radius: 8px;">
                <div class="modal-header" style="padding: 1rem; border-bottom: 1px solid #dee2e6;">
                    <h5 style="font-size: 1.25rem; margin: 0;">{{ __('Add New Currency') }}</h5>
                    <button type="button" style="border: none; background: none; font-size: 1.5rem;" data-bs-dismiss="modal">×</button>
                </div>
                <form method="POST" action="{{ route('settings.currencies.store') }}">
                    @csrf
                    <div class="modal-body" style="padding: 1rem;">
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem;">{{ __('Currency Name') }}</label>
                            <input 
                                type="text" 
                                name="name" 
                                style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 4px;"
                                required
                            >
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem;">{{ __('Currency Code') }}</label>
                            <input 
                                type="text" 
                                name="code" 
                                style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 4px;"
                                required
                            >
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem;">{{ __('Currency Symbol') }}</label>
                            <input 
                                type="text" 
                                name="symbol" 
                                style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 4px;"
                                required
                            >
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem;">{{ __('Exchange Rate') }}</label>
                            <input 
                                type="number" 
                                name="exchange_rate" 
                                step="0.0001"
                                style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 4px;"
                                required
                            >
                        </div>
                    </div>
                    <div class="modal-footer" style="padding: 1rem; border-top: 1px solid #dee2e6;">
                        <button 
                            type="submit" 
                            style="background: #28a745; color: white; padding: 0.375rem 0.75rem; border: none; border-radius: 4px; cursor: pointer;"
                        >
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Currency Modal -->
    <div class="modal fade" id="editCurrencyModal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 500px; margin: 1.75rem auto;">
            <div class="modal-content" style="border: none; border-radius: 8px;">
                <div class="modal-header" style="padding: 1rem; border-bottom: 1px solid #dee2e6;">
                    <h5 style="font-size: 1.25rem; margin: 0;">{{ __('Edit Currency') }}</h5>
                    <button type="button" style="border: none; background: none; font-size: 1.5rem;" data-bs-dismiss="modal">×</button>
                </div>
                <form method="POST" id="editCurrencyForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body" style="padding: 1rem;">
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem;">{{ __('Currency Name') }}</label>
                            <input 
                                type="text" 
                                name="name" 
                                style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 4px;"
                                required
                            >
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem;">{{ __('Currency Code') }}</label>
                            <input 
                                type="text" 
                                name="code" 
                                style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 4px;"
                                required
                            >
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem;">{{ __('Currency Symbol') }}</label>
                            <input 
                                type="text" 
                                name="symbol" 
                                style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 4px;"
                                required
                            >
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem;">{{ __('Exchange Rate') }}</label>
                            <input 
                                type="number" 
                                name="exchange_rate" 
                                step="0.0001"
                                style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 4px;"
                                required
                            >
                        </div>
                    </div>
                    <div class="modal-footer" style="padding: 1rem; border-top: 1px solid #dee2e6;">
                        <button 
                            type="submit" 
                            style="background: #28a745; color: white; padding: 0.375rem 0.75rem; border: none; border-radius: 4px; cursor: pointer;"
                        >
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('[data-bs-target="#editCurrencyModal"]').forEach(button => {
    button.addEventListener('click', function() {
        const currency = JSON.parse(this.dataset.currency);
        const form = document.querySelector('#editCurrencyForm');
        form.action = `/settings/currencies/${currency.id}`;
        form.querySelector('[name="name"]').value = currency.name;
        form.querySelector('[name="code"]').value = currency.code;
        form.querySelector('[name="symbol"]').value = currency.symbol;
        form.querySelector('[name="exchange_rate"]').value = currency.exchange_rate;
    });
});
</script>
@endsection