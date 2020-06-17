<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});


// Home > Blog
Breadcrumbs::for('teachers', function ($trail) {
    $trail->parent('home');
    $trail->push('Teachers', route('teachers'));
});


// Home > Blog
Breadcrumbs::for('classes', function ($trail) {
    $trail->parent('home');
    $trail->push('Classes', route('classes'));
});


// Home > Blog
Breadcrumbs::for('classeslist', function ($trail) {
    $trail->parent('home');
    $trail->parent('Classes');
    $trail->push('Class List', route('classeslist'));
});