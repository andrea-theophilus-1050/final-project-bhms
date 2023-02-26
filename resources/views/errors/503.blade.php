@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))
@section('message2', __('Sorry, the service is unavailable at the moment. Please try again later.')