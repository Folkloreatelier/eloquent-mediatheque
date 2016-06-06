<?php



return array(
	
	'table_prefix' => 'mediatheque_',
	
	'programs' => [
		'ffmpeg' => [
			'ffmpeg.binaries'  => env('FFMPEG_BIN', '/usr/local/bin/ffmpeg'),
			'ffprobe.binaries' => env('FFPROBE_BIN', '/usr/local/bin/ffprobe')
		],
		'audiowaveform' => [
			'bin'  => env('AUDIOWAVEFORM_BIN', '/usr/local/bin/audiowaveform')
		]
	],
	
	
	'models' => array(
		
		'Picture' => \Folklore\EloquentMediatheque\Models\Picture::class,
		'Audio' => \Folklore\EloquentMediatheque\Models\Audio::class,
		'Video' => \Folklore\EloquentMediatheque\Models\Video::class,
		'Text' => \Folklore\EloquentMediatheque\Models\Text::class,
		'Metadata' => \Folklore\EloquentMediatheque\Models\Metadata::class,
		'Document' => \Folklore\EloquentMediatheque\Models\Document::class,
		
	),
    
	'uploadable' => array(
		
		'tmp_path' => sys_get_temp_dir()
		
	),
	
	'fileable' => array(
		
		'destination' => '{type}/{date(Y-m-d)}/{id}-{date(his)}.{extension}',
		
		'filesystem' => null,
	
		'path' => public_path().'/files',
		
		'tmp_path' => sys_get_temp_dir(),
		
		'delete_original_file' => false,
		'delete_file_on_delete' => false,
	    'delete_file_on_update' => false,
		
		'mime_to_extension' => array(
	        //Image
			'image/jpeg' => 'jpg',
			'image/jpg' => 'jpg',
			'image/png' => 'png',
			'image/x-png' => 'png',
			'image/gif' => 'gif',
			'image/x-gif' => 'gif',
			'image/svg+xml' => 'svg',
			'image/xml' => 'svg',
			'image/svg' => 'svg',
	        
	        //Audio
			'audio/wave' => 'wav',
			'audio/x-wave' => 'wav',
			'audio/wav' => 'wav',
			'audio/x-wav' => 'wav',
			'audio/mpeg' => 'mp3',
			'audio/mp3' => 'mp3',
	        
	        //Video
			'video/quicktime' => 'mov',
			'video/mp4' => 'mp4',
			'video/webm' => 'webm',
			'video/ogv' => 'ogv',
			'video/avi' => 'avi',
	        
	        //Document
			'application/pdf' => 'pdf'
		)
		
	),
	
	'linkable' => array(
		
		'fileable_path' => '/files',
		
	)

);
