<?php
return [
    'nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}"><i data-feather="chevron-right"></i></a></li>',
    'nextDisabled' => '<li class="page-item disabled"><a class="page-link" href="javascript:"><i data-feather="chevron-right"></i></a></li>',
    'prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}"><i data-feather="chevron-left"></i></a></li>',
    'prevDisabled' => '<li class="page-item disabled"><a class="page-link" href="javascript:"><i data-feather="chevron-left"></i></a></li>',
    'first' => '<li class="page-item"><a class="page-link" href="{{url}}">'.__("First").'</a></li>',
    'last' => '<li class="page-item"><a class="page-link" href="{{url}}">'.__("Last").'</a></li>',
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item active"><a class="page-link" href="javascript:">{{text}}</a></li>',
    'ellipsis' => '',
];
