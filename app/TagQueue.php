<?php

// app/TagQueue.php

namespace App;


class tagqueue
{
    private $tags = [];

    public function addTag($tag)
    {
        $this->tags[] = $tag;
    }

    public function getTags()
    {
        return $this->tags;
    }
}