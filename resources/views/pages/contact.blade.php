@extends("app")

@section('head_title', 'Contact Us | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
<!-- begin:header -->
    <div id="header" class="heading" style="background-image: url({{ URL::asset('assets/img/img01.jpg') }});">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1 col-sm-12">
            <div class="page-title">
              <h2>Contact</h2>
            </div>
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">{{__('text.Home')}}</a></li>
              <li class="active">Contact</li>
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
                  <div class="blog-title" style="padding: 0;">
                  <h3 style="font-size: 20px;">Heb je vragen of een opmerking? Stuur deze gerust door een mail te sturen naar: info@zoekjehuisje.nl of door het contactformulier in te vullen.
                      Om jou niet langer te laten wachten dan strikt noodzakelijk, reageren we binnen 1 werkdag.</h3>

                </div>

                <div class="blog-text contact">
                  <div class="row">

                  	@if(Session::has('flash_message'))
				    <div class="alert alert-success">
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span></button>
				        {{ Session::get('flash_message') }}
				    </div>
				@endif
                    	<div class="message">
												<!--{!! Html::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}-->
							                    	@if (count($errors) > 0)
											    <div class="alert alert-danger">
											    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
											        <ul>
											            @foreach ($errors->all() as $error)
											                <li>{{ $error }}</li>
											            @endforeach
											        </ul>
											    </div>
											@endif

							                    </div>
                    <div class="col-md-8 col-sm-7">
                      {!! Form::open(array('url' => 'contact-us','class'=>'','id'=>'contactform','role'=>'form')) !!}
                        <div class="form-group">
                          <label for="name" class="sr-only">Jouw naam</label>
                          <input type="text" name="name" class="form-control" placeholder="Jouw naam">
                        </div>
                        <div class="form-group">
                          <label for="email" class="sr-only">E-mailadres?</label>
                          <input type="email" name="email" class="form-control" placeholder="E-mailadres?">
                        </div>
                        <div class="form-group">
                          <label for="subject" class="sr-only">Onderwerp</label>
                          <input type="text" name="subject" class="form-control" placeholder="Onderwerp">
                        </div>
                        <div class="form-group">
                          <label for="name" class="sr-only">Jouw vraag of opmerking</label>
                          <textarea name="user_message" class="form-control" rows="5" placeholder="Jouw vraag of opmerking"></textarea>
                        </div>
                        <div class="form-group">
                          <button type="submit" name="submit" class="btn btn-warning"><i class="fa fa-envelope-o"></i> Bericht versturen</button>
                        </div>
                      {!! Form::close() !!} <br>
                    </div>

                  </div>
                </div>



              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end:content -->

@endsection
