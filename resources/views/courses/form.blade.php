@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron',[
        "title"=> __("Dar de alta un nuevo curso"),
        "icon"=> "edit"
    ])
@endsection

@section('content')
    <div class="pl-5 pr-5">
        <form method="POST"
            action="{{ !$course->id ? route('courses.store') : route('courses.update', ['slug'=>$course->slug]) }}" 
            novalidate
            enctype="multipart/form-data">
            @if($course->id)
                @method('PUT')
            @endif

            @csrf

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-whithout">
                        <div class="card-header">
                            {{__("Inofmacion del curso")}}
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-lg-4 col-form-label text-lg-right">
                                    {{__("Nombre del Curso")}}
                                </label>
                                <div class="col-lg-8">
                                    <input type="text" name="name" id="name"
                                    class="form-control{{$errors->has('name')?' is-invalid': ''}}"
                                    value="{{old('name')?: $course->name}}" required autofocus>

                                    @if($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{$errors->first('name')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="level_id" class="col-lg-4 col-form-label text-lg-right">
                                    {{__("Nivel del curso")}}
                                </label>
                                <div class="col-lg-8">
                                    <select name="level_id" id="level_id" class="form-control">
                                        @foreach(\App\Level::pluck('name', 'id') as $id => $level)
                                            <option {{ (int) old('level_id') ===$id || $course->level_id ===$id ? 'selected': ''}} value="{{$id}}">
                                                {{$level}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category_id" class="col-lg-4 col-form-label text-lg-right">
                                    {{__("Categoria del curso")}}
                                </label>
                                <div class="col-lg-8">
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach(\App\Category::groupBy('name')->pluck('name', 'id') as $id => $category)
                                            <option {{ (int) old('category_id') ===$id || $course->category_id ===$id ? 'selected': ''}} value="{{$id}}">
                                                {{$category}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group ml-3 mr-2">
                                <div class="col-lg-6 offset-4">
                                    <input type="file" class="custom-file-input{{$errors->has('picture') ? ' is-invalid': '' }}"
                                        id="picture" name="picture">
                                    <label for="picture" class="custom-file-label">
                                        {{__("Escoge la imagen del curso")}}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" 
                                    class="col-lg-4 col-form-label text-lg-right">
                                    {{__("Descripcion de Curso")}}
                                </label>
                                <div class="col-lg-8">
                                    <textarea name="description" 
                                        id="description"
                                        class="form-control{{$errors->has('description') ? ' is-invalid': '' }}"
                                        rows="8"
                                        required>
                                        {{old('description') ? : $course->description }}
                                    </textarea>
                                    @if($errors->has('description'))
                                        <span class="invalid-feedback">
                                            <strong>{{$errors->first('description')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card card-whithout">
                        <div class="card-header">{{__("Requisitos para tomar el curso")}}</div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="requirement1"
                                class="col-lg-4 col-form-label text-lg-right">
                                    {{__("Requerimiento 1")}}
                                </label>
                                <div class="col-lg-8">
                                    <input type="text"
                                        id="requirement1"
                                        class="form-control{{$errors->has('requirements.0') ? ' is-invalid': '' }}"
                                        name="requirements[]"
                                        value="{{old('requirements.0') ? old('requirements.0') : ($course->requirements_count>0 ? $course->requirements[0]->requirement : '')}}">
                                        @if($errors->has('requirements.0'))
                                            <span class="invalid-feedback">
                                                <strong>{{$errors->first('requirements.0')}}</strong>
                                            </span>
                                        @endif
                                </div>
                                @if($course->requirements_count>0)
                                    <input type="hidden"
                                        name="requirement_id0"
                                        value="{{$course->requirements[0]->id}}">
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="requirement2"
                                class="col-lg-4 col-form-label text-lg-right">
                                    {{__("Requerimiento 2")}}
                                </label>
                                <div class="col-lg-8">
                                    <input type="text"
                                        id="requirement2"
                                        class="form-control{{$errors->has('requirements.1') ? ' is-invalid': '' }}"
                                        name="requirements[]"
                                        value="{{old('requirements.1') ? old('requirements.1') : ($course->requirements_count>1 ? $course->requirements[1]->requirement : '')}}">
                                        @if($errors->has('requirements.1'))
                                            <span class="invalid-feedback">
                                                <strong>{{$errors->first('requirements.1')}}</strong>
                                            </span>
                                        @endif
                                </div>
                                @if($course->requirements_count>1)
                                    <input type="hidden"
                                        name="requirement_id1"
                                        value="{{$course->requirements[1]->id}}">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card card-whithout">
                        <div class="card-header">{{__("Metas del curso")}}</div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="goal1"
                                class="col-lg-4 col-form-label text-lg-right">
                                    {{__("Meat 1")}}
                                </label>
                                <div class="col-lg-8">
                                    <input type="text"
                                        id="goal1"
                                        class="form-control{{$errors->has('goals.0') ? ' is-invalid': '' }}"
                                        name="goals[]"
                                        value="{{old('goals.0') ? old('goals.0') : ($course->goals_count>0 ? $course->goals[0]->goal : '')}}">
                                        @if($errors->has('goals.0'))
                                            <span class="invalid-feedback">
                                                <strong>{{$errors->first('goals.0')}}</strong>
                                            </span>
                                        @endif
                                </div>
                                @if($course->goals_count>0)
                                    <input type="hidden"
                                        name="goal_id0"
                                        value="{{$course->goals[0]->id}}">
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="goal2"
                                class="col-lg-4 col-form-label text-lg-right">
                                    {{__("Meta 2")}}
                                </label>
                                <div class="col-lg-8">
                                    <input type="text"
                                        id="goal2"
                                        class="form-control{{$errors->has('goals.1') ? ' is-invalid': '' }}"
                                        name="goals[]"
                                        value="{{old('goals.1') ? old('goals.1') : ($course->goals_count>1 ? $course->goals[1]->goal : '')}}">
                                        @if($errors->has('goals.1'))
                                            <span class="invalid-feedback">
                                                <strong>{{$errors->first('goals.1')}}</strong>
                                            </span>
                                        @endif
                                </div>
                                @if($course->goals_count>1)
                                    <input type="hidden"
                                        name="requirement_id1"
                                        value="{{$course->goals[1]->id}}">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card card-whithout">
                        <div class="card-body">
                            <div class="form-group row mb-0">
                                <div class="col-md-4 offset-4">
                                    <button type="submit" name="revision" class="btn btn-danger">
                                        {{ __($btnText) }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection