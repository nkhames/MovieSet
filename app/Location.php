<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use Spatie\Tags\HasTags;

class Location extends Model
{
    use HasTags;
    public static function boot()
    {
        parent::boot();

        self::saving( function($model) {
        
            // Set up a container for any hashtags that get parsed
            App::singleton('tagqueue', function() {
                return new \App\TagQueue;
            });

            $environment = Environment::createCommonMarkEnvironment();
            $parser = new DocParser($environment);
            $htmlRenderer = new HtmlRenderer($environment);

            $text = $parser->parse($model->body);

            $model->html = $htmlRenderer->renderBlock($text);
            $environment->addInlineParser(new \App\Parsers\HashtagParser());
           
            
        });

            
        self::saved( function($model) {
            $model->syncTags(app('tagqueue')->getTags());
	    });

    }
}
