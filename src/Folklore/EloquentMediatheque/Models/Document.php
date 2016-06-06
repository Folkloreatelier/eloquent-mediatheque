<?php namespace Folklore\EloquentMediatheque\Models;

use Folklore\EloquentMediatheque\Traits\WritableTrait;
use Folklore\EloquentMediatheque\Traits\PicturableTrait;
use Folklore\EloquentMediatheque\Traits\FileableTrait;
use Folklore\EloquentMediatheque\Traits\UploadableTrait;
use Folklore\EloquentMediatheque\Traits\LinkableTrait;
use Folklore\EloquentMediatheque\Traits\PaginableTrait;
use Folklore\EloquentMediatheque\Interfaces\PaginableInterface;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Document extends Model implements SluggableInterface, PaginableInterface {
    
    use WritableTrait, PicturableTrait, PaginableTrait, FileableTrait, UploadableTrait, LinkableTrait, SluggableTrait;

    protected $table = 'documents';
    
    public $mediatheque_type = 'document';

    protected $guarded = array();
    protected $fillable = array(
        'name',
        'source',
        'url',
        'embed',
        'filename',
        'mime',
        'size',
        'pages'
    );
    
    protected $sluggable = array(
        'build_from' => array('name', 'mediatheque_type'),
        'save_to' => 'slug'
    );
    
    protected $appends = array(
        'link',
        'mediatheque_type'
    );
    
    /**
     * Paginable
     */
    public static function getPagesFromFile($path)
    {
        return 0;
    }
    
    /**
     * Query scopes
     */
    public function scopeSearch($query, $text)
    {
        $query->where(function($query) use ($text) {
			$query->where('slug', 'LIKE', '%'.$text.'%');
			$query->orWhere('filename', 'LIKE', '%'.$text.'%');
			$query->orWhere('original', 'LIKE', '%'.$text.'%');
		});
        return $query;
    }
}
