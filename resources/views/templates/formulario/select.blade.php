<label class="{{ $class ?? null }}">
    <span>{{ $label ?? $select  ?? "Erro"}}</span>

    <select name="{{ $name_select }}" class="form-control">
        @foreach ($data as $date)
            <option value="{{ $date->id }}">{{ $date->name }}</option>            
        @endforeach
    </select>
</label>