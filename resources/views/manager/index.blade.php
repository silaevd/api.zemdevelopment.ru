@extends('layouts.manager')

@section('content')
    <ul class="tabs tabs-transparent blue">
        <li class="tab"><a class="active" href="#projectsTab">Проекты</a></li>
        <li class="tab"><a href="#contactsTab">Контакты</a></li>
    </ul>

    <div id="projectsTab" class="col s12 tabContent">
        <div class="addProject">
            <a href="{{ url('/manager/project') }}" class="waves-effect waves-light btn green hoverable"><i class="material-icons right">add</i>Добавить</a>
        </div>
        <div class="projects">
            <div class="row">
                <div class="col s12 m6 l3">
                    <div class="card">
                        <div class="card-image">
                            <img src="../assets/images/projects/esthetic.jpg">
                            <a href="{{ url('/manager/project') }}" class="btn-floating halfway-fab waves-effect waves-light orange hoverable firstBtn"><i class="material-icons">edit</i></a>
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
                <form class="">
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
@endsection