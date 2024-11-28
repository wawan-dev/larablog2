<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * 
 * @property int $id
 * @property int|null $user_id
 * @property int|null $article_id
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User|null $user
 * @property Article|null $article
 *
 * @package App\Models
 */
class Comment extends Model
{
	protected $table = 'comments';

	protected $casts = [
		'user_id' => 'int',
		'article_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'article_id',
		'content'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function article()
	{
		return $this->belongsTo(Article::class);
	}
}
