@props(['name', 'label', 'data', 'key', 'textShow', 'selected' => '', 'uppercase' => false])



<div class="form-group mb-3">
    <select name="{{ $name }}" id="{{ $name }}" class="form-select">
        <option value="">{{ $label }}</option>
        @foreach ($data as $d)
            <option {{ $d->$key == $selected ? 'selected' : '' }} value="{{ $d->$key }}">
                @if ($uppercase)
                    {{ strtoupper(strtolower($d->$textShow)) }}
                @else
                    {{ ucwords(strtolower($d->$textShow)) }}
                @endif

            </option>
        @endforeach
    </select>
</div>
