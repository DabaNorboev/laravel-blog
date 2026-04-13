<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle($type, $id)
    {
        $modelClass = Relation::getMorphedModel($type);

        if (! $modelClass) {
            return response()->view('errors.404', [], 404);
        }

        $model = $modelClass::findOrFail($id);

        $like = $model->likes()->where('user_id', auth()->id())->first();

        if ($like) {
            $like->delete();
        } else {
            $model->likes()->create(['user_id' => auth()->id()]);
        }

        return redirect()->back();
    }
}
