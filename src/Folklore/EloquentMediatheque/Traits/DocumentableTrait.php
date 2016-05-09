<?php namespace Folklore\EloquentMediatheque\Traits;

trait DocumentableTrait {

    protected $documentable_order = true;

    /*
     *
     * Relationships
     *
     */
    public function documents()
    {
        $morphName = 'documentable';
        $key = 'document_id';
        $model = config('mediatheque.models.Document', 'Folklore\EloquentMediatheque\Models\Document');
        $table = config('mediatheque.table_prefix').$morphName.'s';
        $query = $this->morphToMany($model, $morphName, $table, null, $key)
                        ->withTimestamps()
                        ->withPivot($morphName.'_position', $morphName.'_order');

        if($this->documentable_order)
        {
            $query->orderBy('documentable_order','asc');
        }

        return $query;
    }

    /*
     *
     * Sync methods
     *
     */
    public function syncDocuments($items = array())
    {
        $model = config('mediatheque.models.Document', 'Folklore\EloquentMediatheque\Models\Document');
        $this->syncMorph($model, 'documentable', 'documents', $items);
    }

}
