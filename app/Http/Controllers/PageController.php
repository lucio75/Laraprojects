<?php

namespace LaraCourse\Http\Controllers;



class PageController extends Controller
{
    protected $data=[
        [
            'name'=>'Lucio',
            'lastname'=>'Ticali'
        ],

        [
            'name'=>'Mattia',
            'lastname'=>'Ticali'
        ],

        [
            'name'=>'Giorgia',
            'lastname'=>'Ticali'
        ]
    ];

    public function about(){

        $about = $this->data;
        $title='About';
        return view('about',compact('title','about'));
    }

    public function blog(){

        $blog = $this->data;
        $title='Our Blog';
        return view('blog',compact('title','about'),
            ['img_url'=>'http://lorempixel.com/400/200',
                'img_title'=>'Immagine inclusa',
                'slot'=>''
            ]);
    }

    public function staff(){

        //return view('staff',['title'=>'Our staff','staff'=>$this->data]);
        //return view('staff')->with('staff',$this->data)->with('title','Our staff');
        //return view('staff')->withStaff($this->data)->withTitle('Our staff');
        $staff = $this->data;
        $title='Our Staff';
        return view('staff',compact('title','staff'));
    }

    public function staffb(){

        //return view('staff',['title'=>'Our staff','staff'=>$this->data]);
        //return view('staff')->with('staff',$this->data)->with('title','Our staff');
        //return view('staff')->withStaff($this->data)->withTitle('Our staff');
        $staffb =$this->data;
        $title='Our Staffb';
        return view('staffb',compact('title','staffb'));
    }
}
