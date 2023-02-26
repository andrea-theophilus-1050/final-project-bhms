@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
@section('message2', __('You are not authorized to access this page.') . ' ' . __('If you think this is an error, please contact the administrator.'))
