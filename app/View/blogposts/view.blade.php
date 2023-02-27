@extends('layout')

@section('content')
<div class='container main-container'>


<section class='row'>
<h2 class='col-md-9'>{{trans('blogpost.view_blogpost')}}</h2>

<nav id="arrows" class='col-xs-12 col-md-3 pt-4'>
  <ul class='pager list-unstyled'>

    @if($previous_blogpost)
        <li class='btn previous float-start'><a class="rounded-pill bg-dark px-3 py-2 text-white" href="{{route('blogpost.show',['blogpost' => $previous_blogpost])}}"> <span class='fa fa-angle-left' aria-hidden='true'></span> {{trans('actions.previous')}}</a></li>
    @endif

    @if($next_blogpost)
        <li class='btn next float-end'><a class="rounded-pill bg-dark px-3 py-2 text-white" href="{{route('blogpost.show',['blogpost' => $next_blogpost])}}">{{trans('actions.next')}} <span class='fa fa-angle-right' aria-hidden='true'></span> </a></li>
    @endif


  </ul>
</nav>
</section>


<section class='row'>
<div class='col-md-4'>
  <button type='button' class='btn btn-link w-100' data-bs-toggle='modal' data-bs-target='#modal-xl-{{ $blogpost->id }}'>
    <img src='{{ $blogpost->getImage() }}' width='350' class='img img-thumbnail mt-3'  />
  </button>

  <div class="text-center">
    <div class='btn-group my-3' role='group'>
      @if(!$blogpost->isFeatured())
        <a href="{{config('horizontcms.backend_prefix').'/blogpost/feature/'.$blogpost->id}}" type='button' class='btn btn-success'><span class='glyphicon glyphicon-star' aria-hidden='true'></span> {{trans('blogpost.primary')}}</a>
      @else
        <a href="{{config('horizontcms.backend_prefix').'/blogpost/revoke-feature/'.$blogpost->id}}" type='button' class='btn btn-success'><span class='glyphicon glyphicon-minus' aria-hidden='true'></span> {{trans('Revoke')}}</a>
      @endif
      <a href="{{route('blogpost.edit',['blogpost' => $blogpost])}}" type='button' class='btn btn-warning'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> {{trans('actions.edit')}} </a>
      
      <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#delete_{{$blogpost->id}}'>
      <span class='glyphicon glyphicon-trash' aria-hidden='true'></span> {{trans('actions.remove')}}
      </button>
    </div>

    @if($blogpost->isDraft())
      <span class="badge badge-info d-block mb-3" style='font-size:14px;'>{{trans('actions.draft')}}</span>
    @endif

      @if($blogpost->author)
      <b class="d-block mb-3">{{trans('blogpost.author')}} :  <a href="{{route('user.show',['user' => $blogpost->author])}}">{{ $blogpost->author->username }}</a></b>
      @else
      <b class="d-block mb-3">{{trans('blogpost.author')}} : <a class="color-primary"> {{ trans('blogpost.removed_user') }} </a> </b>
      @endif 

      <b class="d-block mb-3">{{trans('blogpost.slug')}} :  <a class="color-primary">{{ $blogpost->getSlug() }}</a></b>
      <b class="d-block mb-3">{{trans('blogpost.published_on')}} :  <a class="color-primary">{{ $blogpost->created_at->format(\Settings::get('date_format',\Config::get('horizontcms.default_date_format'),true)) }}</a></b>
    
    @if($blogpost->category)  
      <b class="d-block mb-3">{{trans('blogpost.category')}} :  <a class="color-primary" href="{{ route('blogpostcategory.show',['blogpostcategory' => $blogpost->category]) }}">{{ $blogpost->category->name }}</a></b>
    @endif
      <b class="d-block mb-3">{{trans('blogpost.reading_time')}} : <a class="color-primary">{{ ceil($blogpost->getReadingTime()/60) }} mins</a></b>
      <b class="d-block mb-3">{{trans('blogpost.characters')}} : <a class="color-primary">{{ $blogpost->getTotalCharacterCount() }}</a></b>
      <b class="d-block mb-3">{{trans('blogpost.words')}} : <a class="color-primary">{{ $blogpost->getTotalWordCount() }}</a></b>
      <b class="d-block mb-3">{{trans('blogpost.comments')}} : <a class="color-primary">{{ $blogpost->comments->count() }}</a></b>
  </div>
</div>

<div class="col-md-8 mt-4">
  <div class='well bg-dark text-white p-4 overflow-auto'>
    <h3>{{ $blogpost->title }}</h3><hr/>
    <b>{{ $blogpost->summary }}</b>
    <p class="pt-4">
    {!! $blogpost->text !!}
    </p>
  </div>  
</div>

</section>
<div id='comments'></div>



  @include('image_details', ['modal_id' => $blogpost->id, 'image' => $blogpost->getImage()])

  @include('confirm_delete', [
          "route" => route('blogpost.destroy',['blogpost' => $blogpost]),
          "id" => "delete_".$blogpost->id,
          "header" => trans('actions.are_you_sure'),
          "name" => $blogpost->title,
          "content_type" => "post",
          "delete_text" => trans('actions.delete'),
          "cancel" => trans('actions.cancel')
          ]
  )

@include('blogposts.comments',['user' => \Auth::user()])


</div>

@endsection