<?php

namespace App\Observers;

use App\Properties;

class PropertiesObserver
{
    /**
     * Handle the properties "created" event.
     *
     * @param  \App\Properties  $properties
     * @return void
     */
    public function created(Properties $properties)
    {
        //
    }

    /**
     * Handle the properties "updated" event.
     *
     * @param  \App\Properties  $properties
     * @return void
     */
    public function updated(Properties $properties)
    {
        //
    }
    /**
     * Handle the properties "fetched " event.
     *
     * @param  \App\Properties  $properties
     * @return void
     */

    public function retrieved(Properties $properties)
    {
        $properties->views =$properties->views+1;
        $properties->save();

    }

    /**
     * Handle the properties "deleted" event.
     *
     * @param  \App\Properties  $properties
     * @return void
     */
    public function deleted(Properties $properties)
    {
        //
    }

    /**
     * Handle the properties "restored" event.
     *
     * @param  \App\Properties  $properties
     * @return void
     */
    public function restored(Properties $properties)
    {
        //
    }

    /**
     * Handle the properties "force deleted" event.
     *
     * @param  \App\Properties $properties
     * @return void
     */
    public function forceDeleted(Properties $properties)
    {
        //
    }
}
