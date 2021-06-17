@extends("app")

@section('head_title', isset($page_content->meta_title) ? $page_content->meta_title : getcong('careers_with_us_title').' | '.getcong('site_name'))
@section('head_keywords', isset($page_content->meta_keywords) ? $page_content->meta_keywords : '')
@section('head_description', isset($page_content->meta_description) ? $page_content->meta_description : '')
@section('head_sub_keywords', isset($page_content->meta_sub_keywords) ? $page_content->meta_sub_keywords : '')
@section('head_url', Request::url())

@section("content")
<!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1 col-sm-12">
            <div class="page-title">
              <h2>{{getcong('careers_with_us_title')}}</p>
            </div>
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Home</a></li>
              <li class="active">{{getcong('careers_with_us_title')}}</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- end:header -->
<!-- begin:content -->
    <div id="content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="blog-container">
              <div class="blog-content" style="padding-top:0px;">

               		<div class="blog-text" style="padding-top:0px;">
						{!!getcong('careers_with_us_description')!!}
					</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end:content -->

@endsection
