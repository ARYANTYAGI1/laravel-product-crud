<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }

        /* Main container styling */
        .container {
            width: 100%;
            max-width: 1000px;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        /* Heading styling */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Success message styling */
        .success-message {
            color: green;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Actions column styling */
        td a, td form button {
            color: #007BFF;
            text-decoration: none;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 14px;
        }

        td a:hover, td form button:hover {
            text-decoration: underline;
        }

        /* Add New Product link styling */
        .add-new-product {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            text-align: center;
        }

        .add-new-product:hover {
            background-color: #218838;
        }

        /* Responsive design for smaller screens */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                width: 90%;
            }

            table {
                font-size: 14px;
            }

            .add-new-product {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Product List</h1>

        <!-- Display success message if available -->
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <!-- List of products -->
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>CreatedBy</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->creator->name ?? 'N/A' }}</td>
                <td>
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="max-width: 100px;">
                    @endif
                </td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>

        </table>

        @if(auth()->user()->userType != 1)
    <a href="{{ route('products.create') }}" class="add-new-product">Add New Product</a>
@endif

        <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" style="background-color: #ff4d4d; color: white; border: none; padding: 10px 20px; font-size: 16px; cursor: pointer; border-radius: 5px; transition: background-color 0.3s ease;">
        Logout
    </button>
</form>

    </div>

</body>
</html>
