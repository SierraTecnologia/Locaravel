<?php

namespace Locaravel\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Locaravel;

class LocaravelScope implements Scope
{

    /**
    * Apply the scope to a given Eloquent query builder.
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $builder
    * @param  \Illuminate\Database\Eloquent\Model  $model
    * @return void
    */
    public function apply(Builder $builder, Model $model)
    {
        // dd(Locaravel::isToApplyCodeLocaravel($model));
        if (Locaravel::isToApplyCodeLocaravel($model)) {
            $builder->where('business_code', Locaravel::getCode());
            // if (Auth::check()) {
            //     // @todo Verifica se tem acesso
            // }
        }

        // // no luck here as well
        // $userId = auth()->user()->system_id;

        // /**
        //  * appended query constraint for this scope
        //  */
        // $builder->where('system_id', $userId);
    }
}
