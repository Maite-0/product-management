<x-layout>

    <head>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <h1 class="title">{{ auth()->user()->username }}'s Products</h1>

    <!-- Search Input Field and Create Button -->
    <div class="mb-4 flex items-center justify-between">
        <!-- Create Product Button -->
        <div x-data="{ open: false }">
            <!-- Add Product Button (Restored styling) -->
            <button @click="open = true"
                class="w-[100%] py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Add Product
            </button>

            <!-- Modal for Creating Product -->

            <div x-show="open" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg w-1/3 max-h-[60vh] overflow-y-auto">
                    <h2 class="text-xl font-semibold mb-4 sticky top-0 bg-white p-4 z-10 shadow-md">Create New Product
                    </h2>

                    <!-- Product Creation Form -->
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Product Title</label>
                            <input type="text" id="title" name="title"
                                class="input w-full py-2 px-4 rounded-lg" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" class="input w-full py-2 px-4 rounded-lg" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" id="price" name="price"
                                class="input w-full py-2 px-4 rounded-lg" required>
                        </div>

                        <div class="mb-4">
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                            <input type="number" id="stock" name="stock"
                                class="input w-full py-2 px-4 rounded-lg" required>
                        </div>

                        <div class="mb-4">
                            <label for="image_url" class="block text-sm font-medium text-gray-700">Image URL</label>
                            <input type="text" id="image_url" name="image_url"
                                class="input w-full py-2 px-4 rounded-lg">
                        </div>

                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <input type="text" id="category" name="category"
                                class="input w-full py-2 px-4 rounded-lg" required>
                        </div>

                        <div class="mb-4">
                            <label for="sku" class="block text-sm font-medium text-gray-700">SKU (Stock Keeping
                                Unit)</label>
                            <input type="text" id="sku" name="sku"
                                class="input w-full py-2 px-4 rounded-lg" required>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="status" name="status" class="input w-full py-2 px-4 rounded-lg" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="owner_email" class="block text-sm font-medium text-gray-700">Owner Email</label>
                            <input type="email" id="owner_email" name="owner_email"
                                class="input w-full py-2 px-4 rounded-lg" required>
                        </div>

                        <div class="mb-4">
                            <label for="owner_mobilenumber" class="block text-sm font-medium text-gray-700">Owner Mobile
                                Number</label>
                            <input type="text" id="owner_mobilenumber" name="owner_mobilenumber"
                                class="input w-full py-2 px-4 rounded-lg" required>
                        </div>

                        <div class="flex justify-between">
                            <button type="submit"
                                class="py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-400">Save</button>
                            <button type="button" @click="open = false"
                                class="py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-400">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Search Form -->
        <form action="{{ route('products.index') }}" method="GET" class="flex items-center space-x-2 w-[45%]">
            <input type="text" name="search" value="{{ request()->get('search') }}"
                class="input w-full py-[0.8rem] px-4 rounded-lg" placeholder="Search Products...">
        </form>
    </div>

    <!-- Products Table -->
    <div class="overflow-x-auto shadow-lg border-b border-gray-200 sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="bg-gray-100 text-xs uppercase font-medium text-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3">Product Title</th>
                    <th scope="col" class="px-6 py-3">Price</th>
                    <th scope="col" class="px-6 py-3">Stock</th>
                    <th scope="col" class="px-6 py-3">Category</th>
                    <th scope="col" class="px-6 py-3">Owner Email</th> <!-- New Column -->
                    <th scope="col" class="px-6 py-3">Owner Mobile Number</th> <!-- New Column -->
                    <th scope="col" class="px-6 py-3 min-w-[150px]">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $product->title }}</td>
                        <td class="px-6 py-4">${{ number_format($product->price, 2) }}</td>
                        <td class="px-6 py-4">{{ $product->stock }}</td>
                        <td class="px-6 py-4">{{ $product->category }}</td>
                        <td class="px-6 py-4">{{ $product->owner_email ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $product->owner_mobilenumber ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            <div class="inline-flex space-x-4">
                                <!-- View Icon -->
                                <button class="text-blue-600 hover:text-blue-900 open-modal-btn"
                                    data-product-id="{{ $product->id }}">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 19a8 8 0 111.414-1.414M21 21l-4.35-4.35" />
                                    </svg>
                                </button>

                                <!-- Delete Icon -->
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>


    <script>
        // Add event listener for all buttons to open the modal
        document.querySelectorAll('.open-modal-btn').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                fetchProductDetails(productId);
            });
        });

        document.querySelectorAll('.cancel-edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('product-modal').style.display = 'none';
            });
        });

        // Function to fetch product details via AJAX
        function fetchProductDetails(productId) {
            fetch(`/product/${productId}/details`)
                .then(response => response.json())
                .then(data => {
                    // Populate modal with the fetched product data
                    document.getElementById('modal-title').value = data.title || '';
                    document.getElementById('modal-description').value = data.description || '';
                    document.getElementById('modal-price').value = data.price || '';
                    document.getElementById('modal-stock').value = data.stock || '';
                    document.getElementById('modal-category').value = data.category || '';
                    document.getElementById('modal-ownerMobile').value = data.owner_mobilenumber || '';
                    document.getElementById('modal-ownerEmail').value = data.owner_email || '';

                    // Update form action URL to include the product ID
                    const form = document.querySelector('#edit-product-form');
                    const route = `{{ route('products.update', ':id') }}`.replace(':id', data?.id);
                    form.action = route;
                    // Show the modal
                    document.getElementById('product-modal').style.display = 'flex';
                })
                .catch(error => {
                    console.error('Error fetching product details:', error);
                });
        }

        // Close the modal when the "Close" button is clicked
        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('product-modal').style.display = 'none';
        });

        // Close modal when clicking the "Cancel" button
        document.getElementById('.cancel-edit').addEventListener('click', function() {
            document.getElementById('product-modal').style.display = 'none';
        });

        // Add this script to your Blade view
        document.getElementById("edit-product-form").addEventListener("submit", function(event) {
            var form = event.target;

            // Check if the form is valid using HTML5 validation
            if (!form.checkValidity()) {
                event.preventDefault(); // Prevent form submission if not valid
                return false;
            }
        });
    </script>

    <!-- Modal to display product details -->
    <div id="product-modal"
        class="fixed top-0 left-0 w-full h-full bg-gray-600 bg-opacity-50 flex items-center justify-center z-50"
        style="display:none;">
        <div class="bg-white p-6 rounded max-w-lg w-full">
            <h2 class="text-xl font-semibold mb-4 sticky top-0 bg-white p-4 z-10 shadow-md">View or Edit Product</h2>

            <!-- Edit product details form -->
            @if (isset($product))
            <form id="edit-product-form" action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Editable product fields -->
                <div class="mb-4">
                    <label for="modal-title" class="block text-sm font-medium text-gray-700">Product Title</label>
                    <input type="text" id="modal-title" name="title" class="input w-full py-2 px-4 rounded-lg"
                        value="{{ old('title', $product->title) }}">
                    @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="modal-description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="modal-description" name="description" class="input w-full py-2 px-4 rounded-lg">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="modal-price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" id="modal-price" name="price" class="input w-full py-2 px-4 rounded-lg"
                        value="{{ old('price', $product->price) }}">
                    @error('price')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="modal-stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" id="modal-stock" name="stock" class="input w-full py-2 px-4 rounded-lg"
                        value="{{ old('stock', $product->stock) }}">
                    @error('stock')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="modal-category" class="block text-sm font-medium text-gray-700">Category</label>
                    <input type="text" id="modal-category" name="category"
                        class="input w-full py-2 px-4 rounded-lg" value="{{ old('category', $product->category) }}">
                    @error('category')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="modal-ownerMobile" class="block text-sm font-medium text-gray-700">Owner Mobile
                        Number</label>
                    <input type="text" id="modal-ownerMobile" name="owner_mobilenumber"
                        class="input w-full py-2 px-4 rounded-lg"
                        value="{{ old('owner_mobilenumber', $product->owner_mobilenumber) }}">
                    @error('owner_mobilenumber')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="modal-ownerEmail" class="block text-sm font-medium text-gray-700">Owner Email</label>
                    <input type="email" id="modal-ownerEmail" name="owner_email"
                        class="input w-full py-2 px-4 rounded-lg"
                        value="{{ old('owner_email', $product->owner_email) }}">
                    @error('owner_email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-between">
                    <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-400">Save
                        Changes</button>
                    <button 
                        class="py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-400 cancel-edit-btn">Cancel</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</x-layout>
