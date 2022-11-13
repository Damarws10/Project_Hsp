<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('profile', function(BreadcrumbTrail $trail) {
	$trail->parent('home');
	$trail->push('Profile', route('profile'));
});

Breadcrumbs::for('historikendaraan', function(BreadcrumbTrail $trail) {
	$trail->parent('home');
	$trail->push('History Kendaraan', route('historikendaraan'));
});


Breadcrumbs::for('formuser', function(BreadcrumbTrail $trail) {
	$trail->parent('home');
	$trail->push('Form User', route('formuser'));
});

Breadcrumbs::for('informasiuser', function(BreadcrumbTrail $trail) {
	$trail->parent('formuser');
	$trail->push('Informasi User', route('informasiuser'));
});

Breadcrumbs::for('formkendaraan', function(BreadcrumbTrail $trail) {
	$trail->parent('home');
	$trail->push('Form Kendaraan', route('formkendaraan'));
});

Breadcrumbs::for('informasikendaraan', function(BreadcrumbTrail $trail) {
	$trail->parent('formkendaraan');
	$trail->push('Informasi Kendaraan', route('informasikendaraan'));
});

// // Home > Blog
// Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog'));
// });

// // Home > Blog > [Category]
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category));
// });