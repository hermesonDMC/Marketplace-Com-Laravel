<?php

namespace App;

use App\Notifications\StoreReceiveNewOrder;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;

class Store extends Model
{
    use Slug;
    protected $fillable = ['name', 'description', 'phone', 'mobile_phone', 'logo','slug'];

    /**
     * Get the options for generating the slug.
     */
    // public function getSlugOptions() : SlugOptions
    // {
    //     return SlugOptions::create()
    //         ->generateSlugsFrom('name')
    //         ->saveSlugsTo('slug');
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function orders()
    {
        return $this->belongsToMany(UserOrder::class, 'order_store', null, 'order_id');
    }
    public function notifyStoreOwners(array $storesId = [])
    {
        $stores = $this->whereIn('id', $storesId)->get();

        $stores->map(function($store){
            return $store->user;
        })->each->notify(new StoreReceiveNewOrder);
    }
}

