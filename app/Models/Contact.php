<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerOrder;

class Contact extends Model
{
    const STATUS_NEW = 'new';
    const STATUS_MODIFIED = 'modified';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'mobile', 'address', 'picture'
    ];

    public function customerOrders()
	{
		return $this->hasMany('App\Models\CustomerOrder');
	}

    public static function findByConversation($conversation)
    {
        $contact = self::firstOrNew(
            [
                'fb_id' => $conversation->contact['id'],
            ],
            [
                'first_name' => $conversation->contact['first_name'],
                'last_name' => $conversation->contact['last_name'],
                'picture' => $conversation->contact['profile_pic'],
            ],
        );

        // protected fields
        $contact->fb_id = $conversation->contact['id'];
        $contact->status = $contact->status ?? self::STATUS_NEW;
        $contact->save();

        return $contact;
    }

    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getStatus()
    {
        if ($this->status == self::STATUS_NEW) {
            return trans('messages.contact.status.' . $this->status);
        } else {
            return trans('messages.contact.updated_at', [
                'time' => $this->updated_at->diffForHumans(),
            ]);
        }
    }

    public function getCustomerOrder()
    {
        $order = $this->customerOrders()->first();

        // return new of not exist
        if (!$order) {
            $order = new CustomerOrder();
            $order->contact_id = $this->id;
            $order->status = CustomerOrder::STATUS_NEW;
            $order->save();
        }

        return $order;
    }
}
