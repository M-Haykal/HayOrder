<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Table;
use App\Models\Category;

class MenuRestaurant extends Component
{

    public $restaurant;
    public $menus;
    public $tables;

    public $categories;

    public function mount($slug, $table)
    {
        $this->restaurant = Restaurant::where('slug', $slug)->firstOrFail();

        $this->tables = Table::where('restaurant_id', $this->restaurant->id)->where('table_number', $table)->firstOrFail();

        $this->categories = $this->restaurant->categories()->get();

        $this->menus = $this->restaurant->menus()->get();
    }

    public function render()
    {
        $menus = Menu::where('restaurant_id', $this->restaurant->id)->get();

        return view('livewire.menu-restaurant', [
            'menus' => $menus,
            'restaurant' => $this->restaurant,
            'table_number' => $this->tables->table_number,
            'categories' => $this->categories,
        ]);
    }
}
