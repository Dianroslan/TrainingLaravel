
<div class="flex flex-col">
    <h2>{{ $updateMode ? 'Edit Product': 'Add Product'}}</h2>
    <form class="space-y-2" wire:submit.prevent="save">

        <flux:input 
            wire:model="name"
            label="Name" 
            placeholder="Product Name" 
            class="w-1/3" />
        <flux:textarea
            wire:model="description"
            label="Description"
            placeholder="Describe your Product..."
        />
        <flux:input
        wire:model="price" 
        label="Price (RM)"
        placeholder="Product Price"
        />
        <flux:button variant="primary" type="submit">
            Submit
        </flux:button>
    </form>
    <br>
    @if(session('message'))
    <div class="text-green-600" >{{ session('message') }}</div><br>
    @endif
    <table class="w-full border border-grey-200">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $index => $product)
                
            <tr>
                <td class="border">{{ ($products->currentPage() -1) *$products->perPage() + ($index+1)}}</td>
                <td class="border px-2">{{ $product['name'] }}</td>
                <td class="border px-2">{{ $product['description'] }}</td>
                <td class="border"><span class="flex justify-center">{{ $product['price'] }}</span></td>
                <td class="border p-2">
                    <flux:button button wire:click="edit({{ $product['id'] }})" variant="primary">Edit</flux:button>
                    <flux:button button wire:click="delete({{ $product['id'] }})" variant="danger">Delete</flux:button>
                </td>
            </tr>
            @empty
                <tr>
                    No data  
                </tr>
            @endforelse
        </tbody>
    </table>
    <div>
        {{$products->links()}}
    </div>
</div>