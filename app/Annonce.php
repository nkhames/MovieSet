<?php

namespace App;

use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use Spatie\Tags\HasTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Annonce extends Model
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
            $environment->addInlineParser(new \App\Parsers\HashtagParser());
            $parser = new DocParser($environment);
            $htmlRenderer = new HtmlRenderer($environment);
            $text = $parser->parse($model->body);
            $model->html = $htmlRenderer->renderBlock($text);
           
            
        });

            
        self::saved( function($model) {
            
            $model->syncTags(app('tagqueue')->getTags());
	    });

    }
}
