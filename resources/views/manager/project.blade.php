@extends('layouts.manager')

@section('content')

    <div class="col s12 tabContent">

        <div class="sectionTitle blue">
            @if (!empty($project) && $project['id'])
                <h2 class="">{{$project['title']}}</h2>
            @else
                <h2 class="">Новый проект</h2>
            @endif
        </div>

        <div class="addProjectForm">
            <div class="row">
                <form method="post" action="{{ url('manager/process') }}" enctype="multipart/form-data" class="">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">subtitles</i>
                            <input id="title" type="text" class="validate" name="title" value="{{ !empty($project) ? $project['title'] : '' }}" required>
                            <label for="title">Название проекта</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">insert_link</i>
                            <input id="slug" type="text" class="validate" name="slug" value="{{ !empty($project) ? $project['slug'] : '' }}" required>
                            <label for="slug">Slug (ссылка)</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">crop_landscape</i>
                            <input id="area" type="text" class="validate" name="area" value="{{ !empty($project) ? $project['area'] : '' }}" required>
                            <label for="area">Площадь проекта</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">picture_in_picture_alt</i>
                            <input id="size" type="text" class="validate" name="size" value="{{ !empty($project) ? $project['size'] : '' }}" required>
                            <label for="size">Размеры проекта</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">attach_money</i>
                            <input id="price" type="text" class="validate" name="price" value="{{ !empty($project) ? $project['price'] : '' }}" required>
                            <label for="price">Цена проекта</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">update</i>
                            <input id="deadline" type="text" class="validate" name="deadline" value="{{ !empty($project) ? $project['deadline'] : '' }}" required>
                            <label for="deadline">Срок готовности</label>
                        </div>
                    </div>
                    <div id="videoRow" class="row">
                        <span class="col s12">Видео:</span>
                        <div class="col s12">
                            <a id="addVideoLink" class="btn-floating waves-effect waves-light btn-small"><i class="material-icons right">add</i></a>
                        </div>
                        <div class="hide">
                            <div id="videoInputField" class="input-field col s12">
                                <i class="material-icons prefix">insert_link</i>
                                <input type="text" class="validate" placeholder="ссылка на видео" name="videoLink[]" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col s12">Обложка:</span>
                        <div class="file-field input-field col s12">
                            <div class="btn">
                                <span>File</span>
                                <input type="file" name="cover">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col s12">Фото:</span>
                        <div class="col s12">
                            @if(!empty($project['images']))
                                @php
                                    $keys = array_keys($project['images']);
                                @endphp
                                <input id="fotoInput" type="file" name="images[]"  {{ !empty($errors->has('images')) ? 'required' : null }}
                                    data-fileuploader-files=
                                    '[
                                        @foreach(explode(',', $project['images']) as $key => $image)
                                            {
                                                "name":"{{$image}}",
                                                "size":1024,
                                                "type":"image\/jpeg",
                                                "file":"{{ url($image) }}"
                                            } {{ end($keys) !== $key ? ',' : '' }}
                                        @endforeach
                                    ]'
                                >
                            @else
                                <input id="fotoInput" type="file" name="images[]" multiple {{ !empty($errors->has('images')) ? 'required' : null }}>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <span class="col s12">Популярный</span>
                        <div class="input-field col s12">
                            <div class="switch">
                                <label>
                                    Off
                                    <input type="checkbox" name="isPopular">
                                    <span class="lever"></span>
                                    On
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col s12">Действующий</span>
                        <div class="input-field col s12">
                            <div class="switch">
                                <label>
                                    Off
                                    <input type="checkbox" name="isActive">
                                    <span class="lever"></span>
                                    On
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row center">
                        @csrf
                        <button class="btn waves-effect waves-light blue" type="submit" name="action">Отправить
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection