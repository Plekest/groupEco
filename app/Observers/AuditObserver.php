<?php

namespace App\Observers;

use App\Models\Audit;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class AuditObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created($model)
    {
        $this->logChange($model, 'created');
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated($model)
    {
        $this->logChange($model, 'updated');
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted($model)
    {
        $this->logChange($model, 'deleted');
    }

    /**
     * Logs the given event to the audit log.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $event
     * @return void
     */
    private function logChange($model, $event)
    {
        $agent = new Agent();

        Audit::create([
            'user_id' => Auth::id(),
            'event' => $event,
            'model' => get_class($model),
            'old_values' => $event === 'updated' ? $model->getOriginal() : null,
            'new_values' => $event !== 'deleted' ? $model->getAttributes() : null,
            'ip_address' => request()->ip(),
            'user_agent' => $agent->device(),
        ]);
    }
}
