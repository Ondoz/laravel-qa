<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['body', 'user_id'];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedDateAttribute()
    {
        //diffForHumans
        //format('d/m/Y');
        return $this->created_at->diffForHumans();
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($answer){
            $answer->question->increment('answers_count');
            // $answer->question->save();
        });

        static::deleted(function ($answer){
            $answer->question->decrement('answers_count');
            //jadi semua di sederhanakan dalam datatable add_froreign_id_to_qeustions_table
            // $question = $answer->question;
            // if ($question->best_answers_id === $answer->id) {
            //     $question->best_answers_id = NULL ;
            //     $question->save();
            // }
        });
    }

    public function getStatusAttribute()
    {
      return $this->isBest()  ? 'vote-accepted' : '';
    }

    public function getIsBestAttribute()
    {
        return $this->isBest();
    }

    public function isBest()
    {
        return $this->id === $this->question->best_answer_id ;
    }

    public function votes()
    {
        return $this->morphToMany(User::class, 'votable');
    }
    
    public function upVotes()
    {
        return $this->votes()->wherePivot('vote', 1);
    }

    public function downVotes()
    {
        return $this->votes()->wherePivot('vote', -1);
    }
}
