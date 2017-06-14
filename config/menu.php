<?php

use Spatie\Menu\Laravel\Menu;

//Menu::macro('fullsubmenuexample', function () {
//    return Menu::new()->prepend('<a href="#"><span> Multilevel PROVA </span> <i class="fa fa-angle-left pull-right"></i></a>')
//        ->addParentClass('treeview')
//        ->add(Link::to('/link1prova', 'Link1 prova'))->addClass('treeview-menu')
//        ->add(Link::to('/link2prova', 'Link2 prova'))->addClass('treeview-menu')
//        ->url('http://www.google.com', 'Google');
//});

Menu::macro('adminlteSubmenu', function ($submenuName) {
    return Menu::new()->prepend('<a href="#"><span> ' . $submenuName . '</span> <i class="fa fa-angle-left pull-right"></i></a>')
        ->addParentClass('treeview')->addClass('treeview-menu');
});
Menu::macro('adminlteMenu', function () {
    return Menu::new()
        ->addClass('sidebar-menu');
});
Menu::macro('adminlteSeparator', function ($title) {
    return Html::raw($title)->addParentClass('header');
});
Menu::macro('sidebar', function () {
    return Menu::adminlteMenu()
        ->add(Html::raw('Enrollment Mobile')->addParentClass('header'))
        ->action('HomeController@index', 'Dashboard')
//        ->url('http://www.google.com', 'Google')
        ->add(Menu::adminlteSeparator('Models'))
        #adminlte_menu
        ->add(Link::toUrl('submoduleTypes', 'SubmoduleType'))
        ->add(Link::toUrl('submodules', 'Submodule'))
        ->add(Link::toUrl('modules', 'Module'))
        ->add(Link::toUrl('families', 'Family'))
        ->add(Link::toUrl('cycles', 'Cycle'))
        ->add(Link::toUrl('enrollmentStudySubmodules', 'EnrollmentStudySubmodules'))
        ->add(Link::toUrl('courses', 'Courses'))
        ->add(Link::toUrl('classrooms', 'Classrooms'))
        ->add(Link::toUrl('enrollments', 'Enrollments'))
//        ->add(
//            Menu::fullsubmenuexample()
//        )
//        ->add(
//            Menu::adminlteSubmenu('Best menu')
//                ->add(Link::to('/acacha', 'acacha'))
//                ->add(Link::to('/profile', 'Profile'))
//                ->url('http://www.google.com', 'Google')
//        )
        ->setActiveFromRequest();
});
