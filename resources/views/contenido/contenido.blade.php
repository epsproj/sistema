@extends('principal')
@section('contenido')
    <template v-if="menu==0">
        <h1>Contenido 1</h1>
    </template>


    <template v-if="menu==1">
    <solicitudfactibilidad></solicitudfactibilidad>
    </template>

    <template v-if="menu==2">
    <estadofactibilidad></estadofactibilidad>
    </template>

    <template v-if="menu==3">
    <tipoobra></tipoobra>
    </template>
    <template v-if="menu==4">
    <ejecutor></ejecutor>
    </template>
    <template v-if="menu==5">
    <cargoejecutor></cargoejecutor>
    </template>
    <template v-if="menu==6">
    <persona></persona>
    </template>
    <template v-if="menu==7">
        
    </template>
    <template v-if="menu==8">

    </template>
    <template v-if="menu==9">
        
    </template>
    <template v-if="menu==10">
        
    </template>
    <template v-if="menu==11">

    </template>
    <template v-if="menu==12">

    </template>
    <template v-if="menu==13">

    </template>
    <template v-if="menu==14">

    </template>
    <template v-if="menu==15">
        <estadodenuncia></estadodenuncia>
    </template>
    <template v-if="menu==16">

    </template>
    <template v-if="menu==17">

    </template>
    <template v-if="menu==18">

    </template>
@endsection
