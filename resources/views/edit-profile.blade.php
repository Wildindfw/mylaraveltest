@extends('reddit_layouts.app')

@section('main-feed-content') 
    <form class="profile-form" action="/edit_profile" method="post">
        <h1>Edit Your Profile</h1>
        <p>Elements with <span class="required">*</span> are required.</p>
        @csrf 

        @include('components.subcomponents.form-text-field', [
            'field' => 'name', 
            'label' => 'Name', 
            'isRequired' => true, 
            'default' => $user->name, 
        ])

        @include('components.subcomponents.form-text-field', [
            'field' => 'handle', 
            'label' => 'Handle', 
            'isRequired' => true, 
            'default' => $user->profile->handle, 
        ])

        @include('components.subcomponents.form-text-field', [
            'field' => 'icon', 
            'label' => 'Icon', 
            'isRequired' => false, 
            'default' => $user->profile->icon, 
        ])

        @include('components.subcomponents.form-text-field', [
            'field' => 'profile_image', 
            'label' => 'Profile Image', 
            'isRequired' => false, 
            'default' => $user->profile->profile_image, 
        ])

        @include('components.subcomponents.form-text-field', [
            'field' => 'description', 
            'label' => 'Description', 
            'isRequired' => false, 
            'default' => $user->profile->description, 
        ])

        <input type="submit" value="Update Profile">
    </form>
@endsection 

@section('aux-feed-content') 
    @include('components.posts.user-card') 
    @include('components.posts.footer') 
@endsection