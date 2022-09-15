@php
    $value = isset($value) ? (array)$value : [];
@endphp
@if($categories)
    <ul class="list-none-style">
        @foreach($categories as $key => $category)
            @if($category['id'] != $currentId)
                <li value="{{ $category['id'] ?? '' }}"
                        {{ $category['id'] == $value ? 'selected' : '' }}>
                    {!! Form::customCheckbox([
                        [
                            $name, $category['id'], $category['title'], in_array($category['id'], $value),
                        ]
                    ]) !!}

                    @isset($category['subs'])
                        @include('blog::categories.categories-checkbox-option-line', [
                            'categories' => $category['subs'],
                            'value' => $value,
                            'currentId' => $currentId,
                            'name' => $name
                        ])
                    @endisset
                </li>
            @endif
        @endforeach
    </ul>
@endif
