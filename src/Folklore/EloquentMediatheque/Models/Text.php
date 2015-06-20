<?php namespace Folklore\EloquentMediatheque\Models;

use Folklore\EloquentMediatheque\Models\Collections\TextsCollection;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Text extends Model implements SluggableInterface {
    
    use SluggableTrait;

    protected $table = 'texts';
    
    public $mediatheque_type = 'text';

    protected $fillable = array(
        'content',
        'fields'
    );
    
    protected $sluggable = array(
        'build_from' => 'mediatheque_type',
        'save_to'    => 'slug',
    );
    
    protected $casts = [
        'fields' => 'object'
    ];
    
    /**
     * Relationships
     */
    public function pictures()
    {
        $morphName = 'writable';
        $model = 'Folklore\EloquentMediatheque\Models\Picture';
        $table = config('mediatheque.table_prefix').'writables';
        $query = $this->morphedByMany($model, $morphName, $table)
                        ->withTimestamps()
                        ->withPivot($morphName.'_position', $morphName.'_order');
        return $query;
    }
    
    public function audios()
    {
        $morphName = 'writable';
        $model = 'Folklore\EloquentMediatheque\Models\Audio';
        $table = config('mediatheque.table_prefix').'writables';
        $query = $this->morphedByMany($model, $morphName, $table)
                        ->withTimestamps()
                        ->withPivot($morphName.'_position', $morphName.'_order');
        return $query;
    }
    
    public function videos()
    {
        $morphName = 'writable';
        $model = 'Folklore\EloquentMediatheque\Models\Video';
        $table = config('mediatheque.table_prefix').'writables';
        $query = $this->morphedByMany($model, $morphName, $table)
                        ->withTimestamps()
                        ->withPivot($morphName.'_position', $morphName.'_order');
        return $query;
    }
    
    /**
     * Collections
     */
    public function newCollection(array $models = array())
    {
        return new TextsCollection($models);
    }
    
    /**
     * Query scopes
     */
    public function scopeSearch($query, $text)
    {
        $query->where(function($query) use ($text) {
			$query->where(function($query) use ($text) {
				$query->where('slug', 'LIKE', '%'.$text.'%');
			});
		});
        
        return $query;
    }
}
