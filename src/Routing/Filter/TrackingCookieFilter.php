<?php
namespace App\Routing\Filter;

use Cake\Event\Event;
use Cake\Routing\DispatcherFilter;

class TrackingCookieFilter extends DispatcherFilter
{

    public function beforeDispatch(Event $event)
    {
        $request = $event->data['request'];

        $response = $event->data['response'];
        if (!$request->cookie('landing_page')) {
            $response->cookie([
                'name' => 'landing_page',
                'value' => $request->here(),
                'expire' => '+ 1 year',
            ]);
        }
    }
}