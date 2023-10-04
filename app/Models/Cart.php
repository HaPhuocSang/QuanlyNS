<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $items = [];
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $mathang = ['qty' => 0, 'price' => $item->promotion_price == 0 ? $item->unit_price : $item->promotion_price, 'item' => $item];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $mathang = $this->items[$id];
            }
        }

        $mathang['qty']++;
        $mathang['price'] = ($item->promotion_price == 0 ? $item->unit_price : $item->promotion_price) * $mathang['qty'];
        $this->items[$id] = $mathang;
        $this->totalQty++;
        $this->totalPrice += ($item->promotion_price == 0 ? $item->unit_price : $item->promotion_price);
    }

    public function addMany($item, $id, $soluong)
    {
        $mathang = ['qty' => 0, 'price' => $item->promotion_price == 0 ? $item->unit_price : $item->promotion_price, 'item' => $item];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $mathang = $this->items[$id];
            }
        }

        $mathang['qty'] += $soluong;
        $mathang['price'] = ($item->promotion_price == 0 ? $item->unit_price : $item->promotion_price) * $mathang['qty'];
        $this->items[$id] = $mathang;
        $this->totalQty += $soluong;
        $this->totalPrice += ($item->promotion_price == 0 ? $item->unit_price : $item->promotion_price) * $soluong;
    }

    public function reduceByOne($id)
    {
        if (array_key_exists($id, $this->items)) {
            $this->items[$id]['qty']--;
            $item = $this->items[$id]['item'];
            $price = ($item['promotion_price'] == 0) ? $item['unit_price'] : $item['promotion_price'];

            $this->totalQty--;
            $this->totalPrice -= $price;

            if ($this->items[$id]['qty'] <= 0) {
                unset($this->items[$id]);
            }
        }
    }

    public function removeItem($id)
    {
        if (array_key_exists($id, $this->items)) {
            $this->totalQty -= $this->items[$id]['qty'];
            $item = $this->items[$id]['item'];
            $price = ($item['promotion_price'] == 0) ? $item['unit_price'] : $item['promotion_price'];

            $this->totalPrice -= $price * $this->items[$id]['qty'];
            unset($this->items[$id]);
        }
    }

    public function updateQuantity($id, $newQuantity)
    {
        if ($newQuantity > 0 && array_key_exists($id, $this->items)) {
            $item = $this->items[$id]['item'];
            $price = ($item['promotion_price'] == 0) ? $item['unit_price'] : $item['promotion_price'];

            $oldQuantity = $this->items[$id]['qty'];
            $this->items[$id]['qty'] = $newQuantity;
            $this->items[$id]['price'] = $price * $newQuantity;

            $this->totalQty += $newQuantity - $oldQuantity;
            $this->totalPrice += $price * ($newQuantity - $oldQuantity);
        }
    }

    public function increaseQuantity($id)
    {
        if (array_key_exists($id, $this->items)) {
            $this->items[$id]['qty']++;
            $item = $this->items[$id]['item'];
            $price = ($item['promotion_price'] == 0) ? $item['unit_price'] : $item['promotion_price'];

            $this->totalQty++;
            $this->totalPrice += $price;
        }
    }

    public function decreaseQuantity($id)
    {
        if (array_key_exists($id, $this->items)) {
            if ($this->items[$id]['qty'] > 1) {
                $this->items[$id]['qty']--;
                $item = $this->items[$id]['item'];
                $price = ($item['promotion_price'] == 0) ? $item['unit_price'] : $item['promotion_price'];

                $this->totalQty--;
                $this->totalPrice -= $price;
            }
        }
    }

    public function isEmpty()
    {
        return empty($this->items);
    }
}

