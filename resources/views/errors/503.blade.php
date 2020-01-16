@extends('errors::minimal')

@section('title', __('Sana SoftWare'))
@section('code', 'Sana Software')
@section('message', __($exception->getMessage() ?: 'Service Unavailable'))
