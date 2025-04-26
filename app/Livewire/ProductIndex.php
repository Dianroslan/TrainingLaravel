<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;


class ProductIndex extends Component
{
    use WithPagination;
    public $name, $description, $price, $id;
    public $updateMode = false;

    protected $rules =[
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
    ];

    public function render()
    {
        

        $data['products']= Product::paginate(10);
        //dd($data['product']);
        return view('livewire.product-index', $data);
    }

    public function save()
    {
        $this->validate();
        $input['name'] = $this->name;
        $input['description'] = $this->description;
        $input['price'] = $this->price;
        

        Product::create($input);
        $this->reset(['name', 'description', 'price']);
        session()->flash('message', 'Product Added');

        if($this->updateMode) {
            $product= Product::find($this->id);
            $product->update($input);
            session()->flash('message', 'Product Updated');
            $this->updateMode = false;
        } else {
            $product = Product::create($input);
            session()->flash('message', 'Product Created');
        }
        $this->reset(['name', 'description', 'price']);

    }

    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Product Deleted');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->id = $id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->updateMode = true;
    }   
    


}