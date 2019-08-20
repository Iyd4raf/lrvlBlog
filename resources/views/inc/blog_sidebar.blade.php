
{{ Form::open(['action' => 'SearchController@index', 'method' => 'POST', 'class' => 'form-inline my-2 mt-lg-0 mb-lg-5 my-5 d-flex']) }}  
    {{Form::text('q', '', ['class' => 'form-control flex-grow-1 mr-sm-2', 'placeholder' => 'Search', 'type' => 'search', 'aria-label' => 'Search'])}}
    {{Form::submit('Search', ['class' => 'btn btn-sm btn-outline-success my-2 my-sm-0', 'type' => 'submit'])}}
{{ Form::close() }}
<div class="popular_posts">
    <h4 class="mb-5 text-center">Popular Posts</h4>
    @if (count($popular_posts) > 0)
        @foreach ($popular_posts as $popular_post)
            <div class="popular-post my-4">
                <div class="popular-post-img">
                    <img src="/storage/cover_images/{{$popular_post->cover_image}}" class="img-fluid">
                </div>
                <div class="popular-post-title">
                    <h6><a href="/blog/{{$popular_post->slug}}">{{$popular_post->title}}</a></h6>
                </div>
            </div>
        @endforeach
    @endif
</div>
