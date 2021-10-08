<?php 
    return[
        [
            'label' => 'Dashboard',
            'route' => 'admin.dashboard',
            'icon' => 'fa-home'
        ],
        [
            'label' => 'Major Manager',
            'route' => 'major.index',
            'icon' => 'fa-coins',
            'items' => [[
                'label' => 'All Major',
                'route' => 'major.index'
            ],
            [
                'label' => 'Add Major',
                'route' => 'major.create'
            ]]
        ],

        [
            'label' => 'Course Manager',
            'route' => 'course.index',
            'icon' => 'fa-copy',
            'items' => [[
                'label' => 'All Course',
                'route' => 'course.index'
            ],
            [
                'label' => 'Add Course',
                'route' => 'course.create'
            ]]
        ],
        [
            'label' => 'Scholarship Manager',
            'route' => 'scholarship.index',
            'icon' => 'fa-award',
            'items' => [[
                'label' => 'All Scholarship',
                'route' => 'scholarship.index'
            ],
            [
                'label' => 'Add Scholarship',
                'route' => 'scholarship.create'
            ]]
        ],
        [
            'label' => 'Type Pay Manager',
            'route' => 'typepay.index',
            'icon' => 'fa-credit-card',
            'items' => [[
                'label' => 'All Type Pay',
                'route' => 'typepay.index'
            ],
            [
                'label' => 'Add Type Pay',
                'route' => 'typepay.create'
            ]]
        ],
        [
            'label' => 'Grade Manager',
            'route' => 'grade.index',
            'icon' => 'fa-align-left',
            'items' => [[
                'label' => 'All Grade',
                'route' => 'grade.index'
            ],
            [
                'label' => 'Add Grade',
                'route' => 'grade.create'
            ]]
        ],
        [
            'label' => 'Tuition Manager',
            'route' => 'tuition.index',
            'icon' => 'fa-comment-dollar',
            'items' => [[
                'label' => 'All Tuition',
                'route' => 'tuition.index'
            ],
            [
                'label' => 'Add Tuition',
                'route' => 'tuition.create'
            ]]
        ],
        [
            'label' => 'Student Manager',
            'route' => 'student.index',
            'icon' => 'fa-user-graduate',
            'items' => [[
                'label' => 'All Student',
                'route' => 'student.index'
            ],
            [
                'label' => 'Add Student',
                'route' => 'student.create'
            ]]
        ],
        [
            'label' => 'Bill Manager',
            'route' => 'bill.index',
            'icon' => 'fa-money-bill',
            'items' => [[
                'label' => 'All Bill',
                'route' => 'bill.index'
            ],
            [
                'label' => 'Add Bill',
                'route' => 'bill.create'
            ]]
        ],
        [
            'label' => 'Profile Manager',
            'route' => 'admin.edit',
            'icon' => 'fa-image',
        ],
               

    ]


?>