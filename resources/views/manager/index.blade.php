@extends('layouts.manager')

@section('content')
    <ul class="tabs tabs-transparent blue">
        <li class="tab"><a class="active" href="#projectsTab">Проекты</a></li>
        <li class="tab"><a href="#contactsTab">Контакты</a></li>
        <li class="tab"><a href="#sliderTab">Слайдер</a></li>
    </ul>

    <div id="projectsTab" class="col s12 tabContent">
        <div class="addProject">
            <a href="{{ url('/manager/project') }}" class="waves-effect waves-light btn green hoverable"><i class="material-icons right">add</i>Добавить</a>
        </div>
        <div class="projects">
            <ul class="collapsible popout">
                <li class="active z-depth-1">
                    <div class="collapsible-header activeProjects"><i class="material-icons">check</i>Активные</div>
                    <div class="collapsible-body">
                        <div class="row">
                            @if($projectList)
                                @foreach($projectList as $project)
                                    @if ($project['isActive'])
                                        <div class="col s12 m6 l3">
                                            <div class="card">
                                                <div class="card-image">
                                                    <img src="{{ asset($project['cover']) }}">
                                                    <a href="{{ url('/manager/project/' . $project['id']) . '/edit' }}" class="btn-floating halfway-fab waves-effect waves-light orange hoverable firstBtn"><i class="material-icons">edit</i></a>
                                                    <a class="btn-floating halfway-fab waves-effect waves-light red hoverable" href="{{ url('/manager/project/' . $project['id']) . '/disable' }}"><i class="material-icons">delete</i></a>
                                                </div>
                                                <div class="card-content">
                                                    <span class="card-title truncate">{{ $project['title'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header disabledProjects"><i class="material-icons">block</i>Не активные</div>
                    <div class="collapsible-body">
                        <div class="row">
                            @if($projectList)
                                @foreach($projectList as $project)
                                    @if (!($project['isActive']))
                                        <div class="col s12 m6 l3">
                                            <div class="card">
                                                <div class="card-image">
                                                    <img src="{{ asset($project['cover']) }}">
                                                    <a href="{{ url('/manager/project/' . $project['id']) . '/edit' }}" class="btn-floating halfway-fab waves-effect waves-light orange hoverable firstBtn"><i class="material-icons">edit</i></a>
                                                    <a class="btn-floating halfway-fab waves-effect waves-light red hoverable" href="{{ url('/manager/project/' . $project['id']) . '/delete' }}"><i class="material-icons">delete</i></a>
                                                </div>
                                                <div class="card-content">
                                                    <span class="card-title truncate">{{ $project['title'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </li>
            </ul>



        </div>
    </div>

    <div id="contactsTab" class="col s12 tabContent">
        <div class="contactsForm">
            <div class="row">
                <form method="post" action="{{ url('manager/contact/save') }}" enctype="multipart/form-data" class="">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">location_on</i>
                            <input id="address" name="address" type="text" class="validate" value="{{!empty($contacts) ? $contacts['address'] : ''}}">
                            <label for="address">Адрес</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>
                            <input id="email" name="email" type="text" class="validate" value="{{!empty($contacts) ? $contacts['email'] : ''}}">
                            <label for="email">E-mail</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">phone</i>
                            <input id="phone" name="phone" type="text" class="validate" value="{{!empty($contacts) ? $contacts['phone'] : ''}}">
                            <label for="phone">Телефон</label>
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

    <div id="sliderTab" class="col s12 tabContent">
        <div class="row">
            <div class="homeSliderForm">
                <form method="post" action="{{ url('manager/slider/process') }}" enctype="multipart/form-data" class="">
                    <div class="row">
                        <span class="col s12">Изображения:</span>
                        <div class="col s12">
                            @if(!empty($homeSlider))
                                @php
                                $keys = array_keys($homeSlider);
                                @endphp

                                <input id="sliderInput" type="file" name="images[]"  {{ empty($homeSlider) ? 'required' : null }}
                                    data-fileuploader-files=
                                    '[
                                        @foreach($homeSlider as $key => $image)
                                            {
                                            "name":"{{$image['file_name']}}",
                                            "size":"{{$image['id']}}",
                                            "type":"image\/jpeg",
                                            "file":"{{ url($image['file_name']) }}"
                                            } {{ end($keys) !== $key ? ',' : '' }}
                                        @endforeach
                                    ]'
                                >
                                @else
                                <input id="fotoInput" type="file" name="images[]" multiple>
                            @endif

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