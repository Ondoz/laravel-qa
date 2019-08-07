<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = ['title', 'body'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
    public function getUrlAttribute()
    {
        return route("questions.show", $this->id);
    }
    //keterangan bawah get (namafuntion) Attribute akan digunakan saat pemanggilan
    //ex : biasanya menggunakan $variabel->(namafuntion di model())
    //tapi saat menggunakan get attribute maka akan menjadi $variabel->namafuntion cukup tanpa adanya tanda kurung
    //di antara get dan attribute jika ada huruf kapital lebih dari 1 maka saat pemanggilan harus di pisahkan menggunakan ("_")
    public function getCreatedDateAttribute()
    {
        //diffForHumans
        //format('d/m/Y');
        return $this->created_at->diffForHumans();
    }
}
