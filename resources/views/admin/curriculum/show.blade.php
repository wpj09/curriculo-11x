<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/curriculum.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
@php
    if(\Illuminate\Support\Facades\File::exists(public_path() . '/storage/' . $curriculum->curriculumObject->url_cover)) {
        $cover = url(asset('backend/assets/images/avatar.jpg'));
    } else {
        $cover = $curriculum->curriculumObject->url_cover;
    }
@endphp
<div class="main">
    <div class="left">
        <br>
        <div class="profile-img"><img src="{{ $cover }}"></div>

        <div class="box-1">
            <div class="heading">
                <p>CONTATOS</p>
            </div>
            <p class="p1"><i class="icon-whatsapp p1 icons"></i>{{ $curriculum->curriculumObject->cell }}</p>
            <p class="p1"><i class="icon-envelope p1 icons"></i>{{ $curriculum->curriculumObject->email }}</p>
        </div>

        <div class="box-1">
            <div class="heading">
                <p>CONHECIMENTOS</p>
            </div>

            <p class="p1">{{ $curriculum->knowledge_courses  }}
            <div class="skill-container">
                <div class="skill html"></div>
            </div>
            </p>

            <p class="p1">{{ $curriculum->knowledge_courses  }}
            <div class="skill-container">
                <div class="skill css"></div>
            </div>
            </p>

            <p class="p1">{{ $curriculum->knowledge_courses  }}
            <div class="skill-container">
                <div class="skill js"></div>
            </div>
            </p>

            <p class="p1">{{ $curriculum->knowledge_courses  }}
            <div class="skill-container">
                <div class="skill jquery"></div>
            </div>
            </p>

            <p class="p1">{{ $curriculum->knowledge_courses  }}
            <div class="skill-container">
                <div class="skill web"></div>
            </div>
            </p>

            <p class="p1">{{ $curriculum->knowledge_courses  }}
            <div class="skill-container">
                <div class="skill web"></div>
            </div>
            </p>

            <p class="p1">{{ $curriculum->knowledge_courses  }}
            <div class="skill-container">
                <div class="skill web"></div>
            </div>
            </p>

            <p class="p1">{{ $curriculum->knowledge_courses  }}
            <div class="skill-container">
                <div class="skill gra"></div>
            </div>
            </p>


        </div>
        <br>
        <div class="box-1">
            <div class="heading">
                <p>HOBBIES</p>
            </div>

            <div class="h-div">
                <i class="material-icons icons2">camera_roll</i>
                <i class="material-icons icons2">music_note</i>
                <i class="material-icons icons2">motorcycle</i>
                <i class="material-icons icons2">border_color</i>
            </div>

        </div>

    </div>


    <div class="right">
        <div class="name-div">
            <h1>{{ $curriculum->curriculumObject->name }}</h1>
            <p>{{ $curriculum->desired_occupation }}</p>
            <i class="icon-"></i>
        </div>
        <div class="box-2">
            <h2 class="icon-user" style="font-size: 20px!important;">SOBRE MIM</h2>
            <p class="p2" align="justify">
                {{ $curriculum->about_me }}
            </p>
        </div>


        <div class="box-2">
            <h2 class="icon-graduation-cap">ESCOLARIDADE</h2>
            <p class="p3">2010-2013 <span>{{ $curriculum->scholarity }}</span></p>
            <p class="p2">
                Lorem Ipsum is simply dummy text of
            </p>

            <p class="p3">2013-2016 <span>Lorem Ipsum </span></p>
            <p class="p2">
                Lorem Ipsum is simply dummy text of
            </p>

            <p class="p3">2016-2021 <span>Lorem Ipsum is</span></p>
            <p class="p2">
                Lorem Ipsum is simply dummy text of
            </p>
        </div>


        <div class="box-2">
            <h2 class="icon-folder">EXPERIÊNCIAS</h2>
                <p class="p3">Início: {{ $curriculum->start_date }} Fim: {{ $curriculum->final_date }}
                    <span>{{ $curriculum->company }}</span></p>
                <p class="p2">
                    Lorem Ipsum is simply dummy text of
                </p>

                <p class="p3">2013-2016 <span>Lorem Ipsum </span></p>
                <p class="p2">
                    Lorem Ipsum is simply dummy text of
                </p>
        </div>

    </div>
</div>
</body>
</html>
