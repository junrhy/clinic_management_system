@extends('errors::layout')

@section('title', 'Page Not Found')

@section('message', $exception->getMessage())
