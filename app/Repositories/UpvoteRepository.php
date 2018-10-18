<?php namespace App\Repositories;

use App\Upvote;
use Illuminate\Database\Eloquent\Model;

class UpvoteRepository  extends Repository
{
    public function __construct(Upvote $model)
    {
        parent::__construct($model);
    }
}