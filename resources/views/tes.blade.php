@extends('visit.app')
@push('css')
<style>
iframe { 
    width: 100%;
    aspect-ratio: 16 / 9;
  }
</style>
@endpush
@section('content')
<div class="container">
        <iframe title="player" scrolling="no" frameborder="0" marginwidth="0" allowfullscreen="yes" src="https://kotakajaib.me/embed/adQx5Pa4AgwaiVP" allow="autoplay; fullscreen" style="width: 100%; height: 100%; overflow: hidden;" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
@endsection