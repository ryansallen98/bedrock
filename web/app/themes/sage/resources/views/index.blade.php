@extends('layouts.app')

@section('content')
@include('partials.page-header')

@if (!have_posts())
  <x-alert variant="destructive">
    <x-alert.title>
      {!! __('No results found', 'sage') !!}
    </x-alert.title>
    <x-alert.description>
      {!! __('No results were found for your search.', 'sage') !!}
    </x-alert.description>
    <x-alert.action>
      <x-button as="a" href="/" variant="outline">{!! __('Go Home', 'sage') !!}</x-button>
    </x-alert.action>
  </x-alert>

  {!! get_search_form(false) !!}
@endif

@while(have_posts()) @php(the_post())
@includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
@endwhile

<div class="max-w-sm">
  <x-accordion type="single">
    <x-accordion.item>
      <x-accordion.trigger>
        {!! __('Frequently Asked Questions', 'sage') !!}
      </x-accordion.trigger>
      <x-accordion.content>
        Returns accepted within 30 days. Items must be unused and in original packaging. Refunds processed within 5-7
        business days.
      </x-accordion.content>
    </x-accordion.item>
    <x-accordion.item>
      <x-accordion.trigger>
        {!! __('Frequently Asked Questions', 'sage') !!}
      </x-accordion.trigger>
      <x-accordion.content>
        Returns accepted within 30 days. Items must be unused and in original packaging. Refunds processed within 5-7
        business days.
      </x-accordion.content>
    </x-accordion.item>
  </x-accordion>
</div>

<x-badge variant="default">Default</x-badge>
<x-badge variant="secondary">Secondary</x-badge>
<x-badge variant="destructive" as="a" href="/">Destructive</x-badge>
<x-badge variant="outline">Outline</x-badge>
<x-badge variant="ghost" as="a" href="/">Ghost</x-badge>
<x-badge variant="link" as="a" href="/">Link</x-badge>

{!! get_the_posts_navigation() !!}
@endsection

@section('sidebar')
  @include('sections.sidebar')
@endsection