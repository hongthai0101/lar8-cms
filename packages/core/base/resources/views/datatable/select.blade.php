<select class="form-control form-control-sm"> \
    @foreach($data as $key => $item)
        <option value="{{$key}}">{{$item}}</option> \
    @endforeach
</select>