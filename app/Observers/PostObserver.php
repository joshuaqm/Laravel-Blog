<?php

namespace App\Observers;
use App\Models\Post;

class PostObserver
{
    //created: una vez que se crea en la base de datos
    //creating: antes de que se cree en la base de datos
    //updated: una vez que se actualiza en la base de datos
    //updating: antes de que se actualice en la base de datos
    public function updating(Post $post)
    {
        if($post->is_published && !$post->published_at) {
            $post->published_at = now();
        }
    }
    // deleted: una vez que se elimina de la base de datos
    // deleting: antes de que se elimine de la base de datos
}
