@extends('users::layouts.master')

@section('title', __('Countries Settings'))

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('content')
<div style="max-width: 1200px; margin: 10px auto;margin-left:10px; padding: 0 15px;">
    <!-- عرض الرسائل -->
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- العنوان -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 15px;">
        <h1 style="font-size: 28px; color: #333; margin: 0;">{{ __('Countries Settings') }}</h1>
        <button 
            style="background: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;"
            data-bs-toggle="modal" 
            data-bs-target="#addCountryModal"
        >
            {{ __('Add New') }}
        </button>
    </div>

    <!-- جدول الدول -->
    <div style="background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa;">
                    <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee;">{{ __('Country Name') }}</th>
                    <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee;">{{ __('Dialing Code') }}</th>
                    <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee;">{{ __('Registered Users') }}</th>
                    <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee;">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($countries as $country)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 15px;">{{ $country->name[app()->getLocale()] }}</td>
                    <td style="padding: 15px;">{{ $country->dialing_code }}</td>
                    <td style="padding: 15px;">{{ $country->users_count }}</td>
                    <td style="padding: 15px; display: flex; gap: 10px;">
                        <!-- زر تعديل -->
                        <button 
                            style="background: #ffc107; color: black; border: none; padding: 5px 12px; border-radius: 4px; cursor: pointer;"
                            data-bs-toggle="modal" 
                            data-bs-target="#editCountryModal"
                            data-country="{{ $country->toJson() }}"
                        >
                            {{ __('Edit') }}
                        </button>

                        <!-- زر حذف -->
                        <form action="{{ route('settings.countries.destroy', $country->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}')">
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

    <!-- مودال الإضافة -->
    <div class="modal fade" id="addCountryModal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 500px; margin: 1.75rem auto;">
            <div class="modal-content" style="border: none; border-radius: 8px;">
                <div class="modal-header" style="padding: 1rem; border-bottom: 1px solid #dee2e6;">
                    <h5 style="font-size: 1.25rem; margin: 0;">{{ __('Add New Country') }}</h5>
                    <button type="button" style="border: none; background: none; font-size: 1.5rem;" data-bs-dismiss="modal">×</button>
                </div>
                <form method="POST" action="{{ route('settings.countries.store') }}">
                    @csrf
                    <div class="modal-body" style="padding: 1rem;">
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem;">{{ __('Country Name (English)') }}</label>
                            <input 
                                type="text" 
                                name="name_en" 
                                style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 4px;"
                                required
                            >
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem;">{{ __('Country Name (Arabic)') }}</label>
                            <input 
                                type="text" 
                                name="name_ar" 
                                style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 4px;"
                                required
                            >
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem;">{{ __('Dialing Code') }}</label>
                            <input 
                                type="text" 
                                name="dialing_code" 
                                style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 4px;"
                                pattern="^\+\d{1,5}$"
                                required
                            >
                            <small style="color: #6c757d;">{{ __('The dialing code must start with "+" (e.g., +1, +44).') }}</small>

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

    <!-- مودال التعديل -->
    <div class="modal fade" id="editCountryModal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 500px; margin: 1.75rem auto;">
            <div class="modal-content" style="border: none; border-radius: 8px;">
                <div class="modal-header" style="padding: 1rem; border-bottom: 1px solid #dee2e6;">
                    <h5 style="font-size: 1.25rem; margin: 0;">{{ __('Edit Country') }}</h5>
                    <button type="button" style="border: none; background: none; font-size: 1.5rem;" data-bs-dismiss="modal">×</button>
                </div>
                <form method="POST" id="editCountryForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body" style="padding: 1rem;">
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem;">{{ __('Country Name (English)') }}</label>
                            <input 
                                type="text" 
                                name="name_en" 
                                style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 4px;"
                                required
                            >
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem;">{{ __('Country Name (Arabic)') }}</label>
                            <input 
                                type="text" 
                                name="name_ar" 
                                style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 4px;"
                                required
                            >
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem;">{{ __('Dialing Code') }}</label>
                            <input 
                                type="text" 
                                name="dialing_code" 
                                style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 4px;"
                                pattern="^\+\d{1,5}$"
                                required
                            >
                            <small style="color: #6c757d;">{{ __('The dialing code must start with "+" (e.g., +1, +44).') }}</small>

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
document.querySelectorAll('[data-bs-target="#editCountryModal"]').forEach(button => {
    button.addEventListener('click', function() {
        const country = JSON.parse(this.dataset.country);
        const form = document.querySelector('#editCountryForm');
        form.action = `/settings/countries/${country.id}`;
        form.querySelector('[name="name_en"]').value = country.name.en;
        form.querySelector('[name="name_ar"]').value = country.name.ar;
        form.querySelector('[name="dialing_code"]').value = country.dialing_code;
    });
});



</script>
@endsection
