<?php

    function imagesMime(){
        return explode(',', str_replace('.', '', env('IMAGE_MIME')));
    }

    function imagesMimeText(){
        return implode(',', imagesMime());
    }

    function statusArray(){
        return [
            '' => 'Select Status',
            'active' => 'Active',
            'inactive' => 'In Active'
        ];
    }

    function statusValue($key){
        $array = statusArray();
        return $array[$key];
    }


    function bannerPagesArray(){
        return [
            '' => 'Select Page',
            'home' => 'Home',
            'media' => 'Media',
            'bible' => 'Bible',
            'give' => 'Give'
        ];
    }

    function bannerPageValue($key){
        $array = bannerPagesArray();
        return $array[$key];
    }


    function floatNumber($number)
    {
        return 'Rs '. number_format($number, 2);
    }
    

    function pagesArray(){
        return collect ([
            ['title' => 'Podcast', 'slug' => 'podcast'],
            ['title' => 'Livestream', 'slug' => 'livestream'],
            ['title' => 'Blogs', 'slug' => 'blogs'],
            ['title' => 'Courses', 'slug' => 'courses'],

        ])->map(function($row) {
            return (object) $row;
        });
    }


    function pagesTitle(){
        if (!\Cache::has('categories')){
            $data = \App\Models\Categories::get();
            \Cache::put('categories', $data);
        }
    }

    function getTitle($cat, $page){
        $array = \Cache::get('categories');
        $data = $array->where('category', $cat)->where('page', $page)->first();
        return $data->title;
    }

    function uniqueCode(){
        $code = substr(md5(uniqid(mt_rand() * time(), true)) , 0, 6);
        return strtoupper($code);
    }


    