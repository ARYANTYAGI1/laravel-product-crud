<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
            max-width: 600px;
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

        /* Error message styling */
        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Form input and button styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input, textarea {
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }

        input:focus, textarea:focus {
            border-color: #007BFF;
            outline: none;
        }

        button {
            padding: 12px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838;
        }

        /* Back link styling */
        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
        }

        .back-link:hover {
            background-color: #0056b3;
        }

        /* Responsive design for smaller screens */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                width: 90%;
            }

            button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Edit Product</h1>

        <!-- Display any validation errors -->
        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Product edit form -->
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $product->name }}" required>
    <textarea name="description" required>{{ $product->description }}</textarea>
    <input type="number" name="price" value="{{ $product->price }}" required>
    <input type="number" name="quantity" value="{{ $product->quantity }}" required>

    <!-- Current image preview -->
    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" style="max-width: 100px;">
    @endif

    <!-- Upload new image -->
    <input type="file" name="image" accept="image/*">
    <button type="submit">Update Product</button>
</form>


        <a href="{{ route('products.index') }}" class="back-link">Back to Product List</a>
    </div>

</body>
</html>
