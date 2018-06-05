@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <nav class="nav-extended blue darken-1">
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo">Manager</a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li>
                            <a class="btn-floating btn waves-effect waves-light orange tooltipped" data-position="bottom" data-tooltip="Вернуться на сайт">
                                <i class="material-icons">desktop_windows</i>
                            </a>
                        </li>
                        <li>
                            <a class="btn-floating btn waves-effect waves-light orange tooltipped" data-position="bottom" data-tooltip="Выйти">
                                <i class="material-icons">exit_to_app</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="nav-content">
                    <ul class="tabs tabs-transparent blue">
                        <li class="tab"><a class="active" href="#projectsTab">Проекты</a></li>
                        <li class="tab"><a href="#contactsTab">Контакты</a></li>
                        <li class="tab"><a href="#sliderTab">Слайдер</a></li>
                    </ul>
                </div>
            </nav>

            <div id="projectsTab" class="col s12 tabContent">
                <div class="addProject">
                    <a href="addProject.html" class="waves-effect waves-light btn green hoverable"><i class="material-icons right">add</i>Добавить</a>
                </div>
                <div class="projects">
                    <div class="row">
                        <div class="col s12 m6 l4">
                            <div class="card">
                                <div class="card-image">
                                    <img src="../assets/images/projects/esthetic.jpg">
                                    <a class="btn-floating halfway-fab waves-effect waves-light orange hoverable firstBtn"><i class="material-icons">edit</i></a>
                                    <a class="btn-floating halfway-fab waves-effect waves-light red hoverable"><i class="material-icons">delete</i></a>
                                </div>
                                <div class="card-content">
                                    <span class="card-title">Card Title</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="contactsTab" class="col s12 tabContent">
                <div class="contactsForm">
                    <div class="row">
                        <form class="col s12 m6 offset-m3">
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">location_on</i>
                                    <input id="address" type="text" class="validate" value="">
                                    <label for="address">Адрес</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">email</i>
                                    <input id="email" type="text" class="validate" value="">
                                    <label for="email">E-mail</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">phone</i>
                                    <input id="phone" type="text" class="validate" value="">
                                    <label for="phone">Телефон</label>
                                </div>
                            </div>
                            <div class="row center">
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
                    <div class="row">
                        <span class="col s12">Фото:</span>
                        <div class="col s12">
                            {{--@if(!empty($homeSlider['images']))--}}
                                {{--@php--}}
                                    {{--$keys = array_keys(explode(',', $homeSlider['images']));--}}
                                {{--@endphp--}}
                                {{--<input id="fotoInput" type="file" name="images[]"  {{ empty($homeSlider['images']) ? 'required' : null }}--}}
                                {{--data-fileuploader-files=--}}
                                {{--'[--}}
                                        {{--@foreach(explode(',', $homeSlider['images']) as $key => $image)--}}
                                            {{--{--}}
                                                {{--"name":"{{$image}}",--}}
                                                {{--"size":1,--}}
                                                {{--"type":"image\/jpeg",--}}
                                                {{--"file":"{{ url($image) }}"--}}
                                            {{--} {{ end($keys) !== $key ? ',' : '' }}--}}
                                        {{--@endforeach--}}
                                {{--]'--}}
                                {{-->--}}
                            {{--@else--}}
                                <input id="fotoInput" type="file" name="images[]" multiple>
                            {{--@endif--}}

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
