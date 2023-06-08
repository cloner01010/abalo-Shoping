<template lang="">
<div id="session_creator" data-creator="{{ session('abalo_user') }}"></div>
<div id="newarticle-main-container">
    <script src="{{ asset('storage/js/articles.js') }}"></script>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
</template>

<script>
export default {
    
}
</script>
<style lang="">
    
</style>