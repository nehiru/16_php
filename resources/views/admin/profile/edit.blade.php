@extends('layouts.profile')
@section('title', 'プロフィールの編集')
@section('content')
    
        <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="name">氏名（name）</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name', $user->profile->name) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="gender">性別(gender)</label>
                        <div class="col-md-10">
                            <select name="gender" class="form-control">
                               <?php $gender_val = old('gender', $user->profile->gender); ?>
                               <option value="秘密" @if($gender_val =='秘密') selected="selected" @endif >秘密</option>
                               <option value="男性" @if($gender_val =='男性') selected="selected" @endif >男性</option>
                               <option value="女性" @if($gender_val =='女性') selected="selected" @endif >女性</option>
                             </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="hobby">趣味(hobby)</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="hobby" value="{{ old('hobby' , $user->profile->hobby) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="introduction">自己紹介欄(introduction)</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="20">{{ old('introduction') }}</textarea>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
                
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($user->profile->profile_histories)
                                @foreach ($user->profile->profile_histories as $history)
                                    <li class="list-group-item">{{ $history->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
    
@endsection