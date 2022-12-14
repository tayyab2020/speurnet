@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2> {{ isset($user->name) ? 'Edit: '. $user->name : 'Add User' }}</h2>

		<a href="{{ URL::to('admin/users') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

	</div>
	@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
	 @if(Session::has('flash_message'))
				    <div class="alert alert-success">
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span></button>
				        {{ Session::get('flash_message') }}
				    </div>
	@endif

   	<div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(array('url' => array('admin/users/adduser'),'class'=>'form-horizontal padding-15','name'=>'user_form','id'=>'user_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                <input type="hidden" name="id" value="{{ isset($user->id) ? $user->id : null }}">


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" value="{{ isset($user->name) ? $user->name : null }}" class="form-control">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Phone</label>
                    <div class="col-sm-9">
                        <input type="text" name="phone" value="{{ isset($user->phone) ? $user->phone : null }}" class="form-control" value="">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Fax</label>
                    <div class="col-sm-9">
                        <input type="text" name="fax" value="{{ isset($user->fax) ? $user->fax : null }}" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">City</label>
                    <div class="col-sm-4">
                        <select name="city" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
										@if(isset($user->city))

										@foreach($city_list as $city)
										<option value="{{$city->city_name}}" @if($city->city_name==$user->city) selected @endif>{{$city->city_name}}</option>										    @endforeach

										@else

											 @foreach($city_list as $city)
										<option value="{{$city->city_name}}">{{$city->city_name}}</option>
										@endforeach

										@endif
								</select>
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">About</label>
                    <div class="col-sm-9">

						<textarea name="about" cols="50" rows="5" class="form-control">{{ isset($user->about) ? $user->about : null }}</textarea>
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Facebook</label>
                    <div class="col-sm-9">
                        <input type="text" name="facebook" value="{{ isset($user->facebook) ? $user->facebook : null }}" class="form-control" value="">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Twitter</label>
                    <div class="col-sm-9">
                        <input type="text" name="twitter" value="{{ isset($user->twitter) ? $user->twitter : null }}" class="form-control" value="">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Google Plus</label>
                    <div class="col-sm-9">
                        <input type="text" name="gplus" value="{{ isset($user->gplus) ? $user->gplus : null }}" class="form-control" value="">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Linkedin</label>
                    <div class="col-sm-9">
                        <input type="text" name="linkedin" value="{{ isset($user->linkedin) ? $user->linkedin : null }}" class="form-control" value="">
                    </div>
                </div>
				<div class="form-group">
                    <label for="avatar" class="col-sm-3 control-label">Profile Picture</label>
                    <div class="col-sm-9">
                        <div class="media">
                            <div class="media-left">
                                @if(isset($user->image_icon))

									<img src="{{ URL::asset('upload/members/'.$user->image_icon.'-s.jpg') }}" width="80" alt="person">
								@endif

                            </div>
                            <div class="media-body media-middle">
                                <input type="file" name="image_icon" class="filestyle">
                            </div>
                        </div>

                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">User Type</label>
                    <div class="col-sm-4">
                        <select name="usertype" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
								@if(isset($user->usertype))

								<option value="Users" @if($user->usertype=='Users') selected @endif>User</option>
								<option value="Agents" @if($user->usertype=='Agents' && $user->landlord == 0) selected @endif>Agents</option>
								<option value="Private" @if($user->usertype=='Agents' && $user->landlord == 1) selected @endif>Private Landlord</option>


								@else

										<option value="Users">User</option>
										<option value="Agents">Agents</option>
										<option value="Private">Private Landlord</option>

								@endif

						</select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Account Status</label>
                    <div class="col-sm-4">
                        <select name="status" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
                            @if(isset($user->status))

                                <option value="0" @if($user->status==0) selected @endif>Not Active</option>
                                <option value="1" @if($user->status==1) selected @endif>Active</option>

                            @else

                                <option value="0">Not Active</option>
                                <option value="1">Active</option>

                            @endif

                        </select>
                    </div>
                </div>

				<hr />
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" name="email" value="{{ isset($user->email) ? $user->email : null }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" value="" class="form-control">
                    </div>
                </div>



                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                    	<button type="submit" class="btn btn-primary">{{ isset($user->name) ? 'Edit User' : 'Add User' }}</button>

                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>


</div>

@endsection
