<div class="p-1" style="border-top: 1px solid #ccc;">
    @foreach($replaces as $replace)
    <button type="button" class="btn btn-secondary btn-sm view_data_param" maileclipse-data-toggle="tooltip" data-placement="top"  param-key="{{$replace}}">
        <i class="fa fa-anchor mr-1" aria-hidden="true"></i>{{$replace}}
    </button>
    @endforeach
</div>

@push('javascript')
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/codemirror.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/codemirror.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/xml/xml.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/css/css.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/javascript/javascript.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/htmlmixed/htmlmixed.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/display/placeholder.js"></script>
    <script type = "text/javascript">
        $( document ).ready(function() {
            $('.view_data_param').click(function(){
                var param = $(this).attr('param-key');
                output = `\{\{ $` + param + ` \}\}`;

                if ( $(this).hasClass('is-attribute') ){
                    var output = `\{\{ $` + $(this).attr('param-parent-key') + '->' + param + ` \}\}`;
                }
                tinymce.activeEditor.selection.setContent(output);
            });

        });
    </script>
@endpush
