<div class="tag">
        @if(count($post->tag)>0)
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>標籤</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post->tag as $tag)
                        <tr>
                            <th>{{$tag->id}}</th>
                            <th>{{$tag->name}}</th>
                            <th><td><a href="{{route('tag.show',$tag->id)}}" class="label label-default">觀看標籤關聯</a></td></th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>       
        @else
            <p>未添加任何標籤</p>
        @endcan
    </div>
@endforeach