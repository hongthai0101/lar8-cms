<form action="#" id="form-mail-template-update-field" class="m-form m-form--fit m-form--label-align-right">
    <table class="table m-table m-table--head-bg-success">
        <thead>
        <tr>
            <th>
                @lang('Field')
            </th>
            <th>
                @lang('Model')
            </th>
            <th>
                @lang('Content')
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($replaces as $field)
            @php
                $select = Arr::first($fields ?? [], function ($item) use ($field) {
                    return $item['field'] === $field;
                });

                if (empty($select)) $select = Arr::get($models, 0, []);

                $fillable = Arr::get(Arr::first($models, function ($item) use ($select) {
                    return $item['model'] == Arr::get($select, 'model');
                }), 'fillable', []);
            @endphp
            <tr>
                <td>
                    <div class="form-group">
                        <input type="text" class="form-control" name="field" readonly value="{{$field}}">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <select class="form-control is-valid select-update-field" name="model">
                            @foreach($models as $key => $model)
                                <option @if(Arr::get($select, 'model') == $model['model']) selected @endif data-fillable='@json($model['fillable'])' value="{{$model['model']}}">{{$model['label']}}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td>
                    <select class="form-control is-valid select-fillable" name="fillable">
                        @foreach($fillable as $key => $fill)
                            <option @if(Arr::get($select, 'fillable') == $fill) selected @endif value="{{$fill}}">{{$fill}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
